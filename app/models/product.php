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

}
