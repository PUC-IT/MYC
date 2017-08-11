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
					<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Details</h2>
					<div class="box-icon">
						<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<?php
						$form_location = base_url()."webpages/create/".$update_id;
					?>
					<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="typeahead">Page Title </label>
								<div class="controls">
									<input type="text" class="span6" name="page_title" value="<?= $page_title ?>" requier="">
								</div>
							</div>
							<div class="control-group hidden-phone">
								<label class="control-label">Keywords</label>
								<div class="controls">
									<textarea class="span6" rows="3" name="page_keywords"><?php
									echo $page_keywords;
									?></textarea>
							</div>
							</div>
							<div class="control-group hidden-phone">
								<label class="control-label">Page Description</label>
								<div class="controls">
									<textarea class="span6" rows="3" name="page_description" ><?php
									echo $page_description;
									?></textarea>
									<?php echo form_error('page_keywords','<p style="color:red; display:inline-block;">','</p>'); ?>
								</div>
							</div>
							<div class="control-group hidden-phone">
								<label class="control-label" for="textarea2">Page Content</label>
								<div class="controls">
									<textarea class="cleditor" id="textarea2" rows="3" name="page_content">
									<?php echo $page_content;?>
									</textarea>
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