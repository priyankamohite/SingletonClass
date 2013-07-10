
DELIMITER //
CREATE PROCEDURE insert(IN organisation_id int, IN fname VARCHAR(50),IN lname VARCHAR(50),IN city VARCHAR(50))

BEGIN

SET @organisation_id=organisation_id;
SET @fname=fname;
SET @lname=lname;
SET @city=city;

PREPARE STMT FROM
"INSERT INTO users(organisation_id,fname,lname,city) VALUES (?,?)";

EXECUTE STMT USING @organisation_id,@fname,@lname,@city;

END