<?php
// Введите ваш пароль здесь
$password = 'N8641975320L';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
echo $hashed_password;
?>
