<?php
session_start();

require "config/settingsFiles.php";

use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;

if (isset($_SESSION['status']) && $_SESSION['status'] == 1):
    $reqFiles = new settings();
    $reqFiles->get_required_files();
    $pageName = "Login Page " . SITE_NAME;
    $reqFiles->get_header($pageName);
    $_SESSION['curPage'] = 'login';
    if ($_POST && $_POST['submit_login'] && ($_POST['email'] && $_POST['password'])) {
        $reqFiles->get_valid_checker();
        $checker = new validChecker();
        $data    = $checker->cleanData($_POST);
        $err     = [];
        if (!$checker->email($data['email'])) {
            $err['valid'][] = 'Email is not Valid';
        }

        if (!empty($data['password'])) {
            if (strlen($data['password']) < 7 || strlen($data['password']) > 12) {
                $err['valid'][] = 'Length of Password is not correct.';
            }
        }

        //unset unnecessory $_POST
        unset($_POST, $data['submit_login']);
        //set to session
        foreach ($data as $name => $value) {
            $_SESSION[$name] = $value;
        }

        if (count($err) < 1) {
            $dbconn = new db();
            if (!class_exists('validToRegister')) {
                $conn = $dbconn->getConn();
                require _DIR . '/etc/checker/validToLogin.php';
                $vtR = $validToLogin->validToLoginFunc($conn, $data['email']);
            }
            if (isset($validToLogin) && isset($vtR)) {
                if ($vtR == true && $validToLogin->status == true) {
                    //Insert Record if new User
                    $userAvail = $validToLogin->userAvailCheck($data);
                    if ($userAvail !== true) {
                        $err[][] = $validToLogin->status;
                    } else {
                        //Successfully registered now goto page
                        header("location: " . _HOME . "/dashboard/index.php");
                    }
                } elseif (!$vtR && $validToLogin->status == false) {
                    $err['valid'][] = 'Your Email ( <b>' . $data['email'] . '</b> ) is not verified by us. <a class="link-dark text-decoration-underline" data-bs-toggle="modal" href="#popupVerify" role="button">Click Here</a> to verify.';
                } else {
                    $err['valid'][] = $validToLogin->status;
                }
            }
        }
    }
?>

<div>
    <?php
    if (isset($err) && count($err) > 0) {
        $html = '<div class="ml-2 mr-2">';
        foreach ($err as $errors => $val) {
            $valid = $errors == 'valid' ? true : false;
            foreach ($val as $name => $value) {
                if ($valid) {
                    $html .= '<div class="alert alert-danger">' . $value . ' <button class="btn btn-sm btn-outline-danger float-right close_err">X</button> </div>';
                } else {
                    $html .= '<div class="alert alert-warning">' . $value . ' <button class="btn btn-sm btn-outline-warning float-right close_err">X</button> </div>';
                }
            }
        }
        $html .= '</div>';
        echo $html;
    }
    ?>
    <div class="form-header">
        LOGIN
    </div>
    <div class="form-border">
        <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="loginForm" class=""
              id="login_form">
            <div class="row">
                <div class="col-12">
                    <label for="email">Email: </label>
                    <input name="email" type="email" class="form-control" id="email" required>
                    <label class="email_error"></label>
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
                <div class="col-12 ml-4 pt-2">
                    <input name="remem" type="checkbox" class="form-check-input" id="remem">
                    <label for="remem" class="form-check-label">Remeber password: </label>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class=" col-12 ">
                    <a href="#" role="link" class="link-info">Forgot Password</a>
                    <input type="submit" name="submit_login" class="btn btn-primary float-right" value="Login">
                </div>
            </div>
            <div class="row mt-1">
                <div class=" col-12 ">
                    <a href="<?php echo _HOME.'/register.php'; ?>" role="button" class="btn btn-secondary float-right">Register</a>
                </div>
            </div>
        </form>
    </div>
    <p class="hiddenUrl base"><?php echo _HOME; ?></p>
    <p class="hiddenUrl verify">
<?php
    $reqFiles->get_footer();
endif; ?>
