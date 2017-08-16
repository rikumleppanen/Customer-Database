<?php

class Customer extends BaseModel {

    public $id, $name, $email, $address, $number, $email_consent, $address_consent, $number_consent, $sms_consent, $thirdparty_consent, $tstz;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_email', 'validate_number');
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
                'email_consent' => $row['email_consent'],
                'address_consent' => $row['address_consent'],
                'number_consent' => $row['number_consent'],
                'sms_consent' => $row['sms_consent'],
                'thirdparty_consent' => $row['thirdparty_consent'],
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
                'email_consent' => $row['email_consent'],
                'address_consent' => $row['address_consent'],
                'number_consent' => $row['number_consent'],
                'sms_consent' => $row['sms_consent'],
                'thirdparty_consent' => $row['thirdparty_consent'],
                'tstz' => $row['tstz']
            ));

            return $customer;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Customer (name, email, address, number, email_consent, address_consent, number_consent, sms_consent, thirdparty_consent) VALUES (:name, :email, :address, :number, :email_consent, :address_consent, :number_consent, :sms_consent, :thirdparty_consent) RETURNING id');
        $query->execute(array('name' => $this->name, 'email' => $this->email, 'address' => $this->address, 'number' => $this->number, 'email_consent' => $this->email_consent, 'address_consent' => $this->address_consent, 'number_consent' => $this->number_consent, 'sms_consent' => $this->sms_consent, 'thirdparty_consent' => $this->thirdparty_consent));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Customer SET name=:name, email=:email, address=:address, number=:number, email_consent=:email_consent, address_consent=:address_consent, number_consent=:number_consent, sms_consent=:sms_consent, thirdparty_consent=:thirdparty_consent WHERE id=:id RETURNING id');
        $query->execute(array('name' => $this->name, 'email' => $this->email, 'address' => $this->address, 'number' => $this->number, 'email_consent' => $this->email_consent, 'address_consent' => $this->address_consent, 'number_consent' => $this->number_consent, 'sms_consent' => $this->sms_consent, 'thirdparty_consent' => $this->thirdparty_consent, 'id' => $this->id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Customer WHERE id=:id');
        $query->execute(array('id' => $this->id));
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

    public function validate_email() {
        $errors = array();
        if ($this->email != '' and ! filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Check the email address!';
        }
        return $errors;
    }

    public function validate_number() {
        $errors = array();
        if ($this->number != '' and ! preg_match("/^[\s\d]+$/", $this->number)) {
            $errors[] = 'No white space, extra characters or country codes are needed in phone number!';
        }
        return $errors;
    }

}
