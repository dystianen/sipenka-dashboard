<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function () {
  return redirect()->to('/login');
});

$routes->get('login', 'AuthController::login');
$routes->post('login/store', 'AuthController::loginStore');
$routes->get('logout', 'AuthController::logout');

$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'authGuard']);

/** ================================= 
 *          WEB DASHBOARD
 * ================================== */
$routes->group('teachers', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'TeacherController::index');
  $routes->get('form', 'TeacherController::form');
  $routes->post('save', 'TeacherController::save');
  $routes->post('delete/(:num)', 'TeacherController::delete/$1');
});

$routes->group('users', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'UserController::index');
  $routes->get('form', 'UserController::form');
  $routes->post('save', 'UserController::save');
  $routes->post('delete/(:num)', 'UserController::delete/$1');
});

$routes->group('criteria', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'CriteriaController::index');
  $routes->get('form', 'CriteriaController::form');
  $routes->post('save', 'CriteriaController::saveAll');
  $routes->post('delete/(:num)', 'CriteriaController::delete/$1');
});

$routes->group('pairwise-comparison', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'PairwiseController::index');
  $routes->get('form', 'PairwiseController::form');
  $routes->post('save', 'PairwiseController::save');
  $routes->post('delete/(:num)', 'PairwiseController::delete/$1');
});

$routes->group('performance-assesment', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'PerformanceController::index');
  $routes->get('(:num)', 'PerformanceController::pageCriteria');
  $routes->get('(:num)/(:num)', 'PerformanceController::pageEvaluation/$1/$2');
  $routes->get('form', 'PerformanceController::form');
  $routes->post('save', 'PerformanceController::save');
  $routes->post('delete/(:num)', 'PerformanceController::delete/$1');
});
