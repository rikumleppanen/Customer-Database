<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/drafts/qlist', function() {
    HelloWorldController::guru_list();
});

$routes->get('/drafts/edit', function() {
    HelloWorldController::guru_change();
});


$routes->get('/drafts/query', function() {
    HelloWorldController::guru_query();
});

$routes->get('/drafts/qsum', function() {
    HelloWorldController::guru_qsum();
});

$routes->get('/drafts/customer', function() {
    CustomerController::index();
});

$routes->post('/drafts/customer/new', function() {
    CustomerController::store();
});

$routes->get('/drafts/customer/new', function() {
    CustomerController::create();
});

$routes->get('/drafts/customer/delete/:id', function($id) {
    CustomerController::destroy($id);
});
$routes->get('/drafts/customer/:id', function($id) {
    CustomerController::find($id);
});

$routes->post('/drafts/customer/:id', function($id) {
    CustomerController::update($id);
});

