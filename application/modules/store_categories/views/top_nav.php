<ul class="nav navbar-nav">
<?php
foreach ($parent_categories as $key => $value) {
	$parent_cat_id = $key;
	$parent_cat_title = $value;
?>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $parent_cat_title ?> <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li><a href="#">Action</a></li>
			<li><a href="#">Another action</a></li>
			<li><a href="#">Something else here</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#">Separated link</a></li>
			<li role="separator" class="divider"></li>
			<li><a href="#">One more separated link</a></li>
		</ul>
	</li>
<?php } ?>
</ul>