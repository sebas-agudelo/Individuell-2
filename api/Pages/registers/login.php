<?php
// use Dotenv\Validator;
require_once ("Pages/layout/header.php");
require_once ("Pages/validator.php");
require_once ("Pages/layout/navbar.php");
require_once ("Models/Database.php");
$dbContext = new DbContext();

$errorMessage = "";
$email = "";


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
    } catch (\Exception $e) {
        $errorMessage = "Något har gått fel. Kolla om du har fyllt i E-postadressen & lösenordet korrekt!!";
    }

}

layout_header("Logga in");
?>

<?php
layout_navbar($dbContext)
    ?>

<body>
    <main>
        <section class="login-register-container">

            <article>
                <h2>Välkommen tillbaka</h2>

                <?php
                if ($errorMessage) {
                    ?>
                      <h3 class="errorMessage"><?php echo $errorMessage ?></h3>
                    <?php
                }
                ?>

                <form method="POST">

                    <div class="login-register-input">
                        <label>E-postadress</label>
                        <input class="form-control" type="text" name="email" value="<?php echo $email ?>"
                            placeholder="cris@gmail.com">
                        <span><?php echo $v->get_error_message('email'); ?></span>
                    </div>

                    <div class="login-register-input">
                        <label>Lösenord</label>
                        <input class="form-control" type="password" name="password" placeholder="Lösenord" />
                        <span><?php echo $v->get_error_message('password');?></span>
                    </div>

                    <button>Logga in</button>
               

                </form>
            </article>
        </section>
    </main>
</body>

</html>