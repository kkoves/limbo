# This file creates the Limbo database.
# Version 0.2
# Authors: Krisztián Köves, Piradon (Tien) Liengtiraphan

# Enable MySQL warnings in output
\W

# Create the database limbo_db
CREATE DATABASE IF NOT EXISTS limbo_db;

USE limbo_db;

# Create the admin users table
CREATE TABLE IF NOT EXISTS users
(
	id		  INT		UNSIGNED  AUTO_INCREMENT  PRIMARY KEY,
	user	  TEXT		NOT NULL,
	pass	  TEXT		NOT NULL,
	reg_date  DATETIME  NOT NULL,
	salt	  TEXT		NOT NULL
);

# Insert our first admin user into the users table
INSERT INTO users (user, pass, reg_date, salt)
	VALUES ("admin", "$2y$12$a161bd8b4b7bda7313255uJEXV2e7JysLYdmTJ9yFpJ16LlizHQZS", NOW(), "a161bd8b4b7bda7313255855e3550967f2437dea");

# Create the table that will contain the L&F inventory
CREATE TABLE IF NOT EXISTS stuff
(
    id            INT       AUTO_INCREMENT  PRIMARY KEY,
    location_id   INT       NOT NULL,
    title         TEXT      NOT NULL,
    description   TEXT      NOT NULL,
    category      INT       NOT NULL,
    create_date   DATETIME  NOT NULL,
    update_date   DATETIME  NOT NULL,
	lost_date	  DATETIME,
	found_date	  DATETIME,
    claimed_date  DATETIME,
    room          TEXT,
    owner_email   TEXT,
    owner_phone   TEXT,
    finder_email  TEXT,
    finder_phone  TEXT,
    photo         TEXT,
    owner         TEXT,
    finder        TEXT,
    status        SET("Found", "Lost", "Claimed")  NOT NULL
);

#Insert lost items demo data
INSERT INTO `limbo_db`.`stuff` (`id`, `location_id`, `title`, `description`, `category`, `create_date`, `update_date`, `lost_date`, `found_date`, `claimed_date`, `room`, `owner_email`, `owner_phone`, `finder_email`, `finder_phone`, `photo`, `owner`, `finder`, `status`)
    VALUES ('1', '6', 'Lost Stuff', 'Lost my stuff, someone help me find it', '5', '2015-11-17 12:15:29.000000', '2015-11-17 12:15:29.000000', '2015-11-17 00:00:00', NULL, NULL, NULL, 'JohnDoe@marist.edu', '5185550132', NULL, NULL, NULL, 'John Doe', NULL, 'Lost'),
           ('2', '33', 'Backpack', 'Left my backpack on the bleachers in the stadium', '6', '2015-11-20 12:22:50.000000', '2015-11-20 12:22:50.000000', '2015-11-20 00:00:00', NULL, NULL, 'N/A', 'MaristaFox@marist.edu', '8605550178', NULL, NULL, NULL, 'Marista Fox', NULL, 'Lost'),
           ('3', '31', 'Lost Galaxy S6 Phone', 'Lost my new Galaxy S6 phone in the dining hall, please let me know if you find it!', '1', '2015-11-23 12:28:59.000000', '2015-11-23 12:28:59.000000', '2015-11-23 00:00:00', NULL, NULL, 'Dining hall', 'JaneDoe@marist.edu', '6175550135', NULL, NULL, NULL, 'Jane Doe', NULL, 'Lost');

#Insert found items demo data
INSERT INTO `limbo_db`.`stuff` (`id`, `location_id`, `title`, `description`, `category`, `create_date`, `update_date`, `lost_date`, `found_date`, `claimed_date`, `room`, `owner_email`, `owner_phone`, `finder_email`, `finder_phone`, `photo`, `owner`, `finder`, `status`)
    VALUES ('4', '31', 'Samsung Galaxy S6', 'Found someone''s Samsung Galaxy S6 phone, unlock it to claim the phone', '1', '2015-11-23 12:40:00.000000', '2015-11-23 12:40:00.000000', NULL, '2015-11-23 00:00:00', NULL, 'Dining hall', NULL, NULL, 'JohnSmith@marist.edu', '6095550127', NULL, '', 'John Smith', 'Found'),
           ('5', '22', 'Found high school class ring', 'Someone left their high school class ring in the 2nd floor lounge in Marian, name your high school and graduating class to claim it.', '4', '2015-11-18 12:58:18.000000', '2015-11-18 12:58:18.000000', NULL, '2015-11-18 00:00:00', NULL, '2nd floor lounge', NULL, NULL, 'JeffHowenstine@marist.edu', '3855550136', NULL, '', 'Jeff Howenstine', 'Found'),
           ('6', '2', 'Bose headphones', 'Found Bose headphones in the library, name the headphones'' model to claim it.', '3', '2015-11-21 13:04:45.000000', '2015-11-21 13:04:45.000000', NULL, '2015-11-21 00:00:00', NULL, '3rd floor Reading Room', NULL, NULL, 'EricBerns@marist.edu', '8505550152', NULL, '', 'Eric Berns', 'Found');
           
# Create a table for all the buildings on campus
CREATE TABLE IF NOT EXISTS locations
(
    id           INT       AUTO_INCREMENT  PRIMARY KEY,
    create_date  DATETIME  NOT NULL,
    update_date  DATETIME  NOT NULL,
    name         TEXT      NOT NULL,
    short_name   TEXT      NOT NULL
);

