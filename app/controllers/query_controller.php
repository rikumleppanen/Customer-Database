<?php

class QueryController extends BaseController {

    public static function index() {
        $mqueries = Query::all();
        View::make('browseQueries.html', array('mqueries' => $mqueries));
    }

    public static function find($id) {
        $mquery = Query::find($id);
        View::make('browseAQuery.html', array('mquery' => $mquery));
    }

    public static function create() {
        View::make('makeAQuery.html');
    }

    public static function store() {
        $params = $_POST;
        Kint::dump($params);
        $cust = array(
            'name' => $params['name'],
            'guru' => $_SESSION['user']
        );
        if (array_key_exists('email_consent', $params)) {
            $cust['email_consent'] = $params['email_consent'];
        }
        if (array_key_exists('address_consent', $params)) {
            $cust['address_consent'] = $params['address_consent'];
        }
        if (array_key_exists('number_consent', $params)) {
            $cust['number_consent'] = $params['number_consent'];
        }
        if (array_key_exists('sms_consent', $params)) {
            $cust['sms_consent'] = $params['sms_consent'];
        }
        if (array_key_exists('thirdparty_consent', $params)) {
            $cust['thirdparty_consent'] = $params['thirdparty_consent'];
        }
        $query = new Query($cust);
        Kint::dump($query);
        $errors = $query->errors();
        Kint::dump($errors);
        if (count($errors) > 0) {
            Redirect::to('/queries/new', array('errors' => $errors, 'query' => $cust));
        }      
        $query->save();
        Redirect::to('/queries/' . $query->id, array('message' => 'Query is to be created'));
    }

}
