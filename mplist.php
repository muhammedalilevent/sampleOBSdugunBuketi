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
                Yönetim Bilgi Sistemi
            </h1>
        </div>
    </div>
</header>

<?php
include('conn.php');
$sql = "Select * from users where role = '1' ";
$results = mysqli_query($connect, $sql) or die("Bağlantı Başarısız");
//$classes="Select className from pickedClasses where studentNumber='".$value['userNo']."'";
//$classSql = mysqli_query($connect, $classes) or die("İşlem Başarısız");
//$students = mysqli_fetch_all($results);
?>

<div class="container">

    <div class="row butonlar">
        <a type="button" class="btn btn-success mr-2"href="addUser.php" >Öğrenci Kayıt Ekle/Sil</a>
        <a type="button" class="btn btn-success mr-2" href="mplist.php">Öğrenci Listele</a>
        <a type="button" class="btn btn-danger mr-2" href="deleteUser.php">Kayıt Sil</a>
        <a type="button" class="btn btn-danger" href="index.php?action=loqout">Çıkış Yap</a>
    </div>

    <table class="table table-striped ml-3 mt-3">
        <tr>
            <th>Öğrenci No</th>
            <th>Adı</th>
            <th>Soyadı</th>
            <th>Kayıt Tarihi</th>
            <th>Aldığı Dersler</th>
        </tr>
        <?php

        $arr=array();


        foreach ($results as $value) {

            $sql = "Select className from pickedClasses where studentNumber = '".$value['id']."' ";
            $dersler = mysqli_query($connect, $sql) or die("Bağlantı Başarısız");

             foreach($dersler as $ders) {

                 if($ders['className']!=null)
                 {
                     array_push($arr, $ders['className'] );
                 }
              }

            echo '<tr><td>' . $value['userNo'] . '</td>';
            echo '<td>' . $value['name'] . '</td>';
            echo '<td>' . $value['surname'] . '</td>';
            echo '<td>' . $value['createdAt'] . '</td>';
            echo '<td> ' . implode( ", " , $arr ) . ' </td></tr>';

            $arr=array();
        }

        ?>


    </table>
</div>

</body>
</html>
