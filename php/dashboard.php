<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/dashboard_styles.css">
    <link rel="stylesheet" type="text/css" href="../css/navigation_styles.css">
</head>
<body>
    <?php
        session_start();
        include 'navbar.php';
        require_once 'controller.php';

        $surveyInfo = getSurveyInfo();
        $surveyTitle = $surveyInfo['title'];
        $surveyDescription = $surveyInfo['description'];
        $startDate = $surveyInfo['start_date'];
        $endDate = $surveyInfo['end_date'];
    ?>
    <div class="dashboard-content">
        <div class="survey-info-card">
            <h3><?= $surveyTitle ?></h3>
            <p><?= $surveyDescription ?></p><br>
            <p>Start Date: <?= $startDate ?></p>
            <p>End Date: <?= $endDate ?></p>
        </div>

        <div class="chart-container">
            <?php
            $questions = getSurveyQuestionsTruncated();
            $displayedCharts = [2, 3, 5, 6, 7, 8, 9];

            foreach ($questions as $question) {
                $question_id = $question['id'];
                $question_text = $question['question'];
                $chart_id = 'chart_' . $question_id;

                if (in_array($question_id, $displayedCharts)) {
                    $data = getSurveyResponsesByQuestionId($question_id);

                    echo "<div class='chart-item'>";
                    echo "<h2>$question_text</h2>";
                    echo "<canvas id='$chart_id'></canvas>";
                    echo "<script type='text/json' id='data_$question_id'>" . json_encode($data) . "</script>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
    <?php include 'survey_response.php'; ?>
    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</body>
</html>
