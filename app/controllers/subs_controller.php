<?php

class SubsController extends BaseController {

    public static function initialize($customerid) {
        $products = Product::all();
        $customer = Customer::find($customerid);
        View::make('newSubs.html', array('products' => $products, 'customer' => $customer));
    }

    public static function cancellation($customerid, $subsid) {
        $products = Product::all();
        $customer = Customer::find($customerid);
        View::make('cancelASubs.html', array('products' => $products, 'customer' => $customer, 'subsid' => $subsid));
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
        $errors = $subscription->errorsDate($subscription->startdate);
        Kint::dump($errors);

        if (count($errors) > 0) {
            Redirect::to('/customers/' . $subscription->customer . '/modifyerror', array('errors' => $errors, 'cu' => $subs));
        } else {
            $subscription->save();
            Redirect::to('/customers/' . $subscription->customer, array('message' => 'Subscription is created successfully!'));
        }
    }

    public static function cancel($customerid, $subsid) {
        $params = $_POST;
        $customer = Customer::find($customerid);
        $subs = array(
            'id' => $subsid,
            'enddate' => $params['enddate'],
            'customer' => $customerid
        );

        $subscription = new Subscription($subs);
        $errors = $subscription->errorsDate($subscription->enddate);

        if (count($errors) > 0) {
            Redirect::to('/customers/' . $subscription->customer . '/subs/' . $subsid, array('errors' => $errors, 'customer' => $customer));
        } else {
            $subscription->cancelASubscription();

            Redirect::to('/customers/' . $subscription->customer, array('message' => 'Subscription is cancelled successfully!'));
        }
    }

}
