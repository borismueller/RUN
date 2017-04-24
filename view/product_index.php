<?php
  foreach ($products as $product) {
      echo "<div style='width: 100%;'>";
      echo "<a href='/cart/addToCart?id=$product->id'> add to cart </a>";
      echo "name: ".$product->name."  ";
      echo "type_id: ".$product->type_id."  ";
      echo "type: ".$product->type."  ";
      echo "price: ".$product->price."  ";
      echo "</div>";
  }

  echo "<br>";
?>
