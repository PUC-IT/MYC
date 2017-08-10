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
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Account Options</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<a href="<?= base_url() ?>store_accounts/update_pword/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Account Password</button></a>
			<a href="<?= base_url() ?>store_account_sizes/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Account Sizes</button></a>
			<a href="<?= base_url() ?>store_accounts/"><button type="button" class="btn btn-primary">Update Account Categories</button></a>
			<a href="<?= base_url() ?>store_accounts/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Account</button></a>
			<a href="<?= base_url() ?>store_accounts/view/<?= $update_id ?>"><button type="button" class="btn btn-defualt">View Account on Shop</button></a>
		</div>
		</div><!--/span-->
		</div><!--/row-->
		<?php
		}
		?>
		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header" data-original-title>
					<h2><i class="halflings-icon white edit"></i><span class="break"></span>Account Details</h2>
					<div class="box-icon">
						<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<?php
						$form_location = base_url()."store_accounts/create/".$update_id;
					?>
					<form class="form-horizontal" method="post" action="<?= $form_location ?>">
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="typeahead"> First Name</label>
								<div class="controls">
									<input type="text" class="span4 form-control" name="firstname" value="<?= $firstname ?>">
									<?php echo form_error('firstname','<p style="color:red; display:inline-block;">','</p>'); ?>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="typeahead">Last Name</label>
								<div class="controls">
									<input type="text" class="span4" name="lastname" value="<?= $lastname ?>">
									<?php echo form_error('lastname','<p style="color:red; display:inline-block;">','</p>'); ?>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="typeahead">Company</label>
								<div class="controls">
									<input type="text" class="span4" name="company" value="<?= $company ?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="typeahead">Address line 1</label>
								<div class="controls">
									<input type="text" class="span4" name="address1" value="<?= $address1 ?>">

								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="typeahead">Address line 2</label>
								<div class="controls">
									<input type="text" class="span4" name="address2" value="<?= $address2 ?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="typeahead">Town</label>
								<div class="controls">
								<input type="text" class="span4" name="town" value="<?= $town ?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="typeahead">Country</label>
								<div class="controls">
									<input type="text" class="span4" name="country" value="<?= $country ?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="typeahead">Postcode</label>
								<div class="controls">
									<input type="text" class="span4" name="postcode" value="<?= $postcode ?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="typeahead">Telephone</label>
								<div class="controls">
									<input type="text" class="span4" name="telnum" value="<?= $telnum ?>">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="typeahead">Email</label>
								<div class="controls">
									<input type="text" class="span4" name="email" value="<?= $email ?>">
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