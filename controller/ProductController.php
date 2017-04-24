<?php

require_once '../repository/UserRepository.php';

/**
* Siehe Dokumentation im DefaultController.
*/
class ProductController
{
  public function index() {
    $view = new View('Product index');
    $view->title = 'go';
    $view->display();
  }
}
