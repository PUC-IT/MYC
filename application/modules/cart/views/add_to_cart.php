<div style="margin-top: 25px; background-color: #ddd; border-radius: 7px; padding: 7px;">
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
					echo form_dropdown('status', $color_options, $submitted_color, $additional_dd_code);
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
					echo form_dropdown('status', $size_options, $submitted_size, $additional_dd_code);
				?>
			</td>
		</tr>
		<?php
		}
		?>

		<tr>
			<td>Quantity :</td>
			<td>
				<div class="col-sm-5" style="padding-left: 0px;">
					<input type="text" class="form-control">
				</div>
			</td>

			
			<!-- <td><div class="btn-minus"><input type="button" id="minus" value="-" class="qty"></div></td>
			<td><div class="box-input-qty"><input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control"></div></td>
			<td><div class="btn-plus"><input type="button" id="plus" value="+" class="qty"></div></td> -->
		</tr>
		
		<tr>
			<td colspan="2" style="text-align: center;">
				<button type="submit" class="btn btn-primary" aria-hidden="true"><span class=" glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
			</td>
			
		</tr>
	</table>
</div>