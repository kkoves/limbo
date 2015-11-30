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
        <script>
            $(document).ready(function () {
                $('select').material_select();
                $('.datepicker').pickadate({
                    selectMonths: true, // Creates a dropdown to control month
                    selectYears: 15 // Creates a dropdown of 15 years to control year
                });
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
                            <form class="col s12" action="found.php" method="POST">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="Submission Title" name="submissionTitle" type="text" class="validate" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>">
                                        <label for="submissionTitle">Title</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <input placeholder="User's First Name" name="first_name" type="text" class="validate" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>">
                                        <label for="first_name">First Name</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <input placeholder="User's Last Name" name="last_name" type="text" class="validate" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>">
                                        <label for="last_name">Last Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <i class="material-icons prefix">email</i>
                                        <input name="email" type="email" class="validate">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="input-field col s3">
                                        <i class="material-icons prefix">phone</i>
                                        <input name="phone" type="number" class="validate">
                                        <label for="email">Phone #</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s3">
                                        <select name="location">
                                            <option value="" disabled selected>Building</option>
                                            <?php
                                                require('includes/connect_db.php');
                                                require('includes/helpers.php');
                                                
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
                                        <label>Location Found</label>
                                    </div>
									<div class="input-field col s3">
										<input name="room" type="text" class="validate">
										<label for="room">Room #</label>
									</div>
                                </div>
                                <div class="row">
									<div class="input-field col s3">
                                        <input placeholder="Day/Month/Year" type="date" class="datepicker" name="date">
                                    </div>
                                    <div class="input-field col s3">
                                        <select name="category">
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
                                        <label>Item Type</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea name="description" class="materialize-textarea" length="1000"></textarea>
                                                <label for="textarea1">Description</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="file-field input-field col s6">
                                    <div class="btn red darken-4">
                                        <span>Photo</span>
                                        <input type="file" name="photo">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" name="filepath">
                                    </div>
                                </div>
                                <br><br><br>
                                <div align="right" class="row">
                                    <button class="btn waves-effect waves-light red darken-4" type="submit">Submit
                                        <i class="material-icons right">send</i>
                                    </button>
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
