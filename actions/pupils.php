<?php
//require "../includes/db.inc.php";
session_start();
if(isset($_GET['action']) && $_GET['action']!='edit'){

    $sql='';
    $tablename='pupils';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        if($_GET['action'] == 'delete'){
            $sql="delete from  ".$tablename." where id=".$id;
        }
    }
    if($_GET['action'] == 'add'){
        $surname=mysqli_escape_string($connection, htmlspecialchars($_GET['surname']));
        $name=mysqli_escape_string($connection, htmlspecialchars($_GET['name']));
        $middlename=mysqli_escape_string($connection, htmlspecialchars($_GET['middlename']));
        $address=mysqli_escape_string($connection, htmlspecialchars($_GET['address']));
        $grade=mysqli_escape_string($connection, htmlspecialchars($_GET['grade']));
        $phone=mysqli_escape_string($connection, htmlspecialchars($_GET['phone']));
        $birth_date=mysqli_escape_string($connection, htmlspecialchars($_GET['birth_date']));
        $faculty=mysqli_escape_string($connection, htmlspecialchars($_GET['faculty']));
        $sql= "insert into ".$tablename." (surname, name, middlename, address, grade, phone, birth_date,faculty_id) values ( '" . $surname . "', '" . $name . "','" . $middlename . "','" . $address . "' , '" . $grade . "' ,'" . $phone . "' , '" . $birth_date . "','" . $faculty . "')";
    }
    if($_GET['action'] == 'edit-data'){
        $surname=mysqli_escape_string($connection, htmlspecialchars($_GET['surname']));
        $name=mysqli_escape_string($connection, htmlspecialchars($_GET['name']));
        $middlename=mysqli_escape_string($connection, htmlspecialchars($_GET['middlename']));
        $address=mysqli_escape_string($connection, htmlspecialchars($_GET['address']));
        $grade=mysqli_escape_string($connection, htmlspecialchars($_GET['grade']));
        $phone=mysqli_escape_string($connection, htmlspecialchars($_GET['phone']));
        $birth_date=mysqli_escape_string($connection, htmlspecialchars($_GET['birth_date']));
        $faculty=mysqli_escape_string($connection, htmlspecialchars($_GET['faculty']));
        $id=$_GET['id'];
        $sql= "update `".$tablename."` set `surname`=\"".$surname."\", `name`=\"".$name."\", `middlename`=\"".$middlename."\", `address`=\"".$address."\", `grade`=\"".$grade."\", `phone`=".$phone.", `birth_date`=\"".$birth_date."\",`faculty_id`=".$faculty." where `id`=".$id;

    }

    $result = mysqli_query($connection, $sql);

    if(!$result) $_SESSION['error']= "Bazada xato:".mysqli_error($connection);
    else  $_SESSION['success']= "Amal bajarildi";
}
