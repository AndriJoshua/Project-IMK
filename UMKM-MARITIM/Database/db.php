<?php 
$host = 'localhost';
$dbname = 'projek_imk_tes';
$username = 'root';
$password = '';

$conn = new mysqli($host,$username,$password,$dbname);
if($conn->connect_error){
    die("error" .$conn->connect_error);
}
?>