<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Limbo Admin | Login</title>
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
                $('.modal-trigger').leanModal({
                    dismissible: false, // Modal can be dismissed by clicking outside of the modal
                    opacity: .5, // Opacity of modal background
                    in_duration: 300, // Transition in duration
                    out_duration: 200, // Transition out duration
                    ready: function () {
                        alert('Ready');
                    }, // Callback for Modal open
                    complete: function () {
                        alert('Closed');
                    } // Callback for Modal close
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
		<script>
			<?php
				# Connect to MySQL server and the database
				require( '../includes/connect_db.php' ) ;

				# Connect to MySQL server and the database
				require( '../includes/limbo_login_tools.php' ) ;

				if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

					$user = $_POST['name'];
					$pass = $_POST['pass'];
    
					$pid = validate($user, $pass);

					if($pid == -1)
						echo '<p style=color:red>Login failed, please try again.</p>';

				else
					load('index.php', $pid);
				}
			?>
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
            #content{
                padding-left: 5%;
            }
			#form{
				padding-left: 5%;
			}
        </style>
    <body onload="startTime()">
        <header>
            <nav class="top-nav">
                <div class="container">
                    <div class="nav-wrapper">
                        <a class="page-title" id="title">Limbo Administrator Database</a>
                    </div>
                </div>
            </nav>
            <nav>
                <div class="nav-wrapper">
                    <a id="mainPage" href="#" class="brand-logo center">Admin Page</a>
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
                </ul>
                <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="mdi-navigation-menu"></i></a>
            </div>
        </header>
        <main id="content">	
			<div class="container">
                <div class="row">
                    <div class="col s12">
                        <div id="foundItemForm" class="row">
                            <form class="col s12" action="found.php" method="POST">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input required placeholder="Username" name="name" type="text" class="validate">
                                        <label for="title">Username</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input required placeholder="Password" name="pass" type="password" class="validate">
                                        <label for="first_name">Password</label>
                                    </div>
                                </div>
								<div class="row">
                                    <div class="input-field col s6">
                                        <button class="btn waves-effect waves-light red darken-4" type="submit">Login
											<i class="material-icons right">send</i>
										</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
