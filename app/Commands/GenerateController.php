<?php

namespace app\Commands;
use LDAP\Result;

class GenerateController
{
    private $modelName;
    private $tableName;
    private $fields;

    public function __construct($modelName, $tableName, $fields)
    {
        $this->modelName = ucfirst($modelName);
        $this->tableName = $tableName;
        $this->fields = explode(',', $fields);
    }

    public function generate()
    {
        // Replace placeholders in the controller template with actual values
        $template = file_get_contents(__DIR__ . '/ControllerTemplate.txt');
        $template = str_replace('{{ModelName}}', $this->modelName, $template);

        // Create the controller file
        $controllerFileName = ucfirst($this->modelName) . 'Controller.php';
        file_put_contents(__DIR__ . '/../../controllers/' . $controllerFileName, $template);

        return $controllerFileName;
    }
}
