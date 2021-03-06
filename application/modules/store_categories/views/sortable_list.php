<style>
	.sort{
		list-style: none;
		border:  1px #999 solid;
		color:#333;
		padding: 10px;
		margin-bottom: 5px;
		width: 30%;
	}
</style>

<ul id="sortlist">
	<?php
	$this->load->module('store_categories');
	foreach ($query->result() as $row)
	{
	$num_sub_cats = $this->store_categories->_count_sub_cats($row->id);
	$edit_item_url = base_url()."store_categories/create/".$row->id;
	$view_item_url = base_url()."store_categories/view/".$row->id;
	if ($row->parent_cat_id==0) {
		$parent_cat_title = "&nbsp;";
	} else{
		$parent_cat_title = $this->store_categories->_get_cat_title($row->parent_cat_id);
	}
	?>
	<li class="sort" id="<?= $row->id ?>"><i class="icon-sort"></i><?= $row->cat_title ?>
	<?= $parent_cat_title ?>
	
<a class="btn btn-info" href="<?= $edit_item_url ?>">
			<i class="halflings-icon white edit"></i>
		</a>
		<?php if ($num_sub_cats<1) {
			echo "&nbsp;";
		} else{
		if ($num_sub_cats==1) {
			$entity = "Category";
		} else{
			$entity = "Categories";
		} 
		$sub_cat_url = base_url()."store_categories/manage/".$row->id;
		?>
		<a class="btn btn-defualt" href="<?= $sub_cat_url ?>">
			<i class="halflings-icon white zoom-in"></i>
			<?php echo $num_sub_cats." ".$entity; ?>
		</a>

		<a class="btn btn-info" href="<?= $edit_item_url ?>">
			<i class="halflings-icon white edit"></i>
		</a>
		<?php
		}
		?>

	</li>
	<?php
	}?>
</ul>