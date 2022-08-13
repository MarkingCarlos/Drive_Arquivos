<?php

    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['id_adm'])){
        die("Acesso negado. <p><a href=\"../index.php\">Logar</a></p>");
    }
?>