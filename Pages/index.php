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

        
        <section class="startpage-container">
            <article class="hero-img"></article>
            <h1>MEST KÖPTA BILAR</h1>


            <?php
            foreach ($dbContext->getPopularyProducts() as $product) { ?>
                <article class="startpage-content"><a href="/product?id=<?php echo $product->id ?>">
                        <div class="startpage-img">
                            <img src="<?php echo $product->img ?>" alt="<?php echo $product->img ?>">
                        </div>

                        <div class="favarite-details-content">
                            <h3><?php echo $product->title ?></h3>
                            <button><a href="/product?id=<?php echo $product->id ?>">Läs mer</a></button>
                        </div>
            </a></article>
            <?php } ?>
        </section>
    </main>
    <?php
    layout_footer($dbContext);
    ?>
</body>

</html>