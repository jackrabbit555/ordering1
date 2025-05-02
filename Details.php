<?php

include 'config/db_connect.php';

if (isset($_POST['delete'])) {
  # code...
  $ID_TO_DELETE = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

  $sql = "DELETE FROM Orders WHERE ID = $ID_TO_DELETE";
  if (mysqli_query($conn, $sql)) {
    # code...

    header('Location : index.php');
  } else {
    echo 'Quarry Error' . mysqli_error($conn);
  }
}




if (isset($_GET['id'])) {
  # code...
  $id = mysqli_real_escape_string($conn, $_GET['id']);

  $sql = "SELECT * FROM Orders where id = $id";

  $result = mysqli_query($conn, $sql);

  $order = mysqli_fetch_assoc($result);

  mysqli_free_result($result);
  mysqli_close($conn);
  print_r($order);
}

?>


<!DOCTYPE html>
<html lang="en">

<body>
  <?php include 'Templates/Header.php' ?>
  <div class="container center">
    <?php if ($order) { ?>
      <h4><?php echo $order['Title']; ?></h4>
      <p>Created by <?php echo $order['Email']; ?></p>
      <p><?php echo date($order['Created_At']); ?></p>
      <h5>Order Details:</h5>
      <p><?php echo $order['OrderDetails']; ?></p>

      <form action="Details.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $order['ID'] ?>">
        <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
      </form>
    <?php } else { ?>
      <h5>No such order exists.</h5>
    <?php } ?>
  </div>

  <?php include 'Templates/Footer.php' ?>
</body>


</html>