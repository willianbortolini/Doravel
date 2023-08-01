<?php

namespace app\controllers;

use app\core\Controller;
use app\util\UtilService;
use app\models\service\EquipmentService;
use app\core\Flash;
use app\models\service\Service;

class EquipmentController extends Controller
{
    private $tabela = "equipments";
    private $campo = "equipments_id";
    private $usuario;

    //verifica se tem usuario logado(somente para telas que exigem)
    /*public function __construct()
    {
        $this->usuario = UtilService::getUsuario();
        if (!$this->usuario) {
            $this->redirect(URL_BASE . "login");
            exit;
        }
    }*/

    public function index()
    {
        $dados["equipments"] = EquipmentService::getEquipmentStore();
        $dados["view"] = "Equipment/Show";
        $this->load("templateBootstrap", $dados);
    }

    public function edit($id)
    {
        $dados["equipments"] = Service::get($this->tabela, $this->campo, $id);
        $dados["view"] = "Equipment/Edit";
        $this->load("templateBootstrap", $dados);
    }

    public function create()
    {
        $dados["equipments"] = Flash::getForm();
        $dados["view"] = "Equipment/Edit";
        $this->load("templateBootstrap", $dados);
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
            $csrfToken = $_POST['csrf_token'];
            if ($csrfToken === $_SESSION['csrf_token']) {
                $id = $_POST['id'];
                
                // Excluir a imagem, se existir               
                $existe_imagem = service::get($this->tabela, $this->campo, $id)->img1;
                if (isset($existe_imagem) && $existe_imagem != '') {
                    UtilService::deletarImagens($existe_imagem);
                }
                $existe_imagem = service::get($this->tabela, $this->campo, $id)->img2;
                if (isset($existe_imagem) && $existe_imagem != '') {
                    UtilService::deletarImagens($existe_imagem);
                }

                // Excluir
                EquipmentService::excluir($this->tabela, $this->campo, $id);
            }
        }
    }

    public function save()
    {
        $csrfToken = $_POST['csrf_token'];
        if ($csrfToken === $_SESSION['csrf_token']) {
            $equipment = new \stdClass();
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (isset($_POST["equipments_id"]))
                    $equipment->equipments_id = $_POST["equipments_id"];
                if (isset($_POST["equipments_name"]))
                   $equipment->equipments_name = $_POST["equipments_name"];
                if (isset($_POST["description"]))
                   $equipment->description = $_POST["description"];
                if (isset($_POST["price_per_day"]))
                   $equipment->price_per_day = $_POST["price_per_day"];
                if (isset($_POST["availabilities"]))
                   $equipment->availabilities = $_POST["availabilities"];
                
            }

            if (isset($equipment->equipments_id)) {
                $equipment->stores_id = $_SESSION['store'];
            }

            Flash::setForm($equipment);
            if (EquipmentService::salvar($equipment, $this->campo, $this->tabela) > 1) //se é maior que um inseriu novo 
            {
                $this->redirect(URL_BASE . "Equipment");
            } else {
                if (!$equipment->equipments_id) {
                    $this->redirect(URL_BASE . "Equipment/create");
                } else {
                    $this->redirect(URL_BASE . "Equipment/edit/" . $equipment->equipments_id);
                }
            }
        }
    }

}
