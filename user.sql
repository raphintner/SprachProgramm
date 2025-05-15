CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE,
    email VARCHAR(100) UNIQUE,
    password_hash VARCHAR(255),
    target_language VARCHAR(10) DEFAULT 'en',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE vocabulary (
    id INT PRIMARY KEY AUTO_INCREMENT,
    base_word VARCHAR(255),
    translation VARCHAR(255),
    language_pair VARCHAR(10),
    difficulty TINYINT DEFAULT 1
);

CREATE TABLE progress (
    user_id INT,
    word_id INT,
    last_reviewed DATETIME,
    correct_answers INT DEFAULT 0,
    wrong_answers INT DEFAULT 0,
    next_review DATETIME,
    PRIMARY KEY (user_id, word_id)
);
