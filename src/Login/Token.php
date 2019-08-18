<?php

namespace  Grdar\core\Login;
use  Grdar\core\Model;

class Token extends Model{
	private $user;
	private $codigo;
	private $token;

    public function __construct($user){
        $this->user = $user;
        $this->token();
    }

    public function setSaveToken()
    {
        $this->saveToken();
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    protected function token()
    {
        $this->token = str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789".uniqid());
        $this->codigo = $_SERVER["SERVER_NAME"].'/app/?layout=recuperar&usuario='.$this->user.'&token='.$this->token;
        return $this->token;
    }
    protected function saveToken()
    {
        $query = "UPDATE cliente_acceso SET tokken = '$this->token' where user_id = $this->user";
        $this->setQuery($query);
    }
}