<?php

class SubsController extends BaseController {

    public static function initialize($customerid) {
        $products = Product::all();
        $customer = Customer::find($customerid);
        View::make('newSubs.html', array('products' => $products, 'customer' => $customer));
    }

    public static function modifyerror($customerid) {
        $products = Product::all();
        $customer = Customer::find($customerid);
        View::make('modifyerrorSubs.html', array('products' => $products, 'customer' => $customer));
    }

    public static function store() {
        $params = $_POST;
        $subs = array(
            'startdate' => $params['startdate'],
            'customername' => $params['customername'],
            'customer' => $params['customerid'],
            'product' => $params['product']
        );

        $subscription = new Subscription($subs);

        $errors = $subscription->errors();

        if (count($errors) > 0) {
            Redirect::to('/customers/' . $subscription->customer . '/modifyerror', array('errors' => $errors, 'cu' => $subs));
        } else {
            $subscription->save();
            Redirect::to('/customers/' . $subscription->customer, array('message' => 'Subscription is created successfully!'));
        }
    }

}
