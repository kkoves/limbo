# This file creates the Limbo database.
# Version 0.2
# Authors: Krisztián Köves, Piradon (Tien) Liengtiraphan

# Create the database limbo_db
CREATE DATABASE IF NOT EXISTS limbo_db;

USE limbo_db;

# Create the admin users table
CREATE TABLE IF NOT EXISTS users
(
	id		  INT		UNSIGNED  AUTO_INCREMENT  PRIMARY KEY,
	user	  TEXT		NOT NULL,
	pass	  TEXT		NOT NULL,
	reg_date  DATETIME  NOT NULL
);

# Insert our first admin user into the users table
INSERT INTO users (user, pass, reg_date)
	VALUES ("admin", "gaze11e", NOW());

# Create the table that will contain the L&F inventory
CREATE TABLE IF NOT EXISTS stuff
(
    id           INT       AUTO_INCREMENT  PRIMARY KEY,
    location_id  INT       NOT NULL,
    title        TEXT      NOT NULL,
    description  TEXT      NOT NULL,
    category     TEXT      NOT NULL,
    create_date  DATETIME  NOT NULL,
    update_date  DATETIME  NOT NULL,
    room         TEXT,
    owner        TEXT,
    finder       TEXT,
    status       SET("found", "lost", "claimed")  NOT NULL
);

#Insert lost items demo data

INSERT INTO `limbo_db`.`stuff` (`id`, `location_id`, `title`, `description`, `category`, `create_date`, `update_date`, `room`, `owner`, `finder`, `status`)
    VALUES ('1', '6', 'Lost Stuff', 'Lost my stuff, someone help me find it', 'Other', "2015-11-17 12:15:29", "2015-11-17 12:15:29", NULL, 'John Doe', NULL, 'lost'),
           ('2', '33', 'Backpack', 'Left my backpack on the bleachers in the stadium', 'Other', "2015-11-20 12:22:50", "2015-11-20 12:22:50", 'N/A', 'Marista Fox', NULL, 'lost'),
           ('3', '31', 'Lost Galaxy S6 Phone', 'Lost my new Galaxy S6 phone in the dining hall, please let me know if you find it!', 'Cell Phones', "2015-11-23 12:28:59", "2015-11-23 12:28:59", 'Dining hall', 'Jane Doe', NULL, 'lost');


#Insert found items demo data

INSERT INTO `limbo_db`.`stuff` (`id`, `location_id`, `title`, `description`, `category`, `create_date`, `update_date`, `room`, `owner`, `finder`, `status`)
    VALUES ('4', '31', 'Samsung Galaxy S6', 'Found someone''s Samsung Galaxy S6 phone, unlock it to claim the phone', 'Cell Phones', "2015-11-23 12:40:00", "2015-11-23 12:40:00", 'Dining hall', '', 'John Smith', 'found'),
           ('5', '22', 'Found high school class ring', 'Someone left their high school class ring in the 2nd floor lounge in Marian, name your high school and graduating class to claim it.', 'Jewelry', "2015-11-18 12:58:18", "2015-11-18 12:58:18", '2nd floor lounge', '', 'Jeff Howenstine', 'found'),
           ('6', '2', 'Bose headphones', 'Found Bose headphones in the library, name the headphones'' model to claim it.', 'Electronics', "2015-11-21 13:04:45", "2015-11-21 13:04:45", '3rd floor Reading Room', '', 'Eric Berns', 'found');
           
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
    VALUES(1, "Electronics"),
          (2, "Clothing"),
          (3, "Jewelry"),
          (4, "Other");
           
# Print table definitions and contents to double-check everything

EXPLAIN users;
SELECT * FROM users;

EXPLAIN stuff;
SELECT * FROM stuff ORDER BY create_date DESC;

EXPLAIN locations;
SELECT * FROM locations ORDER BY short_name ASC;

EXPLAIN categories;
SELECT * FROM categories;