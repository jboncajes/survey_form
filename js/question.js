function toggleOptionsInput(questionId) {
  const questionType = document.getElementById(
    "question_type_" + questionId
  ).value;
  const optionsDiv = document.getElementById("question_options_" + questionId);
  const optionsInput = document.getElementById(
    "question_options_text_" + questionId
  );

  if (questionType === "select" || questionType === "radio") {
    optionsDiv.style.display = "block";
    optionsInput.setAttribute("required", "required");
  } else {
    optionsDiv.style.display = "none";
    optionsInput.removeAttribute("required");
  }
}
