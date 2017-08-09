<?php

class Guru extends BaseModel {

    public $id, $name, $email, $admin_rights, $password;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_email');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Guru');
        $query->execute();
        $rows = $query->fetchAll();
        $messages = array();

        foreach ($rows as $row) {
            $messages[] = new Guru(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'admin_rights' => $row['admin_rights'],
                'password' => $row['password']
            ));
        }
        return $messages;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Guru WHERE id =: id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $Guru = new Guru(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'admin_rights' => $row['admin_rights'],
                'password' => $row['password']
            ));
            return $Guru;
        }
        return null;
    }

    public static function authenticate($email, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Guru WHERE email=:email AND password=:password LIMIT 1');
        $query->execute(array('email' => $email, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            $Guru = new Guru(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'admin_rights' => $row['admin_rights'],
                'password' => $row['password']
            ));
            return $Guru;
        }
        return null;
    }

    public function validate_email() {
        $errors = array();
        if ($this->email == '' || $this->email == null ) {
            $errors[] = 'Give your email address, please!';
        }
    //    || $this->email != '%@%'
        return $errors;
    }

}
