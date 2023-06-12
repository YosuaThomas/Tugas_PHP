<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: login.php");
}

require "function.php";

if (isset($_POST["submit"])) {
    if (tambah($_POST) > 0) {
        echo "<script> 
               alert('data berhasil ditambahkan!');
               document.location.href = 'index.php';
             </script>";
    } else {
        echo "<script> 
        alert('data gagal ditambahkan!');    
      </script>";
    }
}

$data = query("SELECT * FROM konten");
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>List Pembelajaran</title>
    <link rel="stylesheet" href="styleindex.css">
</head>

<body>

    <div id="myDIV" class="header">
        <h2 style="margin:5px">List Pembelajaran</h2>

        <a href="logout.php"><button class="btn btn-warning">Logout</button></a>
        <br><br>

        <form action="" method="post">
            <input type="text" id="myInput" placeholder="Silahkan isi" name="kontent">
            <button type="submit" name="submit" class="btn btn-primary btn-lg">Tambah</button>
        </form>

    </div>

    <div class="container-md">
        <table class="table table-info table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Konten</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($data as $dt) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $dt["kontent"]; ?></td>
                        <td>
                            <a href="ubah.php?id=<?= $dt["id"]; ?>"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit</button></a>
                            <a href="hapus.php?id=<?= $dt["id"]; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');"><button type="button" class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>