<?php

$config = require('config.php');
$db = new Database($config['database']);

$heading = 'Note';

$note = $db->query(
    'select * from notes where id = :id',
    [
        'id' => $_GET['id']
    ]
)->findOrFail();

$currentUserId = 3;

authorize($note['user_id'] === $currentUserId);

require 'views/note.view.php';
