<?php 
require_once("Pages/layout/header.php");
require_once("Pages/layout/navbar.php");
require_once("Pages/layout/Sorts.php");
require_once("Models/Database.php");
$dbContext = new DBContext();
$sortOrder = $_GET['sortOrder'] ?? "";
$sortCol = $_GET['sortCol'] ?? "";
$q = $_GET['q'] ?? "";
layout_header("Compra");
?>


<?php 
 layout_navbar($dbContext);
 ?>


<body>
    <main>
<?php 
 layout_Sorts($dbContext);
 ?>
 
<?php foreach($dbContext->searchProducts($sortCol, $sortOrder, $q, null) as $product) { ?>
        <?php
        if($q)
        {
            ?>
        <li>
            <img src="<?php echo $product->img?>" alt="<?php echo $product->img?>">
            <span><?php echo $product->title?></span>
            <span><?php echo 'År ', $product->model?></span>
            <span><?php echo $product->color?></span>
            <span><?php echo $product->price?></span>
            <a href="/product?id=<?php echo $product->id?>">Läs mer</a>
            
        </li>
        
        <?php 
     
        }
    }   
        ?>

<style>
    img{
        width: 25%;
        height: auto;
    }
    </style>

</main>
</body>
</html>