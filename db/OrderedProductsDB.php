<?php require_once  __DIR__ . '/Database.php'; ?>
<?php
class OrderedProductsDB extends Database
{
    protected $tableName = 'ordered_products';
    public function fetchAll()
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName . ";");
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchAllPaginated($pagination, $offset)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " ORDER BY product_id DESC LIMIT " . $pagination . " OFFSET ? " . ";");
        $statement->bindValue(1, $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE product_id = " . $id . ";");
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchByOrderId($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE order_id = " . $id . ";");
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchIdCount()
    {
        $statement = $this->pdo->prepare("SELECT count(product_id) FROM " . $this->tableName . ";");
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function fetchForCart($args, $ids)
    {
        $statement = $this->pdo->prepare("SELECT * FROM products WHERE product_id IN ($args) ORDER BY name");
        $statement->execute(array_values($ids));
        return $statement->fetchAll();
    }

    public function fetchForCartSum($args, $ids)
    {
        $statement = $this->pdo->prepare("SELECT SUM(price) FROM products WHERE product_id IN ($args)");
        $statement->execute(array_values($ids));
        return $statement->fetchColumn();
    }

    public function updateById($id, $field, $newValue)
    {
        $statement = $this->pdo->prepare("UPDATE " . $this->tableName . " SET " . $field . "= '" . $newValue . "' WHERE product_id = " . $id . ";");
        $statement->execute();
    }
    public function updateEntireProductById($id, $name, $price, $description, $img){
        $statement = $this->pdo->prepare("UPDATE " . $this->tableName . " SET name = " . "'" . $name . "'," 
        . " price = " . "" . $price . "," 
        . " description = " . "'" . $description . "'," 
        . " img = " . "'" . $img . "'" .
        " WHERE product_id = " . $id . ";");
        $statement->execute();
    }
    public function create($args)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . $this->tableName . " (order_id, product_id, quantity) 
        " . " VALUES (" . $args['order_id'] . "," . $args['product_id'] . "  ," . $args['quantity'] . ");");
        $statement->execute();
    }
    public function deleteById($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM " . $this->tableName . " WHERE product_id = " . $id . ";");
        $statement->execute();
    }
}
?>