CREATE DATABASE IF NOT EXISTS jofc_db;
USE jofc_db;

-- Users table
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    confirm_password VARCHAR(255) NOT NULL,  
    full_name VARCHAR(100) NOT NULL,
    contact_number VARCHAR(20),
    role ENUM('member', 'admin') DEFAULT 'member',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
);

-- Events table
CREATE TABLE events (
    event_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    event_date DATE NOT NULL,
    start_time TIME,
    end_time TIME,
    category ENUM('service', 'prayer', 'meeting', 'special') NOT NULL,
    created_by INT,
    FOREIGN KEY (created_by) REFERENCES users(user_id)
);

-- Blog posts table
CREATE TABLE blog_posts (
    post_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(255),
    author_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(user_id)
);
