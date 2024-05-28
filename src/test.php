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
                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                        <button class="question-btn" onclick="goToQuestion(<?php echo $i; ?>)"><?php echo $i; ?></button>
                    <?php } ?>
                    <button class="question-btn" onclick="showResults()">WYNIK</button>
                </div>
            </div>
        </div>
        <script>
            const questions = <?php echo json_encode($questions); ?>;
            let currentQuestionIndex = 0;
            const answers = new Array(questions.length).fill(null); // Tablica do przechowywania odpowiedzi

            function displayQuestion(index) {
                if (index >= 0 && index < questions.length) {
                    document.getElementById("question-number").innerText = index + 1;
                    document.getElementById("question").innerText = questions[index].tekst_pytania;
                    updateActiveButton(index + 1); // Aktualizuj aktywny przycisk
                }
            }

            function updateActiveButton(questionNumber) {
                const buttons = document.querySelectorAll(".question-counter .question-btn");
                buttons.forEach(button => button.classList.remove("active"));
                if (questionNumber > 0 && questionNumber <= questions.length) {
                    buttons[questionNumber - 1].classList.add("active");
                }
            }

            function saveAnswerAndNext(answer) {
                answers[currentQuestionIndex] = answer;
                nextQuestion();
            }

            function nextQuestion() {
                if (currentQuestionIndex < questions.length - 1) {
                    currentQuestionIndex++;
                    displayQuestion(currentQuestionIndex);
                } else {
                    submitAnswers();
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

            function showResults() {
                submitAnswers();
            }

            function submitAnswers() {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "submit_answers.php", true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert("Odpowiedzi zostały zapisane.");
                    }
                };
                xhr.send(JSON.stringify({answers: answers}));
            }

            // Wyświetl pierwsze pytanie po załadowaniu strony
            displayQuestion(currentQuestionIndex);

        </script>
        <?php $conn->close(); ?>
    </body>
</html>