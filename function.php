<?php 
include_once "db_connection.php";


function AllDepartment($conn,$query){  
	$result = mysqli_query ($conn,$query);
	$count = 0;
	   $data = array();
	   while ( $row = mysqli_fetch_array($result)){
	       $data[$count] = $row;
		$count++;
	   }
	   return $data;	
}



//total no. of employee
function total_emp($conn){  
	 $query = "SELECT * FROM employee_table";
	$result = mysqli_query ($conn,$query);
	$total_rows = mysqli_num_rows($result);
	return $total_rows;
}

//total no. of client
function total_client($conn){  
	 $query = "SELECT * FROM client_table";
	$result = mysqli_query ($conn,$query);
	$total_rows = mysqli_num_rows($result);
	return $total_rows;
}

//total no. of project
function total_proj($conn){  
	 $query = "SELECT * FROM project_table";
	$result = mysqli_query ($conn,$query);
	$total_rows = mysqli_num_rows($result);
	return $total_rows;
}

//total no. of department
function total_dep($conn){  
	 $query = "SELECT * FROM department_table";
	$result = mysqli_query ($conn,$query);
	$total_rows = mysqli_num_rows($result);
	return $total_rows;
}



function AllRole($conn,$query){  
	 
	$result = mysqli_query($conn,$query);
	$count = 0;
	   $data = array();
	   while ( $row = mysqli_fetch_array($result)){
	       $data[$count] = $row;
		$count++;
	   }
	   return $data;	
}


function all_TL($conn){  
	$query = "SELECT * FROM employee_table WHERE role='TEAM LEADER PHP'";
	$result = mysqli_query($conn,$query);
	$count = 0;
	   $data = array();
	   while ( $row = mysqli_fetch_array($result)){
	       $data[$count] = $row;
		$count++;
	   }
	   return $data;	
}


function all_manager($conn){  
	$query = "SELECT * FROM employee_table WHERE role='Project Manager php'";
	$result = mysqli_query($conn,$query);
	$count = 0;
	   $data = array();
	   while ( $row = mysqli_fetch_array($result)){
	       $data[$count] = $row;
		$count++;
	   }
	   return $data;	
}

function all_project($conn){
	$query = "SELECT * FROM project_table WHERE 1=1";
	$result = mysqli_query($conn,$query);
	$count = 0;
	   $data = array();
	   while ( $row = mysqli_fetch_array($result)){
	       $data[$count] = $row;
		$count++;
	   }
	   return $data;	
	}



function allclient($conn){  
	$query = "SELECT * FROM client_table WHERE 1=1";
	$result = mysqli_query($conn,$query);
	$count = 0;
	   $data = array();
	   while ( $row = mysqli_fetch_array($result)){
	       $data[$count] = $row;
		$count++;
	   }
	   return $data;	
}

//SELECT * FROM department_table INNER JOIN bid_department ON department_table.department = bid_department.department

function allcount($conn){  
	$query="SELECT * FROM department_table WHERE department= 'BIDDING PHP' OR department = 'BIDDING SEO'"; 
	$result = mysqli_query($conn,$query);
	$count = 0;
	   $data = array();
	   while ( $row = mysqli_fetch_array($result)){
	       $data[$count] = $row;
		$count++;
	   }
	   return $data;	
}



function AllEmployee($conn){  
	$query= "SELECT * FROM employee_table WHERE role='BIDDER PHP' or role ='BIDDER SEO'";
	$result = mysqli_query($conn,$query);
	$count = 0;
	   $data = array();
	   while ( $row = mysqli_fetch_array($result)){
	       $data[$count] = $row;
		$count++;
	   }
	   return $data;	
}




	
function emp_count($conn){
	
	$q1 = "SELECT * FROM employee_table";
	$q2 = mysqli_query($conn,$q1);
	$total_rows = mysqli_num_rows($q2);
	return $total_rows;
	
	}	



