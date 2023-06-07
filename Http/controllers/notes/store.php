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

$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'Description required or maximum of 1000 characters exceeded';
}

if (!empty($errors)) {
    return view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$db->query('insert into notes(body, user_id) values(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => $_SESSION['user']['id']
]);

header('location: /notes');
die();
