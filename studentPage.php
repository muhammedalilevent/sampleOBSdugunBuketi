<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" media="screen"/>
    <link href="style.css" rel="stylesheet" media="screen"/>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head>
<body style="background-color:#E6E6E6">
<header>
    <div class="row baslik">
        <div class="page-header selam">
            <h1 class="text-white mt-3">
                <img src="obsLogo.png" class="rounded-circle logo" height="150px" width="150px"/>
                Öğrenci Bilgi Sistemi
            </h1>
        </div>
    </div>
</header>

<?php
include('conn.php');
$sql = "Select * from users where userNo='" . $_COOKIE['userNo'] . "'";
$results = mysqli_query($connect, $sql) or die("Bağlantı Başarısız");
$user = mysqli_fetch_array($results);
?>

<div class="container">
    <div class="row butonlar">
        <a class="btn btn-success mr-2" href="sclasses.php">Ders Seçim</a>
        <a class="btn btn-danger" href="index.php?action=loqout">Çıkış Yap</a>
    </div>
    <br>
    <div class="">
        <table class="table table-striped ml-3 mt-3">
            <tr>
                <td class=""><label for="managerID">Öğrenci Numarası:</label></td>
                <td><?php echo $user['userNo'] ?> </td>
            </tr>
            <tr>
                <td><label for="username">Adı:</label></td>
                <td><?php echo $user['name'] ?> </td>
            </tr>
            <tr>
                <td><label for="lastmname">Soyadı:</label></td>
                <td><?php echo $user['surname'] ?> </td>

            </tr>
            <tr>
                <td><label for="age">Yaş:</label></td>
                <td><?php echo $user['age'] ?> </td>
            </tr>

            <tr>
                <td><label for="createdAt">Kayıt Tarihi :</label></td>
                <td><?php echo $user['createdAt'] ?> </td>
            </tr>

        </table>

        <br><br>

    </div>
</div>
</body>
</html>