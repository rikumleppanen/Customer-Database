<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

function check_admin_rights() {
    BaseController::check_admin_rights();
}

$routes->get('/', function() {
    HelloWorldController::index();
});
//
//$routes->get('/hiekkalaatikko', function() {
//    HelloWorldController::sandbox();
//});
//
//$routes->get('/qlist', function() {
//    HelloWorldController::guru_list();
//});
//$routes->get('/edit', function() {
//    HelloWorldController::guru_change();
//});

$routes->get('/login', function() {
    MarketinguruController::login();
});

$routes->post('/login', function() {
    MarketinguruController::handle_login();
});

$routes->post('/logout', function() {
    MarketinguruController::logout();
});

$routes->get('/query', 'check_logged_in', function() {
    HelloWorldController::guru_query();
});

$routes->get('/qsum', 'check_logged_in', function() {
    HelloWorldController::guru_qsum();
});

$routes->get('/customers', 'check_logged_in', function() {
    CustomerController::index();
});

$routes->post('/customers/new', 'check_logged_in', function() {
    CustomerController::store();
});

$routes->post('/customers/new', 'check_logged_in', function() {
    CustomerController::create();
});

$routes->get('/customers/new', 'check_logged_in', function() {
    CustomerController::create();
});

$routes->get('/customers/delete/:id', 'check_logged_in', function($id) {
    CustomerController::destroy($id);
});

$routes->get('/customers/:id', 'check_logged_in', function($id) {
    CustomerController::find($id);
});

$routes->post('/customers/modify/:id', 'check_logged_in', function($id) {
    CustomerController::update($id);
});

$routes->get('/customers/modify/:id', 'check_logged_in', function($id) {
    CustomerController::modify($id);
});

$routes->get('/customers/modify/:id', 'check_logged_in', function($id) {
    CustomerController::find($id);
});

$routes->post('/customers/modifyerror/:id', 'check_logged_in', function($id) {
    CustomerController::update($id);
});

$routes->get('/customers/modifyerror/:id', 'check_logged_in', function($id) {
    CustomerController::modifyerror($id);
});

$routes->get('/users', 'check_admin_rights', function() {
    MarketinguruController::index();
});

$routes->post('/users/new', 'check_admin_rights', function() {
    MarketinguruController::store();
});

$routes->get('/users/new', 'check_admin_rights', function() {
    MarketinguruController::create();
});

$routes->get('/users/:id', 'check_admin_rights', function($id) {
    MarketinguruController::find($id);
});

$routes->post('/users/:id', 'check_admin_rights', function($id) {
    MarketinguruController::update($id);
});

$routes->get('/users/delete/:id', 'check_admin_rights', function($id) {
    MarketinguruController::destroy($id);
});


