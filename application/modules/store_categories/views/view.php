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
<div class="col-md-2 img-thumbnail" style="margin: 6px; height: 350px;">
	<a href="<?= $item_page ?>"><img src="<?= $small_pic_path ?>" alt="<?= $item_title ?>" class="img-responsive"></a>
	<br>
	<h6><a href="<?= $item_page ?>"><?= $item_title  ?></a></h6>
	<div style="clear: both; color:red; font-weight: bold;"><?= $dollar_symbol.number_format($item_price,2) ?>.0
	<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
	
	</div>
</div>

<?php
}
?>
<div style="clear: both;"></div>

<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#womens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Womens
										</a>
									</h4>
								</div>
								<div id="womens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="#">Fendi</a></li>
											<li><a href="#">Guess</a></li>
											<li><a href="#">Valentino</a></li>
											<li><a href="#">Dior</a></li>
											<li><a href="#">Versace</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Kids</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Fashion</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Households</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Interiors</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Clothing</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Bags</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Shoes</a></h4>
								</div>
							</div>
						</div><!--/category-products-->
						
					</div>
				</div>
				</div>
				</div>
				</section>
				
