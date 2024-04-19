<?php
require_once ("Pages/layout/header.php");
require_once ("Pages/layout/navbar.php");
require_once ("Pages/layout/footer.php");
require_once ("Pages/layout/Sorts.php");
require_once ("Models/Database.php");
$dbContext = new DBContext();
$sortOrder = $_GET['sortOrder'] ?? "";
$sortCol = $_GET['sortCol'] ?? "";
$q = $_GET['q'] ?? "";

$categoryId = $_GET['id'] ?? "";

layout_header("Bilar i lager");

$theCategory = $dbContext->getCategory($categoryId);
?>


<?php
layout_navbar($dbContext)
    ?>


<body>
    <main>

        <h1 class="category-h1">Bilar i lager</h1>

        
        <?php
        layout_Sorts($dbContext);
        ?>

        <section class="category-container">


        
            <?php foreach ($dbContext->searchProducts($sortCol, $sortOrder, $q, $categoryId) as $product) {
                ?>
                <div class="category-content">
                   
                        <div class="img-container">
                            <img src="<?php echo $product->img ?>" alt="<?php echo $product->img ?>">
                        </div>

                        <div class="category-details">
                            <h3><?php echo $product->title ?></h3>
                            <p><?php echo 'Årsmodell: ', $product->model?></p>
                            <P><?php echo 'Färg: ', $product->color ?></P>
                            <h4><?php echo 'Pris: ', $product->price, ' kr' ?></h4>
                        </div>

                        <div class="btn-container">
                            <button><a href="/product?id=<?php echo $product->id ?>">Läs mer</a></button>
                        </div>
                </div>

            <?php } ?>
        </section>
    </main>
    <?php
    layout_footer($dbContext);
    ?>
</body>

</html>