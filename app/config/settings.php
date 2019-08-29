<?php 
return [
    'db' => [
        'hostname' => getenv('DB_HOSTNAME'),
        'database' => getenv('DB_DATABASE'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
    ],
];