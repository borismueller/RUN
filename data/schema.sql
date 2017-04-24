DROP DATABASE IF EXISTS WALK;
CREATE DATABASE WALK;
USE WALK;

CREATE TABLE user (
  id        INT NOT NULL AUTO_INCREMENT,
  name      VARCHAR(64) NOT NULL UNIQUE,
  password  VARCHAR(128) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE type (
  id        INT NOT NULL AUTO_INCREMENT,
  name      VARCHAR(30) NOT NULL UNIQUE,
  PRIMARY KEY (id)
);

CREATE TABLE product (
  id        INT NOT NULL AUTO_INCREMENT,
  name      VARCHAR(30) NOT NULL UNIQUE,
  type_id   INT,
  price     FLOAT,
  FOREIGN KEY (type_id) REFERENCES type(id),
  PRIMARY KEY (id)
);

CREATE TABLE cart (
  user_id   INT NOT NULL,
  product_id INT NOT NULL,
  PRIMARY KEY (user_id, product_id),
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (product_id) REFERENCES product(id)
);


#--makes a user with the password test
INSERT INTO user (name, password) VALUES ('test', '$2y$10$/wt7Nannt9mfYCEw0e/B6.PBpPCMnRuyAmHKBEI8O6Vm0R6BQkAdi');
