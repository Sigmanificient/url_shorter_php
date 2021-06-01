DROP DATABASE url_shortener;
CREATE DATABASE IF NOT EXISTS url_shortener;
USE url_shortener;

CREATE TABLE urls
(
    id       INT AUTO_INCREMENT PRIMARY KEY,
    redirect VARCHAR(1024) NOT NULL
);

CREATE FUNCTION insert_return(url VARCHAR(1024))
    RETURNS int

BEGIN
    INSERT INTO url_shortener.urls (redirect) VALUES (url);
    RETURN (SELECT LAST_INSERT_ID());
END;
