<?php

include("includes/header.php");
require_once("includes/init.php");


$session->logout();

redirect("login.php");
