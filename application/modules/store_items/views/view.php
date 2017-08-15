<div class="row">
	<div class="col-md-5" style="margin-top: 25px;">
		<img src="<?= base_url() ?>big_pics/<?= $big_pic ?>" class="img-responsive" alt="Responsive image">
	</div>
	<div class="col-md-4">
		<h1><?= $item_title ?></h1>
		<div style="clear: both;">
			<?= nl2br($item_description) ?>
		</div>
	</div>
	<!-- Add to Cart -->
	<div class="col-md-3">
		<?= Modules::run('cart/_draw_add_to_cart', $update_id) ?>
	</div>
</div>























<!-- <div class="row">
	<div class="col-sm-6" style="margin-top: 25px; background-color: gray;">
		<img src="<?= base_url() ?>assets/images/big_pics/<?= $big_pic ?>" class="img-responsive" alt="Responsive image">
	</div>
	<div class="col-sm-6">
		<h1><?= $item_title ?></h1>
						
	</div>
</div> -->