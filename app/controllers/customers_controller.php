<?php
require 'app/models/customer.php';
class CustomerController extends BaseController {

    public static function index() {
        $customers = Customer::all();
        View::make('browseCustomers.html', array('customers' => $customers));
    }
    
    public static function find($id) {
        $customers = Customer::find($id);
        View::make('modifyCustomer.html', array('customers' => $customers));
    }

}
