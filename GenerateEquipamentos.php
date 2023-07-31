<?php
require_once __DIR__ . '/app/Commands/GenerateController.php';
$modelName = "equipment";
$tableName = "equipments";
$fields = "id,name,description,image,email";
/*$fieldTypes = [
    'id' => 'number',
    'name' => 'text',
    'description' => 'textarea',
    'image' => 'file',
    'email' => 'email',
];*/

$generator = new app\Commands\GenerateController($modelName, $tableName, $fields);
$result = $generator->generate();
echo $result;