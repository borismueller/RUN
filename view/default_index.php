
<?php
echo "<br>";

require getcwd().'\vendor\autoload.php';
require_once '../repository/CartRepository.php';

use Phpml\Classification\KNearestNeighbors;
/*
$samples = [[1, 2], [3, 4], [5, 6], [2, 1], [4, 3], [6, 5]];
$labels = ['a', 'a', 'a', 'b', 'b', 'b'];

$classifier = new KNearestNeighbors();
$classifier->train($samples, $labels);

$res1 = $classifier->predict([2, 1]);

echo $res1."\n";

echo "<br>";

$samples = [['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta'], ['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta']];
$labels  = [];

use Phpml\Association\Apriori;

$associator = new Apriori($support = 0.5, $confidence = 0.5);
$associator->train($samples, $labels);

$res2 = $associator->predict(['alpha','beta']);
// return [[['beta']]]
var_dump($res2);

echo "<br>";

$res3 = $associator->predict([['alpha','epsilon'],['beta','theta']]);
// return [[['beta']], [['alpha']]]
var_dump($res3);

echo "<br>";
echo "<br>";
echo "<br>";



$cartRepository = new CartRepository();
$carts = $cartRepository->readAll();
$users = array ();
$samples = array();

foreach ($carts as $cart) {
	//get all individual users and products
	if (!in_array($cart->user_id, $users)) {
		$users[]['user'] = $cart->user_id;
	}
}

foreach ($carts as $cart) {
	$pid = $cart->product_id;
	$uid = $cart->user_id;
	$pos = array_search($uid, $users);
	//$users[$pos] = array();
	$users[$pos]['product'] = array();
	$users[$pos]['product'] = $pid;
}

foreach($users as $user => $key){
	var_dump($user);
	echo "<br>";
	var_dump($user['user']);
	echo "<br>";
	var_dump($user['product']);
	echo "<br>";
}

var_dump($users);
echo "<br>";


echo "<br>";
use Phpml\Association\Apriori;

//$samples = [['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta'], ['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta']];
$labels  = [];

$associator = new Apriori($support = 0.5, $confidence = 0.5);
$associator->train($samples, $labels);

*/











$cartRepository = new CartRepository();
$carts = $cartRepository->readAll();

$users = array();

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}

foreach ($carts as $cart) {
	//var_dump($cart);
	echo "<br>";
	if (!in_array_r($cart->user_id, $users)) {
		$users[] = [$cart->user_id];
	}
}

foreach ($users as $key => $user) {
	$users[$key]['prods'] = array();
	$prods = $cartRepository->readByUser_Id($user[0]);
	$products = array();
	foreach ($prods as $prod) {
		$products[] = $prod->product_id;
	}
	$users[$key]['prods'] = $products;
}

$samples = array();

foreach ($users as $user) {
	$samples[] = $user;
	/*echo "<br>";
	echo "prods: ";
	var_dump($user['prods']);
	echo "<br>";
	echo "user: ";
	echo "\t";
	var_dump($user);
	echo "<br>";*/
}

$products = array();
foreach ($samples as $sample) {
	$products[] = $sample['prods'];
	echo "<br>";
	//var_dump($sample['prods']);
	echo "<br>";
}

foreach ($products as $product) {
	//var_dump($product);
	//echo "prod<br>";
}

use Phpml\Association\Apriori;

//$samples = [['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta'], ['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta']];
//$products = [[1, 2], [3, 4], [2, 1], [4, 3]];



$labels  = [];

$associator = new Apriori($support = 0.5, $confidence = 0.5);
$associator->train($products, $labels);

//var_dump($products);

$predNumb = 1;
echo "$predNumb pred: ";
$res = $associator->predict([$predNumb]);
var_dump($res);

?>
