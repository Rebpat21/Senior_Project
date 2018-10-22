
DROP TABLE IF EXISTS YV_Groups ;
DROP TABLE IF EXISTS YV_Polls ;
DROP TABLE IF EXISTS YV_Users ;
DROP TABLE IF EXISTS YV_Schools ;
DROP TABLE IF EXISTS YV_Permissions ;


CREATE TABLE IF NOT EXISTS YV_Permissions (
  idPermissions INT NOT NULL,
  PermissionName VARCHAR(45) NOT NULL,
  PRIMARY KEY (idPermissions))
ENGINE = InnoDB;

INSERT INTO Permissions VALUES (1, "Administrator");
INSERT INTO Permissions VALUES (2, "Teacher");
INSERT INTO Permissions VALUES (3, "Student");

CREATE TABLE IF NOT EXISTS YV_Schools (
  idSchool INT NOT NULL AUTO_INCREMENT,
  SchoolName VARCHAR(250) NOT NULL,
  PRIMARY KEY (idSchool))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS YV_Users (
  idYV_Users INT NOT NULL AUTO_INCREMENT,
  FName VARCHAR(75) NOT NULL,
  LName VARCHAR(75) NOT NULL,
  Password VARCHAR(100) NOT NULL,
  idSchool INT NOT NULL,
  idPermission INT NOT NULL,
  PRIMARY KEY (idYV_Users),
    FOREIGN KEY (idPermission)
    REFERENCES Permissions (idPermissions)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (idSchool)
    REFERENCES Schools (idSchool)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS YV_Polls (
  idPolls INT NOT NULL AUTO_INCREMENT,
  PollName VARCHAR(45) NOT NULL,
  idTeacher INT NOT NULL,
  PRIMARY KEY (idPolls),
    FOREIGN KEY (idTeacher)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS YV_Groups (
  idGroup INT NOT NULL AUTO_INCREMENT,
  GroupName VARCHAR(50) NOT NULL,
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
    FOREIGN KEY (idTeacher)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member1)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member2)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member3)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member4)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member5)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member6)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member7)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member8)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member9)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member10)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member11)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member12)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member13)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member14)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member15)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member16)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member17)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member18)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member19)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member20)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member21)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member22)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member23)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member24)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Member25)
    REFERENCES YV_Users (idYV_Users)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
