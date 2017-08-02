<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('login.html');
    }

    public static function guru_change() {
        View::make('modifyCustomer.html');
    }

    public static function guru_list() {
        View::make('browseCustomers.html');
    }

    public static function guru_query() {
        View::make('makeAQuery.html');
    }

    public static function quru_login() {
        View::make('login.html');
    }

}
