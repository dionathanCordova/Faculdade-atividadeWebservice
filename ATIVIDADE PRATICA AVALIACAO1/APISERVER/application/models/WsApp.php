<?php

class WsApp extends CI_Model {

    public $title;
    public $content;
    public $date;
    private $token;
    private $ok;

    public function createFilme($titulo, $data, $genero, $poster, $sinopse, $sinopseFull) {
        $data = array(
            'titulo'=> $titulo,
            'data'=> $data,
            'genero' => $genero,
            'poster' => $poster,
            'sinopse' => $sinopse,
            'sinopseFull' => $sinopseFull,
            'data' => date('Y-m-d')
        );
        $insert = $this->db->insert('filmes', $data);
        if($insert) {
            return 'Cadastro efetuado';
        }else{
            return 'Não foi possível cadastrar';
        }
    } 

    public function getFilmes() {
        $result = $this->db->get('filmes');
        return $result->result();
    }
    
    public function getFilmesById($filme_id) {
        $this->db->where('id', $filme_id);
        $result = $this->db->get('filmes');
        return $result->result();
    }

    public function updatefilmes($id, $genero, $poster, $titulo, $sinopse, $sinopseFull) {
        // BUSCANDO DADOS DA TABELA ALUNOS
        $this->db->where('id', $id);
        $this->db->from('filmes');
        $query = $this->db->get();
    
        $data = [];
        foreach($query as $info) {
            $data['genero'] = $genero == null ? $info['genero'] : $genero;
            $data['poster'] = $poster == null ? $info['poster'] : $poster;
            $data['titulo'] = $titulo == null ? $info['titulo'] : $titulo;
            $data['sinopse'] = $sinopse == null ? $info['sinopse'] : $sinopse;
            $data['sinopseFull'] = $sinopseFull == null ? $info['sinopseFull'] : $sinopseFull;
        }

        // ALTERANDO STATUS NA TABELA USUARIOS
        $this->db->where('id', $id);
        $return = $this->db->update('filmes', $data);

        if($return) {
            return  ['msg' => 'true'];
        }else{
            return ['msg' => 'false'];
        }
        
    }
     
    public function deleteFilme($filme_id) {
        $this->db->where("id", $filme_id);
        $retorno = $this->db->delete('filmes');
        if($retorno) {
            return 'Filme exclído';
        }
    }
  
    public function createToken() {
		while($token = rand(11111, 99999)) {
			$sql = $this->db->prepare("SELECT * FROM todo WHERE token = :token");
			$sql->bindValue(":token", $token);
			$sql->execute();

			if($sql->rowCount() == 0) {
				break;
			}
		}
		$this->token = $token;
		$this->add('Item 1');
		$id = $this->add('Item 2');
		$this->add('Item 3');

		$this->update(array('done'=>'1', 'id'=>$id));

		return $token;
    }

    // EXEMPLOS
    public function get_last_ten_entries()
    {
            $query = $this->db->get('entries', 10);
            return $query->result();
    }

    public function insert_entry()
    {
            $this->title    = $_POST['title']; // please read the below note
            $this->content  = $_POST['content'];
            $this->date     = time();

            $this->db->insert('todo', $this);
    }

    public function update_entry()
    {
            $this->title    = $_POST['title'];
            $this->content  = $_POST['content'];
            $this->date     = time();

            $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

}