<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/update_styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
    session_start();
    include 'navbar.php';
    require_once 'controller.php';

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 1) {
        header("Location: ../index.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
        $user_id = $_POST['user_id'];
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $type = $_POST['type'];

        $updated = updateUser($user_id, $firstname, $lastname, $middlename, $contact, $email, $address, $type);

        if ($updated) {
            header("Location: edit_user.php");
            exit();
        } else {
            echo "Error updating user.";
        }
    }

    if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        $user = getUserDetails($user_id);

        if (!$user) {
            echo "User not found.";
            exit();
        }
    } else {
        header("Location: users.php");
        exit();
    }

    if (isset($_POST['reset_password'])) {
        $result = resetPassword($user_id);

        if ($result) {
            echo "Password reset successful.";
            header("Location: users.php");
            exit();
        } else {
            echo "Password reset failed.";
        }
    }
    ?>
    <div class="container">
            <h1>Edit User Details</h1>
            <div class="account-form">
                <form method="post" action="edit_user.php">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
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
                            <div class="form-group col-md-12">
                                <label for="address">Home Address</label>
                                <input type="text" id="address" name="address" value="<?= $user['address'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="type">Role</label>
                            <select name="type">
                                <option value="1" <?= $user['type'] == 1 ? 'selected' : '' ?>>Admin</option>
                                <option value="2" <?= $user['type'] == 2 ? 'selected' : '' ?>>User</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <br>
                            <input type="submit" name="update_user" value="Update User">
                        </div>
                        <div class="form-group col-md-4">
                            <br>
                            <input type="submit" name="reset_password" value="Reset Password">
                        </div>
                    </div>
                    </div>
                </form>
            </div>
    <script src="../js/update.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>