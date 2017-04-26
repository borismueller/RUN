<?php
//var_dump($products);

if (!empty($products)) {
	foreach ($products as $product) {
	    echo "<div style='width: 100%;'>";
	    echo "<a href='/cart/removeFromCart?id=$product->id'> remove from cart </a>";
	    echo "name: ".$product->name."  ";
	    echo "type_id: ".$product->type_id."  ";
	    echo "type: ".$product->type."  ";
	    echo "price: ".$product->price."  ";
	    echo "</div>";
	}

	echo "Total price: ";
	echo $fullPrice;
} else {
	echo "you don't have any items in your cart";
}

?>
