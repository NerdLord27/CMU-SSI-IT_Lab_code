-- Create database
CREATE DATABASE IF NOT EXISTS ctf_sql;
USE ctf_sql;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    flag VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert test users with CTF flags
INSERT INTO users (username, password, flag) VALUES
('admin', 'admin', 'flag{sql_injection_master}'),
('user1', 'password123', 'flag{user_level_access_granted}'),
('test', 'vader', 'FLAG{TEST_ACCOUNT_COMPROMISED}'),
('guest', 'DontHackME', 'FLAG{GUEST_PRIVILEGES_ESCALATED}');

-- Create a hidden admin user with a special flag
INSERT INTO users (username, password, flag) VALUES
('superadmin', 'potato', 'FLAG{SUPER_ADMIN_ACCESS_ACHIEVED}');

-- Display the created data
SELECT * FROM users; 