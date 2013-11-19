USE team09;

CREATE TABLE IF NOT EXISTS users (
id int, 
status text,
photo text,
fname varchar(15),
lname varchar(15),
email varchar(30),
PRIMARY KEY (id));

CREATE TABLE IF NOT EXISTS posts (
id int unique,
keyphrase text,
post text,
page text,
post_date date,
user_id int,
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES users(id));

CREATE TABLE IF NOT EXISTS comments (
id int AUTO_INCREMENT,
comment text,
page text,
post_date date,
user_id int,
post_id int,
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES users(id),
FOREIGN KEY (post_id) REFERENCES posts(id));

CREATE TABLE IF NOT EXISTS login (
id int,
username varchar(15) unique not null,
password varchar(15) not null,
user_id int unique not null,
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES users(id));

CREATE TABLE IF NOT EXISTS status (
name varchar(50),
PRIMARY KEY (name));

INSERT INTO users VALUES(0, null, null, null, null, null);
INSERT INTO login VALUES(0,'guest','guest',0);
INSERT INTO status VALUES('Candidate');
INSERT INTO status VALUES('Freshman');
INSERT INTO status VALUES('Sophomore');
INSERT INTO status VALUES('Junior');
INSERT INTO status VALUES('Senior');
INSERT INTO status VALUES('Graduate Student');
INSERT INTO status VALUES('Alumni');
INSERT INTO status VALUES('Staff');
INSERT INTO status VALUES('Teacher');
INSERT INTO status VALUES('Professor');
INSERT INTO status VALUES('Other');