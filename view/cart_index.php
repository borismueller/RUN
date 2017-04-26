<?php
//var_dump($products);

if (!empty($products)) {
	foreach ($products as $product) : ?>
		<div style='width: 100%;'>
			<a href='/cart/removeFromCart?id=<?=$product->id?>'> remove from cart </a>
			<div><?=$product->name?></div>
			<div><?=$product->type_id?></div>
			<div><?=$product->type?></div>
			<div><?=$product->price?></div>
		</div>
	<?php	endforeach;

	echo "Total price: ";
	echo $fullPrice;
} else {
	echo "you don't have any items in your cart";
}

?>
