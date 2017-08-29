<h1>Manage Homepage Offers</h1>
<?php
	$create_item_url = base_url()."homepage_blocks/create";
	$home_url =  base_url()."homepage_blocks/manage";
?>
<?php
if (isset($flash))
{
	echo $flash;
}
?>

<p style="margin-top: 30px;">
	<a href="<?= $create_item_url ?>"><button type="button" class="btn btn-primary">Create New Homepage Offer</button></a>
</p>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><a href="<?= base_url()?>homepage_blocks/manage" style="color: #fff; text-decoration-line: none;"><i class="icon-tasks"></i><span class="break">Homepage Offer Management</span></a></h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white home"></i></a>
			</div>
		</div>
		<div class="box-content">
		<?php
		echo Modules::run('homepage_blocks/_draw_sortable_list');
		?>

		</div>
	</div>
</div><!--/span-->