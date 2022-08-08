INSERT INTO Users (User_Name,Password) VALUES ("EMMANUEL","ADMIN");



-- Create the table in the specified schema
CREATE TABLE example
(
    ID INT NOT NULL AUTO_INCREMENT,
    user_name VARCHAR (255) NOT NULL,
    password  VARCHAR (255) NOT NULL,
    
    PRIMARY KEY(ID)
)
-- Create the table in the specified schema
CREATE TABLE $unique_user_table
(
    ID INT NOT NULL AUTO_INCREMENT
    user_name [NVARCHAR](50) NOT NULL,
    password [NVARCHAR](50) NOT NULL,

    PRIMARY KEY(ID)
);

--the current table is for all the users 
--create the table for the all the personal information
-- ID is the primary key on the users table while U_ID is the primary id on the user_info table ID would be the foreign key on the user_info
CREATE TABLE users_info
(
 U_ID INT NOT NULL AUTO_INCREMENT,
 ID INT NOT NULL,
 user_name VARCHAR (255) NOT NULL,
 password VARCHAR  (255) NOT NULL,
 email VARCHAR (255) NOT NULL,
 birthday VARCHAR (255) NOT NULL,
 sex VARCHAR (10) NOT NULL,
 comment VARCHAR(255) NOT NULL,
 home_address VARCHAR (255) NOT NULL,
 profile_picture VARCHAR (255) NOT NULL,
 
 PRIMARY KEY(U_ID),
 FOREIGN KEY (ID) REFERENCES users(ID)
);

INSERT INTO users_info (U_ID,user_n)

--create another table to store the admin details 
CREATE TABLE admin_info
(
 ID INT NOT NULL AUTO_INCREMENT,
 user_name VARCHAR (255) NOT NULL,
 password VARCHAR (255) NOT NULL,

 PRIMARY KEY (ID)    
);

--create the query that would insert the admin information to the created table
INSERT INTO admin_info (user_name,password) VALUES ("administrator","123admin123();");


--PREPARE THE QUERY FOR THE users_info UPDATE
UPDATE users_info SET email =$email, birthday =$birthday, sex =$sex, comment =$bio, homeAddress =$homeAddress, phone_number =$phoneNumber, profile_picture =$profilePic timeUpdated =$timeUpdated;



INSERT INTO admin_msgs (U_ID,message,date_added) VALUES ()