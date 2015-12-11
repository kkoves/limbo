<?php
    require('../includes/limbo_login_tools.php');
    session_start();
    
    # If session is destroyed, redirect to main Limbo page
    if(session_destroy())
        load('login.php');
?>