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

# Shows the lost items in stuff table of limbo_db
function show_records_found($dbc) {
    #$locations = get_locations();
    
	# Create a query to get location, title, date, category, and status, sorted by date
    $query = 'SELECT * FROM stuff WHERE status=1 ORDER BY id DESC';

    # Execute the query
    $results = mysqli_query( $dbc , $query );
    
    #Output SQL errors, if any
    check_results($results);

    # Show results, if query succeeded
    if( $results )
    {	
        echo '<table>';
        echo '<tr>';
		echo '<th>ID</th>';
        echo '<th>Title</th>';
        echo '<th>Location</th>';
        echo '<th>Date</th>';
        echo '<th>Category</th>';
        echo '<th>Status</th>';
		echo '<th style="text-align:center">Delete Item</th>';
        echo '</tr>';

        # For each row result, generate a table row
        while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
        {
            #$location = $locations[ $row['location_id'] ];
            $location = get_location($row['location_id']);
            $date = format_date($row['create_date'], "m/d/Y");
            $category = get_category($row['category']);
            
            echo '<tr>';
			echo '<th>' . $row['id'] . '</th>';
            echo '<td>' . '<a onclick="modalClick()" class="modal-trigger" href=found.php?id=' . $row['id'] . '>' . $row['title'] . '</a>' . '</td>';
            echo '<td>' . $location . '</td>';
            echo '<td>' . $date . '</td>';
            echo '<td>' . $category . '</td>';
            echo '<td>' . $row['status'] . '</td>';
			echo '<td style="text-align:center;">' . '<a class="material-icons" style="color:#9e9e9e" href="found.php?delete=' .$row['id'] . '">delete</a>' . '</td>';
            echo '</tr>';
        }

        # End the table
        echo '</table>';

        # Free up the results in memory
        mysqli_free_result( $results );
    }
}

# Shows the lost items in stuff table of limbo_db
function show_records_lost($dbc) {
    #$locations = get_locations();
    
	# Create a query to get location, title, date, category, and status, sorted by date
    $query = 'SELECT * FROM stuff WHERE status=2 ORDER BY id DESC';

    # Execute the query
    $results = mysqli_query( $dbc , $query );
    
    #Output SQL errors, if any
    check_results($results);

    # Show results, if query succeeded
    if( $results )
    {	
        echo '<table>';
        echo '<tr>';
		echo '<th>ID</th>';
        echo '<th>Title</th>';
        echo '<th>Location</th>';
        echo '<th>Date</th>';
        echo '<th>Category</th>';
        echo '<th>Status</th>';
		echo '<th style="text-align:center">Delete Item</th>';
        echo '</tr>';

        # For each row result, generate a table row
        while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
        {
            #$location = $locations[ $row['location_id'] ];
            $location = get_location($row['location_id']);
            $date = format_date($row['create_date'], "m/d/Y");
            $category = get_category($row['category']);
            
            echo '<tr>';
			echo '<th>' . $row['id'] . '</th>';
            echo '<td>' . '<a onclick="modalClick()" class="modal-trigger" href=lost.php?id=' . $row['id'] . '>' . $row['title'] . '</a>' . '</td>';
            echo '<td>' . $location . '</td>';
            echo '<td>' . $date . '</td>';
            echo '<td>' . $category . '</td>';
            echo '<td>' . $row['status'] . '</td>';
			echo '<td style="text-align:center">' . '<a class="material-icons" style="color:#9e9e9e" href="lost.php?delete=' .$row['id'] . '">delete</a>' . '</td>';
            echo '</tr>';
        }

        # End the table
        echo '</table>';

        # Free up the results in memory
        mysqli_free_result( $results );
    }
}

# Filter Table by Location
/*function filter_location($id){
	global $dbc;
	
	$query = 'SELECT * FROM stuff WHERE location_id=' . $id;
	
	$results = mysqli_query($dbc, $query);
    check_results($results);
	
	if ($results){
		
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
}*/

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
			
			//If lost date is not "empty" (all 0's), display it
			if($row['lost_date'] != '0000-00-00 00:00:00') {
				echo '<tr>';
                    echo '<td><b>Lost Date:</b></td>';
                    echo '<td>' . format_date($row['lost_date'], "m/d/Y") . '</td>';
                echo '</tr>';
			}
			
			//If found date is not "empty" (all 0's), display it
			if($row['found_date'] != '0000-00-00 00:00:00') {
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

function show_users($id){
	global $dbc;
    
    $query = 'SELECT * FROM users';
    
    $results = mysqli_query($dbc, $query);
    check_results($results);
	
	if($results){
		echo '<table>';
        echo '<th>Username</th>';
        echo '<th>Password</th>';
        echo '<th>Registered Date</th>';
		echo '<th style="text-align:center">Delete User</th>';
		
		
		while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
			echo '<tr>';
				echo '<td>' . $row['user'] . '</td>';
				echo '<td>' . $row['pass'] . '</td>';
				echo '<td>' . $row['reg_date'] . '</td>';
				if($row['user'] !== 'admin')
					echo '<td style="text-align:center">' . '<a class="material-icons" style="color:#9e9e9e" href="index.php?delete=' .$row['id'] . '">delete</a>' . '</td>';
				
			echo '</tr>';
		}
		echo '</table>';
	}
}

