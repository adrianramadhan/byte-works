<?php
require "../../koneksi.php"; // Memuat file koneksi.php untuk menghubungkan ke database

$id = $_GET['p']; // Mengambil nilai 'p' dari query string untuk mendapatkan ID produk yang akan di-update atau dihapus

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id WHERE a.id='$id'");
$data = mysqli_fetch_array($query); // Menjalankan query untuk mendapatkan data produk berdasarkan ID

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'"); // Menjalankan query untuk mendapatkan daftar kategori selain kategori produk saat ini

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Berbagai meta dan link untuk konfigurasi halaman -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
</head>

<style>
    form div {
        margin-bottom: 10px;
    }
</style>

<body>
    <?php require "../component/navbar.php" ?> // Memuat file navbar.php yang berisi navigasi ?>

    <div class="container mt-5">
        <h2>Detail Produk</h2>

        <!-- Form untuk mengedit produk -->
        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama'] ?>" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori'] ?></option>
                        <!-- Looping untuk menampilkan daftar kategori selain kategori produk saat ini -->
                        <?php
                        while ($dataKategori = mysqli_fetch_array($queryKategori)) {
                        ?>
                            <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <!-- Penutup div yang telah dijelaskan sebelumnya untuk mengelompokkan elemen "Kategori" produk. -->
                
                <div>
                    <!-- Div baru untuk mengelompokkan elemen "Harga" produk. -->
                    
                    <label for="harga">Harga</label>
                    <!-- Label untuk input harga produk. -->
                    
                    <input type="number" class="form-control" value="<?php echo $data['harga'] ?>" name="harga" required>
                    <!-- Input tipe angka (number) untuk mengisi harga produk. Value diambil dari data produk yang sudah di-fetch dari database. Atribut "required" menandakan bahwa kolom ini harus diisi. -->
                    
                </div>
                <div>
                    <!-- Div baru untuk mengelompokkan elemen "Foto Produk" dan gambar produk. -->
                    
                    <label for="currentFoto">Foto Produk</label>
                    <!-- Label untuk menunjukkan gambar produk yang sudah ada. -->
                    
                    <br>
                    <!-- Tag HTML untuk membuat baris baru (enter). -->
                    
                    <img src="../../images/<?php echo $data['foto'] ?>" alt="" width="300px">
                    <!-- Elemen gambar (img) untuk menampilkan foto produk yang sudah ada. Sumber gambar diambil dari direktori "images" dan nama file gambar diambil dari data produk yang sudah di-fetch dari database. Atribut "alt" digunakan sebagai alternatif teks jika gambar tidak dapat ditampilkan. Lebar gambar diatur menjadi 300px. -->
                    
                </div>
                
                <div>
                    <!-- Div baru untuk mengelompokkan elemen "Foto" yang digunakan untuk mengunggah foto produk baru. -->
                    
                    <label for="foto">Foto</label>
                    <!-- Label untuk input file foto produk. -->
                    
                    <input type="file" name="foto" id="foto" class="form-control" width="300px">
                    <!-- Input tipe "file" untuk mengunggah foto produk baru. Ketika tombol "Browse" pada input ini ditekan, pengguna dapat memilih foto dari perangkat mereka. Atribut "class" digunakan untuk mengatur tampilan input agar sesuai dengan gaya form. Perlu diketahui bahwa atribut "width" tidak berlaku untuk input tipe "file". -->
                    
                </div>
                <!-- Penutup div yang digunakan sebelumnya untuk mengelompokkan elemen "Foto" produk yang digunakan untuk mengunggah foto produk baru. -->
                
                <div>
                    <!-- Div baru untuk mengelompokkan elemen "Detail" produk. -->
                    
                    <label for="detail">Detail</label>
                    <!-- Label untuk input detail produk. -->
                    
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"><?php echo $data['detail'] ?></textarea>
                    <!-- Textarea untuk mengisi detail produk. Isi textarea diambil dari data produk yang sudah di-fetch dari database. Atribut "cols" dan "rows" mengatur lebar dan tinggi textarea. Atribut "class" digunakan untuk mengatur tampilan textarea agar sesuai dengan gaya form. -->
                    
                </div>
                <div>
                    <!-- Div baru untuk mengelompokkan elemen "Ketersediaan Stok" produk. -->
                    
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <!-- Label untuk input ketersediaan stok produk. -->
                    
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <!-- Label untuk input ketersediaan stok produk. -->
                        
                        <option value="<?php echo $data['ketersediaan_stok'] ?>"><?php echo $data['ketersediaan_stok'] ?></option>
                        <!-- Opsi pertama dalam dropdown menampilkan ketersediaan stok produk saat ini, diambil dari data produk yang sudah di-fetch dari database. -->
                        
                        <?php
                        if ($data['ketersediaan_stok'] == 'tersedia') {
                        ?>
                            <option value="habis">habis</option>
                        <?php
                        } else {
                        ?>
                            <option value="tersedia">tersedia</option>
                        <?php
                        }
                        ?>
                        <!-- Opsi kedua dalam dropdown menawarkan opsi untuk mengubah ketersediaan stok menjadi "habis" atau "tersedia", tergantung pada ketersediaan stok produk saat ini. Jika ketersediaan stok saat ini adalah "tersedia", maka opsi kedua akan menawarkan untuk mengubahnya menjadi "habis", dan sebaliknya. -->
                        
                    </select>
                </div>
                <!-- Penutup div yang digunakan sebelumnya untuk mengelompokkan elemen "Ketersediaan Stok" produk. -->
                
                <button type="submit" name="simpan" class="btn btn-primary mt-2">
                    Update
                </button>
                <!-- Penutup div yang digunakan sebelumnya untuk mengelompokkan elemen "Ketersediaan Stok" produk. -->
                
                <button type="submit" name="delete" class="btn btn-danger mt-2">
                    Hapus
                </button>
                <!-- Tombol "Hapus" untuk menghapus produk dari database. Tombol ini akan mengeksekusi proses penghapusan data produk dari database saat ditekan. -->
                
            </form>
            <!-- Penutup form untuk mengakhiri form yang digunakan untuk mengedit atau menghapus produk. -->
            
            <?php
            if (isset($_POST['simpan'])) {
                <!-- Penutup form untuk mengakhiri form yang digunakan untuk mengedit atau menghapus produk. -->
                $nama = htmlspecialchars($_POST['nama']);
                <!-- Penutup form untuk mengakhiri form yang digunakan untuk mengedit atau menghapus produk. -->
                $kategori = htmlspecialchars($_POST['kategori']);
                // Mengambil dan mengamankan data kategori produk yang telah diperbarui dari form.
                $harga = htmlspecialchars($_POST['harga']);
                // Mengambil dan mengamankan data harga produk yang telah diperbarui dari form.
                $detail = htmlspecialchars($_POST['detail']);
                // Mengambil dan mengamankan data detail produk yang telah diperbarui dari form.
                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);
                // Mengambil dan mengamankan data ketersediaan stok produk yang telah diperbarui dari form.

                $target_dir = "../../images/";
                // Direktori tempat menyimpan foto baru yang akan diunggah. "../../images/" merupakan direktori relatif dari halaman ini.
                $nama_file = basename($_FILES['foto']['name']);
                // Mengambil nama file dari foto yang diunggah menggunakan fungsi basename().
                $target_file = $target_dir . $nama_file;
                // Menyatukan direktori target dengan nama file foto untuk mendapatkan alamat file lengkap.
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                // Mendapatkan ekstensi file foto dengan fungsi pathinfo() dan mengubahnya menjadi huruf kecil dengan strtolower().
                $image_size = $_FILES['foto']['size'];
                // Mengambil ukuran file foto yang diunggah.
                $random_name = generateRandomString(20);
                // Memanggil fungsi generateRandomString(20) untuk menghasilkan string acak sepanjang 20 karakter yang akan digunakan sebagai nama file baru.
                $new_name = $random_name . "." . $imageFileType;
                // Menggabungkan nama file baru yang dihasilkan dengan ekstensi file foto untuk mendapatkan nama file yang unik.

                if ($nama == '' || $kategori == '' || $harga == '') {
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Isian Wajib Diisi
                    </div>
                    <!-- Menampilkan pesan peringatan dalam bentuk div dengan class "alert alert-warning". Pesan tersebut memberitahu pengguna bahwa ada isian yang harus diisi karena merupakan data wajib. -->
            
                    <?php
                } else {
                    // Jika semua field telah diisi (tidak ada yang kosong), maka lanjutkan dengan menyimpan perubahan data produk.
                    
                    $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id='$id'");
                    // Melakukan query untuk memperbarui data produk di dalam database dengan nilai-nilai yang telah diperbarui dari form.

                    if ($nama_file != '') {
                        // Memeriksa apakah ada foto baru yang diunggah (nama file tidak kosong).
                        
                        if ($image_size > 5000000) {
                            // Memeriksa apakah ada foto baru yang diunggah (nama file tidak kosong).
                    ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                File Tidak Boleh lebih dari 5mb
                            </div>
                            // Memeriksa apakah ada foto baru yang diunggah (nama file tidak kosong).
            
                            <?php
                        } else {
                            // Memeriksa apakah ada foto baru yang diunggah (nama file tidak kosong).
                            
                            if ($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif') {
                                // Memeriksa apakah ada foto baru yang diunggah (nama file tidak kosong).
                                
                            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    Format File tidak didukung
                                </div>
                                <!-- Jika format file foto tidak sesuai dengan yang diizinkan, tampilkan pesan peringatan dalam bentuk div dengan class "alert alert-warning". Pesan tersebut memberitahu pengguna bahwa format file yang diunggah tidak didukung. -->
            
                                <?php
                            } else {
                                <!-- Jika format file foto tidak sesuai dengan yang diizinkan, tampilkan pesan peringatan dalam bentuk div dengan class "alert alert-warning". Pesan tersebut memberitahu pengguna bahwa format file yang diunggah tidak didukung. -->
                                     
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $random_name  . "." . $imageFileType);
                                <!-- Jika format file foto tidak sesuai dengan yang diizinkan, tampilkan pesan peringatan dalam bentuk div dengan class "alert alert-warning". Pesan tersebut memberitahu pengguna bahwa format file yang diunggah tidak didukung. -->

                                $queryUpdate = mysqli_query($conn, "UPDATE produk SET foto='$new_name' WHERE id='$id'");
                                // Melakukan query untuk memperbarui nama file foto pada data produk di dalam database sesuai dengan nilai $new_name yang baru.

                                if ($queryUpdate) {
                                    // Jika proses penyimpanan perubahan data produk ke dalam database berhasil:
                                ?>
                                    <div class="alert alert-success mt-3" role="alert">
                                        Produk Berhasil Terupdate
                                    </div>
                                    <!-- Tampilkan pesan berhasil dalam bentuk div dengan class "alert alert-success". Pesan tersebut memberitahu pengguna bahwa produk telah berhasil diperbarui. -->

                                    <meta http-equiv="refresh" content="2; url=produk.php">
                                    <!-- Setelah 2 detik, redirect halaman ke "produk.php" menggunakan meta tag http-equiv. Halaman "produk.php" adalah halaman yang menampilkan daftar produk setelah update berhasil dilakukan. --> 
                    <?php
                                } else {
                                    // Jika proses penyimpanan perubahan data produk ke dalam database gagal:
                                    
                                    mysqli_error($conn);
                                    // Tampilkan pesan error dari database jika ada.
                                }
                            }
                        }
                    }
                }
            }
            if (isset($_POST['delete'])) {
                // Memeriksa apakah tombol "Hapus" telah ditekan (data yang dihapus dikirim melalui POST).
                $queryGetFoto = mysqli_query($conn, "SELECT foto FROM produk WHERE id='$id'");
                // Melakukan query untuk mendapatkan nama file foto produk yang akan dihapus dari database.
                $foto = mysqli_fetch_array($queryGetFoto);
                // Mengambil data hasil query yang berisi nama file foto produk dari database.
                $target_dir = "../../images/";
                // Menyimpan direktori tempat foto-foto produk disimpan.
                $target_file = $target_dir . $foto['foto'];
                // Menyusun alamat file foto yang akan dihapus sesuai dengan direktori dan nama file yang diperoleh dari database.
                unlink($target_file);
                // Menghapus file foto dari server menggunakan fungsi unlink(). Foto yang dihapus sesuai dengan alamat yang telah disusun sebelumnya.

                $queryDelete = mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");
                // Melakukan query untuk menghapus data produk dari database berdasarkan ID yang diambil dari query string.
                
                if ($queryDelete) {
                    // Jika proses penghapusan data produk dari database berhasil:
                    
                    ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        Produk Berhasil Dihapus
                    </div>
                    <!-- Tampilkan pesan berhasil dalam bentuk div dengan class "alert alert-danger". Pesan tersebut memberitahu pengguna bahwa produk telah berhasil dihapus. -->
            
                    <meta http-equiv="refresh" content="0; url=produk.php">
                    <!-- Setelah 0 detik (segera), redirect halaman ke "produk.php" menggunakan meta tag http-equiv. Halaman "produk.php" adalah halaman yang menampilkan daftar produk setelah data produk berhasil dihapus. -->
            <?php
                }
            }
            ?>
        </div>
    </div>

    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
