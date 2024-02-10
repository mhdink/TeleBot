<?php
// اطلاعات اتصال به دیتابیس
$host = 'آدرس_هاست_دیتابیس';
$username = 'نام_کاربری_دیتابیس';
$password = 'رمز_عبور_دیتابیس';
$database = 'نام_دیتابیس';

// اطلاعات دریافتی از فرم
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$subscription = $_POST['subscription'];
$agree = $_POST['agree'];

// اتصال به دیتابیس
$conn = new mysqli($host, $username, $password, $database);

// بررسی اتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ذخیره اطلاعات در دیتابیس
$stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, subscription, agree) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $email, $password, $phone, $subscription, $agree);
$stmt->execute();
$stmt->close();

// بستن اتصال به دیتابیس
$conn->close();

// ارسال ایمیل
$to = "MAHDINK.79@GMAIL.COM";
$subject = "New Purchase Form Submission";
$message = "Name: $name\nEmail: $email\nPhone: $phone\nSubscription: $subscription\nAgree: $agree";
$headers = "From: webmaster@example.com";

mail($to, $subject, $message, $headers);

// بازگشت به صفحه اصلی
header("Location: index.html");
exit();
?>
