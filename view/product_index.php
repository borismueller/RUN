<?php
foreach ($products as $product): ?>
<div style='width: 100%;'>
  <a href='/cart/addToCart?id=$product->id'> add to cart </a>
  <div><?=$product->name?></div>
  <div><?=$product->type_id?></div>
  <div><?=$product->type?></div>
  <div><?=$product->price?></div>
</div>
<?php   endforeach;

echo "<br>";
?>
