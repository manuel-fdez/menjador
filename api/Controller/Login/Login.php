<?php

session_start();

$_SESSION["name"] = "login";
if (isset($_POST['submit']) /*|| isset($_SESSION["username"])*/) {
    if ((isset($_POST['username']) && $_POST['username'] != '') && (isset($_POST['password']) && $_POST['password'] != '')) {

        $_SESSION["username"] = trim($_POST['username']);
        $_SESSION["password"] = trim($_POST['password']);

        $username = $_SESSION["username"];
        $passwordf = $_SESSION["password"];


        //Headers
        include_once '../api/Model/Database.php';
        include_once '../api/Model/User_Parent.php';
        include_once '../api/Model/Student.php';
        include_once '../api/Model/Login.php';
        include_once '../api/Model/Menu.php';

        //DB
        $db = new Database();
        $db_conn = $db->connect();

        //for the prices
        $updatePrice = new Menu($db_conn);
        $readStmt = $updatePrice->readPrice();
        $rowPrice = $readStmt->fetch(PDO::FETCH_ASSOC);
        $actualPrice = $rowPrice["price"];

        $_SESSION["price"] = $actualPrice;


        //for login
        $login = new Login($db_conn);
        $login->setDNI($_SESSION["username"]);
        $rowlog = $login->read()->fetch(PDO::FETCH_ASSOC);
        $login->setRole($rowlog["role"]);
        $passparent = $login->readPasswordParent($_SESSION["username"]);
        $passadmin = $login->readPasswordAdmin($_SESSION["username"]);
        $passrest = $login->readPasswordRest($_SESSION["username"]);
        $countpassp = $passparent->rowCount();
        $countpassa = $passadmin->rowCount();
        $countpassr = $passrest->rowCount();

        //User Parent
        $user = new User_Parent($db_conn);

        $user->setUsername($_SESSION["username"]);
        $parent_DNI = $user->getUsername();

        $stmt = $user->read();
        $count = $stmt->rowCount();

        if ($countpassp  == 1) {
            $row = $passparent->fetch(PDO::FETCH_ASSOC);
            extract($row);

            if ($passwordf == $row['password']) {
                if ($login->getDNI() == $rowlog["DNI"] && $login->getRole() == "parent") {

                    include_once "../front/View/index.php";
                    //header('location: http://www.menjadorescola.me/home');
                }
            } else {

                session_destroy();
                echo "<script>
                alert('Contrase??a equivocada');
                window.location.replace('http://www.menjadorescola.me/');
                </script>";
            }
        } else if ($countpassa  == 1) {
            $row = $passadmin->fetch(PDO::FETCH_ASSOC);
            extract($row);

            if ($passwordf == $row['password']) {
                if ($login->getDNI() == $rowlog["DNI"] && $login->getRole() == "admin") {
                    header('location: http://admin.menjadorescola.me/home');
                    //include_once "../back/View/index.php";
                }
            } else {
                echo "<script>
                alert('Wrong Password');
                window.location.replace('http://admin.menjadorescola.me/');
                </script>";
            }
        } else if ($countpassr  == 1) {
            $row = $passrest->fetch(PDO::FETCH_ASSOC);
            extract($row);

            if ($passwordf == $row['password']) {
                if ($login->getDNI() == $rowlog["DNI"] && $login->getRole() == "restaurant") {
                    header('location: http://intranet.menjadorescola.me/home');
                    //include_once "../intranet/View/index.php";
                }
            } else {
                echo "<script>
                alert('Wrong Password');
                window.location.replace('http://intranet.menjadorescola.me/');
                </script>";
            }
        } else {
            echo "<script>
            alert('Access Denied');
            window.location.replace('http://www.menjadorescola.me/');
            </script>";
        }
    }
} else if (isset($_SESSION["username"])) {

    $username = $_SESSION["username"];
    $passwordf = $_SESSION["password"];
    include_once '../api/Model/Database.php';
    include_once '../api/Model/User_Parent.php';
    include_once '../api/Model/Student.php';

    //DB
    $db = new Database();
    $db_conn = $db->connect();

    //User
    $user = new User_Parent($db_conn);

    $user->setUsername($_SESSION["username"]);
    $parent_DNI = $user->getUsername();

    $stmt = $user->read();
    $count = $stmt->rowCount();

    include_once "../front/View/index.php";
    //header('location: http://www.menjadorescola.me/home');
} else {
    header("Location: http://www.menjadorescola.me/");
}
