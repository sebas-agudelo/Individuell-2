<?php
require_once ("Pages/layout/header.php");
require_once ("Pages/layout/navbar.php");
require_once ("Models/Database.php");
$dbContext = new DBContext();

layout_header("Kontakta oss");
?>

<?php
layout_navbar($dbContext)
    ?>

<body>
    <section class="contact-container">
        <article class="contact-img-container">
            <img src="/assets/contact img/contact-img.jpg" alt="">
        </article>

        <article class="contact-details-container">
            <h2>KONTAKTA OSS</h2>
            <h4>Har du några frågor eller vill du veta mer? <br/>
                Välkommen att kontakta oss.</h4>
            <p><i class="bi bi-telephone-fill"></i> 077 998 98 08</p>
            <p><i class="bi bi-envelope-fill"></i> compra@test.se</p>
            <p><i class="bi bi-geo-alt-fill"></i> Mått Johanssons Väg, Eskilstuna</p>
        </article>
    </section>
</body>