DROP TABLE IF EXISTS YV_Polls, YV_Users, YV_Permissions ;
-- DROP TABLE IF EXISTS YV_Groups ;


CREATE TABLE IF NOT EXISTS YV_Permissions (
  idPermissions INT NOT NULL,
  PermissionName VARCHAR(45) NOT NULL,
  PRIMARY KEY (idPermissions)
)ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS YV_Users (
  idUsers INT NOT NULL AUTO_INCREMENT,
  FName VARCHAR(75) NOT NULL,
  LName VARCHAR(75) NOT NULL,
  Password VARCHAR(100) NOT NULL,
  Email VARCHAR(150) NOT NULL,
  GradYear VARCHAR(2) NULL,
  idPermission INT NOT NULL,
  PRIMARY KEY (idUsers),
    FOREIGN KEY (idPermission)
    REFERENCES YV_Permissions (idPermissions)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS YV_Polls (
  idPolls INT NOT NULL AUTO_INCREMENT,
  PollName VARCHAR(45) NOT NULL,
  idTeacher INT NOT NULL,
  -- idGroup INT NOT NULL,
  Created DATE NOT NULL,
  PRIMARY KEY (idPolls),
    FOREIGN KEY (idTeacher)
    REFERENCES YV_Users (idUsers)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)ENGINE = InnoDB;


-- FOREIGN KEY (idGroup)
-- REFERENCES YV_Groups (idGroup)
-- ON UPDATE NO ACTION
-- ON DELETE NO ACTION)


-- CREATE TABLE IF NOT EXISTS YV_Groups (
--   idGroup INT NOT NULL AUTO_INCREMENT,
--   GroupName VARCHAR(50) NOT NULL,
--   idTeacher INT NOT NULL,
--   Member1 INT NULL,
--   Member2 INT NULL,
--   Member3 INT NULL,
--   Member4 INT NULL,
--   Member5 INT NULL,
--   Member6 INT NULL,
--   Member7 INT NULL,
--   Member8 INT NULL,
--   Member9 INT NULL,
--   Member10 INT NULL,
--   Member11 INT NULL,
--   Member12 INT NULL,
--   Member13 INT NULL,
--   Member14 INT NULL,
--   Member15 INT NULL,
--   Member16 INT NULL,
--   Member17 INT NULL,
--   Member18 INT NULL,
--   Member19 INT NULL,
--   Member20 INT NULL,
--   Member21 INT NULL,
--   Member22 INT NULL,
--   Member23 INT NULL,
--   Member24 INT NULL,
--   Member25 INT NULL,
--   PRIMARY KEY (idGroup),
--     FOREIGN KEY (idTeacher)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member1)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member2)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member3)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member4)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member5)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member6)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member7)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member8)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member9)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member10)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member11)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member12)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member13)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member14)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member15)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member16)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member17)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member18)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member19)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member20)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member21)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member22)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member23)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member24)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (Member25)
--     REFERENCES YV_Users (idUsers)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION)
-- ENGINE = InnoDB;


INSERT INTO YV_Permissions VALUES (1, "Administrator");
INSERT INTO YV_Permissions VALUES (2, "Teacher");
INSERT INTO YV_Permissions VALUES (3, "Student");

INSERT INTO YV_Users (FName, LName, Password, Email, idPermission) VALUES ("Patrick", "Freel", "Password", "freelpatrick@hotmail.com", 1)
