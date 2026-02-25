<!-- conexão do banco de dados pro php -->
<?php 
$host ='localhost';
$user = 'root';
$pass = "";
$db = "webfinal";

$conn = mysqli_connect ($host , $user , $pass , $db);
if (!$conn){
    die ("erro ao conectar: "  . mysqli_connect_error());
}

?>