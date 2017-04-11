CREATE TABLE image_edit.Users (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    password CHAR(128) NOT NULL,
    isCompany INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    profPic VARCHAR(100),
    phone VARCHAR(10),
    CONSTRAINT PK_Users PRIMARY KEY (id)
);

CREATE TABLE image_edit.Logos (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(500),
    CONSTRAINT PK_Logos PRIMARY KEY (id)
);

CREATE TABLE image_edit.Files (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    filepath VARCHAR(255) NOT NULL,
    type ENUM('PNG','JPG','PDF','TIFF','EPS','BMP','OTHER') NOT NULL,
    profile ENUM('RGB','CMYK') NOT NULL,
    length INT NOT NULL,
    width INT NOT NULL,
    description VARCHAR(500),
    CONSTRAINT PK_Files PRIMARY KEY (id)
);

CREATE TABLE image_edit.Collections (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(500),
    CONSTRAINT PK_Collections PRIMARY KEY (id)
);

CREATE TABLE image_edit.UsersClients (
    companyid INT(6) UNSIGNED,
    clientid INT(6) UNSIGNED,
    CONSTRAINT PK_UsersClients PRIMARY KEY (companyid,clientid),
    FOREIGN KEY FK_UsersClients_Clients (companyid)
      REFERENCES Users(id)
      ON UPDATE CASCADE
      ON DELETE RESTRICT,
    FOREIGN KEY FK_UsersClients_Users (clientid)
      REFERENCES Users(id)
      ON UPDATE CASCADE
      ON DELETE RESTRICT
);

CREATE TABLE image_edit.UsersLogos (
    userid INT(6) UNSIGNED,
    logoid INT(6) UNSIGNED,
    CONSTRAINT PK_UsersLogos PRIMARY KEY (userid,logoid),
    FOREIGN KEY FK_UsersLogos_Users (userid)
      REFERENCES Users(id)
      ON UPDATE CASCADE
      ON DELETE RESTRICT,
    FOREIGN KEY FK_UsersLogos_Logos (logoid)
      REFERENCES Logos(id)
      ON UPDATE CASCADE
      ON DELETE RESTRICT
);

CREATE TABLE image_edit.LogosFiles (
    logoid INT(6) UNSIGNED,
    fileid INT(6) UNSIGNED,
    CONSTRAINT PK_LogosFiles PRIMARY KEY (logoid,fileid),
    FOREIGN KEY FK_LogosFiles_Logos (logoid)
      REFERENCES Logos(id)
      ON UPDATE CASCADE
      ON DELETE RESTRICT,
    FOREIGN KEY FK_LogosFiles_Files (fileid)
      REFERENCES Files(id)
      ON UPDATE CASCADE
      ON DELETE RESTRICT
);

CREATE TABLE image_edit.UsersCollections (
    userid INT(6) UNSIGNED,
    collectionid INT(6) UNSIGNED,
    CONSTRAINT PK_UsersCollections PRIMARY KEY (userid,collectionid),
    FOREIGN KEY FK_UsersCollections_Users (userid)
      REFERENCES Users(id)
      ON UPDATE CASCADE
      ON DELETE RESTRICT,
    FOREIGN KEY FK_UsersCollections_Collections (collectionid)
      REFERENCES Collections(id)
      ON UPDATE CASCADE
      ON DELETE RESTRICT
);

CREATE TABLE image_edit.CollectionsLogos (
    collectionid INT(6) UNSIGNED,
    logoid INT(6) UNSIGNED,
    CONSTRAINT PK_CollectionsLogos PRIMARY KEY (collectionid,logoid),
    FOREIGN KEY FK_CollectionsLogos_Collections (collectionid)
      REFERENCES Collections(id)
      ON UPDATE CASCADE
      ON DELETE RESTRICT,
    FOREIGN KEY FK_CollectionsLogos_Logos (logoid)
      REFERENCES Logos(id)
      ON UPDATE CASCADE
      ON DELETE RESTRICT
);
