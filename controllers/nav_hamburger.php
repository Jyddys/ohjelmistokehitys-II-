<?php
require ("../views/nav.php");
require("../views/project_list.php");

?>
<script>
const hamburger = document.querySelector("#hamburger");
const menu = document.querySelector("#menu");

hamburger.addEventListener("click", () => {
  menu.classList.toggle("active");
});
</script>