function delete_project($conn){
	$id = $_GET["id"];
	$q1 = "DELETE FROM project_table WHERE id='$id'";
	$result = mysqli_query($conn,$q1);
	if($result){
		echo "deleted succefully";
		}else{
			echo "deleted fail";
			}
		}

//function to find all department

function getDepartment($conn){                           
$result=mysqli_query($conn,"SELECT * FROM department_detail WHERE 1=1");	
if(mysqli_num_rows($result)>0)
{	
	while($row=mysqli_fetch_assoc($result)){
 		$role[]=$row;										 
		}
		}	                                                        
	else{
		
		$role[]=0;
		}
	
   return $role;
   
}
	


function Employee($conn,$query){
	$q1 = mysqli_query($conn, $query);
	return $q1;
}





/*validation function*/

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  if($data!=''){
	  
  }
  return $data;
}


//function to validate department

function validate_dep($conn){

	$department  = $_POST['department'];
	$error=[];

    if(empty($_POST['department'])){
        $error[]="Department Is Required";
        
    }elseif ($sql = "SELECT * FROM department_table WHERE department ='$department'") {
        $result =mysqli_query ($conn,$sql);  
        if(mysqli_num_rows($result)> 0){
           $error[]= 'Department already Exist';   
        } else{
            $department = test_input($_POST["department"]);

            if (!preg_match("/^[a-zA-Z ]*$/",$department)){
            $error[] = "Only letters allowed";
            } 
        } 
    }
    return $error;
}



//function to validate role

function validate_role($conn){

	$role  = $_POST['role'];
	$error=[];

    if(empty($_POST['role'])){
        $error[]="Role Is Required";
        
    }elseif ($sql = "SELECT * FROM role_table WHERE role ='$role'") {
        $result =mysqli_query ($conn,$sql);  
        if(mysqli_num_rows($result)> 0){
           $error[]= 'Role already Exist';   
        } else{
            $role = test_input($_POST["role"]);

            if (!preg_match("/^[a-zA-Z ]*$/",$role)){
            $error[] = "Only letters allowed";
            } 
        } 
    }
    return $error;
}



//Function to validate client

function validate_client($conn){
	
	$error=[];

		if (empty($_POST["first_name"])) {
			$error[] = "First Name is required";
			} else {
			$first_name = test_input($_POST["first_name"]);
			
			if (!preg_match("/^[a-zA-Z]*$/",$first_name)){
			$error[] = "Only letters allowed";
			}
		}	

		
		if (empty($_POST["last_name"])) {
			$error[] = "Last Name is required";
			} else {
			$last_name = test_input($_POST["last_name"]);
			
			if (!preg_match("/^[a-zA-Z]*$/",$last_name)){
			$error[] = "Only letters allowed";
			}
		}
		
		
		if (empty($_POST["age_name"])) {
			$error[] = "Agency Name is required";
			} else {
			$age_name = test_input($_POST["age_name"]);
			
			if (!preg_match("/^[a-zA-Z]*$/",$age_name)){
			$error[] = "Only letters allowed";
			}
		}
		
		
		if (empty($_POST["contact"])) {
			$error[] = "Contact No. is required";
			} else {
			$contact = test_input($_POST["contact"]);
			if(!preg_match('/^[0-9]{10}+$/', $contact)){
				$error[] = "Invalid phone";
				}
		}
		

		
		if (empty($_POST["country"])) {
			$error[] = "Country Name is required";
			} else {
			$country = test_input($_POST["country"]);
			
			if (!preg_match("/^[a-zA-Z]*$/",$country)){
			$error[] = "Only letters allowed";
			}
		}				
					

		if(empty($_POST["email"])){
			$error[] = "Email is required";
			}elseif($sql = "SELECT * FROM client_table WHERE email ='".$_POST["email"]."'"){
					$result =mysqli_query ($conn,$sql);
					if(mysqli_num_rows($result)> 0){
						$error[]= 'email is used';
						}else{
							$email = test_input($_POST["email"]);
							if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
								$error[] = "Invalid email format";
								}
							}
				}
		


		if (empty($_POST["joining_date"])) {
			$error[] = "joining is required";
			} else {
			$joining_date = test_input($_POST["joining_date"]);
		}
		

		
		if (empty($_POST["department"])) {
			$error[] = "department is required";
			} else {
			$department = test_input($_POST["department"]);
			}		  

		return $error;

	}
	


