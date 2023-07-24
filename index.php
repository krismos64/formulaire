<?php
$firstname = $name = $email = $phone = $message = "";
$firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
$isSuccess = false;
$emailto = "c.mostefaoui@yahoo.fr";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  $firstname = verifyInput($_POST["firstname"]);
  $name = verifyInput($_POST["name"]);
  $email = verifyInput($_POST["email"]);
  $phone = verifyInput($_POST["phone"]);
  $message = verifyInput($_POST["message"]);
  $isSuccess = true;
  $emailText = "";

if(empty($firstname))
{
  $firstnameError = "Donnez-nous votre prénom !";
  $isSuccess = false;
}
else
{
  $emailText .= "Firstname: $firstname\n";
}

if(empty($name))
{
  $nameError = "Donnez-nous votre nom !";
  $isSuccess = false;
}
else
{
  $emailText .= "name: $name\n";
}
if(!isEmail($email))
{
  $emailError = "Ce n'est pas une adresse mail valide !";
  $isSuccess = false;
}
else
{
  $emailText .= "email: $email\n";
}
if(!isPhone($phone))
{
  $phoneError = "Ce n'est pas un numéro valide";
  $isSuccess = false;
}
else
{
  $emailText .= "phone: $phone\n";
}
if(empty($message))
{
  $messageError = "Vous n'avez rien à nous dire ?";
  $isSuccess = false;
}
else
{
  $emailText .= "message: $message\n";
}
if ($isSuccess) 
{
  $headers = "From: $firstname $name <email>\r\nReply-to: $email";
  mail($emailto, "Un message de votre site", $emailText, $headers);
  $firstname = $name = $email = $phone = $message = "";
}

}

function isPhone($var)
{
 return preg_match("/^[0-9 ]+$/",$var);
}
function isEmail($var)
{
  return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function verifyInput($var)
{
  $var = trim($var);
  $var = stripcslashes($var);
  $var = htmlspecialchars($var);
  return $var;
}

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contactez-nous</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="http://fonts.googleapis.com/css?family=Lato"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="container">
      <div class="divider"></div>
      <div class="heading">
        <h2>Contactez-nous</h2>
      </div>
      <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
          <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
            <div class="row">
              <div class="col-md-6">
                <label for="firstname"
                  >Prénom <span class="blue">*</span></label
                >
                <input
                  type="text" 
                  id="firstname"
                  name="firstname"
                  class="form-control"
                  placeholder="Votre prénom"
                  value="<?php echo $firstname; ?>" 
                />
                <p class="comment"><?php echo $firstnameError; ?></p>
              </div>
              <div class="col-md-6">
                <label for="name">Nom<span class="blue">*</span></label>
                <input
                  type="text" 
                  id="name"
                  name="name"
                  class="form-control"
                  placeholder="Votre nom"
                  value="<?php echo $name; ?>"
                />
                <p class="comment"><?php echo $nameError; ?></p>
              </div>
              <div class="col-md-6">
                <label for="email">Email <span class="blue">*</span></label>
                <input
                  type="email" 
                  id="email"
                  name="email"
                  class="form-control"
                  placeholder="Votre email"
                  value="<?php echo $email; ?>"
                />
                <p class="comment"><?php echo $emailError; ?></p>
              </div>
              <div class="col-md-6">
                <label for="phone">Téléphone <span class="blue">*</span></label>
                <input
                  type="tel" 
                  id="phone"
                  name="phone"
                  class="form-control"
                  placeholder="Votre n° de téléphone"
                  value="<?php echo $phone; ?>"
                />
                <p class="comment"><?php echo $phoneError; ?></p>
              </div>
              <div class="col-md-12">
                <label for="message">Message<span class="blue">*</span></label>
                <textarea
                  id="message"
                  name="message"
                  class="form-control"
                  placeholder="Votre message"
                  rows="4">
                  <?php echo $message; ?>
                </textarea>
                <p class="comment"><?php echo $messageError; ?></p>
              </div>
              <div class="col-md-12">
                <p class="blue">
                  * <strong> Ces informations sont requises</strong>
                </p>
              </div>
              <div class="col-md-12">
                <input type="submit" class="button1" value="Envoyer" />
              </div>
            </div>
            <p class="thank-you" style="display:<?php if($isSuccess) echo 'block'; else echo 'none'; ?>">
              Votre message a bien été envoyé. Merci de nous avoir contacté !
            </p>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
