document
  .getElementById("email")
  .addEventListener("input", checkLoginFormInputs);
document
  .getElementById("password")
  .addEventListener("input", checkLoginFormInputs);

function togglePasswordVisibility() {
  var passwordInput = document.getElementById("password");
  var togglePasswordIcon = document.querySelector(".toggle-password");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    togglePasswordIcon.classList.remove("far", "fa-eye");
    togglePasswordIcon.classList.add("far", "fa-eye-slash");
  } else {
    passwordInput.type = "password";
    togglePasswordIcon.classList.remove("far", "fa-eye-slash");
    togglePasswordIcon.classList.add("far", "fa-eye");
  }
}

function checkLoginFormInputs() {
  var emailInput = document.getElementById("email").value;
  var passwordInput = document.getElementById("password").value;
  var loginButton = document.getElementById("loginButton");

  if (emailInput.trim() === "" || passwordInput.trim() === "") {
    loginButton.disabled = true;
  } else {
    loginButton.disabled = false;
  }
}
