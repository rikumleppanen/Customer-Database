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
    
    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors[] = 'You must give a name!';
        }
        if (!preg_match('/^[a-öA-Ö ]*$/', $this->name)) {
            $errors[] = 'Only letters and white space allowed for name!';
        }
        if (strlen($this->name) < 5) {
            $errors[] = 'Name requires at least 5 characters';
        }
        return $errors;
    }

}
