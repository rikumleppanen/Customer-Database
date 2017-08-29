<?php

class Subscription extends BaseModel {

    public $id, $startdate, $enddate, $created, $cancelled, $customer, $product;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        //      $this->validators = array('validate_subscription');
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Subscription WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $subs = new Subscription(array(
                'id' => $row['id'],
                'startdate' => $row['startdate'],
                'enddate' => $row['enddate'],
                'created' => $row['created'],
                'cancelled' => $row['cancelled'],
                'customer' => $row['customer'],
                'product' => $row['product']
            ));

            return $subs;
        }

        return null;
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

    public function cancelASubscription() {
        $query = DB::connection()->prepare('UPDATE Subscription SET enddate=:enddate, cancelled=LOCALTIMESTAMP WHERE id=:id::int RETURNING customer');
        $query->execute(array('enddate' => $this->enddate, 'id' => $this->id));
        $row = $query->fetch();
        $this->customer = $row['customer'];
    }

    public function errorsDate($datetime) {
        $validateDate = 'validate_date';
        $date_error = $this->{$validateDate}($datetime);
        $validateFormat = 'validate_dateFormat';
        $format_error = $this->{$validateFormat}($datetime);
        $errors = array_merge($format_error, $date_error);
        return $errors;
    }

}
