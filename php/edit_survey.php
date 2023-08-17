<!DOCTYPE html>
<html>
<head>
    <title>Edit Survey</title>
    <link rel="stylesheet" type="text/css" href="../css/question_styles.css">
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

    if (isset($_GET['survey_id'])) {
        $survey_id = $_GET['survey_id'];
        $survey = getSurveyById($survey_id);
        $questions = getQuestionsBySurveyId($survey_id);
    } else {
        header("Location: dashboard.php");
        exit();
    }

    if (isset($_POST['save_changes'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
    
        updateSurvey($survey_id, $title, $description, $start_date, $end_date);
    
        foreach ($questions as $question) {
            $question_id = $question['id'];
            $question_name = $_POST['question_name_' . $question_id];
            $question_type = $_POST['question_type_' . $question_id];
            $question_options = '';
    
            if ($question_type === 'select' || $question_type === 'radio') {
                $question_options = $_POST['question_options_' . $question_id];
            }
            updateQuestion($survey_id, $question_id, $question_name, $question_type, $question_options);
        }
        
    }
    ?>
    <div class="container">
    <h1>Survey Details</h1>
    <form method="post" action="">
        <input type="hidden" name="survey_id" value="<?= $survey['id'] ?>">
        <div class="form-row">    
            <div class="form-group col-md-8">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?= $survey['title'] ?>" required>
            </div>
            <div class="form-group col-md-2">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="<?= $survey['start_date'] ?>" required>
            </div>
            <div class="form-group col-md-2">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" value="<?= $survey['end_date'] ?>" required>
            </div>
        </div>
        <div class="form-row">  
            <div class="form-group col-md-12">
                <label for="description">Description</label>
                <textarea id="description" name="description" required><?= $survey['description'] ?></textarea>
            </div>
        </div>
        <h2>Survey Questions</h2>
        <?php foreach ($questions as $question) : ?>
            <div class="question">
                <div class="form-row question-info">
                    <div class="form-group col-md-9">
                        <label for="question_name_<?= $question['id'] ?>">Question</label>
                        <input type="text" id="question_name_<?= $question['id'] ?>" name="question_name_<?= $question['id'] ?>" value="<?= $question['question'] ?>" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="question_type_<?= $question['id'] ?>">Type</label>
                        <select id="question_type_<?= $question['id'] ?>" name="question_type_<?= $question['id'] ?>" required>
                            <option value="text" <?= ($question['type'] === 'text') ? 'selected' : '' ?>>Text</option>
                            <option value="number" <?= ($question['type'] === 'number') ? 'selected' : '' ?>>Number</option>
                            <option value="select" <?= ($question['type'] === 'select') ? 'selected' : '' ?>>Select</option>
                            <option value="radio" <?= ($question['type'] === 'radio') ? 'selected' : '' ?>>Radio</option>
                        </select>
                    </div>
                </div>
                <div class="form-row question-info">
                    <div class="form-group col-md-12">
                        <?php if ($question['type'] === 'select' || $question['type'] === 'radio') : ?>
                            <?php
                            $options = explode(',', $question['frm_option']);
                            ?>
                            <label for="question_options_<?= $question['id'] ?>">Options (Separated by comma)</label>
                            <input type="text" id="question_options_<?= $question['id'] ?>" name="question_options_<?= $question['id'] ?>" value="<?= implode(', ', $options) ?>" required>
                        <?php else : ?>
                            <div id="question_options_<?= $question['id'] ?>" style="display: none;">
                                <label for="question_options_text_<?= $question['id'] ?>">Options (Separated by comma)</label>
                                <input type="text" id="question_options_text_<?= $question['id'] ?>" name="question_options_<?= $question['id'] ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
            </div>
        <?php endforeach; ?>
        <button class="edit_form_button" type="submit" name="save_changes">Save Changes</button>
    </form>
    </div>
    <script>
    <?php foreach ($questions as $question) : ?>
            const questionTypeSelect<?= $question['id'] ?> = document.getElementById('question_type_<?= $question['id'] ?>');
            questionTypeSelect<?= $question['id'] ?>.addEventListener('change', function () {
                toggleOptionsInput(<?= $question['id'] ?>);
            });
            toggleOptionsInput(<?= $question['id'] ?>);
    <?php endforeach; ?>
    </script>
    <script src="../js/script.js"></script>
    <script src="../js/question.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
