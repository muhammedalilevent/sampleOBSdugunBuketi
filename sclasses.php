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
    $sql = "SELECT c.classID, c.classCode,p.className, p.pcID from classes c LEFT JOIN pickedClasses p on c.classID =p.classID LEFT JOIN users u on p.studentNumber=u.userNo where p.studentNumber='".$_COOKIE['userId']."'";
    $sql2=" SELECT * from classes where classes.className not in () ";
    $results = mysqli_query($connect, $sql) or die("Bağlantı Başarısız");
    $chosen = mysqli_fetch_array($results);
?>

<div class="container">
    <div class="row butonlar">
        <a class="btn btn-success mr-2" href="sclasses.php">Ders Seçim</a>
        <a class="btn btn-danger" href="index.php?action=loqout">Çıkış Yap</a>
    </div>
    <h3 class="ml-3">Alınan Dersler</h3>
    <table class="table table-striped  table-sm ml-3 mt-3">
        <tr>
            <th>Ders Kodu </th>
            <th>Ders Adı</th>
            <th>Ders Durumu</th>
            <th>Çıkar</th>
        </tr>
        <?php

        $arr=array();

        foreach($results as $value) {
            if($value['className']!=null)
            {
                array_push($arr, $value['className'] );
            }
            echo  '<tr><td>' . $value['classCode']     . '</td>';
            echo  '<td>' . $value['className']     .  '</td>';
            echo   '<td>Alındı </td>';
            echo '<td> <a class="btn btn-danger btn-sm" href="sclasses.php?action=deleteClass&pcID='.$value['pcID'].'">Sil </a> </td></tr>';
        }

        ?>
    </table>
    <br>
    <h3 class="ml-3">Eklenebilecek Ders</h3>
    <table class="table table-striped table-sm ml-3 mt-3">
        <tr>
            <th>Ders Kodu </th>
            <th>Ders Adı</th>
            <th>Ders Durumu</th>
            <th>Ekle</th>
        </tr>
        <?php
        $sql2=" SELECT * from classes where classes.className not in ( '" . implode( "', '" , $arr ) . "' ) ";
        $results2 = mysqli_query($connect, $sql2) or die("İşlem Başarısız".mysqli_error($connect));


        foreach($results2 as $value) {

            echo  '<tr><td>' . $value['classCode']     . '</td>';

            echo  '<td>' . $value['className']     .  '</td>';

            echo   '<td>Alındı </td>';

            echo '<th> <a class="btn btn-success btn-sm" href="sclasses.php?action=addClass&dersAdi='.$value['className'].'&dersID='.$value['classID'].'">Ekle </a> </th></tr>';
        }

        ?>
        <?php
        $action = isset($_GET['action']) ? $_GET['action'] : NULL;


        switch ($action) {
            case 'addClass':
                echo 'You laughed! dersAdi:'.$_GET['dersAdi']." derSID:".$_GET['dersID'];
                $userId = $_COOKIE['userId'];
                $dersID = $_GET['dersID'];
                $dersAdi = $_GET['dersAdi'];
                $sql3 = "insert into pickedclasses(studentNumber , classID , className) values (".$userId.",".$dersID.",'".$dersAdi."')";

                if (mysqli_query($connect, $sql3)) {
                    header('Location: sclasses.php');
                } else {
                    echo "Error: " . $sql3 . "<br>" . mysqli_error($connect);
                }
                break;
            case 'deleteClass':
                $pcID = $_GET['pcID'];
                $sql_delete = "DELETE FROM pickedclasses WHERE pcID=$pcID";
                if (mysqli_query($connect, $sql_delete)) {
                    header('Location: sclasses.php');
                }
                else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect);
                }
                break;
        }
        ?>
</div>
</body>
</html>