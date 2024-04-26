<?php
require_once ("Pages/layout/header.php");
require_once ("Pages/layout/navbar.php");
require_once ("Pages/validator.php");
require_once ("Models/Database.php");
$dbContext = new DbContext();

$errorMessage = "";
$passwordNotMatch= "";
$email = "";
$username = "";

$validator = new Validator($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if ($validator->is_valid() && $password === $confirm_password) {

        $validator->field('email')->required()->email();
        $validator->field('username')->required()->alpha();
        $validator->field('password')->required()->min_len(6)->max_len(30);
        $validator->field('confirm_password')->required()->min_len(6)->max_len(30);

        try {
            $userId = $dbContext->getAllUsersFromDatabase()->getAuth()->register($email, $password, $username, function ($selector, $token) {
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.ethereal.email';
                $mail->SMTPAuth = true;
                $mail->Username = 'suzanne14@ethereal.email';
                $mail->Password = '7RdEwsV4gAJfk3TG1m';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->From = "compra@test.se";
                $mail->FromName = "Compra"; //To address and name 
                $mail->addAddress($_POST['email']); //Address to which recipient will reply 
                $mail->addReplyTo("noreply@ysuperdupershop.com", "No-Reply"); //CC and BCC 
                $mail->isHTML(true);
                $mail->Subject = "Registrering";
                $url = 'http://localhost:8000/verify_email?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
                $mail->Body = "<i>Hej, klicka på <a href='$url'>$url</a></i> för att verifiera ditt konto";
                $mail->send();

            });

            header('Location: /registerOut');
            exit;

        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            $errorMessage = "E-postadressen finns redan registrerad";
        } catch (\Exception $e) {
            $errorMessage = "Något har gått fel. Kolla om du har fyllt i allting korrekt!!";
        }

        } else if ($password != $confirm_password) {
            $passwordNotMatch = "Lösenordet matchar inte";
        }
}

layout_header("Bli kund");

?>

<?php
layout_navbar($dbContext)
    ?>

<body>
    <main>

        <section class="login-register-container">

            <article>

                <h2>Bli kund</h2>
                <?php
                if ($errorMessage) {
                    ?>
                      <h3 class="errorMessage"><?php echo $errorMessage ?></h3>
                    <?php
                }
                ?>

                <form method="post" class="form">

                    <div class="login-register-input">
                        <label>E-postadress</label>
                        <input class="form-control" type="text" name="email" value="<?php echo $email ?>"
                            placeholder="cris@gmail.com">
                        <span><?php echo $validator->get_error_message('email'); ?></span>
                    </div>

                    <div class="login-register-input">
                        <label>För & efternamn</label>
                        <input class="form-control" type="text" name="username" value="<?php echo $username ?>"
                            placeholder="Cristiano Ronaldo" />
                        <span><?php echo $validator->get_error_message('username'); ?></span>
                    </div>

                    <div class="login-register-input">
                        <label>Lösenord</label>
                        <input class="form-control" type="password" name="password" placeholder="Lösenord" />
                        <span><?php echo $validator->get_error_message('password'), $passwordNotMatch ?></span>
                    </div>

                    <div class="login-register-input">
                        <label>Bekräfta lösenord</label>
                        <input class="form-control" type="password" name="confirm_password"
                            placeholder="Bekräfta lösenord" />
                        <?php echo $validator->get_error_message('confirm_password'), $passwordNotMatch ?>

                    </div>

                    <button>Bli kund</button>

                </form>
            </article>
        </section>
    </main>


</body>

</html>