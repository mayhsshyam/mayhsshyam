<?php
/**
 * Author: Shyam PC
 * Project: Clg_project
 * Date: 12/5/2021
 */

defined("OWNER") or die("You are not allowed to access");


?>
<?php
if (isset($_SESSION['access']) && $_SESSION['access'] == 'USER'):
    if ($_SERVER['SCRIPT_NAME'] === "/index.php"): ?>
        <!-- Navbar  -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
            <div class="container" >
                <img src="<?php echo _HOME . '/assets/logos/gen.png'; ?>" class="d-inline-block align-text-top"
                     width="80" height="80">
                <a class="navbar-brand" href="<?php echo _HOME; ?>"> <font face="Times NEW Roman" size="8">
                        <b>Lookout </b></font></a>jk9g9h
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="mx-auto"></div>
                    <ul class="navbar-nav text-center">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><font size="4.5" color="skyblue">Home</font></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><font size="4.5">About</font></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><font size="4.5">Blog</font></font></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><font size="4.5">Pricing</font></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><font size="4.5">Contact</font></a>
                        </li>
                        </font>
                    </ul>
                    <div class="mx-2 text-center text-white">
                        <a type="button" class="btn btn-success" href="#">Post A Job</a>
                        <a type="button" class="btn btn-danger" href="#">Want A Job</a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- nav bar end -->
    <?php elseif ($_SERVER['SCRIPT_NAME'] === "/login.php" || $_SERVER['SCRIPT_NAME'] === "/register.php"): ?>
        <div style="height: 100px; background: black; color:white; text-align: center; margin: 20px auto;">
            <div>
                <a href="<?php echo _HOME; ?>">HOME</a>
            </div>
            <?php if($_SERVER['SCRIPT_NAME'] =='/login.php'): ?>
                <a href="<?php echo _HOME.'/register.php'; ?>">Register</a>
            <?php else:?>
                <a href="<?php echo _HOME.'/login.php'; ?>">Login</a>
            <?php endif;?>
        </div>
    <?php endif; ?>

<?php endif; ?>