//function to validate employee

function validate_emp($conn){
	$error=[];
	

		
		if (empty($_POST["first_name"])) {
			$error[] = "First Name is required";
			} else {
			$first_name = test_input($_POST["first_name"]);
			
			if (!preg_match("/^[a-zA-Z]*$/",$first_name)){
			$error[] = "Only letters allowed";
			}
		}	

		
		if (empty($_POST["last_name"])) {
			$error[] = "Last Name is required";
			} else {
			$last_name = test_input($_POST["last_name"]);
			
			if (!preg_match("/^[a-zA-Z]*$/",$last_name)){
			$error[] = "Only letters allowed";
			}
		}	

		
		if (empty($_POST["joining_date"])) {
			$error[] = "joining is required";
			} else {
			$joining_date = test_input($_POST["joining_date"]);
		}
		
		
		if (empty($_POST["emp_id"])) {
			$error[] = "employee id is required";
			} else {
			$emp_id = test_input($_POST["emp_id"]);
		   }						
			
	
		
		if (empty($_POST["dob"])) {
			$error[] = "DOB is required";
			} else {
			$dob = test_input($_POST["dob"]);
			}

		
		if (empty($_POST["department"])) {
			$error[] = "department is required";
			} else {
			$department = test_input($_POST["department"]);
			}		  

		if (empty($_POST["role"])) {
			$error[] = "Select role";
			} else {
			$role = test_input($_POST["role"]);
			}
			
		

			
		if (empty($_POST["password1"])) {
			$error[] = "Enter password";
			} else {
			$password1 = test_input($_POST["password1"]);
			}
								  
		if (empty($_POST["password2"])) {
			$error[] = "Confirm password";
			} else {
			$password2 = test_input($_POST["password2"]);
			}	
	
		if ($_POST["password1"] !== $_POST["password2"]) {
			$error[] = 'Password or Confirm password should match!';
			}else{
			$password1 = test_input($_POST["password1"]);
			}	
			
			
		if(empty($_POST["email"])){
			$error[] = "Email is required";
			}elseif($sql = "SELECT * FROM employee_table WHERE email ='".$_POST["email"]."'"){
					$result =mysqli_query ($conn,$sql);
					if(mysqli_num_rows($result)> 0){
						$error[]= 'email is used';
						}else{
							$email = test_input($_POST["email"]);
							if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
								$error[] = "Invalid email format";
								}
							}
				}

		return $error;	
}


//function to update employee

function update_emp($conn){
	$error=[];
	

		
		if (empty($_POST["first_name"])) {
			$error[] = "First Name is required";
			} else {
			$first_name = test_input($_POST["first_name"]);
			
			if (!preg_match("/^[a-zA-Z]*$/",$first_name)){
			$error[] = "Only letters allowed";
			}
		}	

		
		if (empty($_POST["last_name"])) {
			$error[] = "Last Name is required";
			} else {
			$last_name = test_input($_POST["last_name"]);
			
			if (!preg_match("/^[a-zA-Z]*$/",$last_name)){
			$error[] = "Only letters allowed";
			}
		}	

		
		if (empty($_POST["joining_date"])) {
			$error[] = "joining is required";
			} else {
			$joining_date = test_input($_POST["joining_date"]);
		}
		
		
		if (empty($_POST["emp_id"])) {
			$error[] = "employee id is required";
			} else {
			$emp_id = test_input($_POST["emp_id"]);
		   }						
			
	
		
		if (empty($_POST["dob"])) {
			$error[] = "DOB is required";
			} else {
			$dob = test_input($_POST["dob"]);
			}

		
		if (empty($_POST["department"])) {
			$error[] = "department is required";
			} else {
			$department = test_input($_POST["department"]);
			}		  

		if (empty($_POST["role"])) {
			$error[] = "Select role";
			} else {
			$role = test_input($_POST["role"]);
			}	
			

				
		if(empty($_POST["email"])){
			$error[] = "Email is required";
			}elseif($sql = "SELECT * FROM employee_table WHERE email ='".$_POST["email"]."'"){
					$result =mysqli_query ($conn,$sql);
					if(mysqli_num_rows($result)> 0){
						$error[]= 'email is used';
						}else{
							$email = test_input($_POST["email"]);
							if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
								$error[] = "Invalid email format";
								}
							}
				}			
		return $error;
	}


