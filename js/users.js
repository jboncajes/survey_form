$(document).ready(function () {
  $("#usersTable").DataTable({
    searching: true,
    paging: true,
    lengthChange: true,
    info: true,
  });
});

$(document).on("click", ".delete_button", function () {
  var userId = $(this).data("id");
  console.log("Delete button clicked for user ID: " + userId);

  $.ajax({
    method: "POST",
    url: "../php/controller.php",
    data: { action: "deleteUser", id: userId },
  })
    .done(function () {
      location.reload();
    })
    .fail(function (xhr, status, error) {
      console.error(error);
    });
});
