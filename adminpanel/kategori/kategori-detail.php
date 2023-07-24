<?php
require "../../koneksi.php";

$id = $_GET['p'];

$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <?php require "../component/navbar.php" ?>

    <div class="container mt-5">
        <h2>Detail Kategori</h2>
        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="<?php echo $data['nama'] ?>">
                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                </div>
            </form>

            <?php
            if (isset($_POST['editBtn'])) {
                $kategori = htmlspecialchars($_POST['kategori']);
                if ($data['nama'] == $kategori) {
            ?>
                    <meta http-equiv="refresh" content="0; url=kategori.php">
                    <?php
                } else {
                    $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama='$kategori'");
                    $jumlahData = mysqli_num_rows($query);

                    if ($jumlahData > 0) {
                    ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori Sudah Ada
                        </div>
                        <?php
                    } else {
                        $query_simpan = mysqli_query($conn, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");

                        if ($query_simpan) {
                        ?>
                            <div class="alert alert-succeess mt-3" role="alert">
                                Kategori Berhasil Diupdate
                            </div>

                            <meta http-equiv="refresh" content="0; url=kategori.php">
                    <?php
                        }
                    }
                }
            }

            if (isset($_POST['deleteBtn'])) {
                $query_check = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$id'");
                $dataCount = mysqli_num_rows($query_check);

                if ($dataCount > 0) {
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Kategori tidak bisa dihapus karena sudah digunakan di produk
                    </div>
                <?php
                }

                $query_delete = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");
                if ($query_delete) {
                ?>
                    <div class="alert alert-danger mt-3">
                        Kategori Berhasil Dihapus
                    </div>

                    <meta http-equiv="refresh" content="2; url=kategori.php">
            <?php
                }
            }
            ?>
        </div>
    </div>

    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>