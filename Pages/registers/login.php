<?php
// use Dotenv\Validator;
require_once ("Pages/layout/header.php");
require_once ("Pages/validator.php");
require_once ("Pages/layout/navbar.php");
require_once ("Models/Database.php");
$dbContext = new DbContext();

$message = "";
$email = "";
$password = "";

$v = new Validator($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $v->field('email')->required()->email();
    $v->field('password')->required();


    try {
        $dbContext->getAllUsersFromDatabase()->getAuth()
            ->login($email, $password);
        header('Location: /');
        exit;
    } catch (Exception $e) {
        $message = "Kolla om du använde rätt e-postadress och lösenord.";

    }
    
}

layout_header("Logga in");
?>

<?php
layout_navbar($dbContext)
    ?>

<body>
    <main>
        <?php echo $dbContext->getAllUsersFromDatabase()->getAuth()->isLoggedIn(); ?>

        <section class="login-container">

        <h1>Välkommen tillbaka</h1>

        <?php 
        if($message){
            ?>
                 <h3><?php echo $message ?></h3>
            <?php
        }
        ?>

            <form method="POST">

                <div class="e-post">
                    <label for="name">E-postadress</label>
                    <input type="email" name="email" autofocus>
                    <span><?php echo $v->get_error_message('email'); ?></span>
                </div>
                <div class="password">
                    <label for="password">Lösenord</label>
                    <input type="password" name="password">
                    <span><?php echo $v->get_error_message('password'); ?></span>
                </div>

                <button>Logga in</button>
                <a href="" class="forget-password">Glömt lösenord</a>

            </form>
        </section>
    </main>
</body>

</html>