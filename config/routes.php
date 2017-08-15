<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/qlist', function() {
    HelloWorldController::guru_list();
});

$routes->get('/edit', function() {
    HelloWorldController::guru_change();
});

$routes->get('/login', function() {
    MarketinguruController::login();
});

$routes->post('/login', function() {
    MarketinguruController::handle_login();
});

$routes->post('/logout', function() {
    MarketinguruController::logout();
});

$routes->get('/query', function() {
    HelloWorldController::guru_query();
});

$routes->get('/qsum', function() {
    HelloWorldController::guru_qsum();
});

$routes->get('/customers', function() {
    CustomerController::index();
});

$routes->post('/customers/new', function() {
    CustomerController::store();
});

$routes->get('/customers/new', function() {
    CustomerController::create();
});

$routes->get('/customers/delete/:id', function($id) {
    CustomerController::destroy($id);
});

$routes->get('/customers/consent/:id', function($id) {
    CustomerconsentController::find($id);
});

$routes->get('/customers/:id', function($id) {
    CustomerController::find($id);
});

$routes->post('/customers/:id', function($id) {
    CustomerController::update($id);
});



