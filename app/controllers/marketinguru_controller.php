<?php

class MarketinguruController extends BaseController {

    public static function login() {
        View::make('login.html');
    }

    public static function handle_login() {
        $params = $_POST;
        $user = Guru::authenticate($params['email'], $params['password']);
        if (!$user) {
            View::make('login.html', array('error' => 'Check your email address and/or password!', 'email' => $params['email']));
        } else {
            $_SESSION['user'] = $user->id;
            Redirect::to('/customers', array('message' => 'Welcome ' . $user->name . '!'));
        }
    }

    public static function index() {
        $users = Guru::all();
        View::make('browseUsers.html', array('users' => $users));
    }

    public static function find($id) {
        $user = Guru::find($id);
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
        $params = $_POST;
        $mguru = array(
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password'],
        );
        if (array_key_exists('admin_rights', $params)) {
            $mguru['admin_rights'] = $params['admin_rights'];
        }

        $user = new Guru($mguru);
        $user->save();
        Redirect::to('/users/' . $user->id, array('message' => 'User is created successfully!'));
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

        $user = new Guru($mguru);
        //Kint::dump($user);
        $user->update();
        Redirect::to('/users/' . $user->id, array('message' => 'Updated successfully!'));
    }

    public static function destroy($id) {
        $attributes = array('id' => $id);
        $user = new Guru($attributes);
        $user->destroy();
        Redirect::to('/users', array('message' => 'User is deleted from the database.'));
    }

}
