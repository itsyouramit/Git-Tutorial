<?php 
session_start();
include "db_connection.php";

include_once "validation.php";


$AllDepartment = AllDepartment($conn,"SELECT * FROM department_table WHERE 1=1");
$AllRole  = AllRole($conn,"SELECT * FROM role_table WHERE 1=1");
  




if (isset($_POST["submit"])) {
	
	if($fnameErr==1 && $lnameErr==1 && $emailErr==1 && $dateErr==1 && $idErr==1 && $dobErr==1 && $depErr==1 && $rolErr==1 && $passErr==1 
	&& $cpassErr==1 && $dobErr==1)
	{
	   //~ $valid="All fields are validated successfully";
	   
	$first_name 	= 	validation($_POST["first_name"]);
    $last_name		= 	legal_input($_POST["last_name"]);
    $joining_date 	= 	legal_input($_POST["joining_date"]);
    $emp_id 		= 	legal_input($_POST["emp_id"]);
    $dob 			= 	legal_input($_POST["dob"]);
    $department 	= 	legal_input($_POST["department"]);
    $role 			= 	legal_input($_POST["role"]);
    $email 			= 	legal_input($_POST["email"]);
    
    $password1 		= 	legal_input($_POST["password1"]);
    $password2		= 	legal_input($_POST["password2"]);
    
    
    
    
    echo $last_name."++++++++++";
  
	   
	  





	$q1 = "INSERT INTO employee_table (first_name,last_name,joining_date,emp_id,dob,department,role,email,password1,password2) 
	VALUES ('$first_name','$last_name','$joining_date','$emp_id','$dob','$department','$role','$email','$password1','$password2')";
	$q2 = mysqli_query($conn,$q1);
	
	if($q2){
		echo "<script>alert('Employee created sucessfully')</script>";
		}else{
			echo "<script>alert('failed to create)</script>";
		}
	   
	}else{
		
		$set_first_name = $_POST["first_name"];
		$set_last_name = $_POST["last_name"];
		$set_joining_date = $_POST["joining_date"];
		$set_emp_id = $_POST["emp_id"];
		$set_dob = $_POST["dob"];
		$set_department = $_POST["department"];
		$set_role =$_POST["role"];
		$set_email = $_POST["email"];
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Create New Employee</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                           
                                                        <input class="form-control py-2" id="inputFirstName" type="text" 
                                                        placeholder="Enter first name" name="first_name"  value="<?php echo $set_firstName;?>"/>
                                                     value="<?php echo $set_firstName;?>"
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        
                                                        <input class="form-control py-2" id="inputLastName" type="text" 
                                                        placeholder="Last Name" name="last_name" value="<?php echo $set_lastName;?>" />
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Date of joining *</label>
                                                        
                                                        <input class="form-control py-2" id="inputFirstName" type="Date" 
                                                        name="joining_date" value="<?php echo $set_joining_date;?>" />
                                                         
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Employee ID*</label>
                                                        
                                                        <input class="form-control py-2" id="inputLastName" type="text" 
                                                        placeholder=""  value="<?php echo $count4;?>" name="emp_id" value="<?php echo $set_emp_id;?>" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Date of Birth*</label>
                                                       
                                                        <input class="form-control" id="inputFirstName" type="Date" name="dob" value="<?php echo $set_dob;?>" />
                                                    </div>
                                                </div>
                                             
                                             <div class="col-md-4">
												<div class="form-group">
													<label class="small mb-1" for="inputLastName">Department*</label>
													
													<select class="form-control" name="department" >
														department:
														<option class="hidden" value="">Department</option>														

														<?php

                                                                foreach ($AllDepartment as $key => $data1) { ?>
                                                                <option value="<?php echo $data1["department"];?>"><?php echo $data1["department"];?></option>
                                                                <?php } ?> 
														
													</select>
												</div>
                                             </div>
                                             
                                             <div class="col-md-4">
												<div class="form-group">
													<label class="small mb-1" for="inputLastName">Select Role*</label>
													
													<select class="form-control" name="role" >
														role:
														<option class="hidden" value="">Role</option>
														
														<?php

														foreach ($AllRole as $key => $data2) { ?>
														<option value="<?php echo $data2["role"];?>"><?php echo $data2["role"];?></option>
														<?php } ?> 

														
													</select>
												</div>
                                             </div>
                                      
                                            </div>

                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email*</label>
                                                
                                                <input class="form-control py-2" id="inputEmailAddress" type="email" aria-describedby="emailHelp" 
                                                placeholder="Enter email address" name="email" value="<?php echo $set_email;?>"/>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Password*</label>
                                                       
                                                        <input class="form-control py-2" id="inputPassword" type="password" 
                                                        placeholder="Enter password" name="password1" value="<?php echo $password1;?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Confirm Password*</label>
                                                        
                                                        <input class="form-control py-2" id="inputConfirmPassword" type="password" 
                                                        placeholder="Confirm password" name="password2" value="<?php echo $password2;?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2 mb-2">
												<div class="col-md-12">
													<input type="submit" value="Create Employee" class="btn btn-primary btn-block" name="submit">												
												</div>
												
                                            </div>
                                        </form>
                                      <div>
                                      <?php if($lnameErr!=1){ echo $lnameErr; }?>
                                      <?php if($fnameErr!=1){ echo $fnameErr; }?>
                                      <?php if($fnameErr!=1){ echo $fnameErr; }?>
                                      </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                </main>
                  <div>
					
					<?php echo $nameErr1;?><br>
					<?php echo $nameErr2;?><br>
					<?php echo $dateErr; ?><br>
					
					<?php echo $idErr;?><br>
					<?php echo $dobErr;?><br>
					<?php echo $depErr; ?><br>
					<?php echo $rolErr;?><br>
					<?php echo $emailErr;?><br>
					<?php echo $passErr;?><br>
					<?php echo $cpassErr;?>
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













