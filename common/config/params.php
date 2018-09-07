<?php
$pointTest = json_decode(file_get_contents(__DIR__. '/testPoint.json'), true);

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'PointTest' => $pointTest,
];
