CREATE TABLE players (
  name varchar(50) NOT NULL,
  position varchar(10),
  rating tinyint;
  PRIMARY KEY (name)
);

INSERT INTO players VALUES ('Marty Barnsley','Guard',30);
INSERT INTO players VALUES ('Jonas Atkinson','Forward',45);
INSERT INTO players VALUES ('LeBron James','Forward',98);
INSERT INTO players VALUES ('Michael Jordan','Guard',99);
INSERT INTO players VALUES ('Kareem Abdul-Jabbar','Center',95);
INSERT INTO players VALUES ('John Stockton','Guard',45);
INSERT INTO players VALUES ('Larry Bird','Forward',93);
