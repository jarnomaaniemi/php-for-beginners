<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {

    // Form fields ok, continue to authenticate given credentials
    $auth = new Authenticator();

    if ($auth->attempt($email, $password)) {
        // Credentials pass, redirect to home page
        redirect('/');
    }

    $form->error('email', 'No matching account found for that email address and password');
}

// Form is invalid or authentication fails
return view('sessions/create.view.php', [
    'errors' => $form->errors()
]);
