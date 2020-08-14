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
                Kampüs Giriş Sistemi
            </h1>
        </div>
    </div>
</header>
<div class="row butonlar">
        <a type="button" class="btn btn-success mr-2" href="addUser .php">Öğrenci Kayıt Sil</a>
        <a type="button" class="btn btn-success mr-2" href="mplist.php">Öğrenci Listele</a>
        <a type="button" class="btn btn-danger mr-2" href="deleteUser.php">Kayıt Sil</a>
        <a type="button" class="btn btn-danger mr-2 " href="index.php?action=loqout">Çıkış Yap</a> 
    </div>

    <div class="row indexOrtaDiv">
        <div class="col-md-10 formDiv">

            <form action="" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Kullanıcı ID</label>
                    <input class="form-control" id="userID" type="text" name="userID" placeholder="Kullancı ID"
                           maxlength="11"/>
                </div>
                
                <button type="submit" class="btn btn-danger">Kayıt Sil</button>
            </form>
            <?php

            
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['userNo'])){
                include('conn.php');
                //sql injection koruması
                $userID = (isset($_POST['userID']) ? intval($_POST['userID']) : -1);
               // $userID = $_POST['userID'];
                $sql = "DELETE  from pickedClasses where studentNumber='" . $userID . "'";
                $results = mysqli_query($connect, $sql) or die("Bağlantı Başarısız");
               
                //BURDA ÖĞRENCİ KAYDINI SİLERKEN ÖNCE ÖĞRENCİNİN KAYITLI OLDUĞU DERSLERDEN ÇIKARIYORUZ YANİ PICKEDCLASSES'TA OLDUĞU DERSLERİ SİLİYORUZ SONRA USERS TABLOSUNDAN SİLİYORUZ
                if ($results) {
                    $sql2 = "DELETE  from users where id='" . $userID . "'";
                $results2 = mysqli_query($connect, $sql2) or die("Bağlantı Başarısız");
                  if($results2)
                  {
                    echo "Kayıt Silme İşlemi Başarılı";
                  }

    
                } else {
                    echo "Error deleting record: " . mysqli_error($connect);
                }
}

            ?>
        </div>

    </div>


</body>
</html>