CREATE DATABASE IF NOT EXISTS `database-1`;
USE `database-1`;

CREATE TABLE players (
  fname varchar(20) NOT NULL,
  lname varchar(20) NOT NULL,
  position varchar(10),
  rating tinyint,
  PRIMARY KEY (lname)
);

CREATE TABLE teamA (
  lname varchar(20) NOT NULL,
  rating varchar(20),
  PRIMARY KEY (lname)
);

CREATE TABLE teamB (
  lname varchar(20) NOT NULL,
  rating varchar(20),
  PRIMARY KEY (lname)
);

INSERT INTO players VALUES ('LeBron','James','Forward',98);
INSERT INTO players VALUES ('Michael','Jordan','Guard',99);
INSERT INTO players VALUES ('Kareem','Abdul-Jabbar','Center',96);
INSERT INTO players VALUES ('John','Stockton','Guard',90);
INSERT INTO players VALUES ('Kobe','Bryant','Guard',96);
INSERT INTO players VALUES ('Shaquille','ONeal','Center',96);
INSERT INTO players VALUES ('Magic','Johnson','Guard',94);
INSERT INTO players VALUES ('Wilt','Chamberlain','Center',93);
INSERT INTO players VALUES ('Tim','Duncan','Forward',94);
INSERT INTO players VALUES ('Bill','Russell','Center',90);
INSERT INTO players VALUES ('Charles','Barkley','Forward',91);
INSERT INTO players VALUES ('Kevin','Durant','Forward',96);
INSERT INTO players VALUES ('Stephen','Curry','Guard',94);
INSERT INTO players VALUES ('Hakeem','Olajuwon','Center',93);
INSERT INTO players VALUES ('Oscar','Robertson','Guard',90);
INSERT INTO players VALUES ('Larry','Bird','Forward',93);
