$(document).ready(function () {
  $("#survey-table").DataTable({
    columnDefs: [
      { width: "10px", targets: 0 },
      { width: "15px", targets: 2 },
      { width: "10px", targets: 3 },
      { width: "15px", targets: 5 },
      { width: "20px", targets: 6 },
      { width: "20px", targets: "_all" },
    ],
  });
});
