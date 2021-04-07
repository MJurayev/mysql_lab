<?php
//require "../includes/db.inc.php";
session_start();
if(isset($_GET['action']) && $_GET['action']!='edit'){

    $sql='';
    $tablename='marks';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        if($_GET['action'] == 'delete'){
            $sql="delete from  ".$tablename." where id=".$id;
        }
    }
    if($_GET['action'] == 'add'){
        $pupil_id=mysqli_escape_string($connection, htmlspecialchars($_GET['pupil_id']));
        $lesson_id=mysqli_escape_string($connection, htmlspecialchars($_GET['subject_id']));
        $mark=mysqli_escape_string($connection, htmlspecialchars($_GET['mark']));

        $sql= "insert into `".$tablename."` (`pupil_id`, `lesson_id`,`mark`) values (\"" .$pupil_id . "\", \"" . $lesson_id . "\",\"" . $mark . "\")";
    }
    if($_GET['action'] == 'edit-data'){
        $pupil_id=mysqli_escape_string($connection, htmlspecialchars($_GET['pupil_id']));
        $lesson_id=mysqli_escape_string($connection, htmlspecialchars($_GET['lesson_id']));
        $mark=mysqli_escape_string($connection, htmlspecialchars($_GET['mark']));
        $id=$_GET['id'];
        $sql= "update `".$tablename."` set `pupil_id`=\"".$pupil_id."\", `lesson_id`=\"".$lesson_id."\", `mark`=\"".$mark."\"  where `id`=".$id;
//        die($sql);
    }

    $result = mysqli_query($connection, $sql);

    if(!$result) $_SESSION['error']= "Bazada xato:".mysqli_error($connection);
    else  $_SESSION['success']= "Amal bajarildi";


}

//header('Location: /marks.php');
