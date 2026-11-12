<?php

return [
    'db_host' => getenv('DB_HOST') ?: '',
    'db_port' => getenv('DB_PORT') ?: '5432',
    'db_name' => getenv('DB_NAME') ?: 'postgres',
    'db_user' => getenv('DB_USER') ?: '',
    'db_pass' => getenv('DB_PASS') ?: '',
];