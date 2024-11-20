<?php
require_once ("Pages/layout/header.php");
require_once ("Pages/layout/navbar.php");
require_once ("Pages/layout/footer.php");
require_once ("Models/Database.php");
$dbContext = new DBContext();
// $q = $_GET['q'] ?? "";


layout_header("Start - Compra");

?>

<body>

    <?php
    layout_navbar($dbContext);
    ?>

    <main>

        <section class="hero-img-container">
            <article class="hero-img"></article>
        </section>

        <section class="product-list-container">
<h1>MEST KÖPTA BILAR</h1>
            <?php
            foreach ($dbContext->getPopularyProducts() as $product) { ?>
                <article class="product-list-content">


                    <img src="<?php echo $product->img ?>" alt="<?php echo $product->img ?>">

                    <div class="product-list-details">
                        <h3><?php echo $product->title ?></h3>
                        <div class="product-list-price-btn">
                            <h4><?php echo $product->price, ' kr' ?></h4>
                            <button><a href="/product?id=<?php echo $product->id ?>">Läs mer</a></button>
                        </div>
                    </div>


                    </a>
                </article>
            <?php } ?>
        </section>
    </main>
    <?php
    layout_footer($dbContext);
    ?>
</body>

</html>