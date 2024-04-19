<?php

require_once('vendor/autoload.php');

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// globala initieringar !
require_once(dirname(__FILE__) ."/Router/Router.php");

$router = new Router();
$router->addRoute('/', function () {
    require __DIR__ .'/Pages/index.php';
});
$router->addRoute('/category', function () {
    require __DIR__ .'/Pages/category.php';
});
$router->addRoute('/allProducts', function () {
    require __DIR__ .'/Pages/allProducts.php';
});
$router->addRoute('/product', function () {
    require __DIR__ .'/Pages/product.php';
});

$router->addRoute('/addProduct', function () {
    require __DIR__ .'/Pages/addProduct.php';
});
$router->addRoute('/search', function () {
    require __DIR__ .'/Pages/search.php';
});
$router->addRoute('/login', function () {
    require __DIR__ .'/Pages/registers/login.php';
});
$router->addRoute('/logout', function () {
    require __DIR__ .'/Pages/registers/logout.php';
});
$router->addRoute('/register', function () {
    require __DIR__ .'/Pages/registers/register.php';
});
$router->addRoute('/user', function () {
    require __DIR__ .'/Pages/user.php';
});

$router->addRoute('/verify_email', function () {
    require __DIR__ .'/Pages/verify_email.php';
});
$router->addRoute('/shoppingcart', function () {
    require __DIR__ .'/Pages/ShoppingCart.php';
});
$router->addRoute('/contact', function () {
    require __DIR__ .'/Pages/contact.php';
});
$router->addRoute('/registerOut', function () {
    require __DIR__ .'/Pages/registers/registerOut.php';
});

$router->dispatch();
?>