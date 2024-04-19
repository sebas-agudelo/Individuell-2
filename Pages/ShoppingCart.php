<?php
require_once("Pages/layout/header.php");
require_once("Pages/layout/navbar.php");
require_once("Models/Database.php");
$dbContext = new DBContext();
// $q = $_GET['q'] ?? "";

layout_header("Compra");
?>

<?php 
 layout_navbar($dbContext);
 ?>

 <body>
    <h2>Varukorg</h2>
 </body>