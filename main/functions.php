<?php

function redirectToAnotherPage($where) {
  echo "<script type='text/javascript'>
        window.location = 'http://localhost:8080/CMS-Project/main/main/$where'</script>";
}

?>