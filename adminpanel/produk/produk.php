    <?php
    require "../../koneksi.php";
    // Memuat file koneksi.php untuk menghubungkan ke database.

    $queryProduk = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id");
    // Melakukan query untuk mengambil data produk dari tabel produk dan juga mendapatkan nama kategori berdasarkan id kategori yang ada di tabel kategori.
    $jumlahProduk = mysqli_num_rows($queryProduk);
    // Menghitung jumlah produk yang ada berdasarkan hasil query.

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
    // Melakukan query untuk mengambil daftar kategori produk dari tabel kategori.

    function generateRandomString($length)
    {
        // Fungsi untuk menghasilkan random string untuk nama file foto
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    // Fungsi untuk menghasilkan random string sepanjang $length. Fungsi ini digunakan untuk membuat nama file foto produk secara acak.
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Berbagai meta dan link untuk konfigurasi halaman -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produk</title>
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../fontawesome/css/all.min.css">
    </head>

    <style>
        .no-decoration {
            text-decoration: none;
            color: #212529bf;
        }
    </style>

    <body>
        <!-- Bagian navigasi dari halaman -->
        <?php require "../component/navbar.php" ?>
        <!-- Konten utama halaman -->
        <div class="container mt-5">
            <!-- Tampilkan breadcrumb (navigasi hierarki) untuk memberikan informasi tentang posisi halaman saat ini -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <!-- Breadcrumb: Home -->
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-home"></i><a href="../index.php" class="no-decoration"> Home</a>
                    </li>
                    <!-- Breadcrumb: Produk -->
                    <li class="breadcrumb-item active" aria-current="page">
                        Produk
                    </li>
                </ol>
            </nav>

            <!-- Bagian untuk menambahkan produk baru -->
            <div class="my-5 col-12 col-md-6">
                <h3>Tambah Produk</h3>

                <!-- Form untuk menambahkan produk baru -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mt-2">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" autocomplete="off">
                    </div>
                    <div class="mt-2">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <!-- Menampilkan daftar kategori produk yang telah diambil dari database -->
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
                            <!-- Menampilkan opsi tersedia dan habis untuk ketersediaan stok produk -->
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

                    $target_dir = "../../images/";
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
                <!-- Bagian untuk menampilkan pesan berhasil atau gagal ketika menambahkan produk baru -->
            </div>

            <!-- Bagian untuk menampilkan daftar produk -->
            <div class="mt-3">
                <h3>List Produk</h3>

                <div class="table-responsive mt-5">
                    <table class="table">
                        <thead>
                            <!-- Header tabel -->
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
                                // Jika terdapat produk yang ditampilkan
                                while ($data = mysqli_fetch_array($queryProduk)) {
                                    // Lakukan iterasi untuk setiap produk yang ada
                            ?>
                                    <tr>
                                        <!-- Tampilkan data produk pada baris tabel -->
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
                                // Jika tidak ada produk yang ditampilkan
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

        <!-- Skrip untuk mengatur tampilan dengan Bootstrap dan Font Awesome -->
        <script src="../../bootstrap/js/bootstrap.min.js"></script>
        <script src="../../fontawesome/js/all.min.js"></script>
    </body>

    </html>
