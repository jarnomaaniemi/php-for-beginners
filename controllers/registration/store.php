<?php

use Core\App;
use Core\Database;
use Core\Validator;

require base_path('Core/Validator.php');

/**
 * Database class
 * @var object $db
 */
$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

// validate form
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password, 8, 255)) {
    $errors['password'] = 'Please provide a password at least 8 characters and maximum of 255 characters long';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    // if yes, redirect to a login page
    header('location: /');
    die();
} else {
    // if not, save one to a database, log user in and redirect
    $db->query('insert into users(email, password) values (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    // mark that the user has logged in (session)
    login([
        'email' => $email
    ]);

    header('location: /');
    die();
}
