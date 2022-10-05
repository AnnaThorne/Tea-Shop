<?php require_once  __DIR__ . '/Database.php'; ?>
<?php
class OrdersDB extends Database
{
    protected $tableName = 'orders';
    public function fetchAll()
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName ." INNER JOIN users on users.user_id = "
         . $this -> tableName.".user_id" ." ORDER BY date ASC;");
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchAllPaginated($pagination, $offset)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName ." INNER JOIN users on users.user_id = " . $this -> tableName."user_id" 
        ." ORDER BY order_id DESC LIMIT " . $pagination . " OFFSET ? " . ";");
        $statement->bindValue(1, $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE order_id = " . $id . ";");
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchByDateUserId($id, $date)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE user_id = " . $id . " AND date = '" . $date . "';");
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchByUserId($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE user_id = " . $id . " ORDER BY date ASC;");
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchIdCount()
    {
        $statement = $this->pdo->prepare("SELECT count(order_id) FROM " . $this->tableName . ";");
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function fetchForCart($args, $ids)
    {
        $statement = $this->pdo->prepare("SELECT * FROM products WHERE order_id IN ($args) ORDER BY name");
        $statement->execute(array_values($ids));
        return $statement->fetchAll();
    }

    public function fetchForCartSum($args, $ids)
    {
        $statement = $this->pdo->prepare("SELECT SUM(price) FROM products WHERE order_id IN ($args)");
        $statement->execute(array_values($ids));
        return $statement->fetchColumn();
    }

    public function updateById($id, $field, $newValue)
    {
        $statement = $this->pdo->prepare("UPDATE " . $this->tableName . " SET " . $field . "= '" . $newValue . "' WHERE order_id = " . $id . ";");
        $statement->execute();
    }
    public function updateEntireProductById($id, $name, $price, $description, $img)
    {
        $statement = $this->pdo->prepare("UPDATE " . $this->tableName . " SET name = " . "'" . $name . "',"
            . " price = " . "" . $price . ","
            . " description = " . "'" . $description . "',"
            . " img = " . "'" . $img . "'" .
            " WHERE order_id = " . $id . ";");
        $statement->execute();
    }
    public function create($args)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . $this->tableName . " (price, date, user_id) 
        " . " VALUES ('" . $args['price'] . "','" . $args['date'] . "'," . $args['user_id'] . ");");
        $statement->execute();
    }
    public function deleteById($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM " . $this->tableName . " WHERE product_id = " . $id . ";");
        $statement->execute();
    }
}
?>