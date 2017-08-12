<h1>Content Management System</h1>
<?php
	$create_page_url = base_url()."blogs/create";
?>
<?php
if (isset($flash))
{
	echo $flash;
}
?>

<p style="margin-top: 30px;">
	<a href="<?= $create_page_url ?>"><button type="button" class="btn btn-primary">Create New Webpage</button></a>
</p>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white tag"></i><span class="break"></span>Custom Site</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
					<tr>
						<th>Page Url</th>
						<th>Page Title</th>
						<th class="span3">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($query->result() as $row)
					{ 
						$edit_page_url = base_url()."blogs/create/".$row->id;
						$view_page_url = base_url().$row->page_url;
						$del_page_url = base_url()."blogs/deleteconf/".$row->id;
					?>
					<tr>
						<td class="col-md-4"><?= $view_page_url ?></td>
						<td class="center" class="col-md-4"><?= $row->page_title ?></td>
						
						<td class="center" class="col-md-4">
							<a class="btn btn-success" href="<?= $view_page_url ?>" target="blank;">
								<i class="halflings-icon white zoom-in"></i>
							</a> 
							<a class="btn btn-info" href="<?= $edit_page_url ?>">
								<i class="halflings-icon white edit"></i>
							</a>
							<a class="btn btn-danger" href="<?= $del_page_url ?>">
								<i class="halflings-icon white trash"></i>
							</a>
						</td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div><!--/span-->