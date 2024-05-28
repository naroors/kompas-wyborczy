<?php
    require_once 'conn.php';

    $sql = "SELECT * FROM pytania";
    $result = $conn->query($sql);

    $questions = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }
    } else {
        echo "0 results";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Test Europarlemntarny</title>

        <!-- css -->
        <link rel="stylesheet" href="../src/css/test.css">

        <!-- fa -->
        <script src="https://kit.fontawesome.com/c0b0b901e3.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="box-frame">
                <div class="question-info">
                    <h2>Pytanie: </h2> <span id="question-number"><?php echo $row["id"]; ?></span>
                    <div class="previous">
                        <button class="btn-previous-question" onclick="previousQuestion()">Poprzednie pytanie</button>
                    </div>
                </div>

                <div class="questions">
                    <p id="question"><?php echo $row["tekst_pytania"]; ?></p>
                </div>  
                <div class="answer-buttons">
                    <button class="answer-btn" id="zgadzam-sie" onclick="nextQuestion()">Zgadzam się</button> 
                    <button class="answer-btn" id="raczej-tak" onclick="nextQuestion()">Raczej się zgadzam</button>
                    <button class="answer-btn" id="nie-mam-zdania" onclick="nextQuestion()">Nie mam zdania</button>
                    <button class="answer-btn" id="raczej-nie" onclick="nextQuestion()">Raczej się nie zgadzam</button>
                    <button class="answer-btn" id="niezgadzam się" onclick="nextQuestion()">Nie zgadzam się</button>
                </div>
                <div class="question-counter">
                    <button class="question-btn">1</button>
                    <button class="question-btn">2</button>
                    <button class="question-btn">3</button>
                    <button class="question-btn">4</button>
                    <button class="question-btn">5</button>
                    <button class="question-btn">6</button>
                    <button class="question-btn">7</button>
                    <button class="question-btn">8</button>
                    <button class="question-btn">9</button>
                    <button class="question-btn">10</button>
                    <button class="question-btn">11</button>
                    <button class="question-btn">12</button>
                    <button class="question-btn">13</button>
                    <button class="question-btn">14</button>
                    <button class="question-btn">15</button>
                    <button class="question-btn">16</button>
                    <button class="question-btn">17</button>
                    <button class="question-btn">18</button>
                    <button class="question-btn">19</button>
                    <button class="question-btn">20</button>
                    <button class="question-btn">21</button>
                    <button class="question-btn">22</button>
                    <button class="question-btn">23</button>
                    <button class="question-btn">24</button>
                    <button class="question-btn">25</button>
                    <button class="question-btn">WYNIK</button>
                    
                </div>
            </div>
        </div>
        <script>
            const questions = <?php echo json_encode($questions); ?>;
            let currentQuestionIndex = 0;

            function displayQuestion(index) {
                if (index >= 0 && index < questions.length) {
                    document.getElementById("question-number").innerText = index + 1;
                    document.getElementById("question").innerText = questions[index].tekst_pytania;
                }
            }

            function nextQuestion() {
                if (currentQuestionIndex < questions.length - 1) {
                    currentQuestionIndex++;
                    displayQuestion(currentQuestionIndex);
                }
            }

            function previousQuestion() {
                if (currentQuestionIndex > 0) {
                    currentQuestionIndex--;
                    displayQuestion(currentQuestionIndex);
                }
            }

            function goToQuestion(index) {
                if (index > 0 && index <= questions.length) {
                    currentQuestionIndex = index - 1;
                    displayQuestion(currentQuestionIndex);
                }
            }

            // Wyświetl pierwsze pytanie po załadowaniu strony
            displayQuestion(currentQuestionIndex);
        </script>
        <?php $conn->close(); ?>
    </body>
</html>