<?php

namespace  Grdar\core\Login;
use  Grdar\core\Envio;

class RetrievePassword extends Authenticator
{
	private $email;
	private $user_id;
	private $codigo;
	private $result;

    public function __construct($user)
    {
        $this->email = $user;
        $this->resert();
    }

	public function getResert()
    {
	    return $this->result;
	}

    private function resert()
    {
        if($this->existUser() == 'El email introducido no es correcto'){
            return false;
        }
        
        $result = $this->singleObject();
        $this->email = $result->email;
        $this->user_id = $result->user_id;
        
        $codigo = new Token($this->user_id);
        $codigo->setSaveToken();

        $resert = new Envio;
        $resert->setRecoveryPassword($this->email, $codigo->getCodigo());

        return $resert->getLogin() === 1  ? $this->result  = 'success' : $this->result  = 'Algo ha fallado, el correo no ha podido ser enviado';
            
        
    }

    protected function existUser()
    {
        $query = "SELECT user_id, email from cliente_acceso WHERE email = '$this->email'";
        $this->setQuery($query);
        $this->getQuery();
        $usuario = $this->rowCount();
        
        return $this->rowCount() === 1 ? $this->singleObject() : $this->result = 'El email introducido no es correcto'; 

    }
}




