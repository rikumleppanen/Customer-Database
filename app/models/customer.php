<?php

class Customer extends BaseModel {

    public $id, $name, $email, $address, $number, $tstz;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function say_hi() {
        return 'Hello World!';
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Customer');
        $query->execute();
        $rows = $query->fetchAll();
        $customers = array();

        foreach ($rows as $row) {

            $customers[] = new Customer(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'address' => $row['address'],
                'number' => $row['number'],
                'tstz' => $row['tstz']
            ));
        }

        return $customers;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Customer WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $customer = new Customer(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'address' => $row['address'],
                'number' => $row['number'],
                'tstz' => $row['tstz']
            ));

            return $customer;
        }

        return null;
    }

}
