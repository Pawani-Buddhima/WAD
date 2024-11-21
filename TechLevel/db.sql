CREATE DATABASE `techal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

CREATE TABLE subjects (
  id INT auto_increment PRIMARY KEY,
  name VARCHAR(255)
);

CREATE TABLE admin (
  id INT auto_increment PRIMARY KEY,
  name VARCHAR(255),
  password VARCHAR(255),
  email VARCHAR(255),
  telephone VARCHAR(20),
  created_at TIMESTAMP
);

CREATE TABLE student (
  id INT auto_increment PRIMARY KEY,
  name VARCHAR(255),
  address VARCHAR(255),
  tel_no VARCHAR(20),
  date_of_birth DATE,
  created_at TIMESTAMP
);

CREATE TABLE class (
  class_id INT auto_increment PRIMARY KEY,
  grade VARCHAR(10),
  subject_id INT,
  class_type VARCHAR(50),
  time_stamp TIMESTAMP,
  FOREIGN KEY (subject_id) REFERENCES subjects (id),
  FOREIGN KEY (student_id) REFERENCES student (id)
);

CREATE TABLE class_std (
  class_id INT,
  student_id INT,
  FOREIGN KEY (class_id) REFERENCES class (class_id),
  FOREIGN KEY (student_id) REFERENCES student (id)
);

CREATE TABLE tutor (
  tutor_id INT auto_increment PRIMARY KEY,
  name VARCHAR(255),
  tel_no VARCHAR(20),
  class_id INT,
  time_stamp TIMESTAMP,
  FOREIGN KEY (class_id) REFERENCES class (class_id)
);

