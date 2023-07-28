<?php

namespace app\Commands;
use LDAP\Result;

class GenerateController
{
    private $modelName;
    private $ModelName;
    private $modelNames;
    private $tableName;
    private $fields;

    public function __construct($modelName, $tableName, $fields)
    {
        $this->modelName = lcfirst($modelName);
        $this->ModelName = ucfirst($modelName);
        $this->tableName = $tableName;
        $this->fields = explode(',', $fields);
    }

    public function generate()
    {
        // Check if the controller already exists
        /*$controllerFileName = ucfirst($this->modelName) . 'Controller.php';
        if (file_exists(__DIR__ . '/../../controllers/' . $controllerFileName)) {
            return "Controller '$this->modelName' already exists.";
        }*/


        //centroller
        // Replace placeholders in the controller template with actual values
        $template = file_get_contents(__DIR__ . '/ControllerTemplate.txt');
        $template = str_replace('{{ModelName}}', $this->ModelName, $template);   
        $template = str_replace('{{modelName}}', $this->modelName, $template);
        $template = str_replace('{{tableName}}', $this->tableName, $template);      

        // Create the controller file
        $controllerFileName = ucfirst($this->ModelName) . 'Controller.php';
        file_put_contents(__DIR__ . '/../../controllers/' . $controllerFileName, $template);        

        //--service
        // Replace placeholders in the service template with actual values
        $template = file_get_contents(__DIR__ . '/ServiceTemplate.txt');
        $template = str_replace('{{ModelName}}', $this->ModelName, $template);   
        $template = str_replace('{{modelName}}', $this->modelName, $template);
        $template = str_replace('{{tableName}}', $this->tableName, $template); 

        // Create the service file
        $serviceFileName = ucfirst($this->modelName) . 'Service.php';
        file_put_contents(__DIR__ . '/../../services/' . $serviceFileName, $template);
        return $serviceFileName;
    }
}
