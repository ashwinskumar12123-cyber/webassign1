-- Run once:  mysql -u root -p < schema.sql
CREATE DATABASE IF NOT EXISTS chatdb
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE chatdb;

CREATE TABLE IF NOT EXISTS messages (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    sender     VARCHAR(30)  NOT NULL DEFAULT 'Anonymous',
    message    TEXT         NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4;

-- User used by db.php (change the password!)
CREATE USER IF NOT EXISTS 'chatuser'@'%' IDENTIFIED BY 'chatpass';
GRANT SELECT, INSERT ON chatdb.messages TO 'chatuser'@'%';
FLUSH PRIVILEGES;
