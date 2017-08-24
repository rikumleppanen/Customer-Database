<?php

class Subscription extends BaseModel {

    public $id, $startdate, $enddate, $created, $cancelled, $customer, $product;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_startdate');
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
