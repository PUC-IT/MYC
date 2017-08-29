<?php
echo form_open($form_location);
echo form_hidden('upload', '1');
echo form_hidden('cmd', '_cart');
echo form_hidden('business', $paypal_email);
echo form_hidden('currency_code', $currency_code);
echo form_hidden('custom', $custom);

$count=0;
foreach ($query->result() as $row) {
	$count++;
	$item_title = $row->item_title;
	$price = $row->price;
	$item_qty = $row->item_qty;
	$item_size = $row->item_size;
	$item_color = $row->item_color;

	echo form_hidden('item_name_'.$count, $item_title);
	echo form_hidden('amount_'.$count, $price);
	echo form_hidden('item_qty_'.$count, $item_qty);

	if($item_color!=''){
		echo form_hidden('on0_'.$count, 'Color');
		echo form_hidden('on0_'.$count, $item_color);
	}
	if($item_size!=''){
		echo form_hidden('on1_'.$count, 'Size');
		echo form_hidden('on1_'.$count, $item_size);
	}
}
	echo form_hidden('shipping_'.$count, $shipping);
?>

<div style="float: left;"><button type="submit" name="submit" value="Submit" class="btn btn-success" aria-hidden="true">
<span class=" glyphicon glyphicon-shopping-cart"></span>Checkout!
</button>
</div>

<div style="float: right;"><button type="submit" name="submit" value="Submit" class="btn btn-success" aria-hidden="true">
<span class=" glyphicon glyphicon-shopping-cart"></span> Continue Shopping
</button>
</div>

<?php




echo form_close();