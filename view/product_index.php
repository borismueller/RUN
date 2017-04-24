<?php
  foreach ($products as $product) {
      echo "name: ".$product->name."  ";
      echo "type_id: ".$product->type_id."  ";
      echo "type: ".$product->type."  ";
      echo "price: ".$product->price."  ";
      echo "<br>";
  }
?>
