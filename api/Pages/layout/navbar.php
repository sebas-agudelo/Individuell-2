<?php
function layout_navbar($dbContext)
{
    $q = $_GET['q'] ?? "";
    ?>
    <header>
        <div class="logo-contact-container">
            <div class="login-reg-container">
                <?php
                if (!$dbContext->getAllUsersFromDatabase()->getAuth()->isLoggedIn()) {
                    ?>
                    <a href="/login"> <i class="bi bi-person"></i>LOGGA IN</a>
                    <a href="/register"><i class="bi bi-person-plus-fill"></i>BLI KUND</a>

                    <?php
                } else {
                    ?>
                    <i
                        class="bi bi-person"><span><?php echo $dbContext->getAllUsersFromDatabase()->getAuth()->getusername() ?></span></i>
                    <a href="/logout"><i class="bi bi-box-arrow-in-right"></i>LOGGA UT</a>


                    <?php
                } ?>
            </div>
        </div>

        <nav class="nav-container">
            
            <div class="logo-container">
                <a href="/"><img src="assets/Logo/LOGO1.png" alt=""></a>
            </div>

            <ul class="nav-content">
                <li><a href="/">START</a></li>
                <li class="dropdown">BILAR I LAGER
                    <ul class="dropdown-content">
                        <?php
                        foreach ($dbContext->getAllCategories() as $category) { ?>
                            <li>
                                <a href="/category?id=<?php echo $category->id ?>"><?php echo $category->name ?></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <li><a href="/contact">KONTAKT</a></li>
                <li><a>OM OSS</a></li>
                </li>
            </ul>

            <!-- <div class="cart-container">
                    <a href="/shoppingcart"><i class="bi bi-cart4"></i></a>
                </div> -->
            <div class="search-container">
                <form method="GET" action="/search">
                    <input type="search" name="q" value="<?php echo $q ?>" placeholder="Sök" />
                </form>
            </div>
        </nav>



    </header>




    <?php
}
?>