<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 12/5/2021
 */

session_start();
if(isset($_SESSION['logout']) && $_SESSION['logout'] = true){

}
session_destroy();
session_unset();