//function to validate project
	function validate_project($conn){
		$error=[];
		
		if(empty($_POST["project_title"])){
			$error[] = "Project title is required";
			}else{
				$project_title = test_input($_POST["project_title"]);
				if (!preg_match("/^[a-zA-Z-' ]*$/",$project_title)){
				$error[] = "Only letters and space allowed";
				}
			}
		if(empty($_POST["client_name"])){
			$error[] = "client name is required";
			}else{
				$client_name = test_input($_POST["client_name"]);
				}
			
		if(empty($_POST["start_date"])){
			$error[] = "start date is required";
			}else{
				$start_date = test_input($_POST["start_date"]);
				}
				
		if(empty($_POST["upwork_id"])){
		$error[] = "upwork id is required";
		}else{
			$upwork_id = test_input($_POST["upwork_id"]);
			}
			
			
		if(empty($_POST["hired_by"])){
		$error[] = "hired by is required";
		}else{
			$hired_by = test_input($_POST["hired_by"]);
			if (!preg_match("/^[a-zA-Z-' ]*$/",$hired_by)){
			$error[] = "Only letters and space allowed";
			}
		}
			
			
		if(empty($_POST["bid_dep"])){
		$error[] = "bid dep is required";
		}else{
			$bid_dep = test_input($_POST["bid_dep"]);
			}	
			
		
		
		
		if(empty($_POST["country"])){
		$error[] = "country is required";
		}else{
			$country = test_input($_POST["country"]);
			if (!preg_match("/^[a-zA-Z]*$/",$country)){
			$error[] = "Only letters allowed";
			}
		}
		
			
		if(empty($_POST["project_manager"])){
		$error[] = "project manager is required";
		}else{
			$project_manager = test_input($_POST["project_manager"]);
			if (!preg_match("/^[a-zA-Z-' ]*$/",$project_manager)){
			$error[] = "Only letters ansd space allowed";
			}
		}
		
		
		if(empty($_POST["status"])){
		$error[] = "status is required";
		}					


		if(empty($_POST["team_leder"])){
		$error[] = "Team Leader is required";
		}else{
			$team_leder = test_input($_POST["team_leder"]);
			if (!preg_match("/^[a-zA-Z-' ]*$/",$team_leder)){
			$error[] = "Only letters and space allowed";
			}
		}
			
			
		if(empty($_POST["url"])){
			$error[] = "Site Url is required";
			}else{
			$url = test_input($_POST["url"]);
			if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
			  $error[] = "Invalid Url ";
			}
		}	
		return $error;
			
	}


function pagination($conn){
	
	$record_per_page = 2;
	$total_client=total_client($conn);


	$total_page=ceil($total_client/$record_per_page);
	if(isset($_GET["page"]) && $_GET["page"]!=1)
	{
		$start_no = ($_GET["page"]-1)*$record_per_page;
		}
		else{
			$start_no=0;
		}

	$q1 = "SELECT * FROM client_table LIMIT $record_per_page OFFSET $start_no";
	$query = mysqli_query($conn,$q1);
	$data = mysqli_fetch_array($query);
	return $data;
	
	}



?>



