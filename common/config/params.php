<?php

use yii\base\Exception;
use yii\helpers\FileHelper;

/**
 * @param string $fileName
 * @return string
 * @throws Exception
 */
function jsonFile($fileName){
    $dir = __DIR__. '/json_params/';
    $file = $dir.$fileName.'.json';
    if (!is_dir($dir)){
        FileHelper::createDirectory($dir);
    }

    if (!is_file($file)){
        file_put_contents($file, '{}');
    }

    return json_decode(file_get_contents($file), true);
}

try {
    $pointTest = jsonFile('testPoint');
} catch (Exception $e) {
}

try {
    $rulesTraining = jsonFile('rulesTraining');
} catch (Exception $e) {
}

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'PointTest' => $pointTest,
    'RulesTraining' => $rulesTraining,
];
