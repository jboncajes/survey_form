document.addEventListener("DOMContentLoaded", function () {
  function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("show-sidebar");
  }

  const hamburger = document.querySelector(".hamburger");
  hamburger.addEventListener("click", toggleSidebar);

  const sidebarButtons = document.querySelectorAll(".sidebar-btn");

  sidebarButtons.forEach((button) => {
    button.addEventListener("click", function () {
      sidebarButtons.forEach((btn) => btn.classList.remove("active"));
      this.classList.add("active");
    });
  });
});
