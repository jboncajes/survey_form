<?php
function connectDatabase() {
    $db_host = "localhost";
    $db_name = "survey_database";
    $db_user = "root";
    $db_password = "";

    $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $connection;
}

function sanitize($connection, $data) {
    return mysqli_real_escape_string($connection, trim($data));
}

function getUserByEmail($email) {
    $connection = connectDatabase();
    $email = sanitize($connection, $email);

    $query = "SELECT * FROM `users` WHERE `email` = '$email' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }

    return false;
}

function login($email, $password) {
    $connection = connectDatabase();
    $email = sanitize($connection, $email);

    $query = "SELECT * FROM `users` WHERE `email` = '$email' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $hashed_password = $user['password'];

        if (password_verify($password, $hashed_password)) {
            return $user;
        }
    }

    return false;
}

function getLoggedInUserName() {
    if (isset($_SESSION['username'])) {
        return $_SESSION['username'];
    }
    return '';
}

function getLoggedInUserType() {
    if (isset($_SESSION['user_type'])) {
        return $_SESSION['user_type'];
    }
    return '';
}

function getSurveyQuestions()
{
    $connection = connectDatabase();
    $query = "SELECT * FROM questions WHERE status = 'active' ORDER BY order_by";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    $questions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $questions[] = $row;
    }

    mysqli_free_result($result);
    mysqli_close($connection);

    return $questions;
}


function getSurveyQuestionsTruncated()
{
    $connection = connectDatabase();
    $query = "SELECT * FROM questions WHERE status = 'active' ORDER BY order_by";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    $questions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $question = $row['question'];
        if ($question === 'Diagnosed with COVID-19?') {
            $row['question'] = 'Diagnosed?';
        } elseif ($question === 'Encounter with a person diagnosed with COVID-19?') {
            $row['question'] = 'Exposed?';
        } elseif ($question === 'Vaccinated against COVID-19?') {
            $row['question'] = 'Vaccinated?';
        }
        $questions[] = $row;
    }

    mysqli_free_result($result);
    mysqli_close($connection);

    return $questions;
}

function submitSurveyResponse($user_id, $question_id, $answer) {
    $connection = connectDatabase();

    $user_id = mysqli_real_escape_string($connection, $user_id);
    $question_id = mysqli_real_escape_string($connection, $question_id);
    $answer = mysqli_real_escape_string($connection, $answer);

    if ($question_id > 0) {
        $query = "INSERT INTO `answers` (`survey_id`, `user_id`, `answer`, `question_id`) 
                  VALUES (1, '$user_id', '$answer', '$question_id')";
        mysqli_query($connection, $query);
    }

    mysqli_close($connection);
}

function getSurveyResponsesData() {
    $connection = connectDatabase();

    $query = "SELECT q.id AS question_id, q.question, a.answer, COUNT(*) AS count
              FROM answers a
              JOIN questions q ON a.question_id = q.id
              GROUP BY q.id, a.answer";

    $result = mysqli_query($connection, $query);
    $responses = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $responses[] = $row;
    }

    mysqli_close($connection);

    return $responses;
}

function getSurveyResponsesByQuestionId($question_id) {
    $connection = connectDatabase();
    $question_id = sanitize($connection, $question_id);

    if ($question_id == 2) {
        $query = "SELECT
                    CASE
                        WHEN a.answer = 'Male' THEN 'Male'
                        WHEN a.answer = 'Female' THEN 'Female'
                        ELSE 'Prefer not to answer'
                    END AS gender,
                    COUNT(*) AS `count`
                  FROM answers AS a
                  WHERE a.question_id = 2
                  GROUP BY gender";
    } else if ($question_id == 3) {
        $query = "SELECT
                    CASE
                        WHEN a.answer < 18 THEN 'Minor'
                        ELSE 'Adult'
                    END AS age_group,
                    COUNT(*) AS `count`
                  FROM answers AS a
                  WHERE a.question_id = 3
                  GROUP BY age_group";
    } else if ($question_id == 5) {
        $query = "SELECT
                    CASE
                        WHEN a.answer > 37 THEN 'With Fever'
                        ELSE 'Without Fever'
                    END AS fever_status,
                    COUNT(*) AS `count`
                  FROM answers AS a
                  WHERE a.question_id = 5
                  GROUP BY fever_status";
    } else if ($question_id == 9) {
        $query = "SELECT
                    CASE
                        WHEN a.answer = 'Filipino' THEN 'Filipino'
                        ELSE 'Foreigner'
                    END AS nationality,
                    COUNT(*) AS `count`
                  FROM answers AS a
                  WHERE a.question_id = 9
                  GROUP BY nationality";
    } else {
        // For other question_ids, group by the raw answer value
        $query = "SELECT a.answer AS label, COUNT(*) AS `count`
                  FROM answers AS a
                  WHERE a.question_id = $question_id
                  GROUP BY a.answer";
    }

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'label' => $row['gender'] ?? $row['age_group'] ?? $row['fever_status'] ?? $row['nationality'] ?? $row['label'],
            'value' => $row['count'],
        ];
    }

    mysqli_free_result($result);
    mysqli_close($connection);

    return $data;
}


