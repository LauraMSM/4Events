CREATE DATABASE IF NOT EXISTS FourEvents;
USE FourEvents;

GRANT ALL PRIVILEGES ON FourEvents.* TO 'LauraSarmiento'@'%' IDENTIFIED BY '12345';
FLUSH PRIVILEGES;


CREATE TABLE IF NOT EXISTS users(
    ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(25) NOT NULL,
    password VARCHAR(50) NOT NULL,
    name VARCHAR(25) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL
);

CREATE TABLE IF NOT EXISTS events(
    ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(25) NOT NULL,
    description VARCHAR(175) NOT NULL,
    eventDate DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS participants(
    IDUser INT UNSIGNED,
    IDEvent INT UNSIGNED,
    PRIMARY KEY (IDUser, IDEvent),
    FOREIGN KEY (IDUser) REFERENCES users (ID),
    FOREIGN KEY (IDEvent) REFERENCES events (ID)
);

CREATE TRIGGER add_creator_as_participant
AFTER INSERT ON events
FOR EACH ROW
BEGIN
    INSERT INTO participants ( IDEvents, IDUsers )
    VALUES ( NEW.id, NEW.IDUSERS )
END; 