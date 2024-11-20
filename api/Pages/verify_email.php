<?php 
require_once ("Pages/layout/header.php");
require_once ("Models/Database.php");
$dbContext = new DbContext();
layout_header("compra");

try {
    $dbContext->getAllUsersFromDatabase()->getAuth()->confirmEmail($_GET['selector'], $_GET['token']);

    echo 'Email address has been verified';
}
catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
    die('Invalid token');
}
catch (\Delight\Auth\TokenExpiredException $e) {
    die('Token expired');
}
catch (\Delight\Auth\UserAlreadyExistsException $e) {
    die('Email address already exists');
}
catch (\Delight\Auth\TooManyRequestsException $e) {
    die('Too many requests');
}

?>

<body>
    <h2>Verifigera</h2>
</body>