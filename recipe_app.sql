CREATE DATABASE IF NOT EXISTS recipe_app;
USE recipe_app;

-- ============================
-- USERS TABLE
-- ============================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
);

-- ============================
-- RECIPES TABLE
-- ============================
CREATE TABLE recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
);

-- ============================
-- FAVORITES TABLE
-- ============================
CREATE TABLE favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    recipe_id INT NOT NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
        
    FOREIGN KEY (recipe_id) REFERENCES recipes(id)
        ON DELETE CASCADE
);

-- ============================
-- SAMPLE ADMIN ACCOUNT (optional)
-- Email: admin@test.com
-- Password: admin123
-- ============================

INSERT INTO users (username, email, password, role)
VALUES ('admin', 'admin@test.com',
        '$2y$10$M8M6VQVMFyV0gSnbFVKyYuhbozFZ2QV/pk1e/8smXc21hVXVJyQ32', 
        'admin');
