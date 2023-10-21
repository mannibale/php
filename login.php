<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);

    if(isset($_POST["submitButton"])){
        $username = FormSanitizer::sanitizeFormUsername($_POST["userName"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

        $success = $account->login($username, $password);
    
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
        <title>Mikeflix - Login Page</title>
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
                    <?php echo $account->getError(Constants::$loginFailed);?>
                    <input type="text" name="userName" placeholder="Username" value="<?php getInputValue("username");?>" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="submit" name="submitButton" value="Submit">
                </form>
                <a href="register.php" class="signInMessage">Need an account? Sign Up Here!</a>
            </div>
        </div>

    </body>
</html>  