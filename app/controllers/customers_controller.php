<?php

require 'app/models/customer.php';

class CustomerController extends BaseController {

    public static function index() {
        $customers = Customer::all();
        View::make('browseCustomers.html', array('customers' => $customers));
    }

    public static function find($id) {
        $customer = Customer::find($id);
        View::make('modifyCustomer.html', array('customer' => $customer));
    }

    public static function create() {
        View::make('newCustomer.html');
        $params = $_POST;
        $customer = new Customer(array(
            'name' => $params['name'],
            'email' => $params['email'],
            'address' => $params['address'],
            'number' => $params['number']
        ));
        $customer->save();
        Redirect::to('/drafts/customer/' . $customer->id);
    }

    public static function store() {
        $params = $_POST;
        $customer = new Customer(array(
            'name' => $params['name'],
            'email' => $params['email'],
            'address' => $params['address'],
            'number' => $params['number']
        ));
        $customer->save();
        Redirect::to('/drafts/customer/' . $customer->id, array('message' => 'Customer is created successfully!'));
    }

    public static function update($id) {
        $params = $_POST;
        $customer = new Customer(array(
            'name' => $params['name'],
            'email' => $params['email'],
            'address' => $params['address'],
            'number' => $params['number'],
            'id' => $params['id']
        ));
        $customer->update();
        Redirect::to('/drafts/customer/' . $customer->id, array('message' => 'Updated successfully!'));
    }

    public static function destroy($id) {
        $attributes = array('id' => $id);
        $customer = new Customer($attributes);
        $customer->destroy();
        Redirect::to('/drafts/customer', array('message' => 'Customer is deleted from the database.'));
    }

}