function getAllSurveyResponses() {
    $connection = connectDatabase();

    $query = "SELECT * FROM answers";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    mysqli_free_result($result);
    mysqli_close($connection);

    return $data;
}

function getUsers() {
    $connection = connectDatabase();
    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    mysqli_free_result($result);
    mysqli_close($connection);

    return $data;
}

function getSurveyResponseByQuestionAndUser($question_id, $user_id) {
    $connection = connectDatabase();
    $question_id = sanitize($connection, $question_id);
    $user_id = sanitize($connection, $user_id);

    $query = "SELECT answer FROM answers WHERE question_id = $question_id AND user_id = $user_id";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    $row = mysqli_fetch_assoc($result);
    $answer = $row['answer'] ?? '';

    mysqli_free_result($result);
    mysqli_close($connection);

    return $answer;
}

function getSurveyById($survey_id) {
    $connection = connectDatabase();
    $survey_id = sanitize($connection, $survey_id);

    $query = "SELECT * FROM survey WHERE id = $survey_id";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    $survey = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($connection);

    return $survey;
}

function getQuestionsBySurveyId($survey_id) {
    $connection = connectDatabase();
    $survey_id = sanitize($connection, $survey_id);

    $query = "SELECT * FROM questions WHERE survey_id = $survey_id AND status = 'active' ORDER BY order_by";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    $questions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $questions[] = $row;
    }

    mysqli_free_result($result);
    mysqli_close($connection);

    return $questions;
}

function getSurveyInfo() {
    $connection = connectDatabase();

    $sql = "SELECT title, description, start_date, end_date FROM survey";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        die("Error fetching survey info: " . mysqli_error($connection));
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($connection);
        return $row;
    } else {
        mysqli_free_result($result);
        mysqli_close($connection);
        return array(); 
    }
}

function updateSurvey($survey_id, $title, $description, $start_date, $end_date) {
    $connection = connectDatabase();

    $survey_id = 1;
    $title = sanitize($connection, $title);
    $description = sanitize($connection, $description);
    $start_date = sanitize($connection, $start_date);
    $end_date = sanitize($connection, $end_date);

    $query = "UPDATE survey SET title = '$title', description = '$description', start_date = '$start_date', end_date = '$end_date' WHERE id = $survey_id";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    mysqli_close($connection);
}

function updateQuestion($survey_id, $question_id, $question_name, $question_type, $question_options) {
    $connection = connectDatabase();

    $survey_id = 1;
    $question_id = sanitize($connection, $question_id);
    $question_name = sanitize($connection, $question_name);
    $question_type = sanitize($connection, $question_type);
    $question_options = sanitize($connection, $question_options);

    if ($question_type === "select" || $question_type === "radio") {
        $question_options = implode(',', array_map('trim', explode(',', $question_options)));

        $query = "UPDATE questions SET survey_id = $survey_id, question = '$question_name', type = '$question_type', frm_option = '$question_options' WHERE id = $question_id";
    } else {
        $query = "UPDATE questions SET survey_id = $survey_id, question = '$question_name', type = '$question_type', frm_option = NULL WHERE id = $question_id";
    }

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    mysqli_close($connection);
}

function deleteQuestion($question_id) {
    $connection = connectDatabase();
    $question_id = sanitize($connection, $question_id);

    $query = "UPDATE questions SET status = 'archived' WHERE id = $question_id";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    mysqli_close($connection);
}


function getUserDetails($user_id)
{
    $connection = connectDatabase();
    $user_id = sanitize($connection, $user_id);

    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    $user_details = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($connection);

    return $user_details;
}

function updateUserDetails($user_id, $firstname, $lastname, $middlename, $contact, $address, $email, $password)
{
    $connection = connectDatabase();
    $user_id = sanitize($connection, $user_id);
    $firstname = sanitize($connection, $firstname);
    $lastname = sanitize($connection, $lastname);
    $middlename = sanitize($connection, $middlename);
    $contact = sanitize($connection, $contact);
    $address = sanitize($connection, $address);
    $email = sanitize($connection, $email);
    $password = sanitize($connection, $password);

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', middlename = '$middlename', contact = '$contact', address = '$address', email = '$email', password = '$hashed_password' WHERE id = '$user_id'";
    } else {
        $query = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', middlename = '$middlename', contact = '$contact', address = '$address', email = '$email' WHERE id = '$user_id'";
    }

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query execution failed: " . mysqli_error($connection));
    }

    mysqli_close($connection);
}

