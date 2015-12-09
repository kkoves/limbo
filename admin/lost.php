<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Limbo Admin | Lost Items</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
        <script>
            $(document).ready(function(){
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
				$('select').material_select();
                
                var str = window.location.href;
                
                if(str.indexOf("?id=") > -1)
                    $('#modal1').openModal();
				
				if(str.indexOf("?updateID=") > -1)
                    $('#modal2').openModal();
                /*if(window.location == "http://localhost/Assignments/Assignment%204/User/index.php")
                    $('#modal1').closeModal();*/
                
                $(".button-collapse show-on-large").sideNav();
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
                    <a id="mainPage" href="#" class="brand-logo center">Admin Lost Items Page</a>
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
                    <li><a href="compare.php">Compare Records</a></li>
					<li><a href="..\index.php">Log Off</a></li>
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
						<select>
							<option value="" disabled selected style="color:Gray">Location</option>
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
										echo '<option value="' . $row['id'] . '">' . $row['short_name'] . '</option>';
									}
								}
							?>
						</select>
					</div>
					<div class="input-field col s3">
						<select>
							<option value="" disabled selected style="color:Gray">Category</option>
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
										echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
									}
								}
							?>
						</select>
					</div>
				</div>
				<div id="error" style="color:red"></div>
				<?php
					
					#Call a helper function (in includes/helpers.php) to list the database contents
					show_records_lost($dbc);
					
				?>
            </div>
        </main>
    </body>
</html>
