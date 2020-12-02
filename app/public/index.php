<?php

// General variables
$basePath = __DIR__ . '/../';
require $basePath . 'vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

// Define routes
$router->get('/', 'EventController@home');
$router->get('/events', 'EventController@events');

$router->get('/register-event', 'EventController@registerEvent');
$router->post('/register-event', 'EventController@registerEvent');

$router->get('/contact', 'EventController@contact');
$router->post('/contact', 'EventController@contact');

$router->get('/add-ticket', 'EventController@addTicket');
$router->post('/add-ticket', 'EventController@addTicket');

$router->get('/event-tickets', 'EventController@eventTickets');

$router->get('/ticket-info', 'EventController@ticketInfo');

// Run it!
$router->run();

