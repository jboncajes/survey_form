<!DOCTYPE html>
<html>
<head>
    <title>Survey Response</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../css/dashboard_styles.css">
</head>
<body>
    <?php
    require_once 'controller.php';

    function displaySurveyResponses()
    {
        $questions = getSurveyQuestions();
        $users = getUsers();

        echo "<table id='survey-table' class='survey-table'>";
        echo "<thead><tr><th>No.</th>";

        foreach ($questions as $question) {
            $shortQuestion = ($question['question'] === 'Diagnosed with COVID-19') ? 'Diagnosed?' : $question['question'];
            echo "<th>" . htmlspecialchars($shortQuestion) . "</th>";
        }

        echo "</tr></thead><tbody>";

        $rowNumber = 1;
        foreach ($users as $user) {
            $user_id = $user['id'];
            $rowData = [];
            foreach ($questions as $question) {
                $question_id = $question['id'];
                $answer = getSurveyResponseByQuestionAndUser($question_id, $user_id);
                $rowData[] = $answer;
            }

            if (array_filter($rowData)) {
                echo "<tr>";
                echo "<td>" . $rowNumber . "</td>";
                foreach ($rowData as $answer) {
                    echo "<td>" . htmlspecialchars($answer) . "</td>";
                }
                echo "</tr>";
                $rowNumber++;
            }
        }

        echo "</tbody></table>";
    }
    ?>
    <div style="margin-top: 20px;">
        <?php displaySurveyResponses(); ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="../js/response.js"></script>
</body>
</html>