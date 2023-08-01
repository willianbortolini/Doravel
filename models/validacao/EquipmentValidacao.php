<?php
namespace app\models\validacao;
use app\core\Validacao;

class EquipmentValidacao {
    public static function salvar($equipment) {
        $validacao = new Validacao();    
        $validacao->setData("equipments_name", $equipment->equipments_name, "Nome do Equipamento");
        $validacao->setData("description", $equipment->description, "Description");
        $validacao->setData("price_per_day", $equipment->price_per_day, "Preço por dia");
        $validacao->setData("availabilities", $equipment->availabilities, "Disponibilidade");
    
        // Fazendo a validação
        //$validacao->getData("Equipments_name")->isVazio();          
        
        return $validacao;
    }
}
