    <?php
    require "../../../koneksi.php";
    $queryProduk = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id");
    $jumlahProduk = mysqli_num_rows($queryProduk);

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

    function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produk</title>
        <link rel="stylesheet" href="../../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../../assets/fontawesome/css/all.min.css">
    </head>

    <style>
        .no-decoration {
            text-decoration: none;
            color: #212529bf;
        }
    </style>

    <body>
        <?php require "../../component/navbar-admin.php" ?>
        <div class="container mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-home"></i><a href="../dashboard/index.php" class="no-decoration"> Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Produk
                    </li>
                </ol>
            </nav>

            <div class="my-5 col-12 col-md-6">
                <h3>Tambah Produk</h3>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mt-2">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" autocomplete="off">
                    </div>
                    <div class="mt-2">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <?php
                            while ($data = mysqli_fetch_array($queryKategori)) {
                            ?>
                                <option value="<?php echo $data['id']; ?>"><?php echo $data['nama'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga">
                    </div>
                    <div class="mt-2">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div class="mt-2">
                        <label for="detail">Detail</label>
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="mt-2">
                        <label for="ketersediaan_stok">Ketersediaan Stok</label>
                        <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                            <option value="tersedia">tersedia</option>
                            <option value="habis">habis</option>
                        </select>
                        <div class="mt-2">
                            <button type="submit" name="simpan" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                </form>

                <?php
                if (isset($_POST['simpan'])) {
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                    $target_dir = "../../../assets/images/";
                    $nama_file = basename($_FILES['foto']['name']);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES['foto']['size'];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if ($nama == '' || $kategori == '' || $harga == '') {
                ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Isian Wajib Diisi!
                        </div>
                        <?php
                    } else {
                        if ($nama_file != '') {
                            if ($image_size > 5000000) {
                        ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File Tidak Boleh lebih dari 5mb
                                </div>
                                <?php
                            } else {
                                if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
                                ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        Format File tidak didukung
                                    </div>
                            <?php
                                } else {
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $random_name  . "." . $imageFileType);
                                }
                            }
                        }
                        // query insert to produk table
                        $queryTambah = mysqli_query($conn, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stok')");

                        if ($queryTambah) {
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Produk Berhasil Tersimpan
                            </div>

                            <meta http-equiv="refresh" content="2; url=produk.php">
                <?php
                        } else {
                            mysqli_error($conn);
                        }
                    }
                }
                ?>
            </div>

            <div class="mt-3">
                <h3>List Produk</h3>

                <div class="table-responsive mt-5">
                    <table class="table">
                        <thead>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Detail</th>
                            <th>Ketersediaan Stok</th>
                        </thead>
                        <tbody>
                            <?php
                            $number = 1;
                            if ($jumlahProduk > 0) {
                                while ($data = mysqli_fetch_array($queryProduk)) {
                            ?>
                                    <tr>
                                        <td><?php echo $number ?></td>
                                        <td><?php echo $data['nama'] ?></td>
                                        <td><?php echo $data['nama_kategori'] ?></td>
                                        <td><?php echo $data['harga'] ?></td>
                                        <td><?php echo $data['detail'] ?></td>
                                        <td><?php echo $data['ketersediaan_stok'] ?></td>
                                        <td> <a href="produk-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info">
                                                <i class="fas fa-search"></i>
                                            </a></td>
                                    </tr>
                                <?php
                                    $number++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="6">Data Produk Tidak Tersedia</td>
                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="../../../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../../assets/fontawesome/js/all.min.js"></script>
    </body>

    </html>