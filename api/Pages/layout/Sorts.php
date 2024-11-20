<?php
require_once ("Models/Database.php");
$dbContext = new DBContext();

function layout_Sorts($dbContext)
{
    
    
    $q = $_GET['q'] ?? "";
    $categoryId =  $_GET['id'] ?? "";
    // $theCategory = $dbContext->getCategory($categoryId);
    
    ?>

    <body>

        <div class="sort-container">
            <p>MÄRKE
            <a href="?sortCol=title&sortOrder=asc&q=<?php echo $q ?>&id=<?php echo $categoryId ?>"><i class="bi bi-arrow-up"></i></a>
            <a href="?sortCol=title&sortOrder=desc&q=<?php echo $q ?>&id=<?php echo $categoryId ?>"><i class="bi bi-arrow-down"></i></a>
                <i></i>
            </p>
            <p>MODELÅR
            <a href="?sortCol=model&sortOrder=asc&q=<?php echo $q ?>&id=<?php echo $categoryId ?>"><i class="bi bi-sort-numeric-up"></i></a>
            <a href="?sortCol=model&sortOrder=desc&q=<?php echo $q ?>&id=<?php echo $categoryId ?>"><i class="bi bi-sort-numeric-down-alt"></i></a>
            </p>
            <p>PRIS
            <a href="?sortCol=price&sortOrder=asc&q=<?php echo $q ?>&id=<?php echo $categoryId ?>"><i class="bi bi-sort-up-alt"></i></a>
            <a href="?sortCol=price&sortOrder=desc&q=<?php echo $q ?>&id=<?php echo $categoryId ?>"><i class="bi bi-sort-down"></i></a>
            </p>
        </div>


    </body>

    </html>
    <?php
}
?>