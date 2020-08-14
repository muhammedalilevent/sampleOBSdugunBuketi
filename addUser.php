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

<div class="container">
    <div class="row butonlar">
        <a type="button" class="btn btn-success mr-2" href="addDelete.php">Öğrenci Kayıt Sil</a>
        <a type="button" class="btn btn-success mr-2" href="mplist.php">Öğrenci Listele</a>
        <a type="button" class="btn btn-danger mr-2" href="deleteUser.php">Kayıt Sil</a>
        <a type="button" class="btn btn-danger" href="index.php?action=loqout">Çıkış Yap</a>
    </div>

    <div class="row">
        <div class="col-md-4 formDiv">

            <form action="" method="POST">
                <div class="form-group">
                    <label for="userNo">Kullanıcı ID</label>
                    <input type="text" id="userNo" class="form-control" name="userNo" placeholder="Kullanıcı ID" />

                    <label for="name">Ad</label>
                    <input class="form-control" id="name" type="text" name="name" placeholder="İsim"
                           maxlength="30" />

                    <label for="surname">Soyad</label>
                    <input class="form-control" id="surname" type="text" name="surname" placeholder="Soyad"
                           maxlength="30" />

                    <label for="age">Yaş</label>
                    <input class="form-control" id="age" type="number" name="age" placeholder="Yaş" />

                    <label for="password">Parola</label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Parola"
                           maxlength="20" />

                    <label for="created At">Kayıt Tarihi</label>
                    <input class="form-control" id="createdAt" type="date" name="createdAt" />

                    <label class="mt-3 ml-0" for="cars">Rol:</label>
                    <select id="role" name="role">
                        <option value="2">Yönetici</option>
                        <option value="1">Öğrenci</option>
                    </select>

                </div>
                <button type="submit" class="btn btn-success">Giriş</button>
            </form>
            <?php


            if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['userNo'])){
                include('conn.php');

//sql injection koruması
                $userNo = stripcslashes($_POST['userNo']);
                $password = stripcslashes($_POST['password']);
                $name = stripcslashes($_POST['name']);
                $surname = stripcslashes($_POST['surname']);
                $age = stripcslashes($_POST['age']);
                $createdAt = stripcslashes($_POST['createdAt']);
                $role = stripcslashes($_POST['role']);


                $sql = "INSERT INTO users (userNo, name, surname,age,password,createdAt,role)
VALUES ('$userNo','$name', '$surname','$age','$password','$createdAt','$role');";

                $results = mysqli_query($connect, $sql);



                if($results){
                    echo "Kayıt Başarılı Hoşgeldiniz ";
                    header('Location: http://127.0.0.1:8080/weddingTask/addDelete.php');
                }else{
                    echo "Kayıt  Başarısız";
                }

            }

            ?>
        </div>

    </div>
</div>


</body>

</html>