<?php

include 'config/db_connect.php';  // اتصال به دیتابیس

$sql = 'SELECT title, OrderDetails, id FROM Orders';  // دریافت داده‌ها از جدول

$result = mysqli_query($conn, $sql);  // اجرای کوئری

$Orders = mysqli_fetch_all($result, MYSQLI_ASSOC);  // تبدیل نتیجه به آرایه

mysqli_free_result($result);  // آزاد کردن حافظه
mysqli_close($conn);  // بستن اتصال به دیتابیس

?>


<!DOCTYPE html>
<html lang="en">

<?php include 'Templates/header.php'; ?>

<h4 class="center grey-text">Orders!</h4>

<div class="container">
  <div class="row">
    <?php foreach ($Orders as $Order) { ?>
      <div class="col s6 md3">
        <div class="card z-depth-0">
          <img src="img/Order.svg" class="pizza" width="100" height="100">
          <div class="card-content center">
            <h6><?php echo htmlspecialchars($Order['title']); ?></h6>
            <ul>
              <?php foreach (explode(',', $Order['OrderDetails']) as $ing) { ?>
                <li><?php echo htmlspecialchars($ing); ?></li>
              <?php } ?>
            </ul>
          </div>
          <div class="card-action right-align">
            <a class="brand-text" href="Details.php?id=<?php echo $Order['id'] ?>">اطلاعات بیشتر</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>


<?php include 'Templates/footer.php'; ?>

</html>