<h1><?= $headline ?></h1>
<?php
if (isset($flash))
{
	echo $flash;
}
?>

<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Create New Homepage Offer</h2>
				<a href="<?= base_url()?>homepage_blocks/manage" style="color: #fff; text-decoration-line: none;"><span class="break">    Back</span></a>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<?php
					$form_location = base_url()."homepage_blocks/create/".$update_id;
				?>
				<form class="form-horizontal" method="post" action="<?= $form_location ?>">
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="typeahead">Offer Block Title </label>
							<div class="controls">
								<input type="text" class="span4" name="block_title" value="<?= $block_title ?>">
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