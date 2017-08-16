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
        $query = DB::connection()->prepare('SELECT * FROM Guru WHERE id =:id LIMIT 1');
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
        $query = DB::connection()->prepare('SELECT * FROM Guru WHERE id =:id AND admin_rights IS TRUE LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            return true;
        }
        return false;
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

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Guru (name, email, admin_rights, password) VALUES (:name, :email, :admin_rights, :password) RETURNING id');
        $query->execute(array('name' => $this->name, 'email' => $this->email, 'admin_rights' => $this->admin_rights, 'password' => $this->password));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Guru SET name=:name, email=:email, admin_rights=:admin_rights, password=:password WHERE id=:id RETURNING id');
        $query->execute(array('name' => $this->name, 'email' => $this->email, 'admin_rights' => $this->admin_rights, 'password' => $this->password, 'id' => $this->id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Guru WHERE id=:id');
        $query->execute(array('id' => $this->id));
    }

    public function validate_email() {
        $errors = array();
        if ($this->email == '' || $this->email == null || $this->email != '%@%') {
            $errors[] = 'Give your email address, please!';
        }
        return $errors;
    }

}
