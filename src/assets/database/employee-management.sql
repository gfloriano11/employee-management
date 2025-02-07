DROP DATABASE IF EXISTS employee_management;

CREATE DATABASE employee_management;

USE employee_management;

CREATE TABLE users(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    user_pass VARCHAR(255) NOT NULL,
    post VARCHAR(255) DEFAULT "Estagiário",
    is_admin ENUM ("YES", "NO") DEFAULT "NO" NOT NULL,
    profile_pic VARCHAR(255) DEFAULT "default.svg" NOT NULL
);