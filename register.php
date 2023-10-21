<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");
    
    $account = new Account($con);

    if(isset($_POST["submitButton"])){
        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $username = FormSanitizer::sanitizeFormUsername($_POST["userName"]);
        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);
        // echo them out once submitted
        // echo $firstName ."<br>";
        // echo $lastName . "<br>";
        // echo $username . "<br>";
        // echo $email . "<br>";
        $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
        
        if($success){
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
			exit;
        }
    }
function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}    

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mikeflix - Register Page</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
    </head>
    <body>
        <div class="signInContainer">
            <div class="column">
                <div class="header">
                    <img src="assets/img/mikeflix.png" title="logo" alt="Site logo"/>
                    <h3>Sign Up</h3>
                    <span>to continue to Mikeflix</span>
                </div>
                <form method="POST">
                    <?php echo $account->getError(Constants::$firstNameCharacters); //Error Display for First Name ?>
                    <input type="text" name="firstName" placeholder="First Name" value="<?php getInputValue("firstName");?>" required>

                    <?php echo $account->getError(Constants::$lastNameCharacters); //Error Display for Last Name ?>
                    <input type="text" name="lastName" placeholder="Last Name" value="<?php getInputValue("lastName");?>" required>

                    <?php echo $account->getError(Constants::$usernameCharacters); //Error Display for Username ?>
                    <?php echo $account->getError(Constants::$usernameTaken); //Error Display for UsernameTaken ?>
                    <input type="text" name="userName" placeholder="Username" value="<?php getInputValue("username");?>" required>

                    <?php echo $account->getError(Constants::$emailCharacters); //Error Display for Email ?>
                    <?php echo $account->getError(Constants::$emailsDontMatch); //Error Display for emailsDontMatch?>
                    <?php echo $account->getError(Constants::$emailInvalid); //Error Display for emailInvalid?>
                    <?php echo $account->getError(Constants::$emailTaken); //Error Display for emailTaken?>
                    <input type="email" name="email" placeholder="Email" value="<?php getInputValue("email");?>" required>
                    <input type="email" name="email2" placeholder="Confirm Email" value="<?php getInputValue("email2");?>" required>

                    <?php echo $account->getError(Constants::$passwordsDontMatch); //Error Display for passwordsDontMatch?>
                    <?php echo $account->getError(Constants::$passwordLength); //Error Display for passwordLength?>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="password2" placeholder="Confirm Password" required>
                    <input type="submit" name="submitButton" value="Submit">
                </form>
                <a href="login.php" class="signInMessage">Already have an account? Sign In Here!</a>
            </div>
        </div>

    </body>
</html>    