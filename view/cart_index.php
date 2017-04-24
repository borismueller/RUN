<?php
//var_dump($products);


foreach ($products as $product) {
    echo "<div>";
    echo "<a href='/cart/removeFromCart?id=$product->id'> remove from cart </a>";
    echo "name: ".$product->name."  ";
    echo "type_id: ".$product->type_id."  ";
    echo "type: ".$product->type."  ";
    echo "price: ".$product->price."  ";
    echo "</div>";
}

?>
