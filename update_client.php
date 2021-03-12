<?php
session_start();
include "db_connection.php";
include "function.php";


if(!isset($_SESSION["ROLE"])){
	header("location:login.php");
    die();
	}
	

$Q1 = "SELECT * FROM `department_table`";
$result1 = mysqli_query($conn,$Q1);
$count1 = mysqli_num_rows($result1);

	

$id 			= 	$_GET["id"];
$fname			=	$_GET["firstname"];
$lname 			=	$_GET["lastname"];
$joindate		=	$_GET["joindate"];
$age_name 		=	$_GET["age_name"];
$contact 		=	$_GET["contact"];
$department 	=	$_GET["department"];
$country 		=	$_GET["country"];
$email 			=	$_GET["email"];


if(isset($_POST["update"])){
		
	$first_name 	=	$_POST["first_name"];
	$last_name 		=	$_POST["last_name"];
	$joining_date	=	$_POST["joining_date"];
	$age_name 		=	$_POST["age_name"];
	$contact 		=	$_POST["contact"];
	$department 	=	$_POST["department"];
	$country 		=	$_POST["country"];
	$email 			=	$_POST["email"];



	$error=validate_client($conn);
	
	if(sizeOf($error)<=0)
		{
			
	$q1 = "UPDATE `client_table` SET first_name='$first_name',last_name='$last_name',joining_date='$joining_date',
	age_name='$age_name',contact='$contact',department='$department',country='$country',email='$email' WHERE id='$id'";
	
	$result = mysqli_query($conn,$q1);
			
		if($result){
			echo '<script>alert("Client Updated Successfully ")</script>';
			}
		else{
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
									
									
                                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Update Client</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                           
                                                        <input class="form-control py-2" id="inputFirstName" type="text" 
                                                        placeholder="Enter first name" name="first_name"  value="<?php echo $fname;?>"/>
                                                     
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        
                                                        <input class="form-control py-2" id="inputLastName" type="text" 
                                                        placeholder=" " name="last_name"  value="<?php echo $lname;?>"/>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Date of joining *</label>
                                                        
                                                        <input class="form-control py-2" id="inputFirstName" type="Date" 
                                                         value="<?php echo $joindate;?>" name="joining_date" />
                                                         
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Agency Name*</label>
                                                        
                                                        <input class="form-control py-2" id="inputLastName" type="text" 
                                                        name="age_name" value="<?php echo $age_name;?>"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Contact*</label>
                                                       
                                                        <input class="form-control" id="inputFirstName" type="text" placeholder="Contact" name="contact" 
                                                        value="<?php echo $contact;?>"/>
                                                    </div>
                                                </div>
                                             
                                             <div class="col-md-4">
												<div class="form-group">
													<label class="small mb-1" for="inputLastName">Department*</label>
													
													<select class="form-control" name="department" value="<?php echo $department;?>" >
														department:
														<option class="hidden" value=""><?php echo $department;?></option>														

														<?php for($i=1;$i<=$count1;$i++){
															$data = mysqli_fetch_assoc($result1);?>
														
														<option name="catagory" value="<?php echo $data["department"];?>"><?php echo $data["department"];?></option>
														<?php } ?>
														
													</select>
												</div>
                                             </div>
                                             
                                             <div class="col-md-4">
												<div class="form-group">
													<label class="small mb-1" for="inputLastName">Country*</label>
													
													<input class="form-control py-2" id="inputLastName" type="text" 
                                                        placeholder="Country Name"   name="country" value="<?php echo $country;?>"/>
												</div>
                                             </div>
                                      
                                            </div>

                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email*</label>
                                                
                                                <input class="form-control py-2" id="inputEmailAddress" type="email" aria-describedby="emailHelp" 
                                                placeholder="Enter email address" name="email" value="<?php echo $email;?>"/>
                                            </div>
                                       
                                            <div class="form-group mt-2 mb-2">
												<div class="col-md-12">
													<input type="submit" value="Update Client" class="btn btn-primary btn-block" name="update">												
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
                <!-- footer start  -->
                <?php include "footer.php";
                ?> 
 

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





