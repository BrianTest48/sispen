<?php 
  session_start();
  if(!isset($_SESSION["nombres"])) {
     header("location: ../../index.php");
  }
  $nombres = $_SESSION["nombres"];
  $id = $_SESSION["id"];
?>