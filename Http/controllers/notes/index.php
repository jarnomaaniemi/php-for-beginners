<?php

use Core\App;
use Core\Database;

/**
 * Database class
 * @var object $db
 */
$db = App::resolve(Database::class);

// Show all logged in user notes
$notes = $db->query("select * from notes where user_id = :id", [
    'id' => $_SESSION['user']['id']
])->get();

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
]);
