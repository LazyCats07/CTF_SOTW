<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['session_username'])) {
    header("location:login");
    exit();
}

// Query to fetch data from the database
$query = "SELECT * FROM data_order;";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$no = 0;
?>

<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>masterAdmin User</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="..\img\icon\logo.png">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/e56a8fc2bc.js" crossorigin="anonymous"></script>
    <style>
        .list-footer {
            font-size: 12px;
            margin-bottom: auto;
            color: #76a5af;
        }
        .logout-btn {
            border: 2px solid blue;
            color: blue;
            background-color: white;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: red;
            color: white;
        }
        .logout-btn:active {
            font-weight: bold;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <form class="d-flex" role="search">
                <a href="logout" class="btn logout-btn" onclick="handleLogoutClick(event)">Logout</a>
            </form>
        </div>
    </div>
</nav>

<!-- Content -->
<div class="container">
    <h1 class="me-auto">Data Rahasia Negara</h1>
    <figure>
        <blockquote class="blockquote">
            <p>Berisi data Kominfo yang hilang</p>
        </blockquote>
        <figcaption class="blockquote-footer">
            Emang boleh se lama ini masuk nya ? 😶‍🌫️😶‍🌫️😶‍🌫️😶‍🌫️
        </figcaption>
        <figcaption class="blockquote-footer">
            Klik <a href="https://drive.google.com/drive/folders/1DzSknLOl6V8Sv-egbvUcQcVY3Y2uNa0j?usp=sharing">disini</a> untuk step selanjutnya
        </figcaption>
    </figure>

    <!-- Alert -->
    <?php
    $message = $_SESSION['eksekusi'] ?? $_SESSION['hapus'] ?? $_SESSION['edit'] ?? "";
    ?>

    <?php if (!empty($message)): ?>
    <div id="myAlert" class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check" aria-hidden="true"></i>
        <strong><?php echo htmlspecialchars($message); ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(function() {
            document.querySelector('#myAlert').remove();
        }, 3000);
    </script>
    <?php endif; ?>
    <?php session_unset(); ?>
    <!-- Table -->
    <div class="table-responsive">
        <table id="dt" class="table align-middle table-hover border cell-border">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Selamat</th>
                    <th scope="col">Datang di</th>
                    <th scope="col">MBC Laboratory</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <th scope="row"><?php echo ++$no; ?></th>
                    <td><?php echo htmlspecialchars($row['id_cust']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama_cust']); ?></td>
                    <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
