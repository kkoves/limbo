<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
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
            #lostItemForm{
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
                        <div id="lostItemForm" class="row">
                            <form class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input placeholder="Submission Title" id="submissionTitle" type="text" class="validate">
                                        <label for="submissionTitle">Title</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="User's First Name" id="first_name" type="text" class="validate">
                                        <label for="first_name">First Name</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="User's Last Name" id="last_name" type="text" class="validate">
                                        <label for="last_name">Last Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">email</i>
                                        <input id="email" type="email" class="validate">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">phone</i>
                                        <input id="phone" type="number" class="validate">
                                        <label for="email">Phone #</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select>
                                            <option value="" disabled selected>Building</option>
                                            <option value="1">Hancock</option>
                                            <option value="2">Donnelly</option>
                                            <option value="3">McCann Center</option>
                                        </select>
                                        <label>Location Found</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="Day/Month/Year" type="date" class="datepicker">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select>
                                            <option value="" disabled selected>Category</option>
                                            <option value="1">Electronics</option>
                                            <option value="2">Appliance</option>
                                            <option value="3">Clothing</option>
                                        </select>
                                        <label>Item Type</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <textarea id="description" class="materialize-textarea" length="1000"></textarea>
                                                <label for="textarea1">Description</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="file-field input-field">
                                    <div class="btn red darken-4">
                                        <span>Photo</span>
                                        <input type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                                <br><br>
                                <div align="right" class="row">
                                    <a class="waves-effect waves-light red darken-4 btn"><i class="material-icons right">send</i>Submit Form</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
