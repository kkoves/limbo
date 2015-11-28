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

        <!-- Compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
        <script>
            $(".button-collapse show-on-large").sideNav();
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
                    <li><a href="Admin Page.html">Main Page</a></li>
                    <li><a href="Admin Lost Page.html">Lost Items</a></li>
                    <li><a href="Admin Found Page.html">Found Items</a></li>
                    <li><a href="Admin Claimed Page.html">Claimed Items</a></li>
                    <li><a href="Admin Compare Page.html">Compare Records</a></li>
                </ul>
                <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="mdi-navigation-menu"></i></a>
            </div>
        </header>
    </body>
</html>
