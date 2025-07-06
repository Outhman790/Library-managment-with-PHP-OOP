-- Clean and Organized Empty Schema for Library Management System

CREATE DATABASE IF NOT EXISTS library;
USE library;

-- Table: types
CREATE TABLE types (
  Type_ID INT AUTO_INCREMENT PRIMARY KEY,
  Type_Name VARCHAR(50)
) ENGINE=InnoDB;

-- Table: client
CREATE TABLE client (
  Nickname VARCHAR(150) PRIMARY KEY,
  Password VARCHAR(150),
  Address VARCHAR(100),
  Email VARCHAR(100),
  Phone VARCHAR(100),
  CIN VARCHAR(50),
  Occupation VARCHAR(50),
  Penalty_Count INT DEFAULT 0,
  Birth_Date DATE,
  Creation_Date DATE DEFAULT CURRENT_DATE,
  Admin TINYINT(1) DEFAULT 0
) ENGINE=InnoDB;

-- Table: collection
CREATE TABLE collection (
  Collection_ID INT AUTO_INCREMENT PRIMARY KEY,
  Type_ID INT,
  Title VARCHAR(50),
  Author_Name VARCHAR(100),
  Cover_Image VARCHAR(100),
  State VARCHAR(100),
  Edition_Date DATE,
  Buy_Date DATE,
  Status VARCHAR(20) DEFAULT 'Available',
  FOREIGN KEY (Type_ID) REFERENCES types(Type_ID)
) ENGINE=InnoDB;

-- Table: reservation
CREATE TABLE reservation (
  Reservation_ID INT AUTO_INCREMENT PRIMARY KEY,
  Reservation_Date DATETIME,
  Reservation_Expiration_Date DATETIME,
  Collection_ID INT,
  Nickname VARCHAR(150),
  FOREIGN KEY (Collection_ID) REFERENCES collection(Collection_ID),
  FOREIGN KEY (Nickname) REFERENCES client(Nickname)
) ENGINE=InnoDB;

-- Table: borrowings
CREATE TABLE borrowings (
  Borrowing_ID INT AUTO_INCREMENT PRIMARY KEY,
  Borrowing_Date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  Borrowing_Return_Date DATE,
  Nickname VARCHAR(150),
  Collection_ID INT,
  Reservation_ID INT UNIQUE,
  Status VARCHAR(20),
  FOREIGN KEY (Nickname) REFERENCES client(Nickname),
  FOREIGN KEY (Collection_ID) REFERENCES collection(Collection_ID),
  FOREIGN KEY (Reservation_ID) REFERENCES reservation(Reservation_ID)
) ENGINE=InnoDB;