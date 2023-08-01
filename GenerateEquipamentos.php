<?php
require_once __DIR__ . '/app/Commands/GenerateController.php';
$name = "Equipamento";
$modelName = "equipment";
$tableName = "equipments";
$fields = [
    ['name' => 'img1', 'type' => 'img', 'label' => 'imagem 1'],
    ['name' => 'img2', 'type' => 'img', 'label' => 'imagem 2'],
    ['name' => 'equipments_name', 'type' => 'text', 'label' => 'Nome do Equipamento'],
    ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
    ['name' => 'price_per_day', 'type' => 'number', 'label' => 'Preço por dia'],   
    ['name' => 'availabilities', 'type' => 'select', 'label' => 'Disponibilidade'],  
    // Outros campos...
];

$generator = new app\Commands\GenerateController();
$result = $generator->generate($name ,$modelName, $tableName, $fields);
echo $result;