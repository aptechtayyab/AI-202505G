<?php 


session_start();
if($_SESSION["roleid"] != 1){
    echo "<script>window.location.href = '../login.php'</script>";
    exit();
}
?>