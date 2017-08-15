<?php

require 'app/models/guru.php';

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

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'You have signed out!'));
    }

}
