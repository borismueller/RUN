<?php

require_once '../repository/ProductRepository.php';
require_once '../repository/TypeRepository.php';

/**
* Siehe Dokumentation im DefaultController.
*/
class ProductController
{
  public function index() {
    $productRepository = new ProductRepository();
    $typeRepository = new TypeRepository();
    $products = $productRepository->readAll();

    foreach ($products as $product) {
      //add the name of the type to the array
      $product->type = $typeRepository->readById($product->type_id)->name;
    }

    $view = new View('product_index');
    $view->title = 'go';
    $view->products = $products; //add products to the view so we can later display them
    $view->display();
  }

  public function search()
  {
    $name = $_GET['name'];

    $productRepository = new ProductRepository();
    $typeRepository = new TypeRepository();
    $products = $productRepository->readByName($name);

    foreach ($products as $product) {
      $product->type = $typeRepository->readById($product->type_id)->name;
    }

    $productsArray[] = $products;

    $view = new View('product_index');
    $view->title = 'go';
    $view->products = $productsArray;
    $view->display();

    //header("location:/product");
  }
}
