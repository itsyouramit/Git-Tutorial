<?php 
session_start();
include_once "db_connection.php";
include_once "function.php";

if(!isset($_SESSION["ROLE"])){
	header("location:login.php");
    die();
	}

$allcount=allcount($conn);
$allclient=allclient($conn);
$all_TL=all_TL($conn);
$all_manager=all_manager($conn);

//$AllDepartment=AllDepartment($conn,"SELECT * FROM department_detail WHERE 1=1");

$AllEmployee=AllEmployee($conn);

	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){

	$project_title 	= 	$_POST["project_title"];
    $client_name	= 	$_POST["client_name"];
    $start_date 	= 	$_POST["start_date"];
    $upwork_id 		= 	$_POST["upwork_id"];
    $hired_by 		= 	$_POST["hired_by"];
    $bid_dep 		= 	$_POST["bid_dep"];
    $country 		= 	$_POST["country"];
    $project_manager= 	$_POST["project_manager"];
    $status			= 	$_POST["status"];
    $team_leder 	= 	$_POST["team_leder"];
    $url			= 	$_POST["url"];  
     
     $error=validate_project($conn);
 
     if(sizeof($error) <= 0){
		  
		$q1 = "INSERT INTO `project_table` (`project_title`, `client_name`, `start_date`, `upwork_id`, `hired_by`, `bid_dep`, `country`, `project_manager`,`status`,`team_leder`, `url`) 
			VALUES ('$project_title','$client_name','$start_date','$upwork_id','$hired_by','$bid_dep','$country','$project_manager','$status','$team_leder','$url')";
			$q2 = mysqli_query($conn, $q1);
				
		if($q2){
			echo '<script>alert ("Project Added Sucessfully")</script>';
			}
			else{
				return false;
				}		 
		 }else{
			 $error[]="error".mysqli_error($conn);
			 }

}
	

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<!--header script-->
	<?php include "header_script.php"; ?>
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
                        
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Project Details</li>
                        </ol>
					<div class="container">
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


                                    <div class="card-header"><h3 class="text-center font-weight-light my-2">Project Details</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Project Title</label>
                                                        <input class="form-control py-2" id="inputFirstName" type="text" 
                                                        placeholder="Project Title" name="project_title" />   
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Client Name</label>
                                                        <select class="form-control py-2" name="client_name"> 
                                                        
															<option value="">select client</option>
															<?php foreach($allclient as $rows){?>
																<option value="<?php echo $rows["first_name"];?>"><?php echo $rows["first_name"];?></option>
																<?php } ?>
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Start Date</label>
                                                        <input class="form-control py-2" id="inputFirstName" type="Date" 
                                                        name="start_date" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Upwork ID</label>

                                                        <input class="form-control py-2" id="inputLastName" type="text" 
                                                       value="<?php echo $id_count; ?>" placeholder="Upwork Id" 
                                                       name="upwork_id" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Biding Department</label>
                                                        
                                                        <select name="bid_dep" class="form-control py-2">
                                                            <option value="">select department</option>
                                                            <?php foreach($allcount as $rows1){?>
                                                                <option value="<?php echo $rows1["department"];?>"><?php echo $rows1["department"]?>
                                                                </option>
                                                               <?php } ?>																
																
															</select>
															                                                                                                          
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Hired By</label>
                                                        <select name="hired_by" class="form-control py-2">
															
                                                            <option value="">select name</option>
                                                            <?php foreach($AllEmployee as $rows1){?>
                                                                <option value="<?php echo $rows1["firstname"];?>"><?php echo $rows1["firstname"]?>
                                                                </option>
                                                               <?php } ?>
      
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName" >Country</label>
														<input class="form-control py-2" id="inputFirstName" type="text" 
                                                        placeholder="country" name="country" />                                                      
                                                    </div>
                                                </div>    

                                            </div>

										<div class="form-row">  
										<div class="col-md-6">
										   <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Project Manager</label>
                                                     <select name="project_manager" class="form-control py-2">
															
                                                            <option value="">Select Project Manager</option>
                                                            <?php foreach($all_manager as $rows1){?>
                                                                <option value="<?php echo $rows1["firstname"];?>"><?php echo $rows1["firstname"]?>
                                                                </option>
                                                               <?php } ?>
      
                                                        </select>            
													</div>
											</div>
											
										<div class="col-md-6">
										   <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Status</label>
                                                     <select name="status" class="form-control py-2">
															
                                                            <option value="">Select Status</option>
                                                                <option value="Active">Active</option>
                                                                <option value="Inactive">Inactive</option>
                                                        </select>            
													</div>
											</div>
										</div>

                                            
                                            
                                            
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Team Leader</label>
                                                        <select name="team_leder" class="form-control py-2">
															
                                                            <option value="">select team leader</option>
                                                            <?php foreach($all_TL as $rows1){?>
                                                                <option value="<?php echo $rows1["firstname"];?>"><?php echo $rows1["firstname"]?>
                                                                </option>
                                                               <?php } ?>
      
                                                        </select>                   

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Site URL</label>
                                                        <input class="form-control py-2" id="inputConfirmPassword" type="text" 
                                                        placeholder="URL" name="url" />
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" name="submit" value="Add Project" class="btn btn-primary btn-block">
                                    <div>
                                        <?php echo $nameError; ?>
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
                <?php include "footer.php"; ?> 

            </div>
        </div>
			<!-- footer start  -->
			<?php include_once "footer_script.php"; ?> 
    </body>
</html>
