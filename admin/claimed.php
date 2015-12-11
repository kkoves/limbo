<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Limbo Admin | Claimed Items</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
		<?php
			require('../includes/limbo_login_tools.php');
				
			session_start();
				
			# redirect to login page if there is no session open
			if(!isset($_SESSION['login_user'])){
				session_destroy();
				load('login.php');
			}
		?>
        <script>
            $(document).ready(function(){
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
				$('select').material_select();
                
                var loc = window.location.href;
                
                if(loc.indexOf("?id=") > -1)
                    $('#modal1').openModal();
				
				if(loc.indexOf("?updateID=") > -1)
                    $('#modal2').openModal();
                
                $(".button-collapse show-on-large").sideNav();
				
				$('.dropdown-button').dropdown({
					inDuration: 300,
					outDuration: 225,
					constrain_width: true, // Does not change width of dropdown to that of the activator
					hover: true, // Activate on hover
					gutter: 0, // Spacing from edge
					belowOrigin: false, // Displays dropdown below the button
					alignment: 'left' // Displays dropdown with edge aligned to the left of button
				});
            });
			$(document).ready(function () {
				var date = new Date();
				var year = date.getFullYear();
				
                $('select').material_select();
                $('.datepicker').pickadate({
                    selectMonths: true, // Creates a dropdown to control month
                    selectYears: 2, // Creates a dropdown of 2 years to control year
					max: year,
					format: 'yyyy-mm-dd' // Date format
                });
                
                // Auto-fill description field if form submission failed
                $('#description').val('<?php if(isset($_POST['description'])) echo $_POST['description'] ?>');
                $('#description').trigger('autoresize');
            });
        </script>
        <script>
            function startTime() {
                var d = new Date();
                var n = d.toString(d.getDate());
                document.getElementById('clock').innerHTML = n;
                var t = setTimeout(startTime, 500);
            }
            
            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i
                }
                ;  // add zero in front of numbers < 10
                return i;
            }
            
            function modalClick() {
                document.getElementById("modal1").click();
                var time = setTimeout(modalClick, 3000);
            }
        </script>
        <style>
            nav{
                background-color: #B31B1B;
            }
            .nav-wrapper{
                background-color: #B31B1B;
            }
            #title{
                font-size: 50px;
            }
            #mainPage{
                font-size: 20px;
            }
			.container{
				padding-left: 5%;
			}
        </style>
    <body onload="startTime()">
        <header>
            <nav class="top-nav">
                <div class="container">
                    <div class="nav-wrapper">
                        <a class="page-title" id="title">Limbo Database</a>
                    </div>
                </div>
            </nav>
            <nav>
                <div class="nav-wrapper">
                    <a id="mainPage" href="#" class="brand-logo center">Admin Claimed Items Page</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a id="clock" href="#">Time</a></li>
                    </ul>
                </div>
            </nav>
            <div>
                <ul id="slide-out" class="side-nav fixed">
                    <p align="center"><img height="150px" width="150px" src="https://upload.wikimedia.org/wikipedia/en/thumb/4/4b/Marist_College_Seal_-_Vector.svg/1016px-Marist_College_Seal_-_Vector.svg.png"/></p>
                    <li><a href="index.php">Main Page</a></li>
                    <li><a href="lost.php">Lost Items</a></li>
                    <li><a href="found.php">Found Items</a></li>
                    <li><a href="claimed.php">Claimed Items</a></li>
                    <li><a href="compare.php">Compare Records</a></li>
					<li><a href="logout.php">Log Out</a></li>
                </ul>
                <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="mdi-navigation-menu"></i></a>
            </div>
        </header>
		<main>
            <div class="container">
				<?php
					require('../includes/connect_db.php');
					require('../includes/helpers.php');
					
					if(isset($_POST['deleteID'])) 
						delete_item($_POST['deleteID']);
				?>
			    <!-- Modal dialog for "Lost & Found Item Detail" -->
				<div id="modal1" class="modal modal-fixed-footer">
					<div class="modal-content">
						<h4>Lost/Found Item Detail</h4>
						<p>
							<?php
								if(isset($_GET['id']))
									show_record($_GET['id']);
							?>
						</p>
					</div>
					<div class="modal-footer">
						<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
					</div>
				</div>
				<!-- Modal dialog for "Update Item Information" -->
				<div id="modal2" class="modal modal-fixed-footer">
					<div class="modal-content">
						<h4>Update Item Information</h4>
						<p>
							<?php
								if(isset($_GET['updateID']))
									update_item_form($_GET['updateID']);
								
								if(isset($_POST['updateID'])) {
									if(valid_form())
										update_record();
								}
							?>
						</p>
					</div>
					<div class="modal-footer">
						<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s1">
						<label value="" disabled selected style="color:Black">Filter By:<label>
					</div>
					<div class="input-field col s3">
						<a class='dropdown-button btn' href='#' data-activates='location_drop'><i class="material-icons right">keyboard_arrow_down</i>Location</a>
							<ul id='location_drop' class='dropdown-content'>
								<?php
									#Query database for campus locations
									$query = 'SELECT id, short_name FROM locations ORDER BY short_name ASC';
									
									#Execute query
									$results = mysqli_query($dbc, $query);
									
									#Output SQL errors, if any
									check_results($results);
									
									#Populate drop-down list, if we got results from the query
									if($results) {
										while($row = mysqli_fetch_array($results , MYSQLI_ASSOC)) {
											echo '<li>' . '<a href="claimed.php?location=' . $row['id'] . '">' . $row['short_name'] . '</a>' . '</li>';
										}
									}
								?>
							</ul>
					</div>
					<div class="input-field col s3">
						<a class='dropdown-button btn' href='#' data-activates='category_drop'><i class="material-icons right">keyboard_arrow_down</i>Category</a>
							<ul id='category_drop' class='dropdown-content'>
								<?php
									#Query database for item categories
									$query = 'SELECT * FROM categories ORDER BY name ASC';
									
									#Execute query
									$results = mysqli_query($dbc, $query);
									
									#Output SQL errors, if any
									check_results($results);
									
									#Populate drop-down list, if we got results from the query
									if($results) {
										while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
											echo '<li>' . '<a href="claimed.php?category=' . $row['id'] . '">' . $row['name'] . '</a>' . '</li>';
										}
									}
								?>
							</ul>
					</div>
					<div class="input-field col s3">
						<a class="waves-effect waves-light btn" href='claimed.php'>Show All</a>
					</div>
				</div>
				<?php
					$user = sha1("yGq5Ed4FD3E2EpBsU9TzyjQYWtRFCkJmQTZHRheUEnCB4QXUQHKLhxs2GXDUwXy6BX4dVsX3Gjfrf2gvsGzFu2KUvdjsK55qfvsc9RYWAFEhJBgfPKAx7YBntKh4vfDdMpsfb2y7umwafXNLWJWmZj4FqdZD8nwRVA7DyFzn5SGdn9X6j4wzgpSePsPUK6ApCMDhF3gCCR9wTX8fwcE9NSvTzyJz8dVvn4xKJeBN6WbaxBLNeJ2wsgXJSAVELDL2ksHxsFQ9MsRVnHwSzytufG5JVAkRt42WEJjm3DYEwHcHKpfZRrjYu6P23NpNYSCBg2mLzPqV4hwTFqKTqAeypvSMVKhP4jF333jK6QHWrLZngAxnGs78KSgegyvcSn8Z9KfEPQ82vC3QuvXbgdknacyULaTajnd3rcVyuqM7Mk4wjDMXXNYC7bj9AFs76EVNM9nYxveQtKuS2H9XjnmgrM6fDczBWHHKkwZGnGMWSWn2SJxsATV5ZHwcPU3BFd4a");
				
					if(isset($_GET['location']))
						show_location_filter("Claimed",$_GET['location'], $user);
					
					else if(isset($_GET['category']))
						show_category_filter("Claimed",$_GET['category'], $user);
				?>
                <?php
                    #Call a helper function (in includes/helpers.php) to list the database contents
					if(!isset($_GET['location']) && !isset($_GET['category']))
						show_records_claimed($dbc, $user);
                ?>
            </div>
        </main>
    </body>
</html>
