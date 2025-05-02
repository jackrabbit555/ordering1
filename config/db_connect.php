<?php


$conn = mysqli_connect('localhost', 'Amir', '123', 'ordering project');

if (!$conn) {
  # code...
  echo 'Connection' . mysqli_connect_error();
}

?>