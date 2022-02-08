<?php
session_start();
$curFile = 'Login';
use config\settingsFiles\settingsFiles;
if($_SESSION['status'] == 1):
//general files inistialiazation
    require "config/settingsFiles.php";
    $reqFiles = new settingsFiles();
    $reqFiles->get_required_files();
    $pageName = "Login page " . SITE_NAME;
    $reqFiles->get_header();
    $_SESSION['curPage'] ='login';
    if($_POST){
        if(true){
        }
    }

?>

<div>

    <div class="form-header">
        LOGIN
    </div>
    <div class="form-border">
        <form method="post" action="<?php htmlspecialchars($_SERVER['DOCUMENT_ROOT']); ?>" name="loginForm" class="login-form">
            <div class="row">
                <div class="col-12">
                    <label for="email">Email: </label>
                    <input name="email" type="email" class="form-control" id="email" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <label for="pass">Password: </label>
                    <input name="password" type="password" class="form-control" id="pass" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ml-4 pt-2" >
                    <input name="remem" type="checkbox" class="form-check-input" id="remem">
                    <label for="remem" class="form-check-label">Remeber password: </label>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class=" col-12 ">
                    <a href="#" role="link" class="link-info">Forgot Password</a>
                    <input type="submit" class="btn btn-primary float-right" value="Login">
                </div>
            </div>
            <div class="row mt-1">
                <div class=" col-12 ">
                <a href="/register.php" role="button" class="btn btn-secondary float-right">Register</a>
                </div>
            </div>
        </form>
    </div>

<?php
    $reqFiles->get_footer();
endif;?>
