<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/register_styles.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form method="post" action="process_register.php">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Last Name</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                    <label>First Name</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" required>
                </div>
                <div class="form-group col-md-4">
                    <label>Middle Name</label>
                    <input type="text" id="middlename" name="middlename" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Mobile Number</label>
                    <input type="text" id="contact" name="contact" class="form-control" required>
                </div>
                <div class="form-group col-md-8">
                    <label for="register_email">Email Address</label>
                    <input type="email" id="register_email" name="register_email" class="form-control" required oninput="checkEmailFormat()">
                    <span id="email-validate-msg"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Home Address</label>
                    <input type="text" id="address" name="address" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="password-container">
                        <label>Password</label>
                        <input type="password" id="create_password" name="create_password" class="form-control" required oninput="checkPasswordMatch()">
                        <i class="far fa-eye toggle-create_password" onclick="toggleCreatePasswordVisibility()"></i>
                    </div>
                    <span id="password-validate-msg"></span>
                </div>
                <div class="form-group col-md-6">
                    <div class="password-container">
                        <label>Confirm Password</label>
                        <input type="password" id="confirm_password" class="form-control" required oninput="checkPasswordMatch()">
                        <i class="far fa-eye toggle-confirm_password" onclick="toggleConfirmPasswordVisibility()"></i>
                    </div>
                    <span id="password-match-msg"></span>
                </div>
            </div>
            <input type="submit" id="registerButton" name="register" value="Register" class="btn btn-primary" disabled>
            <div class="separator">
                <span></span>
            </div>
            <a href="../index.php" class="login-button">Back to Login</a>
        </form>
    </div>
    <script src="../js/register.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
