<?php

require 'app/models/customer.php';

class CustomerController extends BaseController {

    public static function index() {
        $customers = Customer::all();
        View::make('browseCustomers.html', array('customers' => $customers));
    }

    public static function find($id) {
        $customer = Customer::find($id);
        //Kint::dump($customer);
        View::make('modifyCustomer.html', array('customer' => $customer));
    }

    public static function create() {
        View::make('newCustomer.html');
        $params = $_POST;
        $cust = array(
            'name' => $params['name'],
            'email' => $params['email'],
            'address' => $params['address'],
            'number' => $params['number']
        );
        if (array_key_exists('email_consent', $params)) {
            $cust['email_consent'] = $params['email_consent'];
        }
        if (array_key_exists('number_consent', $params)) {
            $cust['number_consent'] = $params['number_consent'];
        }
        if (array_key_exists('address_consent', $params)) {
            $cust['address_consent'] = $params['address_consent'];
        }
        if (array_key_exists('sms_consent', $params)) {
            $cust['sms_consent'] = $params['sms_consent'];
        }
        if (array_key_exists('thirdparty_consent', $params)) {
            $cust['thirdparty_consent'] = $params['thirdparty_consent'];
        }
        $customer = new Customer($cust);
        $customer->save();
        Redirect::to('/customers/' . $customer->id);
    }

    public static function store() {
        $params = $_POST;
        $cust = array(
            'name' => $params['name'],
            'email' => $params['email'],
            'address' => $params['address'],
            'number' => $params['number'],
        );
        if (array_key_exists('email_consent', $params)) {
            $cust['email_consent'] = $params['email_consent'];
        }
        if (array_key_exists('number_consent', $params)) {
            $cust['number_consent'] = $params['number_consent'];
        }
        if (array_key_exists('address_consent', $params)) {
            $cust['address_consent'] = $params['address_consent'];
        }
        if (array_key_exists('sms_consent', $params)) {
            $cust['sms_consent'] = $params['sms_consent'];
        }
        if (array_key_exists('thirdparty_consent', $params)) {
            $cust['thirdparty_consent'] = $params['thirdparty_consent'];
        }
        $customer = new Customer($cust);
        $customer->save();

        Redirect::to('/customers/' . $customer->id, array('message' => 'Customer is created successfully!'));
    }

    public static function update($id) {
        $params = $_POST;
        $cust = array(
            'id' => $params['id'],
            'name' => $params['name'],
            'email' => $params['email'],
            'address' => $params['address'],
            'number' => $params['number']
        );
        if (array_key_exists('email_consent', $params)) {
            $cust['email_consent'] = $params['email_consent'];
        } 
        if (array_key_exists('number_consent', $params)) {
            $cust['number_consent'] = $params['number_consent'];
        }
        if (array_key_exists('address_consent', $params)) {
            $cust['address_consent'] = $params['address_consent'];
        }
        if (array_key_exists('sms_consent', $params)) {
            $cust['sms_consent'] = $params['sms_consent'];
        }
        if (array_key_exists('thirdparty_consent', $params)) {
            $cust['thirdparty_consent'] = $params['thirdparty_consent'];
        }
        $customer = new Customer($cust);
        $customer->update();
        Redirect::to('/customers/' . $customer->id, array('message' => 'Updated successfully!'));
    }

    public static function destroy($id) {
        $attributes = array('id' => $id);
        $customer = new Customer($attributes);
        $customer->destroy();
        Redirect::to('/customers', array('message' => 'Customer is deleted from the database.'));
    }

}
