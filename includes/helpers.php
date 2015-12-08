<?php
$debug = false;

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
		echo '<th style="text-align:center">Update Item</th>';
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
			echo '<td style="text-align:center">' . '<a class="material-icons" style="color:#9e9e9e" href="found.php?updateID=' . $row['id'] . '">edit</a>' . '</td>';
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
		echo '<th style="text-align:center">Update Item</th>';
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
			echo '<td style="text-align:center">' . '<a class="material-icons" style="color:#9e9e9e" href="lost.php?updateID=' . $row['id'] . '">edit</a>' . '</td>';
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
	
	mysqli_free_result($results);
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
	
	mysqli_free_result($results);
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
	
	$random = mt_rand(0, 999999);
	$random_string = sha1($random);
	
	$options = [
		'cost' => 12,
		'salt' => $random_string,
	];
	
	$user = trim($_POST['user']);
	$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT, $options);
	$pass_confirm = password_hash($_POST['pass_confirm'], PASSWORD_BCRYPT, $options);
	
	if($pass !== $pass_confirm) {
		echo '<script>$(document).ready(function () {$("#error").html("&nbsp; Error: Password fields do not match");});</script>';
	}
	else {
		$query = "INSERT INTO users(user, pass, reg_date, salt) VALUES(\"$user\", \"$pass\", NOW(), \"$options[salt]\")";
	
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

function update_record(){
	global $dbc, $debug;
    
	$query = 'UPDATE stuff SET ' . ' location_id=' . $_POST['location'] . ', title="' . $_POST['title'] . '", description="' . $_POST['description'] . '", category=' . $_POST['category'] . ', update_date=NOW()' . ', lost_date="' . $_POST['lost_date'] . '", found_date="' . $_POST['found_date'] . '", room="' . $_POST['room'] . '", email="' . $_POST['email'] . '", phone="' . $_POST['phone'] . '", photo="' . $_POST['photo'] . '", owner="' . $_POST['owner_full_name'] . '", finder="' . $_POST['finder_full_name'] . '", status="' . $_POST['status'] . '" WHERE id=' . $_POST['updateID'];
	
	$results = mysqli_query($dbc, $query);
	
	check_results($results);
	
    if($debug)
        echo '<script>$(document).ready(function () {$("#error").html("' . 'Query: ' . addslashes($query) . '");});</script>';
}

function update_item_form($id){
	global $dbc;
	
	$query = 'SELECT * FROM stuff WHERE id=' . $id;
    
    $results = mysqli_query($dbc, $query);
    check_results($results);
	
	while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
		# Assigns queries current values to variables.
		$item_id = $row['id'];
		$location_id = $row['location_id'];
		$title = $row['title'];
		$description = $row['description'];
		$category_id = $row['category'];
        
        if(!empty($row['lost_date']) && $row['lost_date'] !== '0000-00-00 00:00:00')
            $lost_date = format_date($row['lost_date'], "Y-m-d");
		else
            $lost_date = '0000-00-00';
        
        if(!empty($row['found_date']) && $row['found_date'] !== '0000-00-00 00:00:00')
            $found_date = format_date($row['found_date'], "Y-m-d");
		else
            $found_date = '0000-00-00';
		
        $room = $row['room'];
		$email = $row['email'];
		$phone = $row['phone'];
		$photo = $row['photo'];
		$owner = $row['owner'];
		$finder = $row['finder'];
		$status = $row['status'];

		#echo '<script>$(document).ready(function () {var date = new Date();var year = date.getFullYear();$("select").material_select();$(".datepicker").pickadate({selectMonths: true,selectYears: 2,max: year,format: "yyyy-mm-dd"});$("#description").val(' . $description . ');$("#description").trigger("autoresize");});</script>';
		echo '<div class="row">';
        echo '<form enctype="multipart/form-data" class="col s12" action="../admin/lost.php" method="POST">';
        echo '<div class="row">';
        echo '<div class="input-field col s12">';
        echo '<input required placeholder="Submission Title" name="title" type="text" class="validate" value="' . $title . '">';
        echo '<label for="title">Title*</label>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="input-field col s12">';
		if(!empty($row['finder']))
			echo '<input required placeholder="Finder\'s Name" name="finder_full_name" type="text" class="validate" value="' . $finder . '">';
		if(!empty($row['owner']))
			echo '<input required placeholder="Owner\'s Name" name="owner_full_name" type="text" class="validate" value="' . $owner . '">';
        echo '<label for="full_name">Oweners\'s Name*</label>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="input-field col s6">';
        echo '<i class="material-icons prefix">email</i>';
        echo '<input required name="email" type="email" class="validate" value="' . $email . '">';
        echo '<label for="email">Email*</label>';
        echo '</div>';
        echo '<div class="input-field col s6">';
        echo '<i class="material-icons prefix">phone</i>';
        echo '<input name="phone" type="number" class="validate" value="' . $phone . '">';
        echo '<label for="phone">Phone #</label>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div id="building" class="input-field col s6">';
        echo '<select required name="location">';
        echo '<option value="" disabled>Building</option>';
		
        #Query database for campus locations
        $query2 = 'SELECT id, short_name FROM locations ORDER BY short_name ASC';                                       
        #Execute query
        $results2 = mysqli_query($dbc, $query2);
        #Output SQL errors, if any
        check_results($results2);                                   
        #Populate drop-down list, if we got results from the query
        if($results2) {
			while($row2 = mysqli_fetch_array($results2 , MYSQLI_ASSOC)) {
				if($row2['id'] == $location_id)
					echo '<option value="' . $row2['id'] . '" selected>' . $row2['short_name'] . '</option>';
				else
					echo '<option value="' . $row2['id'] . '">' . $row2['short_name'] . '</option>';
			}
        }
		
        echo '</select>';
        echo '<label>Location Lost*</label>';
        echo '</div>';
		echo '<div class="input-field col s6">';
		echo '<input name="room" type="text" class="validate" value="' . $room . '">';
		echo '<label for="room">Room #</label>';
		echo '</div>';
        echo '</div>';
        
        #echo date selection fields, ordered by item's status (e.g., Lost date selection is shown first if item is in Lost status)
        echo '<div class="row">'; # begin date row
            if($status === "Lost") {
                echo '<div class="input-field col s6">'; # begin date col 1
                echo '<input required placeholder="Year-Month-Day" type="date" class="datepicker" name="lost_date" value="' . $lost_date . '">';
                echo '<label for="lost_date">Date Lost*</label>';
                echo '</div>'; # end date col 1
                
                echo '<div class="input-field col s6">'; # begin date col 2
                echo '<input required placeholder="Year-Month-Day" type="date" class="datepicker" name="found_date" value="' . $found_date . '">';
                echo '<label for="found_date">Date Found*</label>';
            }
    
            if($status === "Found") {
                echo '<div class="input-field col s6">'; # begin date col 1
                echo '<input required placeholder="Year-Month-Day" type="date" class="datepicker" name="found_date" value="' . $found_date . '">';
                echo '<label for="found_date">Date Found*</label>';
                echo '</div>'; # end date col 1
                
                echo '<div class="input-field col s6">'; # begin date col 2
                echo '<input required placeholder="Year-Month-Day" type="date" class="datepicker" name="lost_date" value="' . $lost_date . '">';
                echo '<label for="lost_date">Date Lost*</label>';
            }
        echo '</div>'; # end date col 2
        
        echo '</div>'; # end date row
		echo '<div class="row">';
		echo '<div id="status" class="input-field col s6">';
        echo '<select required name="status">';
        echo '<option value="" disabled selected>Status</option>';
		
		#Query database for status
        $query4 = 'SELECT * FROM status ORDER BY id ASC';                         
        #echo '#Execute query';
        $results4 = mysqli_query($dbc, $query4);   
        #echo '#Output SQL errors, if any';
        check_results($results4);      
        #echo '#Populate drop-down list, if we got results from the query';
		if($results4) {
			while($row4 = mysqli_fetch_array($results4 , MYSQLI_ASSOC)) {
				if($row4['status'] == $status)
					echo '<option value="' . $row4['status'] . '" selected>' . $row4['status'] . '</option>';
				else
					echo '<option value="' . $row4['status'] . '">' . $row4['status'] . '</option>';
			}
		}
		
        echo '</select>';
        echo '<label>Status*</label>';
        echo '</div>';
        
        echo '<div id="category" class="input-field col s6">';
        echo '<select required name="category">';
        echo '<option value="" disabled selected>Category</option>';
		
		#Query database for categories
        $query3 = 'SELECT * FROM categories ORDER BY name ASC';                         
        #echo '#Execute query';
        $results3 = mysqli_query($dbc, $query3);
        #echo '#Output SQL errors, if any';
        check_results($results3);
        #echo '#Populate drop-down list, if we got results from the query';
		if($results3) {
			while($row3 = mysqli_fetch_array($results3 , MYSQLI_ASSOC)) {
				if($row3['id'] == $category_id)
					echo '<option value="' . $row3['id'] . '" selected>' . $row3['name'] . '</option>';
				else
					echo '<option value="' . $row3['id'] . '">' . $row3['name'] . '</option>';
			}
		}
		
        echo '</select>';
        echo '<label>Item Type*</label>';
        echo '</div>';
        
		echo '<div class="input-field col s6">';
		echo '<input hidden name="updateID" type="text" class="validate" value="' . $item_id . '">';
		echo '<label hidden for="updateID">ID #</label>';
		echo '</div>';
		echo '</div>';
        echo '<div class="row">';
        echo '<div class="input-field col s12">';
        echo '<div class="row">';
        echo '<div class="input-field col s12">';
        echo '<textarea required id="description" name="description" class="materialize-textarea" length="1000"></textarea>';
        echo '<label for="textarea1">Description*</label>';
		echo '<script>$(document).ready(function () {$("#description").val("' . $description . '");});</script>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="file-field input-field col s12">';
        echo '<div class="btn red darken-4">';
        echo '<span>Photo</span>';
        echo '<input type="file" name="photo">';
        echo '</div>';
        echo '<div class="file-path-wrapper">';
        echo '<input class="file-path validate" type="text" name="filepath">';
        echo '</div>';
        echo '</div>';
        echo '<br><br><br>';
        echo '<div align="right" class="row">';
        echo '<button class="btn waves-effect waves-light red darken-4" type="submit">Submit';
        echo '<i class="material-icons right">send</i>';
        echo '</button>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
	}
	
	mysqli_free_result($results);
	mysqli_free_result($results2);
	mysqli_free_result($results3);
	mysqli_free_result($results4);
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
    
    if(empty($_POST['found_date']))
        $found_date = "0000-00-00";
    else
        $found_date = $_POST['found_date'];
    
    if(empty($_POST['lost_date']))
        $lost_date = "0000-00-00";
    else
        $lost_date = $_POST['lost_date'];
    
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