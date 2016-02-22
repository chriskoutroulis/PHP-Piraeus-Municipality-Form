CREATE DATABASE IF NOT EXISTS pirdb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE pirdb;

CREATE TABLE IF NOT EXISTS problems (
email VARCHAR(50) NOT NULL,
first_name VARCHAR(50) NOT NULL,
last_name VARCHAR(50) NOT NULL,
cellphone CHAR(10) NOT NULL,
street VARCHAR(50) NOT NULL,
street_number VARCHAR(3) NOT NULL,
zipcode VARCHAR(5) NOT NULL,
problem VARCHAR(500) NOT NULL
);

GRANT EXECUTE ON PROCEDURE pirdb.addReport TO 'piradmin'@'localhost' IDENTIFIED BY '1234';

DROP PROCEDURE IF EXISTS addReport;
DELIMITER <>
CREATE PROCEDURE addReport (IN cemail VARCHAR(50), IN cname VARCHAR(50), IN csurname VARCHAR(50),
IN cmobile CHAR(10), IN cstreet VARCHAR(50), IN cstreetnumber VARCHAR(3), IN ctk VARCHAR(5), 
IN ccomplaint VARCHAR(500))
BEGIN
INSERT INTO problems VALUES (cemail, cname, csurname, cmobile, cstreet, cstreetnumber, 
ctk, ccomplaint);
END <>
DELIMITER ;

-- Test Call
-- CALL addReport('chriskoutroulis@gmail.com', 'Χριστόδουλος', 'Κουτρουλής', '6985212457', 
-- 'Οδός Σινώπης', '32', '19562', 'Μια γάτα κόλλησε πάνω σε ένα δέντρο');





