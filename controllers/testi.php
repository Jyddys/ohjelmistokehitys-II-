<script>
    
const searchInput = document.querySelector('#search');
const resultsList = document.querySelector('#results');

searchInput.addEventListener('input', function() {
  const searchValue = this.value;

  fetch(`search.php?search=${searchValue}`)
    .then(response => response.text())
    .then(data => {
      resultsList.innerHTML = data;
    });
});

</script>

<?php
require("../views/project_list.php");
?>