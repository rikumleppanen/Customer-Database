<?php

class Subscription extends BaseModel {

    public $id, $startdate, $enddate, $created, $cancelled, $customer, $product;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_startdate');
    }
    
    public static function findByCustomer($customerid) {
        $query = DB::connection()->prepare('SELECT * FROM Subscription WHERE customer=:customerid ORDER BY created DESC');
        $query->execute(array('customerid' => $customerid));
        $rows = $query->fetchAll();
        $messages = array();

        foreach ($rows as $row) {
               $messages[] = new Subscription(array(
                'id' => $row['id'],
                'startdate' => $row['startdate'],
                'enddate' => $row['enddate'],
                'created' => $row['created'],
                'cancelled' => $row['cancelled'],
                'customer' => $row['customer'],
                'product' => $row['product']
            ));
        }
        return $messages;
    }
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Subscription (startdate, created, customer, product) VALUES (:startdate, LOCALTIMESTAMP, :customer::int, :product::int) RETURNING customer');
        $query->execute(array('startdate' => $this->startdate, 'customer' => $this->customer, 'product' => $this->product));
        $row = $query->fetch();
        $this->customer = $row['customer'];
    }

    public function validate_startdate() {
        $errors = array();
        if ($this->startdate == '') {
            $errors[] = 'Starting date is not valid!';
        }
        return $errors;
    }

}
