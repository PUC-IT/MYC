<h1><?= $headline ?></h1>
<?php
if (isset($flash))
{
	echo $flash;
}

if (is_numeric($update_id)) 
{ 
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Options</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php
			if ($big_pic=="") { ?>
				<a href="<?= base_url() ?>store_items/upload_image/<?= $update_id ?>"><button type="button" class="btn btn-primary">Upload Item Image</button></a>
			<?php
			} else 
			{ ?>
				<a href="<?= base_url() ?>store_items/delete_image/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Item Image</button></a>
			<?php
			}
			?>
			<a href="<?= base_url() ?>store_item_colors/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Item Colors</button></a>
			<a href="<?= base_url() ?>store_item_sizes/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Item Sizes</button></a>
			<a href="<?= base_url() ?>store_cat_assign/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Item Categories</button></a>
			<a href="<?= base_url() ?>store_items/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Item</button></a>
			<a href="<?= base_url() ?>store_items/view/<?= $update_id ?>"  target="blank;"><button type="button" class="btn btn-defualt">View Item on Shop</button></a>
		</div>
	</div><!--/span-->
</div><!--/row-->
<?php
}
?>



	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Details</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<?php
					$form_location = base_url()."store_items/create/".$update_id;
				?>
				<form class="form-horizontal" method="post" action="<?= $form_location ?>">
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="typeahead">Item Title </label>
							<div class="controls">
								<input type="text" class="span6" name="item_title" value="<?= $item_title ?>" requier="">
								<?php echo form_error('item_title','<p style="color:red; display:inline-block;">','</p>'); ?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="typeahead">Item Price </label>
							<div class="controls">
								<input type="text" class="span1" name="item_price" value="<?= $item_price ?>">
								<?php echo form_error('item_price','<p style="color:red; display:inline-block;">','</p>'); ?>
							</div>
							
						</div>
						<div class="control-group">
							<label class="control-label" for="typeahead">Was Price <span style="color: green;">(optional)</span></label>
							<div class="controls">
								<input type="text" class="span1" name="was_price" value="<?= $was_price ?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="typeahead">Status </label>
							<div class="controls">
								<?php
									$additional_dd_code = 'id="selectError3"';
									$options = array(
													'' => 'Please select...',
													'1' => 'Active',
													'0' => 'Inactive',);
									echo form_dropdown('status', $options, $status, $additional_dd_code);
								?>
							</div>
						</div>
						<div class="control-group hidden-phone">
							<label class="control-label" for="textarea2">Item Description</label>
							<div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3" name="item_description"><?php
								echo $item_description;
								?></textarea>
								<?php echo form_error('item_description','<p style="color:red; display:inline-block;">','</p>'); ?>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-primary" name="submit" value="Submit">Save changes</button>
							<button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div><!--/span-->
	</div><!--/row-->

<!-- <?php
if ($big_pic!="") { ?> -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Images</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<img src="<?= base_url() ?>big_pics/<?= $big_pic ?>">
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- <?php
}
?> -->


<div id="" class="tabs-panel">
<input type="hidden" name=" value="0">
<ul id="categorychecklist" data-wp-lists="list:category" class="categorychecklist form-no-clear">
				
<li id="$cat_id">
<label class="selectit">
<input value="" type="checkbox" name="" id=""> Laptop
</label>
</li>

</ul>
</div>