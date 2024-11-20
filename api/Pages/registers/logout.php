<?php 
require 'vendor/autoload.php';
require_once("Pages/layout/header.php");
require_once("Pages/layout/navbar.php");
require_once("Models/Database.php");
$dbContext = new DbContext();
// layout_header("compra");


$dbContext->getAllUsersFromDatabase()->getAuth()->logOut();
header('Location: /');
exit;

?>
