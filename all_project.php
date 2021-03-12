<?php 
session_start();

if(!isset($_SESSION["ROLE"])){
	header("location:login.php");
    die();
	}


include_once "db_connection.php";
include_once "function.php";
		
$all_project=all_project($conn);




$record_per_page = 6;
$all_emp=emp_count($conn);

$total_page=ceil(total_proj($conn)/$record_per_page);

if(isset($_GET["page"]) && $_GET["page"]!=1)
{
	$start_no = ($_GET["page"]-1)*$record_per_page;
	}
	else{
		$start_no=0;
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
                        <h1 class="mt-4" style="text-align:center;">Project Details</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Project Details</li>
                        </ol>


					<div class="container-fluid">
                      

                        <div class="card mb-4">
                   
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>SL No.</th>
                                  
                                                <th>Project Title</th>
                                                <th>Client Name</th>
                                                <th>Site URL</th>
                                                <th>Status</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                 
                                        <tbody>
											
            
									<?php 
																			
										$q1 = "SELECT * FROM project_table LIMIT $record_per_page OFFSET $start_no";
										$query = mysqli_query($conn,$q1);

										while($rows=mysqli_fetch_array($query)){ 
											$count++; ?>
											<tr>
												<td><?php echo $count;?></td>
												<td><?php echo $rows["project_title"]?></td>
												<td><?php echo $rows["client_name"]?></td>
												<td><?php echo $rows["url"]?></td>
												<td><?php echo $rows["status"]?></td>
												<!--
												<td>
													<btn>
														<a class="btn btn-primary" href="update_emp.php?id=<?php echo $rows["id"];?>&firstname=<?php echo $rows["firstname"]?>&lastname=<?php echo $rows["lastname"]?>&joining_date=<?php echo $rows["joining_date"]?>
														&emp_id=<?php echo $rows["emp_id"]?>&dob=<?php echo $rows["dob"]?>
														&department=<?php echo $rows["department"]?>&role=<?php echo $rows["role"]?>
														&email=<?php echo $rows["email"];?>">Update</a>
													</btn>
												</td> -->	
							
												<td >
													<btn>
														<a class="btn btn-danger" href="delete_project.php?id=<?php echo $rows['id'];?>"onclick="conf_delete()">Delete</a>
													</btn>
												</td>
											</tr>
											
										<?php } ?>                             
                                            
                                        </tbody>
                                        
                                    </table>
                                    
                                    <div style="text-align:center;">
                                     <?php 
										for($page_no = 1; $page_no<= $total_page; $page_no++) {  	
										echo '<a href = "all_emp.php?page=' . $page_no . '">' . $page_no . ' </a>';
										}
									?>                                    
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

