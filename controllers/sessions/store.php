<?php

use Core\App;
use Core\Database;
use Core\Validator;

/**
 * Database class
 * @var object $db
 */
$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a valid password ';
}

if (!empty($errors)) {
    return view('sessions/create.view.php', [
        'errors' => $errors
    ]);
}

// match credentials
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

// user found, we don't know if password match
if ($user) {
    if (password_verify($password, $user['password'])) {
        // Correct password, login and create user to session
        login([
            'id' => $user['id'],
            'email' => $email
        ]);
    
        header('location: /');
        exit();
    }
}

// email or password doesn't match account in database
return view('sessions/create.view.php', [
    'errors' => [
        'email' => 'No matching account found for that email address and password'
    ]
]);
