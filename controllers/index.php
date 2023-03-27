<?php

view('index.view.php', [
    'heading' => 'Home',
    'user' => $_SESSION['user']['email'] ?? 'Guest'
]);
