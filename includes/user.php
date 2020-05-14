<?php
include 'db.php';

class User extends DB{
    private $username;
    private $email;

    //Funcion que comprueba si el usuario existe
    public function userExists($user, $pass){
        
        $contador = 0;

        $query = $this->connect()->prepare('SELECT * FROM account WHERE username = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            if (password_verify($pass, $currentUser['password'])){
                $contador++;
            }
        }

        if($contador>0){
            return true;
        }else{
            return false;
        }
    }

    //Funcion que comprueba si el usuario fue confirmado para poder logear
    public function userConfirmado($user){
        $query = $this->connect()->prepare('SELECT * FROM account WHERE username = :user AND confirmado = 1');
        $query->execute(['user' => $user]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    //Funcion que comprueba si el usuario tiene activado el control parental
    public function userParental($user){
        $query = $this->connect()->prepare('SELECT * FROM account WHERE username = :user AND parental = 1');
        $query->execute(['user' => $user]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    //Funcion que comprueba si el usuario es administrador
    public function userAdmin($user){
        $query = $this->connect()->prepare('SELECT * FROM account WHERE username = :user AND poderoso = 1');
        $query->execute(['user' => $user]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    //Funcion para cambiar la contraseña del usuario
    public function userChangePass($user, $pass){
        $hashpass = password_hash($pass, PASSWORD_DEFAULT);
        $query = $this->connect()->prepare("UPDATE username SET password = :hashpass WHERE username = :user");
        $query->execute(['hashpass' => $hashpass, 'user' => $user]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    //Funcion para cambiar la configuracion de control parental
    public function userChangeParental($user, $parent){
        $query = $this->connect()->prepare('UPDATE username SET parental = :parent WHERE username = :user');
        $query->execute(['parent' => $parent, 'user' => $user]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM account WHERE username = :user');
        $query->execute(['user' => $user]);
        
        foreach ($query as $currentUser) {
            $this->username = $currentUser['username'];
            $this->email = $currentUser['email'];
        }
    }

    //Funcion que comprueba si existe el usuario solo con el nombre
    public function ExisteUsuario($user){
        $query = $this->connect()->prepare('SELECT * FROM account WHERE username = :user');
        $query->execute(['user' => $user]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    //Registramos un nuevo usuario
    public function createUser($user, $pass){
		$salt = $this->generateRandomString();
		$hash = $this->generateRandomString(32);
        $hashpass = hash('sha256', $pass . $salt);
        $query = $this->connect()->prepare("INSERT INTO account (username, password, salt, hash) VALUES ('$user', '$hashpass', '$salt', '$hash')");
        $query->execute();

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function getUserName(){
        return $this->username;
    }

    public function getEmail(){
        return $this->email;
    }
	
	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		
		return $randomString;
	}
}

?>