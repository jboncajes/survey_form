<!DOCTYPE html>
<html>
<head>
    <title>Survey</title>
    <link rel="stylesheet" type="text/css" href="../css/survey_styles.css">
</head>
<body>
    <?php
    session_start();
    include 'sidebar.php';
    include 'navbar.php';
    require_once 'controller.php';

    $surveyInfo = getSurveyInfo();
    $surveyTitle = $surveyInfo['title'];
    $surveyDescription = $surveyInfo['description'];

    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 2) {
        header("Location: ../index.php");
        exit();
    }

    if (isset($_POST['submit_survey'])) {
        $user_id = $_SESSION['user_id'];
        $responses = $_POST['responses'];

        foreach ($responses as $question_id => $answer) {
            if (is_array($answer)) {
                if (!empty($answer[1])) {
                    submitSurveyResponse($user_id, $question_id, $answer[1]);
                }
            } else {
                submitSurveyResponse($user_id, $question_id, $answer);
            }
        }

        header("Location: survey.php");
        exit();
    }

    $questions = getSurveyQuestions();
    ?>
    <div class="survey-container">
        <div class="survey-info-card">
            <h3><?= $surveyTitle ?></h3>
            <p><?= $surveyDescription ?></p>
            <img src="../assets/images/survey.jpg" alt="Image Description">
        </div>
        <div class="survey-form">
            <form class="form-container" method="post" action="submit_response.php">
                <?php
                $question_counter = 1;
                foreach ($questions as $question_id => $question) { ?>
                    <div class="card">
                        <label class="question-label"><?php echo $question['question']; ?></label>
                        <?php switch ($question['type']) {
                            case 'text':
                                echo "<input type='hidden' name='question_ids[$question_counter]' value='$question_id'>";
                                echo "<input class='text-input' type='text' name='responses[$question_counter]' required>";
                                break;
                            case 'radio':
                                echo "<input type='hidden' name='question_ids[$question_counter]' value='$question_id'>";
                                $options = explode(',', $question['frm_option']);
                                foreach ($options as $option) {
                                    echo "<input type='radio' name='responses[$question_counter]' value='$option' required> $option<br>";
                                }
                                break;
                            case 'number':
                                echo "<input type='hidden' name='question_ids[$question_counter]' value='$question_id'>";
                                if (strtolower($question['question']) === 'body temperature') {
                                    echo "<input class='number-input' type='number' name='responses[$question_counter]' min='35.0' max='42.0' step='0.1' value='37.0' required>";
                                } else {
                                    echo "<input class='number-input' type='number' name='responses[$question_counter]' required>";
                                }
                                break;
                            case 'select':
                                echo "<input type='hidden' name='question_ids[$question_counter]' value='$question_id'>";
                                $options = explode(',', $question['frm_option']);
                                $selectId = "select_" . $question['id'];

                                echo "<select class='select-input' id='$selectId' name='responses[$question_counter]' onchange=\"showTextArea(this, 'otherArea_" . $question['id'] . "');\" required>";
                                foreach ($options as $option) {
                                    $selected = ($option === 'Filipino') ? 'selected' : '';
                                    echo "<option value='$option' $selected>$option</option>";
                                }
                                echo "</select>";

                                echo "<div id='otherArea_" . $question['id'] . "' class='other-option' style='display:none;'>";
                                echo "<textarea name='responses[otherArea_" . $question['id'] . "]'></textarea>";
                                echo "</div>";
                                break;
                        } ?>
                    </div>
                <?php
                $question_counter++;
                } ?>
                <input class="submit-button" type="submit" name="submit_survey" value="Submit">
            </form>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>
