<?php
session_start();
require_once 'controller.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 2) {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['submit_survey'])) {
    $user_id = $_SESSION['user_id'];
    $responses = $_POST['responses'];

    // Loop through the responses to submit them one by one
    for ($question_id = 1; $question_id <= 9; $question_id++) {
        if (isset($responses[$question_id])) {
            $answer = $responses[$question_id];

            // Check if the answer is an array (for select type with 'other' option)
            if (is_array($answer)) {
                // Use the 'otherArea_' prefix to get the textarea value for 'other' option
                $other_area_key = 'otherArea_' . $question_id;
                if (isset($responses[$other_area_key])) {
                    $answer = $answer[0] . ' - ' . $responses[$other_area_key];
                } else {
                    $answer = $answer[0];
                }
            }

            // Submit the survey response
            submitSurveyResponse($user_id, $question_id, $answer);
        }
    }

    header("Location: survey.php");
    exit();
} else {
    header("Location: survey.php");
    exit();
}
