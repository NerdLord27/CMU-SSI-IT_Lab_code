<?php
session_start();

// Include database connection
require_once 'db.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // INTENTIONALLY VULNERABLE CODE - Direct string concatenation for SQL injection
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    
    try {
        $stmt = $pdo->query($query);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // Login successful - display employee dashboard
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>SecureCorp - Employee Dashboard</title>
                <link rel="stylesheet" href="style.css">
            </head>
            <body>
                <div class="container">
                    <div class="success-container">
                        <div class="success-header">
                            <h1>Welcome to SecureCorp</h1>
                            <p>Employee Portal Dashboard</p>
                        </div>
                        
                        <div class="welcome-message">
                            <h3>Authentication Successful</h3>
                            <p>Welcome back, <strong><?php echo htmlspecialchars($user['username']); ?></strong>!</p>
                            <p>You have successfully accessed the secure employee portal.</p>
                        </div>
                        
                        <div class="user-info">
                            <h4>Access Credentials</h4>
                            <p><strong>Employee ID:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                            <p><strong>Access Level:</strong> <?php echo htmlspecialchars($user['username'] === 'admin' ? 'Administrator' : 'Employee'); ?></p>
                            <p><strong>Session Token:</strong> <?php echo htmlspecialchars($user['flag']); ?></p>
                        </div>
                        
                        <div style="margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #28a745;">
                            <h4 style="color: #28a745; margin-bottom: 10px;">System Status: Operational</h4>
                            <p style="margin: 0; color: #666; font-size: 14px;">All systems operational. Your session is secure and encrypted.</p>
                        </div>
                        
                        <a href="index.html" class="back-btn">Sign Out</a>
                    </div>
                </div>
            </body>
            </html>
            <?php
        } else {
            // Login failed
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>SecureCorp - Access Denied</title>
                <link rel="stylesheet" href="style.css">
            </head>
            <body>
                <div class="container">
                    <div class="success-container">
                        <div class="error-message">
                            <h3> Access Denied</h3>
                            <p>Invalid employee ID or password. Please check your credentials and try again.</p>
                            <p style="margin-top: 10px; font-size: 14px;">If you continue to have issues, please contact IT Support.</p>
                        </div>
                        
                        <div style="margin: 20px 0; padding: 15px; background: #fff3cd; border-radius: 8px; border-left: 4px solid #ffc107;">
                            <h4 style="color: #856404; margin-bottom: 10px;">Security Notice</h4>
                            <p style="margin: 0; color: #856404; font-size: 14px;">Multiple failed login attempts may result in account lockout for security purposes.</p>
                        </div>
                        
                        <a href="index.html" class="back-btn">Try Again</a>
                    </div>
                </div>
            </body>
            </html>
            <?php
        }
    } catch (PDOException $e) {
        // Show generic error for production-like appearance
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SecureCorp - System Error</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <div class="container">
                <div class="success-container">
                    <div class="error-message">
                        <h3>⚠️ System Error</h3>
                        <p>We're experiencing technical difficulties. Please try again later.</p>
                        <p style="margin-top: 10px; font-size: 14px;">If the problem persists, contact IT Support immediately.</p>
                    </div>
                    
                    <div style="margin: 20px 0; padding: 15px; background: #fff3cd; border-radius: 8px; border-left: 4px solid #ffc107;">
                        <h4 style="color: #856404; margin-bottom: 10px;">📞 Support Information</h4>
                        <p style="margin: 0; color: #856404; font-size: 14px;">IT Helpdesk: ext. 1234 | Email: support@securecorp.com</p>
                    </div>
                    
                    <a href="index.html" class="back-btn">Return to Login</a>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
} else {
    // Redirect to login page if accessed directly
    header('Location: index.html');
    exit();
}
?> 