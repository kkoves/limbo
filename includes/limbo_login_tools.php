<!--
This file contains PHP login helper functions.
Orginally created by Ron Coleman.
History:
Who	Date		Comment
RC	 7-Nov-13	Created.
-->
<?php

# Includes these helper functions
#require( 'helpers.php' ) ;

# Loads a specified or default URL.
function load( $page, $pid = -1 )
{
  # Begin URL with protocol, domain, and current directory.
  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

  # Remove trailing slashes then append page name to URL and the print id.
  $url = rtrim( $url, '/\\' ) ;
  $url .= '/' . $page;

  # Execute redirect then quit.
  header("Location: $url");

  exit();
}

# Validates the user.
# Returns -1 if validate fails, and >= 0 if it succeeds
# which is the primary key id.
function validate($user = '', $pass = '')
{
    global $dbc;

    if(empty($user) || empty($pass))
      return -1;

    # Make the query
    $query = "SELECT user, pass FROM users WHERE user='" . $user . "'" . " AND pass='" . $pass . "'";

    # Execute the query
    $results = mysqli_query( $dbc, $query );
    #check_results($results);

    # If we get no rows, the login failed
    if (mysqli_num_rows( $results ) == 0 )
      return -1;

    # We have at least one row, so get the frist one and return it
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC);

    $pid = $row [ 'id' ];

    return intval($pid);
}
?>