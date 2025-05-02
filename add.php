<?php

// اتصال به دیتابیس
include 'config/db_connect.php';

// تعریف متغیرهای اولیه
$email = $title = $OrderDetails = '';
$errors = array('email' => '', 'title' => '', 'OrderDetails' => '');

// بررسی ارسال فرم
if (isset($_POST['submit'])) {

  // اعتبارسنجی ایمیل
  if (empty($_POST['email'])) {
    $errors['email'] = 'ایمیل الزامی است <br>';
  } else {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo ('ایمیل معتبر نیست<br>');
    }
  }

  // اعتبارسنجی عنوان سفارش
  if (empty($_POST['title'])) {
    $errors['title'] = 'عنوان سفارش الزامی است <br>';
  } else {
    $title = $_POST['title'];
    if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
      $errors['title'] = 'عنوان فقط باید شامل حروف و فاصله باشد <br>';
    }
  }

  // اعتبارسنجی جزئیات سفارش
  if (empty($_POST['OrderDetails'])) {
    $errors['OrderDetails'] = 'جزئیات سفارش الزامی است <br>';
  } else {
    $OrderDetails = $_POST['OrderDetails'];
    if (!preg_match('/^[a-zA-Z\s]+(,\s?[a-zA-Z\s]*)*$/', $OrderDetails)) {
      $errors['OrderDetails'] = 'جزئیات سفارش باید با ویرگول جدا شده باشند <br>';
    }
  }

  // بررسی خطاها و اجرای کوئری
  if (!array_filter($errors)) {
    // جلوگیری از SQL Injection
    $email =  mysqli_real_escape_string($conn, $_POST['email']);
    $title =  mysqli_real_escape_string($conn, $_POST['title']);
    $OrderDetails =  mysqli_real_escape_string($conn, $_POST['OrderDetails']);

    // کوئری درج اطلاعات
    $sql = "INSERT INTO orders(Title,Email,OrderDetails) VALUES('$title', '$email', '$OrderDetails')";

    // هدایت به صفحه اصلی در صورت موفقیت
    if (mysqli_query($conn, $sql)) {
      header('Location: index.php');
    } else {
      echo 'Query Error ' . mysqli_error($conn);
    }
  }
}

?>


<!DOCTYPE html>
<html>

<?php include('Templates/Header.php'); ?>

<section class="container grey-text">
  <h4 class="center">افزودن سفارش</h4>
  <form class="white" action="add.php" method="POST">
    <label>ایمیل شما</label>
    <input type="text" name="email">

    <label>عنوان سفارش</label>
    <input type="text" name="title">

    <label>جزئیات سفارش (با ویرگول جدا شود)</label>
    <input type="text" name="OrderDetails">

    <div class="center">
      <input type="submit" name="submit" value="ارسال" class="btn brand z-depth-0">
    </div>
  </form>
</section>


<?php include('Templates/Footer.php'); ?>

</html>