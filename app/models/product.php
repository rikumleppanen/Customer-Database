<?php

class Product extends BaseModel {

    public $id, $name;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Product');
        $query->execute();
        $rows = $query->fetchAll();
        $messages = array();

        foreach ($rows as $row) {
            $messages[] = new Product(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
        }
        return $messages;
    }

    public static function find($subsid) {
        $query = DB::connection()->prepare('SELECT * FROM Product WHERE id IN(SELECT product FROM Subscription WHERE id=:subsid)');
        $query->execute(array('subsid' => $subsid));
        $row = $query->fetch();

        if ($row) {
            $product = new Product(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));

            return $product;
        }

        return null;
    }

}
