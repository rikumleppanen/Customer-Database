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

$routes->get('/login', function() {
    MarketinguruController::login();
});

$routes->post('/login', function() {
    MarketinguruController::handle_login();
});

$routes->post('/logout', function() {
    MarketinguruController::logout();
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

$routes->get('/drafts/customer/consent/:id', function($id) {
    CustomerconsentController::find($id);
});

$routes->get('/drafts/customer/:id', function($id) {
    CustomerController::find($id);
});

$routes->post('/drafts/customer/:id', function($id) {
    CustomerController::update($id);
});



