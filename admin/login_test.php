<!--
This PHP script front-ends index.php with a login page.
Originally created By Ron Coleman.
Revision history:
Who	Date		Comment
RC  07-Nov-13   Created.
-->
<!DOCTYPE html>
<html>
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
<!-- Get inputs from the user. -->
<h1>Admin Login</h1>
<form action="login_test.php" method="POST">
<table>
<tr>
<td>Username:</td><td><input type="text" name="name"></td>
</tr>
<tr>
<td>Password:</td><td><input type="password" name="pass"</td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>