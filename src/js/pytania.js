var currentQuestion = 1;

function fetchQuestion(questionNumber) {
    fetch(`get_question.php?question_number=${questionNumber}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('question-number').textContent = data.id;
            document.getElementById('question').textContent = data.tekst_pytania;
        });
}

function nextQuestion() {
    currentQuestion++;
    fetchQuestion(currentQuestion);
}

function previousQuestion() {
    if (currentQuestion > 1) {
        currentQuestion--;
        fetchQuestion(currentQuestion);
    }
}

// Fetch the first question when the page loads
fetchQuestion(currentQuestion);