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

        <section class="product-list-container">


        
            <?php foreach ($dbContext->searchProducts($sortCol, $sortOrder, $q, $categoryId) as $product) {
                ?>
                <article class="product-list-content">
                   
                    
                            <img src="<?php echo $product->img ?>" alt="<?php echo $product->img ?>">
                  

                        <div class="product-list-details">
                            <h3><?php echo $product->title ?></h3>
                            <p><?php echo 'Årsmodell: ', $product->model?></p>
                            <P><?php echo 'Färg: ', $product->color ?></P>
                            
                            <div class="product-list-price-btn">
                                <h4><?php echo $product->price, ' kr' ?></h4>
                                <button><a href="/product?id=<?php echo $product->id ?>">Läs mer</a></button>
                            </div>
                        </div>
                </article>

            <?php } ?>
        </section>
    </main>
    <?php
    layout_footer($dbContext);
    ?>
</body>

</html>