# Deletes an Item from the database
function delete_item($id){
	global $dbc;
	
	$query = 'DELETE FROM stuff WHERE id=' .$id;
	
	$results = mysqli_query($dbc, $query);
    check_results($results);
	
}

# Deletes an Item from the database
function delete_user($id){
	global $dbc;
	
	$query = 'DELETE FROM users WHERE id=' .$id;
	
	$results = mysqli_query($dbc, $query);
    check_results($results);
	
}

# Adds a new admin to the system
function add_admin(){
	global $dbc;
	
	# Variable options will be used to hash the password the new administrator will have. Passwords will also not be stored as plain text.
	$options = [
		'cost' => 12,
		'salt' => 'PkRMWmhrzL3qFJbmur9KjZhg7chW4TeFnm55B25V2zsZ8W7RJDvJaVESCrhqFcxRL47ZbvKMtJrDwCyRUwKCjEnuybE6aGcB5NR97WW7bDqQHP5jLnVhtZqkPu5u2hmhMKeC9kPmqn3cNp9pKwcu5Bfha4hyAbHW42SrdydRK4uCCEYtNczgN9EGhm2c37d2AmWtS4sat9CxFjdK7w25ydCrfA5GA9PWEVEd3TaVHCkjqz22avgY7HuAEVKHUTyb',
	];
	
	$user = $_POST['user'];
	$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT, $options);
	$pass_confirm = password_hash($_POST['pass'], PASSWORD_BCRYPT, $options);
	
	
	if($pass !== $pass_confirm) {
		echo '<script>$(document).ready(function () {$("#error").html("&nbsp; Error: Password fields do not match");});</script>';
	}
	else {
		$query = "INSERT INTO users(user, pass, reg_date) VALUES(\"$user\", \"$pass\", NOW())";
	
		#Show query if debugging is enabled (at the top of this file)
		#show_query($query);

		#Get results of SQL query
		$results = mysqli_query($dbc,$query);
		
		#Output SQL errors, if any
		check_results($results);
		
		return $results ;
	}
	
	//return false on failure
	return false;
}

# Inserts a lost/found item into limbo_db from $_POST
function insert_item($status, $date /*$title, $full_name, $email, $phone, $location, $room, $lost_date, $found_date, $report_date, $category, $description, $filepath*/) {
    global $dbc;
	
	#$var = $_POST[''];
	
	#Assign variabled to insert into database from user input in $_POST
	$loc = $_POST['location'];
	$title = $_POST['title'];
	$descr = $_POST['description'];
	$category = $_POST['category'];
	$create_date = $date;
	$update_date = $date;
	
	if($status == 'Lost') $lost_date = $_POST['date'];
	else $lost_date = '';
	
	if($status == 'Found') $found_date = $_POST['date'];
	else $found_date = '';
	
	$room = $_POST['room'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$photo = $_POST['filepath'];
	
	if($status == 'Lost') $owner = $_POST['full_name'];
	else $owner = '';
	
	if($status == 'Found') $finder = $_POST['full_name'];
	else $finder = '';
	
	$stat = $status;
    
    #TODO: add database insert functionality here
    
    $query = "INSERT INTO stuff(location_id, title, description, category, create_date, update_date, lost_date, found_date, room, email, phone, photo, owner, finder, status) VALUES($loc, \"$title\", \"$descr\", $category, \"$create_date\", \"$update_date\", \"$lost_date\", \"$found_date\", \"$room\", \"$email\", \"$phone\", \"$photo\", \"$owner\", \"$finder\", \"$stat\")";
	#'INSERT INTO stuff(location_id, value2, value3) VALUES (' . $value1 . ' , "' . $value2 . '" , "' . $value3 . '" )';
    
	#Show query if debugging is enabled (at the top of this file)
    show_query($query);

	#Get results of SQL query
    $results = mysqli_query($dbc,$query);
    
	#Output SQL errors, if any
	check_results($results);
	
    return $results ;
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
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>';
}

# Function to upload picture to database
function upload_picture(){
    #$target_dir = "uploads/";
    $target_dir = "C:\\PROGRA~2\\EASYPH~1.1VC\\data\\localweb\\uploads\\";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    echo "<p>$target_file</p>";
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        echo "<script> alert(\'And...you fail\');</script>";

    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
            echo "<script> alert(\'And...you pass\');</script>";
        } else {
            echo "Sorry, there was an error uploading your file.";
            echo "<script> alert(\'And...you fail\');</script>";
        }
    }
}

function valid_form() {
    #TODO: add form validation functionality here
    
	$errors = false; #TODO: make errors array
	
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    
    #Concatenate separate name fields into one
    $name = trim($first_name) . ' ' . trim($last_name);
    
    $_POST['full_name'] = $name;
    
    $phone = $_POST['phone'];
    
    #TODO: validate phone number
	#Basic regex: /\d{10}/
    
    $description = $_POST['description'];
    
    #remove new lines (\n) from description field
    $description = trim(preg_replace('/\s+/', ' ', $description));
    
    $_POST['description'] = $description;
	
	#If there are errors in form fields
	/*
	if(!empty(errors)) {
		#TODO: Print error messages
		echo '<p>Invalid form submission, please try again. Most form values were saved.</p>';
		return false;
	}
	#Else, if there are no errors in form fields (to the best of our knowledge)
	else {
		#TODO: Print success message
		return true;
	}
	*/
	return true;
}

?>