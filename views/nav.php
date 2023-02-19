<div class="hamburger-menu" id="hamburger">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
<nav id="menu" class="menu">
    <ul class="nav-links" >
        <li><a class="navbar-btn" href="/~e2101548/php/proman/views">theTrackerApp</a></li>
        <li><a class="navbar-btn" href="/~e2101548/php/proman/controllers/project_list.php">Project list</a></li>
        <li><a class="navbar-btn" href="/~e2101548/php/proman/controllers/task_list.php">Tasks list</a></li>
        <li><a class="navbar-btn" href="/~e2101548/php/proman/controllers/project.php">Add project</a></li>
        <li><a class="navbar-btn" href="/~e2101548/php/proman/controllers/task.php">Add task</a></li>
        <form action="logout.php" method="post">
            <input type="submit" name="logout" value="Log Out">
        </form>
    </ul>
</nav>

<script>
const hamburger = document.querySelector("#hamburger");
const menu = document.querySelector("#menu");

hamburger.addEventListener("click", () => {
  menu.classList.toggle("active");
});
</script>