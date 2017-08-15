<h1><?= $cat_title ?></h1>

<?php
foreach ($query->result() as $row) {
$item_title = $row->item_title;
$small_pic = $row->small_pic;
$item_price = $row->item_price;
//$was_price = $row->was_price;
$small_pic_path = base_url()."small_pics/".$small_pic;
$item_page = base_url().$item_segments."/".$row->item_url;
?>
<div class="col-md-2 img-thumbnail" style="margin: 6px; height: 300px;">
	<a href="<?= $item_page ?>"><img src="<?= $small_pic_path ?>" alt="<?= $item_title ?>" class="img-responsive"></a>
	<br>
	<h6><a href="<?= $item_page ?>"><?= $item_title  ?></a></h6>
	<div style="clear: both; color:red; font-weight: bold;"><?= $dollar_symbol.number_format($item_price,2) ?>
	
	</div>
</div>

<?php
}
?>