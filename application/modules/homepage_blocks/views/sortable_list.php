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
	$this->load->module('homepage_blocks');
	foreach ($query->result() as $row)
	{
	$edit_item_url = base_url()."homepage_blocks/create/".$row->id;
	$view_item_url = base_url()."homepage_blocks/view/".$row->id;
	$block_title = $row->block_title;
	?>
	<li class="sort" id="<?= $row->id ?>"><i class="icon-sort"></i><?= $row->block_title ?>
	<?= $block_title ?>
	
<a class="btn btn-info" href="<?= $edit_item_url ?>">
			<i class="halflings-icon white edit"></i>
		</a>
		<?php
		$num_items = 0;
		if ($num_items<1) {
			echo "&nbsp;";
		} else{
		if ($num_items==1) {
			$entity = "Homepage Offer";
		} else{
			$entity = "Homepage Offers";
		} 

		$sub_cat_url = base_url()."homepage_blocks/manage/".$row->id;

		?>
		<a class="btn btn-defualt" href="<?= $sub_cat_url ?>">
			<i class="halflings-icon white zoom-in"></i>ehll
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