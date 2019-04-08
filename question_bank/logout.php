<?php
  session_start();
   if(session_destroy()) {
    	//echo "logout";
      header("Location: index.php?msg=Successfully Logged out");
   }
?>
