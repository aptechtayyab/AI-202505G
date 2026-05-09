<?php 
session_start();
if($_SESSION["roleid"] !=3){
  
    echo "<script>window.location.href = 'login.php'</script>";
    exit();

}

?>