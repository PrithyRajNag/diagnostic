/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
// Dropdown Sidebar Menu
var sidebarItems = document.querySelectorAll(".sidebar-item.has-sub");

    var _loop = function _loop() {
        var sidebarItem = sidebarItems[i];
        // console.log(sidebarItem)
        sidebarItems[i].querySelector(".sidebar-link").addEventListener("click", function (e) {
            e.preventDefault();
            // var submenu = sidebarItem.querySelector(".submenu");

            //   if (submenu.classList.contains("active")) submenu.classList.remove("active");
            //   submenu.classList.add("active");
        });
    };

for (var i = 0; i < sidebarItems.length; i++) {
  _loop();
} // Navbar Toggler


var sidebarToggler = document.querySelectorAll(".sidebar-toggler");

for (var i = 0; i < sidebarToggler.length; i++) {
  var toggler = sidebarToggler[i];
  toggler.addEventListener("click", function () {
    var sidebar = document.getElementById("sidebar");
    if (sidebar.classList.contains("active")) sidebar.classList.remove("active");else sidebar.classList.add("active");
  });
} // Perfect Scrollbar INit


if (typeof PerfectScrollbar == "function") {
  var container = document.querySelector(".sidebar-wrapper");
  var ps = new PerfectScrollbar(container);
}

window.onload = function () {
  var w = window.innerWidth;

  if (w < 768) {
    console.log("widthnya ", w);
    document.getElementById("sidebar").classList.remove("active");
  }
};

feather.replace();
/******/ })()
;
