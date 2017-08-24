<?php

class CustomerSubscription extends BaseModel {

    public $customerid, $subsid, $name, $email, $startdate, $enddate, $product, $status;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_customerid');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT cu.id as customerid, su.id as subsid, cu.name, cu.email, su.startdate, su.enddate, su.product, CASE WHEN su.startdate::date <= CURRENT_DATE AND (su.enddate IS NULL OR su.enddate::date > CURRENT_DATE) THEN 1 WHEN su.startdate::date > CURRENT_DATE THEN 0 ELSE 2 END as status FROM Customer cu LEFT JOIN Subscription su ON su.customer = cu.id ORDER BY startdate DESC;');
        $query->execute();
        $rows = $query->fetchAll();
        $customers = array();

        foreach ($rows as $row) {

            $customers[] = new CustomerSubscription(array(
                'customerid' => $row['customerid'],
                'subsid' => $row['subsid'],
                'name' => $row['name'],
                'email' => $row['email'],
                'startdate' => $row['startdate'],
                'enddate' => $row['enddate'],
                'product' => $row['product'],
                'status' => $row['status']
            ));
        }

        return $customers;
    }

    public function validate_customerid() {
        $errors = array();
        if ($this->customerid == '') {
            $errors[] = 'Customer ID is missing!';
        }
        return $errors;
    }

}
