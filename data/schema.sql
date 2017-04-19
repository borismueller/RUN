DROP DATABASE IF EXISTS RUN;
CREATE DATABASE RUN;
USE RUN;

CREATE TABLE user (
  id        INT NOT NULL AUTO_INCREMENT,
  name      VARCHAR(64) NOT NULL UNIQUE,
  password  VARCHAR(128) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE file (
  id        INT NOT NULL AUTO_INCREMENT,
  name      VARCHAR(64) UNIQUE,
  tags      VARCHAR(64),
  path      VARCHAR(64),
  PRIMARY KEY (id)
);

CREATE TABLE user_file (
  user_id    INT NOT NULL,
  file_id    INT NOT NULL,
  tag       VARCHAR(64) NOT NULL,
  PRIMARY KEY (user_id, file_id),
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (file_id) REFERENCES file(id)
);
