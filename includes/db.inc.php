<?php
const DBHOST='localhost';
const DBNAME='college3';
const DBUSER ='root';
const DBPASS = '';
$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if(!$connection)
    echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
        <strong>Database error:</strong> Baza bilan ulanishda xatolik yuz berdi!!!
        </div>";
?>