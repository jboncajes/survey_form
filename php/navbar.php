<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/navigation_styles.css">
</head>
<body>
  <nav class="navbar">
    <div class="navbar-left">
        <a class="hamburger" onclick="toggleSidebar()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </a>
        <?php
            if (isset($_SESSION['user_firstname'])) {
            $user_firstname = $_SESSION['user_firstname'];
            echo "<span>Welcome, $user_firstname!</span>";
            }
        ?>
    </div>
    <div class="navbar-right">
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>
  </nav>
  <div id="sidebar">
    <div id="sidebar" class="show-sidebar">
        <div class="sidebar-content">
            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1) : ?>
                <a href="dashboard.php" class="sidebar-btn">Dashboard</a>
                <a href="edit_survey.php?survey_id=1" class="sidebar-btn">Edit Survey</a>
                <a href="users.php" class="sidebar-btn">Users</a>
                <a href="account_management.php" class="sidebar-btn">Account Management</a>
            <?php else : ?>
                <a href="survey.php" class="sidebar-btn">Survey</a>
                <a href="account_management.php" class="sidebar-btn">Account Management</a>
            <?php endif; ?>
        </div>
    </div>
  </div>
  <script src="../js/navigation.js"></script>
</body>
</html>
