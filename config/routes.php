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

$routes->get('/drafts/customer/:id', function($id){
    CustomerController::find($id);
});
