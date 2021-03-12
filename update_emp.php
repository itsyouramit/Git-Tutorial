<?php 
session_start();
include_once "db_connection.php";
include_once "function.php";


//error_reporting(0);
if(!isset($_SESSION["ROLE"])){
	header("location:login.php");
    die();
	}
	
	
// fetching data from department table

$Q1 = "SELECT * FROM `department_table`";
$result1 = mysqli_query($conn,$Q1);
$count1 = mysqli_num_rows($result1);

// fetching data from role table 

$Q2 = "SELECT * FROM `role_table`";
$result2 = mysqli_query($conn,$Q2);
$count2 = mysqli_num_rows($result2);

$Q3 = "SELECT * FROM `employee_table`";
$result3 = mysqli_query($conn,$Q3);
$count3 = mysqli_num_rows($result3);

$count4 =$count3+1;



$id 			= 	$_GET["id"];
$firstname 		=	$_GET["firstname"];
$lastname 		=	$_GET["lastname"];
$joining_date 	= 	$_GET["joining_date"];
$emp_id 		= 	$_GET["emp_id"];
$dob 			= 	$_GET["dob"];
$department 	= 	$_GET["department"];
$role 			= 	$_GET["role"];
$email 			= 	$_GET["email"]; 




if(isset($_POST["update"])){
	$firstname 		=	$_POST["first_name"];
	$lastname 		=	$_POST["last_name"];
	$joining_date 	= 	$_POST["joining_date"];
	$emp_id 		= 	$_POST["emp_id"];
	$dob 			= 	$_POST["dob"];
	$email	 		= 	$_POST["email"];
	$department 	= 	$_POST["department"];
	$role 			= 	$_POST["role"];
			
	
	
	$error=update_emp($conn);
		
	if(sizeOf($error)<=0)
		{
			
		$q1 = "UPDATE `employee_table` SET `firstname`='$firstname ',`lastname`='$lastname ',`joining_date`='$joining_date',`emp_id`='$emp_id',
		`dob`='$dob',`department`='$department',`role`='$role',`email`='$email'WHERE id=$id";
		$result = mysqli_query($conn,$q1);

			if($result){
			echo '<script>alert("Employee Updated Successfully ")</script>'; 	
			}else{
			echo '<script>alert("Failed to update ")</script>';
			}	
			
		}else{
			$error[]="Error".mysqli_error($conn);
		}
	
}	


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>WizeBrain Family</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed">
        <!-- navigation bar -->
        <?php include "navbar.php"; ?>
        
        <!-- sidenav-->
        <div id="layoutSidenav">
           <?php include "leftsidenav.php"; ?>  
			<!-- sidecontent-->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">

					<div class="container" style="margin-top:40px;">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-3">
									
						<?php if(isset($error) && sizeOf($error)>0){ ?>
							<div class="error"> 
							<?php foreach($error as $error_message){ 
							echo $error_message."<br>";
							} ?>

							</div>
							<?php } ?>
									
									
                                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Update Employee</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                           
                                                        <input class="form-control py-2" id="inputFirstName" type="text" 
                                                         value="<?php echo $firstname;?>" name="first_name" />
                                                     
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        
                                                        <input class="form-control py-2" id="inputLastName" type="text" 
                                                        placeholder="<?php echo $lastname;?>" value="<?php echo $lastname;?>" 
                                                        name="last_name" />
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Date of joining *</label>
                                                        
                                                        <input class="form-control py-2" id="inputFirstName" type="text" 
                                                        placeholder="<?php echo $joining_date;?>" value="<?php echo $joining_date;?>" 
                                                        name="joining_date" />
                                                         
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Employee ID*</label>
                                                        
                                                        <input class="form-control py-2" id="inputLastName" type="text" 
                                                        placeholder=""  value="<?php echo $emp_id;?>" name="emp_id" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Date of Birth*</label>
                                                       
                                                        <input class="form-control" id="inputFirstName" type="text" 
                                                         placeholder="<?php echo $dob;?>" value="<?php echo $dob;?>" name="dob" />
                                                    </div>
                                                </div>
                                             
                                             <div class="col-md-4">
												<div class="form-group">
													<label class="small mb-1" for="inputLastName">Department*</label>
													
													<select class="form-control" name="department" placeholder="<?php echo $department;?>"  required >
														department:
														<option class="hidden"  ><?php echo $department;?></option>														

														<?php for($i=1;$i<=$count1;$i++){
															$data = mysqli_fetch_assoc($result1);?>
														
														<option name="catagory" value="<?php echo $data["department"];?>"><?php echo $data["department"];?></option>
														<?php } ?>
														
													</select>
												</div>
                                             </div>
                                             
                                             <div class="col-md-4">
												<div class="form-group">
													<label class="small mb-1" for="inputLastName">Select Role*</label>
													
													<select class="form-control" name="role" required>
														role:
														<option class="hidden"  ><?php echo $role;?></option>
														
														<?php for($j=1;$j<=$count2;$j++){
															$data2 = mysqli_fetch_assoc($result2);
															?>														
															<option name="catagory" value="<?php echo $data2["role"];?>" ><?php echo $data2["role"]; ?></option>
															<?php } ?>
														
													</select>
												</div>
                                             </div>
                                      
                                            </div>

                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email*</label>
                                                
                                                <input class="form-control py-2" id="inputEmailAddress" type="email" aria-describedby="emailHelp" 
                                                placeholder="<?php echo $email;?>" value="<?php echo $email;?>" name="email" />
                                            </div>
                                            <div class="form-row">
                             
                                            </div>
                                            <div class="form-group mt-2 mb-2">
												<div class="col-md-12">
													<input type="submit" value="Update Employee" class="btn btn-primary btn-block" name="update">												
												</div>
												
                                            </div>
                                        </form>
                                      
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                </main>
                  <div>
					<?php echo $ErrorMsg;?><br>
					<?php echo $nameErr1;?><br>
					<?php echo $nameErr2;?><br>
					<?php echo $dateErr; ?><br>
					
					<?php echo $idErr;?><br>
					<?php echo $dobErr;?><br>
					<?php echo $depErr; ?><br>
					<?php echo $rolErr;?><br>
					<?php echo $emailErr;?><br>
					<?php echo $passErr;?>
				</div>
                <!-- footer start  -->
                <?php include "footer.php"; ?> 

            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>

