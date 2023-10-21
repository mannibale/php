<?php 
require_once("includes/config.php");

if(isset($_SESSION["userLoggedIn"])) {
	unset($_SESSION["userLoggedIn"]);
    header("Location: index.php");
	exit;
}
?>