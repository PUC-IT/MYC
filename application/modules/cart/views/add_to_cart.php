<div style="margin-top: 25px; background-color: #ddd; border-radius: 7px; padding: 7px;">

<?php
echo form_open('store_basket/add_to_basket');
?>

	<table class="table">
		<tr>
			<td>Item ID :</td>
			<td><?= $item_id ?></td>
		</tr>

		<?php
		if ($num_colors>0) { ?>
		<tr>
			<td>Color :</td>
			<td>
				<?php
					$additional_dd_code = 'class="form-control"';
					echo form_dropdown('item_color', $color_options, $submitted_color, $additional_dd_code);
				?>
			</td>
		</tr>
		<?php
		}
		?>

		<?php
		if ($num_sizes>0) { ?>
		<tr>
			<td>Size :</td>
			<td>
				<?php
					$additional_dd_code = 'class="form-control"';
					echo form_dropdown('item_size', $size_options, $submitted_size, $additional_dd_code);
				?>
			</td>
		</tr>
		<?php
		}
		?>

		<tr>
			<td>QTY :</td>
			<td>
				<div class="col-sm-5" style="padding-left: 0px;">
					<input name="item_qty" type="text" class="form-control" placeholder="01">
				</div>
			</td>

			
			<!-- <td><div class="btn-minus"><input type="button" id="minus" value="-" class="qty"></div></td>
			<td><div class="box-input-qty"><input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control"></div></td>
			<td><div class="btn-plus"><input type="button" id="plus" value="+" class="qty"></div></td> -->
		</tr>
		
		<tr>
			<td colspan="2" style="text-align: center;">
				<button type="submit" name="submit" value="Submit" class="btn btn-primary" aria-hidden="true"><span class=" glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
			</td>
			
		</tr>
	</table>

	<?php
	echo form_hidden('item_id', $item_id);
	echo form_close();
	?>
</div>