<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 3;

$note = $db->query(
    'select * from notes where id = :id',
    [
        'id' => $_POST['id']
    ]
)->findOrFail();

authorize($note['user_id'] === $currentUserId);

// Delete request on a note
$db->query('delete from notes where id = :id', [
    'id' => $_POST['id']
]);

header('location: /notes');
exit();
