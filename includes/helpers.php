<?php
$debug = true;

# Get locations on Marist campus, make array
/*function get_locations() {
    global $dbc;
    
    #Create a query to get all the locations
    $query = 'SELECT name FROM locations ORDER BY id ASC';
    
    #Execute query
    $results = mysqli_query($dbc, $query);
    check_results($results);
    
    if($results) {
        $results = mysqli_fetch_array($results);
        echo $results[0];
        
        #for($i = 0; $i < $results->num_rows; $i++)
        #    echo $results[$i];
            
        foreach($results as $key => $value)
            echo "<p> $key : $value </p>";
            
        return $results;
        
    }
    else
        return false;
}*/

# Get one location from locations table
function get_location($id) {
    global $dbc;
    
    $query = 'SELECT name FROM locations WHERE id=' . $id;
    
    $results = mysqli_query($dbc, $query);
    check_results($results);
    
    $results = mysqli_fetch_array($results);
    return $results[0];
}

function format_date($date) {
    $date = strtotime($date);
    $dateForView = date("m/d/Y", $date);
    
    return $dateForView;
}

# Shows the records in stuff table of limbo_db
function show_records($dbc) {
    #$locations = get_locations();
    
	# Create a query to get location, title, date, and status, sorted by date
    $query = 'SELECT id, location_id, title, create_date, status FROM stuff ORDER BY create_date DESC';

    # Execute the query
    $results = mysqli_query( $dbc , $query );
    check_results($results);

    # Show results, if query succeeded
    if( $results )
    {
        echo '<table>';
        echo '<tr>';
        echo '<th>Title</th>';
        echo '<th>Location</th>';
        echo '<th>Date</th>';
        echo '<th>Status</th>';
        echo '</tr>';

        # For each row result, generate a table row
        while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
        {
            #$location = $locations[ $row['location_id'] ];
            $location = get_location($row['location_id']);
            $date = format_date($row['create_date']);
            
            echo '<tr>';
            echo '<td>' . '<a onclick="modalClick()" class="modal-trigger" href=index.php?id=' . $row['id'] . '>' . $row['title'] . '</a>' . '</td>';
            echo '<td>' . $location . '</td>';
            echo '<td>' . $date . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '</tr>';
        }

        # End the table
        echo '</table>';

        # Free up the results in memory
        mysqli_free_result( $results );
    }
}


# Shows a single record
function show_record($id) {
	global $dbc;
    
    $query = 'SELECT * FROM stuff WHERE id=' . $id;
    
    $results = mysqli_query($dbc, $query);
    check_results($results);
    
    if($results) {
        echo '<table>';
        
        while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            $location = get_location($row['location_id']);
            $date = format_date($row['create_date']);
            
            echo '<tr>';
                echo '<td><b>Title:</b></td>';
                echo '<td>' . $row['title'] . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td><b>Location:</b></td>';
                echo '<td>' . $location . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td><b>Description:</b></td>';
                echo '<td>' . $row['description'] . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td><b>Creation Date:</b></td>';
                echo '<td>' . $date . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td><b>Last Update:</b></td>';
                echo '<td>' . $date . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td><b>Room:</b></td>';
                echo '<td>' . $row['room'] . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td><b>Owner:</b></td>';
                echo '<td>' . $row['owner'] . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td><b>Finder:</b></td>';
                echo '<td>' . $row['finder'] . '</td>';
            echo '</tr>';
            echo '<tr>';
                echo '<td><b>Status:</b></td>';
                echo '<td>' . $row['status'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}

# Inserts a record into the prints table
function insert_record($dbc, $number, $fname, $lname) {
 $query = 'INSERT INTO presidents(number, fname, lname) VALUES (' . $number . ' , "' . $fname . '" , "' . $lname . '" )' ;
  # show_query($query);

  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}

# Shows the query as a debugging aid
function show_query($query) {
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}

# Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}

function valid_number($num) {
    if(empty($num) || !is_numeric($num))
        return false ;
    else if($num <= 0 || $num > 44)
        return false;
    else {
        $num = intval($num) ;
        if($num <= 0)
            return false ;
    }
    return true ;
}

function valid_name($name) {
    if(empty($name))
        return false;
    else if(ctype_alpha($name))
        return true;
    else return false;
}

function valid_form() {
  $number = $_POST['number'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  
  # Check for valid for entry  
  if ( empty( $number ) || !is_numeric($number) ) {
  	$errors[] = 'number' ;
  }
  else {
  	$number = trim( $number )  ;
  }

  if ( empty( $fname ) || intval($fname) == 1 || $fname=="1" ) {
  	$errors[] = 'fname' ;
  }
  else {
  	$fname = trim( $fname )  ;
  }
  
  if ( empty( $lname ) || intval($lname) == 1 || $lname == "1" ) {
  	$errors[] = 'lname' ;
  }
  else {
  	$lname = trim( $lname )  ;
  }

  # Report result.
  if( !empty( $errors ) )
  {
    echo '<h3 style="color:red">Error! Please enter a valid value for: ' ;
    foreach ( $errors as $field ) 
        echo " $field";
        
    echo '</h3>';
    return false;
  }
  else {
  	echo "<p>Success! Thank You!</p>";
    return true;
  }
}

?>