<?php
// Start the session
session_start();

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : null;
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles/style.css"/>
    </head>
    <header>
        <title>My Website</title>
    </header>
    <body>
        <script src="scripts/script.js"></script>
     
        <div id="header">
            <img src="images/logo.svg" alt="Logo"/>
            <h1>Welcome to my website</h1>
            <div class="user-profile">
                <?php if ($isLoggedIn): ?>
                    <!-- Show username and logout button if logged in -->
                    <img src="images/user.svg" alt="User Profile"/>
                    <span>Welcome, <?php echo htmlspecialchars($username); ?></span>
                    <form action="logout.php" method="POST" style="display: inline;">
                        <button type="submit">Logout</button>
                    </form>
                <?php else: ?>
                    <!-- Show login and signup buttons if not logged in -->
                    <button onclick="window.location.href='login.php'">Login</button>
                    <button onclick="window.location.href='signup.php'">Signup</button>
                <?php endif; ?>
            </div>
        </div>

        <div id="body">
            <div class="content">
                <h2>Main Content Area</h2>
                <p>This is where the main content of the page will go.</p>
            </div>

            <div class="sidebar">
                <h3>Sidebar</h3>
                <p>This is the sidebar content.</p>
            </div>
        </div>
        <div id="footer">
            <p>Footer content goes here.</p>
            <ul class="social-icons">
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Instagram</a></li>
            </ul>
        </div>
    </body>
    <footer>
    </footer>
</html>