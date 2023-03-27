<?php

use Core\App;
use Core\Database;

/**
 * Database class
 * @var object $db
 */
$db = App::resolve(Database::class);

$note = $db->query(
    'select * from notes where id = :id',
    [
        'id' => $_GET['id']
    ]
)->findOrFail();

authorize($note['user_id'] === $_SESSION['user']['id']);

view('notes/show.view.php', [
    'heading' => 'Note',
    'note' => $note
]);
