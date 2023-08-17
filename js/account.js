document.getElementById("lastname").addEventListener("input", checkChanges);
document.getElementById("firstname").addEventListener("input", checkChanges);
document.getElementById("middlename").addEventListener("input", checkChanges);
document.getElementById("contact").addEventListener("input", checkChanges);
document.getElementById("email").addEventListener("input", checkChanges);
document.getElementById("address").addEventListener("input", checkChanges);
document
  .getElementById("create_password")
  .addEventListener("input", checkChanges);

var passwordMatch = false;
var emailFormat = false;

function checkChanges() {
  var lastNameInput = document.getElementById("lastname").value;
  var firstNameInput = document.getElementById("firstname").value;
  var middleNameInput = document.getElementById("middlename").value;
  var contactInput = document.getElementById("contact").value;
  var emailInput = document.getElementById("email").value;
  var addressInput = document.getElementById("address").value;
  var saveChangesButton = document.getElementById("save_changes_btn");

  var has_changes =
    firstNameInput !== firstNameInput &&
    lastNameInput !== lastNameInput &&
    middleNameInput !== middleNameInput &&
    contactInput !== contactInput &&
    addressInput !== addressInput &&
    emailInput !== emailInput;

  if (!has_changes) {
    saveChangesButton.disabled = false;
  } else {
    saveChangesButton.disabled = true;
  }
}

function toggleCreatePasswordVisibility() {
  var passwordInput = document.getElementById("create_password");
  var toggleCreatePasswordIcon = document.querySelector(
    ".toggle-create_password"
  );

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    toggleCreatePasswordIcon.classList.remove("far", "fa-eye");
    toggleCreatePasswordIcon.classList.add("far", "fa-eye-slash");
  } else {
    passwordInput.type = "password";
    toggleCreatePasswordIcon.classList.remove("far", "fa-eye-slash");
    toggleCreatePasswordIcon.classList.add("far", "fa-eye");
  }
}

function toggleConfirmPasswordVisibility() {
  var passwordInput = document.getElementById("confirm_password");
  var toggleConfirmPasswordIcon = document.querySelector(
    ".toggle-confirm_password"
  );

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    toggleConfirmPasswordIcon.classList.remove("far", "fa-eye");
    toggleConfirmPasswordIcon.classList.add("far", "fa-eye-slash");
  } else {
    passwordInput.type = "password";
    toggleConfirmPasswordIcon.classList.remove("far", "fa-eye-slash");
    toggleConfirmPasswordIcon.classList.add("far", "fa-eye");
  }
}

function checkPasswordMatch() {
  var passwordPattern =
    /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  var createPasswordInput = document.getElementById("create_password");
  var confirmPassInput = document.getElementById("confirm_password");
  var passwordValidateMsg = document.getElementById("password-validate-msg");
  var passwordMatchMsg = document.getElementById("password-match-msg");

  if (!passwordPattern.test(createPasswordInput.value)) {
    passwordValidateMsg.textContent =
      "Password must be at least 8 characters with 1 uppercase, 1 special character, and 1 number.";
    passwordValidateMsg.style.color = "red";
    passwordValidateMsg.style.fontSize = "12px";
  } else if (
    passwordPattern.test(createPasswordInput.value) ||
    createPasswordInput.value === ""
  ) {
    passwordValidateMsg.textContent = "";
  }

  if (createPasswordInput.value === confirmPassInput.value) {
    passwordMatchMsg.textContent = "Password Matched";
    passwordMatchMsg.style.color = "green";
    passwordMatchMsg.style.fontSize = "12px";
    passwordMatch = true;
  } else {
    passwordMatchMsg.textContent = "";
    passwordMatch = false;
  }

  return passwordMatch;
}

function checkEmailFormat() {
  var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  var emailInput = document.getElementById("email");
  var emailValidateMsg = document.getElementById("email-validate-msg");

  if (!emailPattern.test(emailInput.value)) {
    emailValidateMsg.textContent =
      "Please put a valid email format (e.g. sample@email.com).";
    emailValidateMsg.style.color = "red";
    emailValidateMsg.style.fontSize = "12px";
    emailFormat = false;
  } else {
    emailFormat = true;
  }

  return emailFormat;
}
