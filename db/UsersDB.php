<?php require_once  __DIR__ . '/Database.php'; ?>
<?php
class UsersDB extends Database{
    protected $tableName = 'users';
    public function fetchAll(){
        $statement = $this -> pdo -> prepare("SELECT * FROM " . $this-> tableName .";");
        $statement -> execute();
        return $statement -> fetchAll();
    }
    public function fetchAllPaginated($pagination){
        $statement = $this -> pdo -> prepare("SELECT * FROM " . $this-> tableName . " LIMIT " . $pagination . " OFFSET ? ".";");
        $statement -> execute();
        return $statement -> fetchAll();
    }
    public function fetchById($id){
        $statement = $this -> pdo -> prepare("SELECT * FROM " . $this-> tableName . " WHERE user_id = " . $id .";");
        $statement -> execute();
        return $statement -> fetchAll();
    }
    public function fetchByEmail($email){
        $statement = $this -> pdo -> prepare("SELECT * FROM " . $this-> tableName . " WHERE email LIKE '" . $email ."';");
        $statement -> execute();
        return $statement -> fetchAll();
    }
    public function updateById($id, $field, $newValue){
        $statement = $this -> pdo -> prepare("UPDATE " . $this-> tableName . " SET " . $field . " = '" . $newValue . "' WHERE user_id = " . $id .";");
        echo "UPDATE " . $this-> tableName . " SET " . $field . " = '" . $newValue . "' WHERE user_id = " . $id .";";
        $statement -> execute();
    }
    public function create($args){
        $statement = $this -> pdo -> prepare("INSERT INTO " . $this-> tableName ." (email, password, privilege) 
        ". " VALUES ('".$args['email'] ."','".$args['password']."','" .$args['privilege'] ." "."');");
        $statement -> execute();
    }
    public function deleteById($id){
        $statement = $this -> pdo -> prepare("DELETE FROM " . $this-> tableName . "WHERE user_id = " . $id .";");
        $statement -> execute();
    }
}
?>