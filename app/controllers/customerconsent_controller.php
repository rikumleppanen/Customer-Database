<?php

require 'app/models/customerconsent.php';

class CustomerconsentController extends BaseController {

    public static function find($id) {
        $cconsents = customerconsent::find($id);
        View::make('consent.html', array('cconsents' => $cconsents));
    }

}
