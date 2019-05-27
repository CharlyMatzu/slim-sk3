CREATE DATABASE skeleton_db CHARACTER SET utf8 COLLATE UTF8_GENERAL_CI;
USE skeleton_db; 

CREATE TABLE User(
	id 			INTEGER AUTO_INCREMENT PRIMARY KEY,
	firstName	VARCHAR(30) NOT NULL,
	lastName		VARCHAR(30) NOT NULL,
	email			VARCHAR(30) NOT NULL UNIQUE
);


CREATE USER 'skeleton_user'@'localhost' IDENTIFIED BY 'skeleton_pass';
GRANT ALL PRIVILEGES ON skeleton_db.* TO 'skeleton_user'@'localhost';

INSERT INTO User(firstName, lastName, email) VALUES
('Carlos', 'Zuniga', 'foo@mail.com');