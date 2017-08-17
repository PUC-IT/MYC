<h1>Manage Categories</h1>
<?php
	$create_item_url = base_url()."store_categories/create";
	$home_url =  base_url()."store_categories/manage";
?>
<?php
if (isset($flash))
{
	echo $flash;
}
?>

<p style="margin-top: 30px;">
	<a href="<?= $create_item_url ?>"><button type="button" class="btn btn-primary">Add New Category</button></a>
</p>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><a href="<?= base_url()?>store_categories/manage" style="color: #fff; text-decoration-line: none;"><i class="icon-tasks"></i><span class="break">    Category Management</span></a></h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white home"></i></a>
			</div>
		</div>
		<div class="box-content">

		<?php
			echo Modules::run('store_categories/_draw_sortable_list',  $parent_cat_id);
		?>
		

		</div>
	</div>
</div><!--/span-->