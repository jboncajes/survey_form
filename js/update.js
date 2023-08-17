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
