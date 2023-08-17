<!DOCTYPE html>
<html>
<head>
    <title>Account Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/account_styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
    session_start();
    include 'navbar.php';
    require_once 'controller.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $user = getUserDetails($user_id);

    if (isset($_POST['save_changes'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middlename = $_POST['middlename'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = $_POST['create_password'];

        $has_changes = (
            $firstname !== $user['firstname'] ||
            $lastname !== $user['lastname'] ||
            $middlename !== $user['middlename'] ||
            $contact !== $user['contact'] ||
            $address !== $user['address'] ||
            $email !== $user['email'] ||
            !empty($password)
        );

        $updatePassword =  ($password !== $user['password']);
        echo json_encode(['message' => $updatePassword]);
        echo json_encode(['message' => $password]);

        if ($has_changes) {
            updateUserDetails($user_id, $firstname, $lastname, $middlename, $contact, $address, $email, $password);
            if ($updatePassword) {
                header("Location: account_management.php?success=1");
                exit();
            } else {
                header("Location: account_management.php?success=1");
                exit();
            }
        }

    }
    ?>
    <div class="container">
        <h1>Account Management</h1>
        <div class="account-form">
            <form method="post" action="account_management.php">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" value="<?= $user['lastname'] ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" value="<?= $user['firstname'] ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="middlename">Middle Name</label>
                        <input type="text" id="middlename" name="middlename" value="<?= $user['middlename'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="contact">Contact Number</label>
                        <input type="text" id="contact" name="contact" value="<?= $user['contact'] ?>" required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required oninput="checkEmailFormat()">
                        <span id="email-validate-msg"></span>
                    </div>    
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="address">Home Address</label>
                        <input type="text" id="address" name="address" value="<?= $user['address'] ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="password-container">
                        <label for="password">Password</label>
                        <input type="password" id="create_password" name="create_password" class="form-control" oninput="checkPasswordMatch()">
                        <i class="far fa-eye toggle-create_password" onclick="toggleCreatePasswordVisibility()"></i>
                    </div>
                    <span id="password-validate-msg"></span>
                </div>
                    <div class="form-group col-md-6">
                        <div class="password-container">
                            <label>Confirm Password</label>
                            <input type="password" id="confirm_password" class="form-control" oninput="checkPasswordMatch()">
                            <i class="far fa-eye toggle-confirm_password" onclick="toggleConfirmPasswordVisibility()"></i>
                        </div>
                        <span id="password-match-msg"></span>
                    </div>
                </div>
                <div class="button-container">
                    <input type="submit" name="save_changes" id="save_changes_btn" value="Save Changes" disabled>
                </div>
            </form>
        </div>
    <script src="../js/account.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
