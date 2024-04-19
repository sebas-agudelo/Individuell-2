<?php
function layout_footer($dbContext)
{
    
    ?>
    <footer>
        <section class="info-container">
            <article>
                <h4>Compra Auto Sverige</h4>
                <ul>
                    <li>Om oss</li>
                </ul>
            </article>

            <article>
                <h4>Kontakt</h4>
                <ul>
                    <li><i class="bi bi-telephone-fill"></i> 077 998 98 08</li>
                    <li><i class="bi bi-envelope-fill"></i> compra@test.se</li>
                    <li><i class="bi bi-geo-alt-fill"></i> Mått Johanssons Väg, Eskilstuna</li>
                </ul>
            </article>
            <article>
                <h4>Bilar i lager</h4>
                <ul>
                <?php
                foreach($dbContext->getAllCategories() as $category){
                    ?>
                    <li>
                        <a href="/category?id=<?php echo $category->id ?>"><?php echo $category->name ?></a>
                    </li>
                    <?php
                }
                ?>

                </ul>
            </article>
        </section>

        <article class="social-media-container">
            <p>
                Copyright ©<span>Compra AB</span>
            </p>
            <div>
                <i class="bi bi-instagram"></i>
                <i class="bi bi-facebook"></i>
                <i class="bi bi-linkedin"></i>
            </div>
        </article>
    </footer>
    <?php

}
?>