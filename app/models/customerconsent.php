<?php

class customerconsent extends BaseModel {

    public $id, $customer, $consent, $tstz;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function say_hi() {
        return 'Hello World!';
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Customerconsent WHERE customer = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $cconsents = array();

        foreach ($rows as $row) {

            $cconsents[] = new customerconsent(array(
                'id' => $row['id'],
                'customer' => $row['customer'],
                'consent' => $row['consent'],
                'tstz' => $row['tstz']
            ));
        }
        return $cconsents;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Customerconsent (customer, consent) VALUES (:customer, :consent) RETURNING id');
        $query->execute(array('customer' => $this->customer, 'consent' => $this->consent));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
