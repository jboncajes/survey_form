<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/login_styles.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
            <?php
            session_start();
            require_once 'php/controller.php';

            $error_message = '';

            if (isset($_POST['login'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $user = login($email, $password);

                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_firstname'] = $user['firstname'];
                    $_SESSION['user_lastname'] = $user['lastname'];
                    $_SESSION['user_type'] = $user['type'];

                    if ($user['type'] == 1) {
                        header("Location: php/dashboard.php");
                        exit();
                    } elseif ($user['type'] == 2) {
                        $connection = connectDatabase();
                        $query = "SELECT * FROM `survey` WHERE `status` = 'active' AND `start_date` <= CURDATE() AND `end_date` >= CURDATE() LIMIT 1";
                        $result = mysqli_query($connection, $query);

                        if ($result && mysqli_num_rows($result) == 1) {
                            header("Location: php/survey.php");
                            exit();
                        } else {
                            $error_message = "No active survey available at the moment.";
                        }
                    }
                } else {
                    $error_message = "Invalid email or password. Please try again.";
                }
            }
            ?>
            <?php if ($error_message !== '') { ?>
                <p><?php echo $error_message; ?></p>
            <?php } ?>
        <form method="post" action="index.php">
            <label>Email Address</label>
            <input type="email" name="email" id="email" required><br>
            <label>Password</label>
            <div class="password-container">
                <input type="password" name="password" id="password" required>
                <i class="far fa-eye toggle-password" onclick="togglePasswordVisibility()"></i>
            </div>
            <input type="submit" name="login" value="Login" id="loginButton" disabled>
            <div class="separator">
                <span></span>
            </div>
            <a href="php/register.php" class="signup-button">Sign Up</a>
        </form>
    </div>
    <script src="js/login.js"></script>
</body>
</html>
