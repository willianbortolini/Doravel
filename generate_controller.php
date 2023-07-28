<?php
require_once __DIR__ . '/app/Commands/GenerateController.php';

if ($argc < 3) {
    echo "Uso: php generate_controller.php <NomeDoModel> <NomeDaTabela> <Campos>\n";
    exit(1);
}

require_once __DIR__ . '/vendor/autoload.php';

$modelName = $argv[1];
$tableName = $argv[2];
$fields = $argv[3];

$generator = new app\Commands\GenerateController($modelName, $tableName, $fields);
$controllerFileName = $generator->generate();

echo "Controller gerado: " . $controllerFileName . "\n";
