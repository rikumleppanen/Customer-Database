<?php

class Query extends BaseModel {

    public $id, $name, $email_consent, $address_consent, $number_consent, $sms_consent, $thirdparty_consent, $created, $guru, $sum_rows;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT q.id, q.name, q.created::timestamp::date, m.name as guru, q.sum_rows FROM Query q, Marketinguru m WHERE q.guru = m.id');
        $query->execute();
        $rows = $query->fetchAll();
        $messages = array();

        foreach ($rows as $row) {
            $messages[] = new Query(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'created' => $row['created'],
                'guru' => $row['guru'],
                'sum_rows' => $row['sum_rows']
            ));
        }
        return $messages;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Query WHERE id =:id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $qu = new Query(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email_consent' => $row['email_consent'],
                'address_consent' => $row['address_consent'],
                'number_consent' => $row['number_consent'],
                'sms_consent' => $row['sms_consent'],
                'thirdparty_consent' => $row['thirdparty_consent'],
                'created' => $row['created'],
                'guru' => $row['guru']
            ));
            return $qu;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Query (name, created, guru, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent) VALUES (:name, LOCALTIMESTAMP, :guru, :email_consent, :address_consent, :number_consent, :sms_consent, :thirdparty_consent) RETURNING id');
        $query->execute(array('name' => $this->name, 'guru' => $this->guru, 'email_consent' => $this->email_consent, 'address_consent' => $this->address_consent, 'number_consent' => $this->number_consent, 'sms_consent' => $this->sms_consent, 'thirdparty_consent' => $this->thirdparty_consent));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function collect() {
        $query = DB::connection()->prepare('INSERT INTO Querycustomer (query, customer) SELECT DISTINCT :id::int, id as customer FROM Customer WHERE (email_consent=:email_consent OR :email_consent IS NULL) AND (address_consent=:address_consent OR :address_consent IS NULL) AND (number_consent=:number_consent OR :number_consent IS NULL) AND (sms_consent=:sms_consent OR :sms_consent IS NULL) AND (thirdparty_consent=:thirdparty_consent OR :thirdparty_consent IS NULL)');
        $query->execute(array('id' => $this->id, 'email_consent' => $this->email_consent, 'address_consent' => $this->address_consent, 'number_consent' => $this->number_consent, 'sms_consent' => $this->sms_consent, 'thirdparty_consent' => $this->thirdparty_consent));
    }

//    public function save_rows($id) {
//        $query = DB::connection()->prepare('SELECT COUNT(*) as sum FROM Querycustomer WHERE query=:id');
//        $query->execute(array('id' => $id));
//        $row = $query->fetch();
//
//        //$this->sum_rows = $row['sum'];
//        $query2 = DB::connection()->prepare('UPDATE Query SET sum_rows=:sum_rows WHERE query=:id');
//        $query2->execute(array('sum_rows'=> $row['sum'], 'id' => $id));
//    }

    public static function display($id) {
        $query2 = DB::connection()->prepare('SELECT * FROM Customer WHERE id IN(SELECT customer FROM Querycustomer WHERE query=:id)');
        $query2->execute(array('id' => $id));
        $rows = $query2->fetchAll();
        $messages = array();

        foreach ($rows as $row) {
            $messages[] = new Customer(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email']
            ));
        }
        return $messages;
    }

    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors[] = 'You must give a name!';
        }
        if (strlen($this->name) < 5) {
            $errors[] = 'Name requires at least 5 characters';
        }
        return $errors;
    }

}
