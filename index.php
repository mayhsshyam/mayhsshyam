<?php
/**
 * Author: Shyam
 * Project: Clg_project
 * Date: 12/5/2021
 */

session_start();
require "config/generalFiles.php";
//require "config/dbFiles.php";
$_SESSION['access']  = isset($_SESSION['access']) ? $_SESSION['access'] : 'USER';

$_SESSION['curPage'] = "index";
require "header.php";
$data=true;
require "footer.php";
