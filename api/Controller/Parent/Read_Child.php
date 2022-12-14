<?php

//Headers
include_once '../api/Model/Database.php';
include_once '../api/Model/User.php';
include_once '../api/Model/Student.php';


//DB
$db = new Database();
$db_conn = $db->connect();

//User
$user = new User($db_conn);

$stmt = $user->readParent();

var_dump($stmt);

$count = $stmt->rowCount();

if ($count > 0) {

    $userArr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $e = array(
            "name" => $name,
            "last_name" => $last_name,
            "DNI" => $DNI,
            "student_name" => $student_name,
        );

        array_push($userArr, $e);
    }
    //echo json_encode($userArr);
}

//INCLUDE VIEW PHP
include "View/View-Admin.php";
