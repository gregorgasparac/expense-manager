<?php

session_start();
unset($_SESSION["userID"]);
header("Location: index.html");

?>