# Populate the locations table with all the campus buildings
INSERT INTO locations (create_date, update_date, name, short_name)
    VALUES ("2015-09-26 16:04:41", NOW(), "Byrne House", "Byrne House"),
           ("2015-09-26 16:04:41", NOW(), "James A. Cannavino Library", "Library"),
           ("2015-09-26 16:04:41", NOW(), "Champagnat Hall", "Champagnat"),
           ("2015-09-26 16:04:41", NOW(), "Our Lady Seat of Wisdom Chapel", "Chapel"),
           ("2015-09-26 16:04:41", NOW(), "Cornell Boathouse", "Cornell Boathouse"),
           ("2015-09-26 16:04:41", NOW(), "Donnelly Hall", "Donnelly"),
           ("2015-09-26 16:04:41", NOW(), "Margaret M. and Charles H. Dyson Center", "Dyson"),
           ("2015-09-26 16:04:41", NOW(), "Fern Tor", "Fern Tor"),
           ("2015-09-26 16:04:41", NOW(), "Fontaine Hall", "Fontaine"),
           ("2015-09-26 16:04:41", NOW(), "Foy Townhouses", "Foy"),
           ("2015-09-26 16:04:41", NOW(), "Lower Fulton Townhouses", "Lower Fulton"),
           ("2015-09-26 16:04:41", NOW(), "Upper Fulton Townhouses", "Upper Fulton"),
           ("2015-09-26 16:04:41", NOW(), "Gartland Apartments", "Gartland"),
           ("2015-09-26 16:04:41", NOW(), "North Field", "Gartland Field"),
           ("2015-09-26 16:04:41", NOW(), "Greystone Hall", "Greystone"),
           ("2015-09-26 16:04:41", NOW(), "Hancock Center", "Hancock"),
           ("2015-09-26 16:04:41", NOW(), "Kieran Gatehouse", "Gatehouse"),
           ("2015-09-26 16:04:41", NOW(), "Kirk House", "Kirk House"),
           ("2015-09-26 16:04:41", NOW(), "Leo Hall", "Leo"),
           ("2015-09-26 16:04:41", NOW(), "Longview Park (Riverfront)", "Riverfront"),
           ("2015-09-26 16:04:41", NOW(), "Lowell Thomas Communications Center", "Lowell Thomas"),
           ("2015-09-26 16:04:41", NOW(), "Marian Hall", "Marian"),
           ("2015-09-26 16:04:41", NOW(), "Marist Boathouse", "Marist Boathouse"),
           ("2015-09-26 16:04:41", NOW(), "James J. McCann Recreational Center", "McCann"),
           ("2015-09-26 16:04:41", NOW(), "Midrise Hall", "Midrise"),
           ("2015-09-26 16:04:41", NOW(), "Rotunda", "Rotunda"),
           ("2015-09-26 16:04:41", NOW(), "St. Ann's Hermitage", "St. Ann's Hermitage"),
           ("2015-09-26 16:04:41", NOW(), "St. Peter's", "St. Peter's"),
           ("2015-09-26 16:04:41", NOW(), "Sheahan Hall", "Sheahan"),
           ("2015-09-26 16:04:41", NOW(), "Steel Plant Art Studios and Gallery", "Steel Plant"),
           ("2015-09-26 16:04:41", NOW(), "Student Center", "Student Center"),
           ("2015-09-26 16:04:41", NOW(), "Talmadge Court", "Talmadge"),
           ("2015-09-26 16:04:41", NOW(), "Tennis Pavilion", "Tennis Court"),
           ("2015-09-26 16:04:41", NOW(), "Tenney Stadium", "Tenney Stadium"),
           ("2015-09-26 16:04:41", NOW(), "Lower New Townhouses", "Lower New"),
           ("2015-09-26 16:04:41", NOW(), "Upper New Townhouses", "Upper New"),
           ("2015-09-26 16:04:41", NOW(), "Lower West Cedar Townhouses", "Lower West"),
           ("2015-09-26 16:04:41", NOW(), "Upper West Cedar Townhouses", "Upper West");

# Create categories table
CREATE TABLE IF NOT EXISTS categories(
    id    INT   NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name  TEXT  NOT NULL
);

# Populate categories table
INSERT INTO categories(id, name)
    VALUES(1, "Cell Phones"),
          (2, "Clothing"),
          (3, "Electronics"),
          (4, "Jewelry"),
          (5, "Other"),
          (6, "Bags");

# Create status table
CREATE TABLE IF NOT EXISTS status(
	id    	INT   	NOT NULL PRIMARY KEY AUTO_INCREMENT,
	status	TEXT	NOT NULL
);

# Populate status table
INSERT INTO status(id, status)
	VALUES(1, "Found"),
		  (2, "Lost"),
		  (3, "Claimed");
           
# Print table definitions and contents to double-check everything

EXPLAIN users;
SELECT * FROM users;

EXPLAIN stuff;
SELECT * FROM stuff ORDER BY create_date DESC;

EXPLAIN locations;
SELECT * FROM locations ORDER BY short_name ASC;

EXPLAIN categories;
SELECT * FROM categories;

EXPLAIN status;
SELECT * FROM status;