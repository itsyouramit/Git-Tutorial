<?php 
error_reporting(0);

?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">EMS</div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>





                <div class="sb-sidenav-menu-heading">Admin</div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Departments
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="all_department.php">See All</a>
                        
                        <?php if ($_SESSION["ROLE"] == 1) { ?>
                        <a class="nav-link" href="new_department.php">Create New</a>
                        <?php } ?>
                        
                    </nav>
                </div>
                
                

                
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Roles
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>

                </a>


                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="department_role.php">Department Role</a>
                        
                        
                        <?php if ($_SESSION["ROLE"] == 1) { ?>
                        <a class="nav-link" href="new_role.php">Create New Role</a>
                       <?php } ?>


                    </nav>
                </div> 
                
            

                 <?php if ($_SESSION["ROLE"] == 1) { ?>
                  
                
                <div class="sb-sidenav-menu-heading">Admin</div>
                <a class="nav-link" href="create_emp.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Add Employee
                </a>
                <a class="nav-link" href="all_emp.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Employee List
                </a>
                
                <a class="nav-link" href="add_client.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Add Client
                </a>
                <a class="nav-link" href="all_client.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Client List
                </a> 
                
                <a class="nav-link" href="add_project.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                   Add Project 
                </a>                
                
                <?php } ?>

                <a class="nav-link" href="all_project.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                   Project Detail 
                </a> 
	
	
                
            </div>
        </div>
        <div class="sb-sidenav-footer">
			
		
			
            <div class="small">Logged in : <?php echo $_SESSION["USERNAME"];?></div>
            
             
            
        </div>
    </nav>
</div>
