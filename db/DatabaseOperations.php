<?php
interface DatabaseOperations{
    //read all
    public function fetchAll();
    
    //read one
    public function fetchById($id);

    //update
    public function updateById($id, $field, $newValue);

    //create
    public function create($args);

    //delete
    public function deleteById($id);
}
?>