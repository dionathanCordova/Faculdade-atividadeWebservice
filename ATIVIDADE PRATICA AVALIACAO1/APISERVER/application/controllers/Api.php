<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require APPPATH . '/libraries/ImplementJwt.php';

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->objOfJwt = new ImplementJwt();
        header('Content-Type: application/json');
        
        // carreganho o model Tabelas_model e setando um apelido de Tabelas
        $this->load->model('WsApp', 'WS');
    }

	public function index()
	{
        echo json_encode(
            [
                'UMA API PARA 1° ATIVIDADE PRÁTICA DE WEBSERVICE',
                'ENDPOINTS' => 
                    [
                        'index'         => ['url' => 'http://localhost:8080/Api/'],
                        'createFilme'   => ['url' => 'http://localhost:8080/Api/createFilme',   'Params' => 'titulo, genero, poster, sinopse, sinopseFull', 'Metodo' => 'POST'],
                        'getFilmes'     => ['url' => 'http://localhost:8080/Api/getFilmes',     'Metodo' => 'GET'],
                        'getFilmesById' => ['url' => 'http://localhost:8080/Api/getFilmesById', 'Params' => 'filme_id', 'Metodo' => 'GET'],
                        'updatefilmes'  => ['url' => 'http://localhost:8080/Api/updatefilmes',  'Params' => 'filme_id, titulo, genero, poster, sinopse, sinopseFull', 'Metodo' => 'POST'],
                        'deleteFilme'   => ['url' => 'http://localhost:8080/Api/deleteFilme',   'Params' => 'filme_id', 'Metodo' => 'POST'],
                    ]
            ]
        );
    }
    
    public function createFilme() {
        $response = ['status' => 'Não foram informados os dados de cadastro'];
        if(!empty($_POST)){ 
            $titulo   = !empty($_POST['titulo']) ? $_POST['titulo'] : '';
            $data     = !empty($_POST['data']) ? $_POST['data'] : '';
            $genero   = !empty($_POST['genero']) ? $_POST['genero'] : '';
            $poster   = !empty($_POST['poster']) ? $_POST['poster'] : '';
            $sinopse  = !empty($_POST['sinopse']) ? $_POST['sinopse'] : '';
            $sinopseFull = !empty($_POST['sinopseFull']) ? $_POST['sinopseFull'] : '';
    
            $query = $this->WS->createFilme($titulo, $data, $genero, $poster, $sinopse, $sinopseFull);
            if($query) {
                $response = ['status' => 200];
            }
        }
        echo json_encode($response);        
    }

    public function getFilmes() {
        $response = ['status' => 'Não existem filmes cadastrados'];
        $query = $this->WS->getFilmes();

        if($query) {
            $response = ['status' => 200];
            echo json_encode($query);
        }
    }

    public function getFilmesById(){
        $response = ['status' => 'Não foi informado o id do filme'];
        if(!empty($_GET)){ 
            $filme_id  = !empty($_GET['filme_id']) ? $_GET['filme_id'] : '';
            $query = $this->WS->getFilmesById($filme_id);
            echo json_encode($query);
        }else{
             echo json_encode($response);
        }
    }

    public function updatefilmes() {
        $response = ['status' => 404, 'msg' => 'Não foram informados os dados para alteração'];

        if(!empty($_POST)) {
            $filme_id = $_POST['filme_id'];
            $titulo   = $_POST['titulo'];
            $genero   = $_POST['genero'];
            $poster   = $_POST['poster'];
            $sinopse  = $_POST['sinopse'];
            $sinopseFull = $_POST['sinopseFull'];
            $query = $this->WS->updatefilmes($filme_id, $genero, $poster, $titulo, $sinopse, $sinopseFull);

            if($query) {
                $response = ['status' => 200];
            }
        }
        
        echo json_encode($response);
    }

    public function deleteFilme($filme_id) {
        $response = ['status' => 404, 'msg' => "Não foi informado o id do filme que será removido"];

        if($_SERVER["REQUEST_METHOD"] == "DELETE") :
            $filme_id = !empty($filme_id) ? $filme_id : 0;
            $query = $this->WS->deleteFilme($filme_id);
            if($query) :
                $response = ['status' => 200];
            endif;
        endif;
       
        echo json_encode($response);
    }
}
