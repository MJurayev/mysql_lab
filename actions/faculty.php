<?php
session_start();
if(isset($_GET['action']) && $_GET['action']!='edit'){

    $sql='';
    $tablename = 'faculty';
    if(isset($_GET['id'])) {
        $id = mysqli_escape_string($connection, htmlspecialchars($_GET['id']));
        if ($_GET['action'] == 'delete') {
            $sql = "delete from  " . $tablename . " where id=" . $id;
        }
        if ($_GET['action'] == 'edit-data') {
            $name=mysqli_escape_string($connection, htmlspecialchars($_GET['name']));
            $sql = "update  " . $tablename . " set `name`=\"".$name."\" where `id`=". $id;
        }


    }
    if($_GET['action'] == 'add'){
        $name=mysqli_escape_string($connection, htmlspecialchars($_GET['name']));
        $sql= "insert into ".$tablename." ( name) values ('" . $name . "')";
    }

    $result = mysqli_query($connection, $sql);

    if(!$result)
        $_SESSION['error'] = "Bazada xato:" . mysqli_error($connection);
    else  $_SESSION['success']= "Amal bajarildi".$result;

//    header("Location:/faculty.php");

}
?>