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

$routes->get('/drafts/qchange', function() {
    HelloWorldController::guru_change();
});


$routes->get('/drafts/query', function() {
    HelloWorldController::guru_query();
});

