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

// find corresponding note
$note = $db->query(
    'select * from notes where id = :id',
    [
        'id' => $_POST['id']
    ]
)->findOrFail();

// authorize current user
authorize($note['user_id'] === $_SESSION['user']['id']);

// validate form
$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'Description required or maximum of 1000 characters exceeded';
}

if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

// if no validation errors, make update query
$db->query('update notes set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body'],
]);

// redirect user
header('location: /notes');
die();