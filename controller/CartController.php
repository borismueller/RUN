<?php

require_once '../repository/ProductRepository.php';
require_once '../repository/TypeRepository.php';

/**
* Siehe Dokumentation im DefaultController.
*/
class CartController
{
  public function index() {
      $productRepository = new ProductRepository();
      $typeRepository = new TypeRepository();

      if (!empty($_SESSION['cart']['products'])) {
        $cart = $_SESSION['cart'];
        $productIds = $cart['products'];

        $products = array();

        foreach ($productIds as $id) {
          $products[] = $productRepository->readById($id);
        }

				$fullPrice = 0;
        foreach ($products as $product) {
          //add the name of the type to the array & and add up price
          $product->type = $typeRepository->readById($product->type_id)->name;
					$fullPrice += $product->price;
        }

				$view = new View('cart_index');
	      $view->title = 'go';
	      $view->products = $products; //add products to the view so we can later display them
				$view->fullPrice = $fullPrice;
				$view->display();
      } else {
				echo "you don't have any items in your cart";
				//TODO
			}
  }

  public function addToCart() {
      if (isset($_GET['id'])) {
        $productId = $_GET['id'];
      } else {
        throw new Exception("No id", 1);
        //TODO
      }
      echo $productId;
      if (empty($_SESSION['cart']['products'])) {
        $_SESSION['cart']['products'] = array();
      }


      if (!empty($_SESSION['username'])) {
        $_SESSION['cart']['user'] = $_SESSION['username'];
      }

      //TODO: only add if id doesn't already exist
      $_SESSION['cart']['products'][count($_SESSION['cart']['products'])] = $productId;
  }

  public function removeFromCart() {
      if (isset($_GET['id'])) {
        $productId = $_GET['id'];
      } else {
        throw new Exception("No id", 1);
        //TODO
      }

      //can only remove the first instance
      $key = array_search($productId, $_SESSION['cart']['products']);

      //removes the element from the array and keeps indexes correct
      array_splice($_SESSION['cart']['products'], $key, 1);
    }
}
