<?php 

namespace  Grdar\core\Login;
use  Grdar\core\Model;
use  Grdar\core\Datos;

class UpdatePassword extends Model
{
    public $user;
    public $pass;
    public $newpass;
    public $conpass;
    public $return;

    public function __construct($pass, $newpass, $conpass)
    {
        $this->user = $_SESSION['user'];
        $this->pass = $pass;
        $this->newpass = $newpass;
        $this->conpass = $conpass;

        return $this->checkPassword() === true ? $this->checkNewPassword() :  $this->return = 'ERROR: La contraseña es incorrecta!' ;
    }

    public function getChange()
    {
        return $this->return;
    }

    private function checkPassword()
    {
        $class = new Datos($_SESSION['user']);
        $query = "SELECT acceso.secret_passwd FROM cliente_acceso as acceso 
                                    INNER JOIN clientes as cli on acceso.user_id = cli.id
                                    WHERE cli.id = $this->user";
        $this->setQuery($query);
        $this->getQuery();
        $pwd = $this->singleObject();
        return $this->pass === $pwd->secret_passwd ? true : false;
    }

    private function checkNewPassword()
    {
        return $this->newpass === $this->conpass ? $this->updatePwd() :  $this->return = 'ERROR: Las contraseñas no coinciden!';
    }

    private function updatePwd()
    {            
        $query = "UPDATE cliente_acceso SET secret_passwd= '$this->newpass' WHERE user_id = $this->user";
        $this->setQuery($query);
        $this->getQuery();
        $this->return = $this->rowCount();
    }
}