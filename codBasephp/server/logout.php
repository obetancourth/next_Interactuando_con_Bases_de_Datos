<?php
    session_start();
    unset($_SESSION["usuariocod"]);
    unset($_SESSION["userdata"]);
    header('location:../client/index.html');
 ?>
