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
$routes->group('users', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'UserController::index');
  $routes->get('form', 'UserController::form');
  $routes->post('save', 'UserController::save');
  $routes->post('delete/(:num)', 'UserController::delete/$1');
});

$routes->group('teachers', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'TeacherController::index');
  $routes->get('form', 'TeacherController::form');
  $routes->post('save', 'TeacherController::save');
  $routes->post('delete/(:num)', 'TeacherController::delete/$1');
});

$routes->group('periods', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'PeriodController::index');
  $routes->get('form', 'PeriodController::form');
  $routes->post('save', 'PeriodController::save');
  $routes->post('delete/(:num)', 'PeriodController::delete/$1');
});

$routes->group('criteria', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'CriteriaController::index');
  $routes->get('form', 'CriteriaController::form');
  $routes->post('save', 'CriteriaController::save');
  $routes->post('delete/(:num)', 'CriteriaController::delete/$1');
});

$routes->group('question-subcategories', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'SubcategoryController::index');
  $routes->get('by-category/(:num)', 'SubcategoryController::getByCategory/$1');
  $routes->get('form', 'SubcategoryController::form');
  $routes->post('save', 'SubcategoryController::save');
  $routes->post('delete/(:num)', 'SubcategoryController::delete/$1');
});

$routes->group('questions', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'QuestionController::index');
  $routes->get('form', 'QuestionController::form');
  $routes->post('save', 'QuestionController::save');
  $routes->post('delete/(:num)', 'QuestionController::delete/$1');
});

$routes->group('pairwise-comparison', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'PairwiseController::index');
  $routes->get('form', 'PairwiseController::form');
  $routes->post('save', 'PairwiseController::save');
  $routes->post('delete/(:num)', 'PairwiseController::delete/$1');
});

$routes->group('performance-assesment', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'PerformanceController::index');
  $routes->get('(:num)', 'PerformanceController::pageCriteria/$1');
  $routes->get('(:num)/(:num)', 'PerformanceController::pageEvaluation/$1/$2');
  $routes->get('form', 'PerformanceController::form');
  $routes->post('save', 'PerformanceController::save');
  $routes->post('delete/(:num)', 'PerformanceController::delete/$1');
});

$routes->group('ahp', ['filter' => 'authGuard'], function ($routes) {
  $routes->post('calculate', 'AhpResultsController::calculateAHP');
});

$routes->group('evaluation-results', ['filter' => 'authGuard'], function ($routes) {
  $routes->get('', 'EvaluationController::index');
  $routes->get('pdf/generate', 'PdfController::generate');
});
