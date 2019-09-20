

--
CREATE TABLE userinfo(
	ID int IDENTITY(1,1) NOT NULL PRIMARY KEY,
	username varchar(150) NOT NULL, 
	passwords varchar(150) NOT NULL,
	email varchar(150) NOT NULL,
	firstname varchar(150),
	lastname varchar(150)
);



CREATE TABLE CONTACTS (
  CONTACT_ID int IDENTITY(1,1) NOT NULL PRIMARY KEY,
  phone varchar(15) NOT NULL,
  email varchar(150) NOT NULL,
  firstname varchar(150) NOT NULL,
  lastname varchar(150) NOT NULL,
  ID int FOREIGN KEY REFERENCES userinfo(ID)
);
