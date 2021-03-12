<?php 
session_start();
include_once "db_connection.php";
include_once "function.php";

if(isset($_POST["submit"])){
    
    $department_name = strtoupper($_POST["department"]);
    
     $error=validate_dep($conn);

    
    	if(sizeOf($error) <= 0)
		{	
		$q1 = "INSERT INTO department_table (department) VALUES('$department_name')";
		$q2 = mysqli_query($conn, $q1);
		
		if($q2){
			echo '<script>alert("Department Created Successfully ")</script>'; 
			}else{
				echo '<script>alert("Failed to create  ")</script>';
				}		
		} 
		else{
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
                    <div class="container-fluid" style="margin-top:140px;">
                      
					<div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-3">

								<div class="card-header"><h3 class="text-center font-weight-light my-4">Create Department</h3></div>
                                    <div class="card-body">
                                        <form method = "POST">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" 
                                                        placeholder="Enter Department Name" name="department" />
                                                    </div>
                                                </div>
                                       
                                            </div>
                                            <div class="form-group mt-4 mb-0">
												<input type="submit" name="submit" class="btn btn-primary btn-block" value="Create Department">
											</div>											
                                        </form>
                                        <!--form end-->
                                    </div>
                            <?php if(isset($error) && sizeOf($error)>0){ ?>
							<div class="error"> 
							<?php foreach($error as $error_message){ 
							echo $error_message."<br>";
							} ?>

							</div>
							<?php } ?>
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
