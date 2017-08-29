<?php
foreach ($query->result() as $row) {
$item_title = $row->item_title;
$small_pic = $row->small_pic;
$item_price = $row->item_price;
$was_price = $row->was_price;
$small_pic_path = base_url()."small_pics/".$small_pic;
$item_page = base_url().$item_segments."/".$row->item_url;
$item_price = number_format($row->item_price, 2);
$item_price = str_replace('.00', '', $item_price);
?>

<div class="col-sm-3">
	<div class="product-image-wrapper offer offer-<?= $theme ?>">
	<div class="shape">
			<div class="shape-text">
				<span class="glyphicon glyphicon-star-empty" aria-hidden="true" style="font-size: 18px;"></span>
			</div>
		</div>
		<div class="single-products offer-content">
		<h3 class="lead">
			<div style="clear: both; color:red; font-weight: bold;">Price: <?= $dollar_symbol.$item_price ?></div>
			</h3>
			<div class="productinfo text-center">
				<a href="<?= $item_page ?>"><img src="<?= $small_pic_path ?>" alt="<?= $item_title ?>" class="img-responsive"></a>
				<h6><a href="<?= $item_page ?>"><?= $item_title  ?></a></h6>
				
				<a href="<?= $item_page ?>" class="btn btn-default btn-<?= $theme ?>" style="margin-bottom: 24px;"><i class="fa fa-shopping-cart"></i>View Detail</a>
			</div>
		</div>
	</div>
</div>


<!-- <div class="col-xs-3 col-md-4 col-sm-6 col-xs-12">
	<div class="offer offer-<?= $theme ?>">
		<div class="shape">
			<div class="shape-text">
				<span class="glyphicon glyphicon-star-empty" aria-hidden="true" style="font-size: 18px;"></span>
			</div>
		</div>
		<div class="offer-content">
			<h3 class="lead">
			<div style="clear: both; color:red; font-weight: bold;"><?= $dollar_symbol.$item_price ?></div>
			</h3>
			<a href="<?= $item_page ?>"><img src="<?= $small_pic_path ?>" alt="<?= $item_title ?>" class="img-responsive"></a>
			<a href="<?= $item_page ?>"><?= $item_title  ?></a>
		</div>
	</div>
</div> -->
<?php }
?>