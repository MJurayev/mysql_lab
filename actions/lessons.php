<?php
//require "../includes/db.inc.php";
session_start();
if(isset($_GET['action']) && $_GET['action']!='edit'){

    $sql='';
    $tablename='lessons';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        if($_GET['action'] == 'delete'){
            $sql="delete from  ".$tablename." where id=".$id;
        }
    }
    if($_GET['action'] == 'add'){
        $pupil_id=mysqli_escape_string($connection, htmlspecialchars($_GET['pupil_id']));
        $employee_id=mysqli_escape_string($connection, htmlspecialchars($_GET['employee_id']));
        $subject_id=mysqli_escape_string($connection, htmlspecialchars($_GET['subject_id']));
        $day_of_week=mysqli_escape_string($connection, htmlspecialchars($_GET['day_of_week']));
        $para=mysqli_escape_string($connection, htmlspecialchars($_GET['para']));

        $sql= "insert into ".$tablename." (`pupil_id`, `employee_id`,`subject_id`,`day_of_week`, `para`) values (\"" .$pupil_id . "\", \"" . $employee_id . "\",\"" . $subject_id . "\", \"".$day_of_week."\" , \"".$para."\")";
    }
    if($_GET['action'] == 'edit-data'){
        $pupil_id=mysqli_escape_string($connection, htmlspecialchars($_GET['pupil_id']));
        $employee_id=mysqli_escape_string($connection, htmlspecialchars($_GET['employee_id']));
        $subject_id=mysqli_escape_string($connection, htmlspecialchars($_GET['subject_id']));
        $day_of_week=mysqli_escape_string($connection, htmlspecialchars($_GET['day_of_week']));
        $para=mysqli_escape_string($connection, htmlspecialchars($_GET['para']));
        $id=$_GET['id'];
        $sql= "update `".$tablename."` set `pupil_id`=\"".$pupil_id."\", `employee_id`=\"".$employee_id."\", `subject_id`=\"".$subject_id."\", `day_of_week`=\"".$day_of_week."\", `para`=\"".$para."\" where `id`=".$id;
//        die($sql);
    }

    $result = mysqli_query($connection, $sql);

    if(!$result) $_SESSION['error']= "Bazada xato:".mysqli_error($connection);
    else  $_SESSION['success']= "Amal bajarildi";
//    header("Location:/lessons.php");
}

//header('Location: /pupils.php');
