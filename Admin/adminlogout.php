<?php
session_start();
session_destroy();
echo '<script>
        // alert("Admin Logout Successful!");
        location = "../index.html";
      </script>';
?>