<?php

session_start();

session_unset();

session_destroy();

if(!isset($_SESSION['adm'])){
    header("Location:./");
}