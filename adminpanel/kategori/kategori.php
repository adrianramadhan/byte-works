<?php
// untuk memastikan koneksi ke database dan menampilkan navbar jika ada
require "../../koneksi.php";
require "../component/navbar.php";

// melakukan query ke database untuk mengambil semua data dari tabel kategori
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

// menghitung jumlah data kategori yang telah diambil dari database
$jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!-- HTML Section -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>

    <!-- Menambahkan file eksternal CSS Bootstrap dan Font Awesome untuk mengatur tampilan dan ikon pada halaman. -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../fontawesome/css/all.min.css">
</head>

<!-- CSS internal -->
<style>
.no-decoration {
    text-decoration: none;
    color: #212529bf;
}
</style>

<body>
    <!-- Section Tambah Kategori -->
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-home"></i><a href="../index.php" class="no-decoration"> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kategori
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah kategori</h3>

            <!-- form tambah kategori -->
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input class="form-control" type="text" id="kategori" name="kategori"
                        placeholder="Input Nama Kategori">
                </div>
                <div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                    </div>
                </div>
            </form>

            <!-- fungsi menambah kategori -->
            <?php
            if (isset($_POST['simpan_kategori'])) {
                $kategori = htmlspecialchars($_POST['kategori']);
                $queryExist = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama='$kategori'");

                $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                if ($jumlahDataKategoriBaru > 0) {
            ?>

            <!-- alert yang muncul apabila kategori sudah ada-->
            <div class="alert alert-warning mt-2" role="alert">
                Kategori Sudah Ada
            </div>
            <?php
                } else {
                    $querySimpan = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");

                    if ($querySimpan) {
                    ?>

            <!-- alert yang muncul apabila kategori berhasil disimpan-->
            <div class="alert alert-success mt-2" role="alert">
                Kategori Berhasil Disimpan
            </div>

            <meta http-equiv="refresh" content="0; url=kategori.php">
            <?php
                    }
                }
            }
            ?>
        </div>

        <!-- list kategori yang sudah ditambahkan akan muncul di bawah form tambah kategori -->
        <div class="mt-3">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                        <!--  fungsi pencarian data -->
                        <?php
                        $number = 1;
                        // pengkondisian apabila kategori tidak ada
                        if ($jumlahKategori == 0) {
                        ?>
                        <td class="text-center" colspan="3">Data Tidak Tersedia</td>
                        <?php
                        
                        // pengkondisian apabila ada kategori yang sudah ditambahkan
                        } else {   
                            while ($data = mysqli_fetch_array($queryKategori)) {
                            ?>
                        <tr>
                            <td><?php echo $number ?></td>
                            <td><?php echo $data['nama'] ?></td>
                            <td>
                                <a href="kategori-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                                $number++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- untuk memanggil file bootstrap -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../fontawesome/js/all.min.js"></script>
</body>

</html>
