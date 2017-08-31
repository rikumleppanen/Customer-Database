<?php

class MarketinguruController extends BaseController {

    public static function login() {
        View::make('login.html');
    }

    public static function handle_login() {
        $params = $_POST;
        $user = Marketinguru::authenticate($params['email'], $params['password']);
        if (!$user) {
            View::make('login.html', array('error' => 'Check your email address and/or password!', 'email' => $params['email']));
        } else {
            $_SESSION['user'] = $user->id;
            Redirect::to('', array('message' => 'Welcome ' . $user->name . '!'));
        }
    }

    public static function index() {
        $users = Marketinguru::all();
        View::make('browseUsers.html', array('users' => $users));
    }

    public static function find($id) {
        $user = Marketinguru::find($id);
        //Kint::dump($user);
        View::make('modifyUser.html', array('user' => $user));
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'You have signed out!'));
    }

    public static function create() {
        View::make('newUser.html');
    }

    public static function store() {
        self::check_admin_rights();
        $params = $_POST;
        $mguru = array(
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password'],
        );
        if (array_key_exists('admin_rights', $params)) {
            $mguru['admin_rights'] = $params['admin_rights'];
        }

        $user = new Marketinguru($mguru);
        $errors = $user->errors();
        if (count($errors) > 0) {
            Redirect::to('/users/new', array('errors' => $errors, 'mguru' => $mguru));
        } else {
            $user->save();
            Redirect::to('/users/' . $user->id, array('message' => 'User is created successfully!'));
        }
    }

    public static function update() {
        $params = $_POST;
        $mguru = array(
            'id' => $params['id'],
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password'],
        );
        if (array_key_exists('admin_rights', $params)) {
            $mguru['admin_rights'] = $params['admin_rights'];
        }

        $user = new Marketinguru($mguru);

        $errors = $user->errors();

        if (count($errors) > 0) {
            Redirect::to('/users/' . $user->id, array('errors' => $errors, 'mguru' => $mguru));
        } else {
            $user->update();
            Redirect::to('/users/' . $user->id, array('message' => 'Updated successfully!'));
        }
    }

    public static function delete($id) {
        $attributes = array('id' => $id);
        $user = new Marketinguru($attributes);
        $user->destroy();
        Redirect::to('/users', array('message' => 'User is deleted from the database.'));
    }

}
