<?php
require_once '../config.php';
require_once '../models/admin.php';
if (isset($_GET["validate"])) {
    utilisateurs::validate($_GET['validate']);
    
    header("Location: controller-utilisateurs.php");
    exit();
}
if (isset($_GET["unvalidate"])) {
    utilisateurs::unvalidate($_GET['unvalidate']);
    
    header("Location: controller-utilisateurs.php");
    exit();
}

