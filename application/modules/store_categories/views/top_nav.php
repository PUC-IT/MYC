<ul class="nav navbar-nav">
	<?php
	$this->load->module('store_categories');
	foreach ($parent_categories as $key => $value) {
		$parent_cat_id = $key;
		$parent_cat_title = $value;
	?>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $parent_cat_title ?> <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<?php
			$query = $this->store_categories->get_where_custom('parent_cat_id', $parent_cat_id);
			foreach ($query->result() as $row) {
				$cat_url = $row->cat_url;
				echo '<li><a href="'.$target_url_start.$cat_url.'">'.$row->cat_title.'</a></li>';
			}
			?>
		</ul>
	</li>
	<?php } ?>
</ul>

<style>
.dropdown-menu > li.kopie > a {
padding-left:5px;
}

.dropdown-submenu {
position:relative;
}
.dropdown-submenu>.dropdown-menu {
top:0;left:100%;
margin-top:-6px;margin-left:-1px;
-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;
}

.dropdown-submenu > a:after {
border-color: transparent transparent transparent #333;
border-style: solid;
border-width: 5px 0 5px 5px;
content: " ";
display: block;
float: right;
height: 0;
margin-right: -10px;
margin-top: 5px;
width: 0;
}

.dropdown-submenu:hover>a:after {
border-left-color:#555;
}
.dropdown-menu > li > a:hover, .dropdown-menu > .active > a:hover {
text-decoration: none;
}

@media (max-width: 767px) {
.navbar-nav  {
display: inline;
}
.navbar-default .navbar-brand {
display: inline;
}
.navbar-default .navbar-toggle .icon-bar {
background-color: #fff;
}
.navbar-default .navbar-nav .dropdown-menu > li > a {
color: red;
background-color: #ccc;
border-radius: 4px;
margin-top: 2px;
}
.navbar-default .navbar-nav .open .dropdown-menu > li > a {
color: #333;
}
.navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
.navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
background-color: #ccc;
}
.navbar-nav .open .dropdown-menu {
border-bottom: 1px solid white;
border-radius: 0;
}
.dropdown-menu {
padding-left: 10px;
}
.dropdown-menu .dropdown-menu {
padding-left: 20px;
}
.dropdown-menu .dropdown-menu .dropdown-menu {
padding-left: 30px;
}
li.dropdown.open {
border: 0px solid red;
}
}

@media (min-width: 768px) {
ul.nav li:hover > ul.dropdown-menu {
display: block;
}
#navbar {
text-align: center;
}
}
</style>