USE csmadvice_445;

CREATE TABLE IF NOT EXISTS users (
id int AUTO_INCREMENT, 
status text,
photo blob,
fname varchar(15),
lname varchar(15),
email varchar(30),
PRIMARY KEY (id));

CREATE TABLE IF NOT EXISTS posts (
id int AUTO_INCREMENT,
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
id int AUTO_INCREMENT,
username varchar(15) unique not null,
password varchar(15) not null,
user_id int unique not null,
PRIMARY KEY (id),
FOREIGN KEY (user_id) REFERENCES users(id));
