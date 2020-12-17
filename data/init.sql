CREATE DATABASE IF NOT EXISTS schedule;	

USE schedule;

CREATE TABLE IF NOT EXISTS users (
	username VARCHAR(20) PRIMARY KEY NOT NULL,
	password VARCHAR(255) NOT NULL
);	

CREATE TABLE IF NOT EXISTS presentations (
	presentationId INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
	presentationName VARCHAR(50) NOT NULL,
	facultyNumber INT(5) NOT NULL, 
	presentatorName VARCHAR(50) NOT NULL,
	room INT(3) NOT NULL,
	startHour TIME NOT NULL,
	endHour TIME NOT NULL,
	date DATE NOT NULL,
	weekDay VARCHAR(9) NOT NULL
);
 
CREATE TABLE IF NOT EXISTS personal (
	username VARCHAR(20) PRIMARY KEY NOT NULL,
	firstOption VARCHAR(30),
	secondOption VARCHAR(30),
	thirdOption VARCHAR(30),
	fourthOption VARCHAR(30)
);
