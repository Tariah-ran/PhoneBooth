<?php
//ends and redirects the page back to the signIn page
session_destroy();
header("location: index.php");
?>