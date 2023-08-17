<!DOCTYPE html>
<html>
<head>
    <title>Active Users</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/users_styles.css">
</head>
<body>
    <?php
    session_start();
    include 'navbar.php';
    require_once 'controller.php';
    ?>
    <h1>Users List</h1>
    <table id="usersTable" class="usersTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Contact Number</th>
                <th>Email Address</th>
                <th>Home Address</th>
                <th>Role</th>
                <th>Tools</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $users = getActiveUsers();
            $userNumber = 1;

            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>" . $userNumber . "</td>";
                echo "<td>" . $user['lastname'] . "</td>";
                echo "<td>" . $user['firstname'] . "</td>";
                echo "<td>" . $user['middlename'] . "</td>";
                echo "<td>" . $user['contact'] . "</td>";
                echo "<td>" . $user['email'] . "</td>";
                echo "<td>" . $user['address'] . "</td>";
                echo "<td>" . $user['type_label'] . "</td>";
                if ($user['id'] !== $_SESSION['user_id']) {
                    echo '<td class="action-icons">
                            <a class="edit-button" title="Edit" href="edit_user.php?user_id=' . $user['id'] . '">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="post" action="controller.php" style="display: inline;">
                                <input type="hidden" name="action" value="deleteUser">
                                <input type="hidden" name="id" value="' . $user['id'] . '">
                                <button type="submit" class="delete-button" title="Delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>';
                } else {
                    echo '<td></td>';
                }
                
                echo "</tr>";
                $userNumber++;
            }            
        ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="../js/users.js"></script>
</body>
</html>