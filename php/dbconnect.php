<?php
// session_start();
// if(!isset($_SESSION['logdin']) || $_SESSION != true){
//   header("location: ../index.php");
//   exit;
// }else if(isset($_SESSION['logdin']) || $_SESSION != true){
//    header("location: home.php");
//    exit;
// }
?>
<?php
// include '../index.php';

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'canvas';

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

// if($conn){
//     echo "Database connected";
// }











?>