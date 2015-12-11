<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Limbo | Main Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
        <?php
            require('includes/helpers.php');
            require('includes/connect_db.php');
            
            if(isset($_POST['owner_email'])) {
                #if(valid_form()) { // if form is valid
					claim_found_item("Claimed");	
					$_POST = array();
                    echo '<script>$(document).ready(function () {$("#success").html("Success! The item has been marked as claimed. An admin will be in contact with you to address your claim.");});</script>';                    
                #}
			}
            else if(isset($_POST['finder_email'])){
                #if(valid_form()) { // if form is valid
					claim_found_item("Found");	
					$_POST = array();
                    echo '<script>$(document).ready(function () {$("#success").html("Success! The item has been marked found.");});</script>';
                #}
            }
        ?>
        <script>
            $(document).ready(function(){
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
				$('select').material_select();
                
                // Display lost/found item detail modal if window contains "id?=" and an id number
                var str = window.location.href;
                
                if(str.indexOf("?id=") > -1)
                    $('#modal1').openModal();
                
                if(str.indexOf("?claimID=") > -1)
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
                padding-left: 5%;
                font-size: 50px;
            }
            #mainPage{
                font-size: 20px;
            }
            main{
                padding-left: 5%;
            }
            td{
                vertical-align: top;
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
                    <a id="mainPage" href="#" class="brand-logo center">Main Page</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a id="clock" href="collapsible.html">Time</a></li>
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
                </ul>
                <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="mdi-navigation-menu"></i></a>
            </div>
        </header>
        <main>
            <div class="container">
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
                        <?php 
                            global $dbc; 
                            
                            if(isset($_GET['id']) && is_numeric($_GET['id'])) {
                                $query = 'SELECT status FROM stuff WHERE id=' . $_GET['id'];
                                
                                $results = mysqli_query($dbc, $query);
                                check_results($results);
                                
                                $row = mysqli_fetch_array($results);
                                
                                $status = $row['status'];
                                
                                if($status === 'Lost')
                                    echo '<a href="#found" class="modal-action waves-effect waves-green btn-flat modal-trigger">Found This Item?</a>';
                                else if($status === 'Found')
                                    echo '<a href="#claimed" class="modal-action waves-effect waves-green btn-flat modal-trigger ">Claim This Item</a>';
                            }
                                
                                
                        ?>
					</div>
				</div>
                <!-- Modal dialog for "Claim/Found Item Form" -->
				<div id="claimed" class="modal modal-fixed-footer">
					<div class="modal-content">
						<h4>Claim Item Form</h4>
						<p>
                             <div class="row">
                                <div class="col s12">
                                    <div id="claimedItemForm" class="row">
                                        <form enctype="multipart/form-data" class="col s12" action="index.php" method="POST">
                                        <div id="modalError" style="color:red"></div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input required placeholder="Owner's Name" name="owner_full_name" type="text" class="validate" value="<?php if(isset($_POST['owner_full_name'])) echo $_POST['owner_full_name']; ?>">
                                                <label for="owner_full_name">Owner's Name<span style="color:#B31B1B">*</span></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">email</i>
                                                <input required name="owner_email" type="email" class="validate" value="<?php if(isset($_POST['owner_email'])) echo $_POST['owner_email']; ?>">
                                                <label for="owner_email">Email<span style="color:#B31B1B">*</span></label>
                                            </div>
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">phone</i>
                                                <input name="owner_phone" type="number" class="validate" value="<?php if(isset($_POST['owner_phone'])) echo $_POST['owner_phone']; ?>">
                                                <label for="owner_phone">Phone #</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div align="right" class="input-field col s12">
                                                <input hidden name="id" type="text" class="validate" value="<?php if(isset($_GET['id']) && is_numeric($_GET['id'])) echo $_GET['id']; ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div align="right" class="input-field col s12">
                                                <button class="btn waves-effect waves-light red darken-4" type="submit">Submit
                                                    <i class="material-icons right">send</i>
                                                </button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </p>
                    </div>
					<div class="modal-footer">
						<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                        
					</div>
				</div>
                <!-- Modal dialog for "Claim/Found Item Form" -->
				<div id="found" class="modal modal-fixed-footer">
					<div class="modal-content">
						<h4>Found Item Form</h4>
						<p>
                             <div class="row">
                                <div class="col s12">
                                    <div id="claimedItemForm" class="row">
                                        <form enctype="multipart/form-data" class="col s12" action="index.php" method="POST">
                                        <div id="error" style="color:red"></div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input required placeholder="Finder's Name" name="finder_full_name" type="text" class="validate" value="<?php if(isset($_POST['finder_full_name'])) echo $_POST['finder_full_name']; ?>">
                                                <label for="finder_full_name">Finder's Name<span style="color:#B31B1B">*</span></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">email</i>
                                                <input required name="finder_email" type="email" class="validate" value="<?php if(isset($_POST['owner_email'])) echo $_POST['owner_email']; ?>">
                                                <label for="finder_email">Email<span style="color:#B31B1B">*</span></label>
                                            </div>
                                            <div class="input-field col s6">
                                                <i class="material-icons prefix">phone</i>
                                                <input name="finder_phone" type="number" class="validate" value="<?php if(isset($_POST['owner_phone'])) echo $_POST['owner_phone']; ?>">
                                                <label for="finder_phone">Phone #</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div align="right" class="input-field col s12">
                                                <input hidden name="id" type="text" class="validate" value="<?php if(isset($_GET['id']) && is_numeric($_GET['id'])) echo $_GET['id']; ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div align="right" class="input-field col s12">
                                                <button class="btn waves-effect waves-light red darken-4" type="submit">Submit
                                                    <i class="material-icons right">send</i>
                                                </button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </p>
                    </div>
					<div class="modal-footer">
						<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                        
					</div>
				</div>
                
                <!-- Filters -->
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
											echo '<li>' . '<a href="index.php?location=' . $row['id'] . '">' . $row['short_name'] . '</a>' . '</li>';
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
											echo '<li>' . '<a href="index.php?category=' . $row['id'] . '">' . $row['name'] . '</a>' . '</li>';
										}
									}
								?>
							</ul>
					</div>
					<div class="input-field col s3">
						<a class='dropdown-button btn' href='#' data-activates='status_drop'><i class="material-icons right">keyboard_arrow_down</i>Status</a>
							<ul id='status_drop' class='dropdown-content'>
								<?php
									#Query database for item status
									$query = 'SELECT * FROM status WHERE status="Found" OR status="Lost"';
									
									#Execute query
									$results = mysqli_query($dbc, $query);
									
									#Output SQL errors, if any
									check_results($results);
									
									#Populate drop-down list, if we got results from the query
									if($results) {
										while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
											echo '<li>' . '<a href="index.php?status=' . $row['id'] . '">' . $row['status'] . '</a>' . '</li>';
										}
									}
								?>
							</ul>
					</div>
					<div class="input-field col s2">
						<a class="waves-effect waves-light btn" href='index.php'>Show All</a>
					</div>
				</div>
                <?php
					$random = mt_rand(0, 999999);
					$user = sha1($random);
				
					if(isset($_GET['location']))
						show_location_filter("all", $_GET['location'], $user);
					
					else if(isset($_GET['category']))
						show_category_filter("all", $_GET['category'], $user);
					
					else if(isset($_GET['status']))
						show_status_filter($_GET['status']);
						
				?>
				<div id="error" style="color:red"></div>
                <div id="success" style="color:green"></div>
				<?php
					#Call a helper function (in includes/helpers.php) to list the database contents
					if(!isset($_GET['location']) && !isset($_GET['category']) && !isset($_GET['status']))
						show_records($dbc);
				?>
            </div>
        </main>
    </body>
</html>
