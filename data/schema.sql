DROP DATABASE IF EXISTS RUN;
CREATE DATABASE RUN;
USE RUN;

CREATE TABLE user (
  id        INT NOT NULL AUTO_INCREMENT,
  name      VARCHAR(64) NOT NULL,
  password  VARCHAR(128) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE file (
  id        INT NOT NULL AUTO_INCREMENT,
  name      VARCHAR(64),
  tags      VARCHAR(64),
  path      VARCHAR(64),
  PRIMARY KEY (id)
);

CREATE TABLE tag (
  user_id    INT NOT NULL,
  file_id    INT NOT NULL,
  name       VARCHAR(64) NOT NULL,
  PRIMARY KEY (user_id, file_id),
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (file_id) REFERENCES file(id)
);

CREATE TABLE visible (
  user_id    INT NOT NULL,
  file_id    INT NOT NULL,
  PRIMARY KEY (user_id, file_id),
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (file_id) REFERENCES file(id)
)
