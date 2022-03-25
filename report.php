<?php session_start();
require "config/settingsFiles.php";

use config\settingsFiles\settingsFiles as settings;
use config\dbFiles\dbFIles as db;

$reqFiles                = new settings();
$reqFiles->get_required_files();
$pageName = "Report Page " . SITE_NAME;
$_SESSION['access'] = isset($_SESSION['access'])? $_SESSION['access'] : 'USER';
$_SESSION['curPage'] = 'dashboard';
$reqFiles->get_header($pageName);
?>
		<section class="inner-header-title blank">
			<div class="container">
					<h1>Report</h1>
				</div>
		</section>
		<div class="clearfix"></div>
		             <div class="detail-desc section">
				<div class="container white-shadow">
				
				<br>	
					<div class="row bottom-mrg">
						<form class="add-feild">
							<div class="col-md-12 col-sm-6">
								<div class="input-group">
									<select class="form-control input-lg" required>
										<option>Spam</option>
										<option>Misleading Information</option>
										<option>Sexual Content</option>
										<option>Violance Content</option>
									</select>
								</div>
							</div>
							
							<div class="col-md-12 col-sm-12">
								<textarea id="demo" class="form-control" placeholder="Report Description" required></textarea>
								<span id="s1" style="color:red;"></span>
							</div>

							<div class="col-md-6 col-sm-3">
								<button type="submit" class="update-btn">Report</button>
							</div>
							<div class="col-md-6 col-sm-3">
								<button type="submit" class="update-btn">cancel</button>
							</div>


					</form>
				</div>
			</div>
		</div>
<?php
$reqFiles->get_footer(false);
