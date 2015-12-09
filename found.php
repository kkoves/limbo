<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Limbo | Found Items</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
        <script>
            $(".button-collapse show-on-large").sideNav();
        </script>
        <?php
            require('includes/helpers.php');
            require('includes/connect_db.php');
            
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(valid_form()) { // if form is valid 
					insert_item('Found', date('Y-m-d H:i:s')); // insert the values from the form into the database, with item status and current timestamp
					$_POST = array();
				}
			}
        ?>
        <script>
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
            #foundItemForm{
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
                    <a id="mainPage" href="#" class="brand-logo center">Found Page</a>
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
                <div class="row">
                    <div class="col s12">
                        <div id="foundItemForm" class="row">
                            <form enctype="multipart/form-data" class="col s12" action="found.php" method="POST">
                                <div id="error" style="color:red"></div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input required placeholder="Submission Title" name="title" type="text" class="validate" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>">
                                        <label for="title">Title<span style="color:#B31B1B">*</span></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <input required placeholder="User's First Name" name="first_name" type="text" class="validate" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
                                        <label for="first_name">First Name<span style="color:#B31B1B">*</span></label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input required placeholder="User's Last Name" name="last_name" type="text" class="validate" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
                                        <label for="last_name">Last Name<span style="color:#B31B1B">*</span></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <i class="material-icons prefix">email</i>
                                        <input required name="finder_email" type="email" class="validate" value="<?php if(isset($_POST['finder_email'])) echo $_POST['finder_email']; ?>">
                                        <label for="finder_email">Email<span style="color:#B31B1B">*</span></label>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="material-icons prefix">phone</i>
                                        <input name="finder_phone" type="number" class="validate" value="<?php if(isset($_POST['finder_phone'])) echo $_POST['finder_phone']; ?>">
                                        <label for="finder_phone">Phone #</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <select required name="location">
                                            <option value="" disabled selected>Building</option>
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
                                        <label>Location Found<span style="color:#B31B1B">*</span></label>
                                    </div>
									<div class="input-field col s3">
										<input required name="room" type="text" class="validate" value="<?php if(isset($_POST['room'])) echo $_POST['room']; ?>">
										<label for="room">Room #</label>
									</div>
                                </div>
                                <div class="row">
									<div class="input-field col s3">
                                        <input placeholder="Year-Month-Day" type="date" class="datepicker" name="date" value="<?php if(isset($_POST['date'])) echo $_POST['date']; ?>">
										<label for="date">Date Found<span style="color:#B31B1B">*</span></label>
                                    </div>
                                    <div class="input-field col s3">
                                        <select required name="category">
                                            <option value="" disabled selected>Category</option>
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
                                        <label>Item Type<span style="color:#B31B1B">*</span></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <textarea required id="description" name="description" class="materialize-textarea" length="1000"></textarea>
                                        <label for="textarea1">Description<span style="color:#B31B1B">*</span></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="file-field input-field col s6">
                                        <div class="btn red darken-4">
                                            <span>Photo</span>
                                            <input type="file" name="photo">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" name="filepath">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div align="right" class="input-field col s6">
                                        <button class="btn waves-effect waves-light red darken-4" type="submit">Submit
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        foreach($_POST as $key => $value)
                            echo "<p>$key : $value</p>";
                    }
                ?>
            </div>
        </main>
    </body>
</html>
