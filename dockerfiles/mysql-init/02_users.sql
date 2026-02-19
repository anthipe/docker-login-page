
CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY 'pass';
GRANT SELECT ON data.* TO 'admin'@'localhost';


CREATE USER IF NOT EXISTS 'admin'@'%' IDENTIFIED BY 'pass';
GRANT SELECT ON data.* TO 'admin'@'%';


FLUSH PRIVILEGES;