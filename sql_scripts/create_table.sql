CREATE DATABASE IF NOT EXISTS SingleLoginUser;
USE SingleLoginUser;

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

