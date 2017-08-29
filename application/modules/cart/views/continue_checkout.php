<h2>Please Create An New Account now?</h2>
<p>You do need to crate an account with us, if you do then you'll be able to access:</p>
<p>
	<ul>
		<li>Order Tracking</li>
		<li>Downloadable your order form</li>
		<li>Priority Technical Support</li>
	</ul>
</p>
<p>Just take few minutes to finish creating an account!</p>
<p>Would you like to create an account now?</p>
<div class="col-md-10" style="margin-top: 36px;">
<?php
echo form_open('cart/submit_choice'); ?>
	<button type="submit" name="submit" value="Yes, Let's Do" class="btn btn-success" aria-hidden="true">
	<span class=" glyphicon glyphicon-thumbs-up"></span> Yes, Let's Do
	</button>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<button type="submit" name="submit" value="No, Thanks" class="btn btn-danger" aria-hidden="true">
	<span class=" glyphicon glyphicon-thumbs-down"></span> No, Thanks
	</button>

<?php 
echo form_hidden('checkout_token', $checkout_token);
echo form_close(); ?>
</div>