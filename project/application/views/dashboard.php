<html>
<head>
  <title>MyDashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/dash.css"); ?>">
</head>
	<body>
		
		    <nav class="navbar navbar-inverse">
		  	<div class="container-fluid">
	    		<ul class="nav navbar-nav">
	    		    <li class="active"><a href="<?php echo base_url("welcome/dashboard"); ?>">DashBoard</a></li>
		      		<li><a href="<?php echo base_url("welcome/profile_manager"); ?>">Profile Manager</a></li>
		      		<li class="dropdown">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Items Manager
				        <span class="caret"></span></a>
				        <ul class="dropdown-menu">
				          <li><a href="<?php echo base_url("welcome/add_items"); ?>">Add Item</a></li>
				          <li class="divider"></li>
				          <li><a href="<?php echo base_url("welcome/modify_items"); ?>">Modify Item</a></li>
				        </ul>
			        </li>
			        <li class="dropdown">
				        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Category Manager
				        <span class="caret"></span></a>
				        <ul class="dropdown-menu">
				          <li><a href="<?php echo base_url("welcome/add_category"); ?>">Add Catagory</a></li>
				          <li class="divider"></li>
				          <li><a href="<?php echo base_url("welcome/modify_category"); ?>">Modify Category</a></li>
				        </ul>
			        </li>
		    	</ul>
		    	<ul class="nav navbar-nav navbar-right">			      
		      		<li><a href="<?php echo base_url("welcome/logout"); ?>">Log Out</a></li>
		    	</ul>
		  	</div>
		</nav>
			<div class="container">
			<?php if($this->session->flashdata('msg')): ?>
			<div class="alert alert-danger">
				<b>Error: </b><?php echo $this->session->flashdata('msg'); ?>
			</div>
		    <?php endif; ?>
			<div class="row">
				<div class="col-lg-2">
					<img class="bg-img" style="height: 140px; width: 165px;" src="<?php echo base_url().'uploads/'.$this->session->userdata('image'); ?>">
				</div>
				<div class="col-lg-10">
					<div class="header">
						<p><strong>Id:</strong> <?php echo $this->session->userdata('id'); ?></p>
						<p><strong>Name:</strong> <?php echo $this->session->userdata('name'); ?></p>
						<p><strong>Email:</strong> <?php echo $this->session->userdata('email'); ?></p>
					</div>
				</div>
			</div>
			<div class="row">
			    <?php foreach($category_info as $c): ?>
			    	<input type="hidden" name="id" value="<?php echo $id = $c['id']; ?>">
			    	
				<div class="col-lg-4">
					<div class="categories">
						<a href="<?php echo base_url("welcome/categories/$id"); ?>"><img style="height: 238px;width: 358px;" src="<?php echo base_url().'uploads/'.$c['image']; ?>" class="img-responsive"></a>
						<h1 style="text-align: center;"><a href="<?php echo base_url("welcome/categories/$id"); ?>"><?php echo $c['name'] ?></a></h1>
					</div>
				</div>
			<?php endforeach; ?>	
			</div>
		</div>	  	
		<nav style="padding-bottom: 0px; margin-bottom: 0px;" class="navbar navbar-inverse navbar-fixed-bottom">
	  	    <div class="container-fluid">
    		    <ul class="nav navbar-nav">
    		        <li><a href="#">&copy Registered</a></li>
	    	    </ul>
	  	    </div>
	    </nav>
	</body>
</html>
	
	