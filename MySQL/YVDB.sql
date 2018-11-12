DROP TABLE IF EXISTS YV_Poll_Votes, YV_Poll_Options, YV_Polls, YV_Users, YV_Permissions ;
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
  id INT NOT NULL AUTO_INCREMENT,
  subject VARCHAR(45) NOT NULL,
  idTeacher INT NOT NULL,
  -- Data VARCHAR(5000) NOT NULL,
  -- idGroup INT NULL,
  Created DATETIME NOT NULL,
  Changed DATETIME NOT NULL,
  Status ENUM('1', '0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (id),
    FOREIGN KEY (idTeacher)
    REFERENCES YV_Users (idUsers)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    -- FOREIGN KEY (idGroup)
    -- REFERENCES YV_Groups (idGroup)
    -- ON UPDATE NO ACTION
    -- ON DELETE NO ACTION)
)ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE IF NOT EXISTS YV_Poll_Options (
  id INT NOT NULL AUTO_INCREMENT,
  poll_id INT NOT NULL,
  Name VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  Created DATETIME NOT NULL,
  Changed DATETIME NOT NULL,
  Status ENUM('1', '0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (id),
    FOREIGN KEY (poll_id)
    REFERENCES YV_Polls (id)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
)ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS YV_Poll_Votes (
  id INT NOT NULL AUTO_INCREMENT,
  poll_id INT NOT NULL,
  poll_option_id INT NOT NULL,
  vote_count BIGINT(10) NOT NULL,
  PRIMARY KEY (id),
    FOREIGN KEY (poll_id)
    REFERENCES YV_Polls (id)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
    FOREIGN KEY (poll_option_id)
    REFERENCES YV_Poll_Options (id)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
)ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO YV_Permissions VALUES (1, "Administrator");
INSERT INTO YV_Permissions VALUES (2, "Teacher");
INSERT INTO YV_Permissions VALUES (3, "Student");

INSERT INTO YV_Users (FName, LName, Password, Email, GradYear, idPermission) VALUES ("Patrick", "FreelA", "$2y$10$OGE0ZDI3NjY3YTEyMWMzNepUSGpHlYsESNT63kSPuvZ7cj8QRoaqi", "patricka@hotmail.com", "NA", 1);
INSERT INTO YV_Users (FName, LName, Password, Email, GradYear, idPermission) VALUES ("Patrick", "FreelT", "$2y$10$OGE0ZDI3NjY3YTEyMWMzNepUSGpHlYsESNT63kSPuvZ7cj8QRoaqi", "patrickt@hotmail.com", "NA", 2);
INSERT INTO YV_Users (FName, LName, Password, Email, GradYear, idPermission) VALUES ("Patrick", "FreelS", "$2y$10$OGE0ZDI3NjY3YTEyMWMzNepUSGpHlYsESNT63kSPuvZ7cj8QRoaqi", "patricks@hotmail.com", "15", 3);

INSERT INTO YV_Polls (subject, idTeacher, Created, Changed, Status) VALUES ('Which is Your Favorite Website for PHP Programming?', 2, '2016-11-07 04:13:13', '2016-11-07 04:13:13', '1');

INSERT INTO YV_Poll_Options (poll_id, Name, Created, Changed, Status) VALUES (1, 'CodexWorld', '2016-11-07 11:29:31', '2016-11-07 11:29:31', '1');
INSERT INTO YV_Poll_Options (poll_id, Name, Created, Changed, Status) VALUES (1, 'SitePoint', '2016-11-07 11:29:31', '2016-11-07 11:29:31', '1');
INSERT INTO YV_Poll_Options (poll_id, Name, Created, Changed, Status) VALUES (1, 'Envato Tuts+', '2016-11-07 11:29:31', '2016-11-07 11:29:31', '1');
INSERT INTO YV_Poll_Options (poll_id, Name, Created, Changed, Status) VALUES (1, 'Others', '2016-11-08 08:20:25', '2016-11-08 08:20:25', '1');
