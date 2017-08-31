<?php

class Marketinguru extends BaseModel {

    public $id, $name, $email, $admin_rights, $password;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_email', 'validate_EmailUniqueness', 'validate_password');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Marketinguru');
        $query->execute();
        $rows = $query->fetchAll();
        $messages = array();

        foreach ($rows as $row) {
            $messages[] = new Marketinguru(array(
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
        $query = DB::connection()->prepare('SELECT * FROM Marketinguru WHERE id=:id LIMIT 1');
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

    public static function admin_rights($id) {
        $query = DB::connection()->prepare('SELECT * FROM Marketinguru WHERE id=:id AND admin_rights IS TRUE LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            return true;
        }
        return false;
    }

    public static function authenticate($email, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Marketinguru WHERE email=:email AND password=:password LIMIT 1');
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

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Marketinguru (name, email, admin_rights, password) VALUES (:name, :email, :admin_rights, :password) RETURNING id');
        $query->execute(array('name' => $this->name, 'email' => $this->email, 'admin_rights' => $this->admin_rights, 'password' => $this->password));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Marketinguru SET name=:name, email=:email, admin_rights=:admin_rights, password=:password WHERE id=:id RETURNING id');
        $query->execute(array('name' => $this->name, 'email' => $this->email, 'admin_rights' => $this->admin_rights, 'password' => $this->password, 'id' => $this->id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Marketinguru WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }

    public function validate_EmailUniqueness() {
        $errors = array();
        $query = DB::connection()->prepare('SELECT id FROM Marketinguru WHERE email=:email');
        $query->execute(array('email' => $this->email));
        $row = $query->fetch();

        if (!is_null($row[0]) && $row[0] != $this->id) {
            $errors[] = 'There cannot be several registered users with the same email address';
        }
        return $errors;
    }

}
