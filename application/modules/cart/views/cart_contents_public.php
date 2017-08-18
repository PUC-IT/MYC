<div class="row">
<div class="col-md-12">
<table class="table table-stiped table-bordered">
		<thead class="cart_menu">
			<tr>
				<td class="col-md-2">Items</td>
				<td class="col-md-4">Product Detail</td>
				<td class="col-md-1">Price</td>
				<td class="col-md-1">QTY</td>
				<td class="col-md-2">Sub Total</td>
			</tr>
		</thead>
		<tbody>
		<?php
			$grand_total = 0;
			$item_total = 0;
			foreach ($query->result() as $row) { 
				$sub_total = $row->price*$row->item_qty;
				$sub_total_desc = number_format($sub_total, 2);
				$grand_total = $grand_total+$sub_total;
				$item_total = $item_total+$row->item_qty;
			?>
			<tr style="vertical-align: inherit;">
				<td class="col-md-2">
					<?php if ($row->small_pic!='') { ?>
						<img src="<?= base_url(); ?>small_pics/<?= $row->small_pic ?>">
					<?php 
					} else {
						echo "No Image avaliable!";
					}
					?>						
				</td>
				<td class="col-md-4" style="vertical-align: inherit;">
					<a href=""><?= $row->item_title ?></a>
					<p><?= $row->item_description ?></p>
				</td>
				<td class="col-md-1" style="vertical-align: inherit;">
					<?= $currency_symbol.$row->price ?>
				</td>
				<td class="col-md-2" style="vertical-align: inherit;">
					<div class="cart_quantity_button">
						<a class="cart_quantity_down" href=""> - </a>									
						<input class="cart_quantity_input" type="text" name="quantity" value="<?= $row->item_qty ?>" autocomplete="off" size="2">
						<a class="cart_quantity_up" href=""> + </a>
					</div>
				</td>
				<td class="col-md-2" style="text-align: center; vertical-align: inherit;">
					<?= $currency_symbol.$sub_total_desc ?>
				</td>
				<td style="vertical-align: inherit;">
					<a class="button" href=""><i class="fa fa-times"></i></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3" style="text-align: right;font-weight: bold;">Total</td>
				<td style="font-weight: bold; text-align: center;">
					<?= $item_total ?>
				</td>
				<td style="font-weight: bold; text-align: center;">
					<?php 
					$grand_total_desc = number_format($grand_total, 2);
					echo $currency_symbol.$grand_total_desc 
					?>
				</td>
			</tr>
		</tfoot>

	
	</table>
</div>
	
</div>


<!-- 
<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Sub Total</td>
							<td>Remove</td>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($query->result() as $row) { 
							$sub_total = $row->price*$row->item_qty;
							$sub_total_desc = number_format($sub_total, 2);
							
							?>
						<tr>
							<td class="cart_product">
								<a href="">
									<?php if ($row->small_pic!='') { ?>
									<img src="<?= base_url(); ?>small_pics/<?= $row->small_pic ?>">
									<?php 
									} else {
										echo "No Image avaliable!";
									}
									?>
								</a>
							</td>
							<td class="cart_description">
								<?= $row->item_title ?>
							</td>
							<td class="cart_price">
								<?= $currency_symbol.$row->price ?>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_down" href=""> - </a>									
									<input class="cart_quantity_input" type="text" name="quantity" value="0" autocomplete="off" size="2">
									<?= $row->item_qty ?>
									<a class="cart_quantity_up" href=""> + </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?= $currency_symbol.$sub_total ?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
					
				</table>
			</div> -->