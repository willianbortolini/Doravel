<?php

namespace app\models\service;

use app\models\validacao\EquipmentValidacao;
use app\models\dao\EquipmentDao;
use app\util\UtilService;

class EquipmentService
{
    public static function salvar($equipment, $campo, $tabela)
    {
        $validacao = EquipmentValidacao::salvar($equipment);
        /*global $config_upload;
        if ($validacao->qtdeErro() <= 0) {          
                if (isset($_POST["remove_img"]) && $_POST["remove_img"] === "1") {
                    $existe_imagem = service::get($tabela, $campo, $equipment->id)->image;
                    if (isset($existe_imagem) && $existe_imagem != '') {
                        UtilService::deletarImagens($existe_imagem);
                    }
                    $equipment->image = '';                    
                } else {
                    if (isset($_FILES["image"]["name"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
                        $existe_imagem = service::get($tabela, $campo, $equipment->id)->image;
                        if (isset($existe_imagem) && $existe_imagem != '') {
                            UtilService::deletarImagens($existe_imagem);
                        }
                        $equipment->image = UtilService::upload("image", $config_upload);

                        if (!$equipment->{"image"}) {
                            return false;
                        }
                    }
                }
            
        }*/
        return Service::salvar($equipment, $campo, $validacao->listaErros(), $tabela);

    }  

    public static function excluir($tabela, $campo, $id)
    {
        Service::excluir($tabela, $campo, $id);
    }
}