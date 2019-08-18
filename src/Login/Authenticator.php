<?php

namespace  Grdar\core\Login;

use  Grdar\core\Model;

class Authenticator extends Model{
	public $user;
	public $pass;
	public $return;

    public function __construct($user, $pass)
    {
	    $this->user = $user;
	    $this->pass = md5($pass);
	    $this->connect();
    }

    public function getConnect()
    {
        return $this->return;
    }

    public function connect(){
        $query = "SELECT id, user_id from cliente_acceso WHERE email = '$this->user' AND secret_passwd = '$this->pass'";
        $this->setQuery($query);
        $this->getQuery();
        $this->isUser($this->rowCount());
    }

    protected function isUser($user){
        if($user == 1){
            $login = $this->singleObject();
            $_SESSION['user'] = $login->user_id;
            $_SESSION['token'] = new Token($login->user_id);
            $this->return = 'success';
        }
    }
}




