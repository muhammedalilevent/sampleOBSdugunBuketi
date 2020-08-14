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


    <div class="row indexOrtaDiv">
        <div class="col-md-10 formDiv">

            <form action="" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Kullanıcı ID</label>
                    <input class="form-control" id="userNo" type="text" name="userNo" placeholder="Kullancı ID"
                           maxlength="11"/>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Şifre</label>
                    <input type="password" id="password" class="form-control" name="password" placeholder="Şifre"/>
                </div>
                <button type="submit" class="btn btn-success">Giriş</button>
            </form>
            <?php

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['userNo'])) {

                include('conn.php');
                //sql injection koruması
                $userNo = stripcslashes($_POST['userNo']);
                $password = stripcslashes($_POST['password']);
                $sql = "Select * from users where userNo='" . $userNo . "' and password='" . $password . "'";
                $results = mysqli_query($connect, $sql) or die("Bağlantı Başarısız");
                $row = mysqli_fetch_array($results);

                if ($row['userNo'] == $userNo && $row['password'] == $password) {

                    echo "Giriş Başarılı Hoşgeldiniz " . $row['name'];
                    echo $row['userNo'];
                    setcookie("userNo", $row['userNo']);
                    setcookie("userId", $row['id']);
                    if ($row['role'] == 1) {
                        header('Location: studentPage.php');
                    } else {
                        header('Location: managerPage.php');
                    }
                } else {
                    echo "Giriş Başarısız";
                }
            }

            $action = isset($_GET['action']) ? $_GET['action'] : NULL;


            switch ($action) {
                case 'loqout':
                       setcookie ("userNo", "", time() - 3600);
                       setcookie ("userId", "", time() - 3600);
                       header('Location: index.php');
                    break;
                case 'other':

                    break;
            }

            ?>
        </div>

    </div>


</body>
</html>