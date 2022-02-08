<?php
session_start();
if(!isset($_SESSION['time'])){
    session_regenerate_id(true);
    $_SESSION['time'] = time();
}
if(isset($_SESSION['time']) < time() - 300) {
    session_regenerate_id(true);
    $_SESSION['time'] = time();
}
require "config/settingsFiles.php";

use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;

if (isset($_SESSION['status']) && $_SESSION['status'] == 1):
    $reqFiles = new settings();
    $reqFiles->get_required_files();
    $pageName = "Register Page " . SITE_NAME;
    $reqFiles->get_header($pageName);
    $_SESSION['curPage'] = 'register';

    if ($_POST && $_POST['submit_register']) {
        $reqFiles->get_valid_checker();
        $checker = new validChecker();
        $data    = $checker->cleanData($_POST);
        $err     = [];
        if (!$checker->email($data['email'])) {
            $err['email'] = 'Email is not Valid';
        }
        if (!$checker->phone($data['contact_no'])) {
            $err['phone'] = 'Contact number is not Valid';
        }
        $pass_check = $checker->pass_confirm($data['password'], $data['cpassword']);
        if (!$pass_check && is_string($pass_check)) {
            $err['pass'] = $pass_check;
        }
        //unset unnecessory $_POST
        unset($_POST['submit_register'], $_POST['agreTnC']);
        //set to session
        foreach($_POST as $name => $value){
            $_SESSION[$name] = $value;
        }

        /**START FILES UPLOAD**/
        if($_FILES && $_FILES['image']){
            if (!class_exists('validToUploadFunc')) {
                require _DIR . '/etc/checker/validToUpload.php';
                $uploadImage = new uploadImageFunc();
                $upR = $uploadImage->validToUploadFunc($_FILES, 'image', 'image');
                var_dump($upR);
            }

        }
        //    $upload = new UploadImage();

        /**END FILES UPLOAD **/
        //firstly check is Valid to register or get OTP signed
//        if (count($err) < 1) {
        if (true) {
            $dbconn = new db();
            if (!class_exists('validToRegister')) {
                $conn            = $dbconn->getConn();
                require _DIR . '/etc/checker/validToRegister.php';
                $vtR = $validToRegister->validToRegisterFunc($conn, $data['email']);
            }
            if (isset($validToRegister) && isset($vtR)) {
                if ($vtR == true && $validToRegister->status == true ) {
                    //Insert Record if new User
                    if(!$validToRegister->userAvailCheck()){
                        $err[] =$validToRegister->userAvailCheck();
                    }
                } elseif(!$vtR && $validToRegister->status == false ) {
                    $err['valid'] = 'Your Email ( <b>' . $data['email'] . '</b> ) is not verified by us. <a class="link-dark text-decoration-underline" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Click Here</a> to verify.';
                }else{
                    $err['valid'] = $validToRegister->status;
                }
            }
        }
    }
    ?>
    <div>
        <?php
        if (isset($err) && count($err) > 0) {
            $html = '<div class="ml-2 mr-2">';
            foreach ($err as $name => $value) {
                if ($name == 'valid') {
                    $html .= '<div class="alert alert-danger">' . $value . ' <button class="btn btn-sm btn-outline-danger float-right close_err">X</button> </div>';
                } else {
                    $html .= '<div class="alert alert-warning">' . $value . ' <button class="btn btn-sm btn-outline-warning float-right close_err">X</button> </div>';
                }
            }
            $html .= '</div>';
            echo $html;
        }
        ?>
        <div class="form-header">
            REGISTRATION FORM
        </div>
        <div class="form-border">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                  name="register_form" method="post" enctype="multipart/form-data"
                  class="" id="register_form">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <label for="fname" class="form-label font-weight-bold">First name: </label>
                        <input type="text" name="fname" class="form-control " id="fname" value="" required>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="lname" class="form-label font-weight-bold">Last name: </label>
                        <input type="text" name="lname" class="form-control" id="lname" value="" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="email" class="form-label font-weight-bold">Email: </label>
                        <input type="email" name="email" class="form-control" id="email" value="" required>
                        <label class="email_error"></label>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="contact_no" class="form-label font-weight-bold">Contact No: </label>
                        <input type="number" name="contact_no" class="form-control" id="contact_no" value="">
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <label for="dob" class="form-label font-weight-bold">Date of Birth: </label>
                        <input type="date" name="dob" class="form-control " id="dob" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="jobType" class="form-label font-weight-bold">Type: </label>
                        <select name="jobType" class="form-select" id="jobType">
                            <option class="">Organization</option>
                            <option class="" selected>Joseeker</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="occupation" class="form-label font-weight-bold">Occupation: </label>
                        <input type="text" name="occupation" class="form-control" id="occupation" value="" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <label for="country" class="form-label font-weight-bold">Country: </label>
                        <input type="text" name="country" class="form-control" id="country" value="" required>
                    </div>
                    <div class="col-6">
                        <label for="state" class="form-label font-weight-bold">State: </label>
                        <input type="text" name="state" class="form-control" id="state" value="" required>
                    </div>
                    <div class="col-12">
                        <label for="city" class="form-label font-weight-bold">City: </label>
                        <input type="text" name="city" class="form-control" id="city" value="" required>
                    </div>
                    <div class="col-6">
                        <label for="address" class="d-block form-label font-weight-bold">Address: </label>
                        <textarea name="address" cols="60" rows="5" class="form-field" id="address"
                                  required> </textarea>
                    </div>

                    <div class=" col-6">
                        <div class="row">
                            <div class="col-8">
                                <label for="image" class="d-block form-label font-weight-bold">Upload Image: </label>
                                <input type="file" name="image" class="form-control-file" id="image">
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-danger" id="image-remove"> REMOVE</button>
                            </div>
                        </div>

                        <div class="col-12 form-control-file " id="preview-upload-image">
                            <img src="" alt="Image is visible here...">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-12">
                        <label for="pass" class="form-label font-weight-bold">Password: </label>
                        <input type="password" name="password" class="form-control" id="pass" required>
                    </div>
                    <div class="col-12">
                        <label for="cpass" class="form-label font-weight-bold">Confirm Password: </label>
                        <input type="password" name="cpassword" class="form-control" id="cpass" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 ml-4 pt-2">
                        <input name="agreTnC" type="checkbox" class="form-check-input" id="agreTnC" required>
                        <label for="agreTnC" class="form-check-label">I agree T&C: </label>
                    </div>
                </div>
                <hr>

                <div class="row mt-1">
                    <div class=" col-12 ">
                        <input type="reset" class="btn btn-warning float-left" value="Reset" id="resetbtn">
                        <input type="submit" name="submit_register" class="btn btn-primary float-right"
                               value="Register">
                    </div>
                </div>
                <div class="row mt-1">
                    <div class=" col-12 ">
                        <a href="<?php echo _HOME . '/login.php'; ?>" role="button"
                           class="btn btn-secondary float-right">Login</a>
                    </div>
                </div>
            </form>
        </div>
        <p class="hiddenUrl base"><?php echo _HOME; ?></p>
        <p class="hiddenUrl verify">
    </div>

    <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Verify Your Email</a>

    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Verify Your Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=""
                          name="verify_email_form" method="post" class="" id="verify_email_form">
                        <!--                    This is tab for nav-->
                        <div class="d-block ">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item text-center active">
                                    <button type="button" role="tab" class="nav-link active" id="Email-modal" data-bs-toggle="tab" data-bs-target="#pill_email" aria-selected="true">Enter Email</button></li>

                                <li class="nav-item text-center ">
                                    <button type="button" role="tab" class="nav-link" id="Code-modal" data-bs-toggle="tab" data-bs-target="#pill_code" aria-selected="false">Enter Code</button></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pill_email">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="email" class="form-label font-weight-bold">Email: </label>
                                        <input type="email" name="email" class="form-control" id="verify_email" value=""
                                               required>
                                        <label class="email_error"></label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" role="button" class="btn btn-primary float-right"
                                                id="verify_email_button">Verify
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pill_code">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="email_code" class="form-label font-weight-bold">Email: </label>
                                        <input type="email" name="email_code" class="form-control" id="email_code" value=""
                                               required>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="code" class="form-label font-weight-bold">Code: </label>
                                        <input type="text" name="code" class="form-control" id="code" value="" required>
                                        <label class="email_error _code"></label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" role="button" class="btn btn-primary float-right"
                                                id="verify_email_submit_button">Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                        data-bs-dismiss="modal">Close
                </button>
            </div>
        </div>
    </div>
    <?php
    $reqFiles->get_footer();
else:
    echo 'Cannot call directly';
endif;

