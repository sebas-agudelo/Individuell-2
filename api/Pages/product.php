<?php
require_once ("Pages/layout/header.php");
require_once ("Pages/layout/navbar.php");
require_once ("Models/Database.php");
$dbContext = new DBContext();
$id = $_GET['id'];

$product = $dbContext->getProducts($id);
layout_header("Compra");
?>

<?php
layout_navbar($dbContext);
?>

<body>
    <main>


        <section class="product-container">
            <div class="img-container">
                <img src="<?php echo $product->img ?>" alt="<?php echo $product->img ?>">
            </div>

            <div class="product-details">
                <h2><?php echo $product->title ?></h2>
                <!-- <h4><?php echo 'Årsmodell ', $product->model ?></h4>
                <h4><?php echo 'Färg ', $product->color ?></h4> -->
                <h4><?php echo 'Pris ',  $product->price, ' kr' ?></h4>

                <div class="btns-container">
                <button class="contact-btn"><a href="/contact">Kontakt</a></button>
                <button class="buy-btn">Köp</button>
                </div>
            </div>


    

        </section>
    </main>
</body>

</html>