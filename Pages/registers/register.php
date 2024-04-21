<?php
require_once ("Pages/layout/header.php");
require_once ("Pages/layout/navbar.php");
require_once ("Pages/validator.php");
require_once ("Models/Database.php");
$dbContext = new DbContext();

$message = "";
$passwordMessage = "";
$email = "";
$username = "";

$v = new Validator($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if ($v->is_valid() && $password === $confirm_password) {

        $v->field('email')->required()->email();
        $v->field('username')->required();
        $v->field('password')->required();
        $v->field('confirm_password')->required();

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

        } catch (Exception $e) {
            $message = "Något har gått fel";
        }
    } else if ($password != $confirm_password) {
        $passwordMessage = "Lösenordet stämmer inte";
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
                <p><?php echo $message ?></p>

                <form method="post" class="form">

                    <div class="login-register-input">
                        <label>E-postadress</label>
                        <input class="form-control" type="text" name="email" value="<?php echo $email ?>"
                            placeholder="cris@gmail.com">
                        <span><?php echo $v->get_error_message('email'); ?></span>
                    </div>

                    <div class="login-register-input">
                        <label>För & efternamn</label>
                        <input class="form-control" type="text" name="username" value="<?php echo $username ?>"
                            placeholder="Cristiano Ronaldo" />
                        <span><?php echo $v->get_error_message('username'); ?></span>
                    </div>

                    <div class="login-register-input">
                        <label>Lösenord</label>
                        <input class="form-control" type="password" name="password" placeholder="Lösenord" />
                        <span><?php echo $v->get_error_message('password'), $passwordMessage ?></span>
                    </div>

                    <div class="login-register-input">
                        <label>Bekräfta lösenord</label>
                        <input class="form-control" type="password" name="confirm_password"
                            placeholder="Bekräfta lösenord" />
                        <?php echo $v->get_error_message('confirm_password'), $passwordMessage ?>

                    </div>

                    <button>Bli kund</button>

                </form>
            </article>
        </section>
    </main>


</body>

</html>