<?php
require 'config.php';
if (is_logged_in()) header('Location: dashboard.php');

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // LOGIN FROM YOUR users TABLE
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_name'] = $user['name'];

        header('Location: dashboard.php');
        exit;

    } else {
        $msg = "Invalid email or password";
    }
}
?>
