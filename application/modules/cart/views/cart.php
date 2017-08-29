<h1>Your Shopping Cart Items</h1>

<?php
if ($num_rows<1) {
	echo "<p>You currently have no item in your Shopping Cart.</p>";
} else {
	echo "<p>".$showing_statement."</p>";
	$user_type = 'public';
	echo Modules::run('cart/_attempt_draw_checkout_btn', $query);
	echo Modules::run('cart/_draw_cart_contents', $query, $user_type);
	
}
?>