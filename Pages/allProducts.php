<!-- <?php 
require_once("Pages/layout/header.php");
require_once("Pages/layout/navbar.php");
require_once("Models/Database.php");
$dbContext = new DBContext();
$q = $_GET['q'] ?? "";



layout_header("Compra");
?>

<?php 
layout_navbar($dbContext)
?>


<body>
    <h2><?php echo 'Köp din sport bil hos oss'?></h2>

 <ul>
        <?php
            foreach($dbContext->getAllCategories() as $category){ ?>
            
            <li>
                <a href="/category?id=<?php echo $category->id?>">
                    <span><?php echo $category->name?></span>
            
            </a>
            </li>
        
        <?php } ?>
    </ul>

    <ul>
    <?php foreach($dbContext->searchProducts($q, null) as $product) { ?>
    <li>
        <img src="<?php echo $product->img?>" alt="<?php echo $product->img?>">
        <span><?php echo $product->title?></span>
        <span><?php echo 'År ', $product->model?></span>
        <span><?php echo $product->color?></span>
        <span><?php echo $product->price?></span>
        <a href="/product?id=<?php echo $product->id?>">Läs mer</a>
    </li>
    <?php } ?>
</ul>

<!-- <form method="GET" action="/search">
    Search:
    <input type="text" name="q" value="<?php echo $q?>"/>
</form> -->

<style>
    img{
        width: 25%;
        height: auto;
    }
</style>
</body>
</html> -->