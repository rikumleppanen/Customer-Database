<?php

class SubsController extends BaseController {

    public static function initialize($customerid) {
        $products = Product::all();
        $customer = Customer::find($customerid);
        View::make('Subscription/newSubs.html', array('products' => $products, 'customer' => $customer));
    }

    public static function cancellation($customerid, $subsid) {
        $product = Product::find($subsid);
        $customer = Customer::find($customerid);
        View::make('Subscription/cancelASubs.html', array('product' => $product, 'customer' => $customer, 'subsid' => $subsid));
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

        if (count($errors) > 0) {
            Redirect::to('/customers/' . $subscription->customer . '/newsubs', array('errors' => $errors));
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

//    public static function delete($customerid) {
//        $attributes = array('customer' => $customerid);
//        $subs = new Subscription($attributes);
//        $subs->destroyByCustomer($customerid);
//    }

}
