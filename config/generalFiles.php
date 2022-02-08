<?php

/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 12/5/2021
 */

namespace config\generalFiles;

if ($_SERVER['SCRIPT_NAME'] == '/config/generalFiles.php' || $_SERVER['REQUEST_URI'] == '/config/generalFiles.php')
    die('Direct access is not allowed');

if (!defined("OWNER")) {
    define("OWNER", "k&s");
}
if (!defined("SITE_NAME")) {
    define("SITE_NAME", "| LOOKOUT");
}
if (!defined("_HOME")) {
    // $isHTTPS = $_SERVER['HTTPS'] != NULL  ? 'https://': 'http://' ;
    define("_HOME", 'http://' . $_SERVER['HTTP_HOST']);
}
if (!defined("_DIR")) {
    define("_DIR", $_SERVER['DOCUMENT_ROOT']);
}
if (!defined("_UPLOAD")) {
    define("_UPLOAD",_DIR.'/uploads/');
}
