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

function get_category($id){
    global $dbc;
    
    $query = 'SELECT name FROM categories WHERE id='. $id;
    
    $results = mysqli_query($dbc, $query);
    check_results($results);
    
    $results = mysqli_fetch_array($results);
    return $results[0];
}

function format_date($date, $format) {
    $date = strtotime($date);
    $dateForView = date($format, $date);
    
    return $dateForView;
}

# Shows the records in stuff table of limbo_db
function show_records($dbc) {
    #$locations = get_locations();
    
	# Create a query to get location, title, date, category, and status, sorted by date
    $query = 'SELECT * FROM stuff ORDER BY create_date DESC';

    # Execute the query
    $results = mysqli_query( $dbc , $query );
    
    #Output SQL errors, if any
    check_results($results);

    # Show results, if query succeeded
    if( $results )
    {
        echo '<table>';
        echo '<tr>';
        echo '<th>Title</th>';
        echo '<th>Location</th>';
        echo '<th>Date</th>';
        echo '<th>Category</th>';
        echo '<th>Status</th>';
        echo '</tr>';

        # For each row result, generate a table row
        while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
        {
            #$location = $locations[ $row['location_id'] ];
            $location = get_location($row['location_id']);
            $date = format_date($row['create_date'], "m/d/Y");
            $category = get_category($row['category']);
            
            echo '<tr>';
            echo '<td>' . '<a onclick="modalClick()" class="modal-trigger" href=index.php?id=' . $row['id'] . '>' . $row['title'] . '</a>' . '</td>';
            echo '<td>' . $location . '</td>';
            echo '<td>' . $date . '</td>';
            echo '<td>' . $category . '</td>';
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
            $category = get_category($row['category']);
            
            echo '<tr>';
                echo '<td><b>Title:</b></td>';
                echo '<td>' . $row['title'] . '</td>';
            echo '</tr>';
            
            echo '<tr>';
                echo '<td><b>Status:</b></td>';
                echo '<td>' . $row['status'] . '</td>';
            echo '</tr>';
			
			if(!empty($row['lost_date'])) {
				echo '<tr>';
                    echo '<td><b>Lost Date:</b></td>';
                    echo '<td>' . format_date($row['lost_date'], "m/d/Y") . '</td>';
                echo '</tr>';
			}
			
			if(!empty($row['found_date'])) {
				echo '<tr>';
                    echo '<td><b>Found Date:</b></td>';
                    echo '<td>' . format_date($row['found_date'], "m/d/Y") . '</td>';
                echo '</tr>';
			}
            
            echo '<tr>';
                echo '<td><b>Category:</b></td>';
                echo '<td>' . $category . '</td>';
            echo '</tr>';
            
            echo '<tr>';
                echo '<td><b>Description:</b></td>';
                echo '<td>' . $row['description'] . '</td>';
            echo '</tr>';
            
            echo '<tr>';
                echo '<td><b>Location:</b></td>';
                echo '<td>' . $location . '</td>';
            echo '</tr>';
            
            echo '<tr>';
                echo '<td><b>Room:</b></td>';
                echo '<td>' . $row['room'] . '</td>';
            echo '</tr>';
            
            if(!empty($row['owner'])) {
                echo '<tr>';
                    echo '<td><b>Owner:</b></td>';
                    echo '<td>' . $row['owner'] . '</td>';
                echo '</tr>';
            }
            
            if(!empty($row['finder'])) {
                echo '<tr>';
                    echo '<td><b>Finder:</b></td>';
                    echo '<td>' . $row['finder'] . '</td>';
                echo '</tr>';
            }
            
            echo '<tr>';
                echo '<td><b>Email:</b></td>';
                echo '<td>' . $row['email'] . '</td>';
            echo '</tr>';
            
            echo '<tr>';
                echo '<td><b>Phone Number:</b></td>';
                echo '<td>' . $row['phone'] . '</td>';
            echo '</tr>';
            
            if(!empty($row['photo'])) {
                echo '<tr>';
                    echo '<td><b>Photo:</b></td>';
                    echo '<td>' . $row['photo'] . '</td>';
                echo '</tr>';
            }
			
			echo '<tr>';
                echo '<td><b>Report Date:</b></td>';
                echo '<td>' . format_date($row['create_date'], "m/d/Y, h:i:s A") . '</td>';
            echo '</tr>';
            
            echo '<tr>';
                echo '<td><b>Last Update:</b></td>';
                echo '<td>' . format_date($row['update_date'], "m/d/Y, h:i:s A") . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}

# Inserts a lost/found item into limbo_db
function insert_item($title, $full_name, $email, $phone, $location, $room, $date, $category, $description, $photo) {
    global $dbc;
    
    #TODO: add database insert functionality here
    
    #$query = 'INSERT INTO table(value1, value2, value3) VALUES (' . $value1 . ' , "' . $value2 . '" , "' . $value3 . '" )';
     
    #show_query($query);

    #$results = mysqli_query($dbc,$query) ;
    #check_results($results) ;

    #return $results ;
}

# Shows query as a debugging aid
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

function validate_form() {
    #TODO: add form validation functionality here
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    
    #Concatenate separate name fields into one
    $name = trim($first_name) . ' ' . trim($last_name);
    
    $_POST['full_name'] = $name;
    
    $phone = $_POST['phone'];
    
    #TODO: validate phone number
    
    $description = $_POST['description'];
    
    #remove new lines (\n) from description field
    $description = trim(preg_replace('/\s+/', ' ', $description));
    
    $_POST['description'] = $description;
}

?>