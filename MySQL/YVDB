CREATE SCHEMA IF NOT EXISTS mydb DEFAULT CHARACTER SET utf8;
USE mydb;

DROP TABLE IF EXISTS Permissions ;

CREATE TABLE IF NOT EXISTS Permissions (
  idPermissions INT NOT NULL,
  PermissionName VARCHAR(45) NOT NULL,
  PRIMARY KEY (idPermissions))
ENGINE = InnoDB;

INSERT INTO TABLE Permissions (idPermissions, PermissionName) VALUES (1, "Administrator");
INSERT INTO TABLE Permissions (idPermissions, PermissionName) VALUES (2, "Teacher");
INSERT INTO TABLE Permissions (idPermissions, PermissionName) VALUES (3, "Student");

DROP TABLE IF EXISTS Schools ;

CREATE TABLE IF NOT EXISTS Schools (
  idSchool INT NOT NULL AUTO_INCREMENT,
  SchoolName VARCHAR(250) NOT NULL,
  PRIMARY KEY (idSchool))
ENGINE = InnoDB;

DROP TABLE IF EXISTS YV_Users ;

CREATE TABLE IF NOT EXISTS YV_Users (
  idYV_Users INT NOT NULL AUTO_INCREMENT,
  FName VARCHAR(75) NOT NULL,
  LName VARCHAR(75) NOT NULL,
  Password VARCHAR(100) NOT NULL,
  idSchool INT NOT NULL,
  idPermission INT NOT NULL,
  PRIMARY KEY (idYV_Users),
  INDEX fk_YV_Users_Permissions_idx (idPermission ASC),
  INDEX fk_YV_Users_Schools1_idx (idSchool ASC),
  CONSTRAINT fk_YV_Users_Permissions
    FOREIGN KEY (idPermission)
    REFERENCES Permissions (idPermissions)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_YV_Users_Schools1
    FOREIGN KEY (idSchool)
    REFERENCES Schools (idSchool)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS Polls ;

CREATE TABLE IF NOT EXISTS Polls (
  idPolls INT NOT NULL AUTO_INCREMENT,
  PollName VARCHAR(45) NOT NULL,
  idTeacher INT NOT NULL,
  PRIMARY KEY (idPolls),
  INDEX fk_Polls_YV_Users1_idx (idTeacher ASC),
  CONSTRAINT fk_Polls_YV_Users1
    FOREIGN KEY (idTeacher)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

DROP TABLE IF EXISTS Groups ;

CREATE TABLE IF NOT EXISTS Groups (
  idGroup INT NOT NULL AUTO_INCREMENT,
  GroupName VARCHAR(45) NOT NULL,
  idTeacher INT NOT NULL,
  Member1 INT NULL,
  Member2 INT NULL,
  Member3 INT NULL,
  Member4 INT NULL,
  Member5 INT NULL,
  Member6 INT NULL,
  Member7 INT NULL,
  Member8 INT NULL,
  Member9 INT NULL,
  Member10 INT NULL,
  Member11 INT NULL,
  Member12 INT NULL,
  Member13 INT NULL,
  Member14 INT NULL,
  Member15 INT NULL,
  Member16 INT NULL,
  Member17 INT NULL,
  Member18 INT NULL,
  Member19 INT NULL,
  Member20 INT NULL,
  Member21 INT NULL,
  Member22 INT NULL,
  Member23 INT NULL,
  Member24 INT NULL,
  Member25 INT NULL,
  PRIMARY KEY (idGroup),
  INDEX fk_Groups_YV_Users1_idx (idTeacher ASC, Member1 ASC, Member2 ASC, Member3 ASC, Member4 ASC, Member5 ASC, Member6 ASC, Member7 ASC, Member8 ASC, Member9 ASC, Member10 ASC, Member11 ASC, Member12 ASC, Member13 ASC, Member14 ASC, Member15 ASC, Member16 ASC, Member17 ASC, Member18 ASC, Member19 ASC, Member20 ASC, Member21 ASC, Member22 ASC, Member23 ASC, Member24 ASC, Member25 ASC),
  CONSTRAINT fk_Groups_YV_Users1
    FOREIGN KEY (idTeacher , Member1 , Member2 , Member3 , Member4 , Member5 , Member6 , Member7 , Member8 , Member9 , Member10 , Member11 , Member12 , Member13 , Member14 , Member15 , Member16 , Member17 , Member18 , Member19 , Member20 , Member21 , Member22 , Member23 , Member24 , Member25)
    REFERENCES YV_Users (idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users , idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
