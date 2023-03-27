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
        'id' => $_POST['id']
    ]
)->findOrFail();

authorize($note['user_id'] === $_SESSION['user']['id']);

// Delete request on a note
$db->query('delete from notes where id = :id', [
    'id' => $_POST['id']
]);

header('location: /notes');
exit();