function groupResponsesForQuestionYesOrNo($data)
{
    $groupedData = array(
        'Yes' => 0,
        'No' => 0
    );

    foreach ($data as $response) {
        if ($response === 'Yes') {
            $groupedData['Yes']++;
        } else {
            $groupedData['No']++;
        }
    }

    return $groupedData;
}

function groupResponsesForQuestionId2($data)
{
    $groupedData = array(
        'Male' => 0,
        'Female' => 0,
        'Prefer not to answer' => 0
    );

    foreach ($data as $response) {
        if ($response === 'Male') {
            $groupedData['Male']++;
        } else if ($response === 'Female') {
            $groupedData['Female']++;
        } else {
            $groupedData['Prefer not to answer']++;
        }
    }

    return $groupedData;
}

function groupResponsesForQuestionId3($data)
{
    $groupedData = array(
        'Minor' => 0,
        'Adult' => 0
    );

    foreach ($data as $response) {
        if ($response < 18) {
            $groupedData['Minor']++;
        } else {
            $groupedData['Adult']++;
        }
    }

    return $groupedData;
}

function groupResponsesForQuestionId5($data)
{
    $groupedData = array(
        'Normal Temperature' => 0,
        'With Fever' => 0
    );

    foreach ($data as $response) {
        if ($response >= 37.5) {
            $groupedData['With Fever']++;
        } else {
            $groupedData['Normal Temperature']++;
        }
    }

    return $groupedData;
}

function groupResponsesForQuestionId9($data)
{
    $groupedData = array(
        'Filipino' => 0,
        'Foreigner' => 0
    );

    foreach ($data as $response) {
        if ($response === 'Filipino') {
            $groupedData['Filipino']++;
        } else {
            $groupedData['Foreigner']++;
        }
    }

    return $groupedData;
}

function insertUserData($lastname, $firstname, $middlename, $contact, $email, $address, $password) {
    $connection = connectDatabase();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (lastname, firstname, middlename, contact, email, address, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    if (!$stmt) {
        die("Error: " . $connection->error);
    }

    $stmt->bind_param("sssssss", $lastname, $firstname, $middlename, $contact, $email, $address, $hashedPassword);

    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
    $connection->close();
}

function getActiveUsers() {
    $connection = connectDatabase();
    
    $query = "SELECT id, firstname, lastname, middlename, contact, address, email, type FROM users WHERE status = 'active'";
    $result = mysqli_query($connection, $query);

    $users = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $userType = $row['type'] == 1 ? 'Admin' : 'User';

            $row['type_label'] = $userType;

            $users[] = $row;
        }
        mysqli_free_result($result);
    }

    mysqli_close($connection);

    return $users;
}

function deleteUser($id) {
    $connection = connectDatabase();

    $id = sanitize($connection, $id);

    $query = "UPDATE users SET status = 'archived' WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
}

if (isset($_POST['action']) && $_POST['action'] === 'deleteUser') {
    if (isset($_POST['id'])) {
        $userId = $_POST['id'];
        deleteUser($userId);
    } else {
        echo json_encode(['success' => false, 'message' => 'User ID not provided']);
    }
    exit();
}

function resetPassword($id) {
    $connection = connectDatabase();
    $pass = 'P@ssw0rd';
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    $query = "UPDATE users SET password = '$hashedPassword' WHERE id = $id";
    $result = mysqli_query($connection, $query);

    mysqli_close($connection);
    return $result;
}

function updateUser($id, $firstname, $lastname, $middlename, $contact, $email, $address, $type) {
    $connection = connectDatabase();

    $firstname = mysqli_real_escape_string($connection, $firstname);
    $lastname = mysqli_real_escape_string($connection, $lastname);
    $middlename = mysqli_real_escape_string($connection, $middlename);
    $contact = mysqli_real_escape_string($connection, $contact);
    $email = mysqli_real_escape_string($connection, $email);
    $address = mysqli_real_escape_string($connection, $address);

    $query = "UPDATE users SET 
                firstname = '$firstname',
                lastname = '$lastname',
                middlename = '$middlename',
                contact = '$contact',
                email = '$email',
                address = '$address',
                type = '$type'
              WHERE id = $id";

    $result = mysqli_query($connection, $query);

    mysqli_close($connection);

    return $result;
}

function checkAnsweredToday($user_id, $survey_id) {
    $connection = connectDatabase();
    $user_id = sanitize($connection, $user_id);
    $survey_id = sanitize($connection, $survey_id);
    $today = date('Y-m-d');

    $query = "SELECT * FROM answers WHERE user_id = '$user_id' AND survey_id = '$survey_id' AND DATE(date_created) = '$today'";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Error executing query: " . mysqli_error($connection));
    }

    $answeredToday = mysqli_num_rows($result) > 0;

    mysqli_free_result($result);
    mysqli_close($connection);

    return $answeredToday;
}


?>