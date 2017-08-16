<html>
<head>
  <title>MyDashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/profile.css"); ?>">
</head>
	<body>
        <nav class="navbar navbar-inverse">
		  	<div class="container-fluid">
	    		<ul class="nav navbar-nav">
	    		    <li><a href="<?php echo base_url("welcome/dashboard"); ?>">DashBoard</a></li>
		      		<li class="active"><a href="<?php echo base_url("welcome/profile_manager"); ?>">Profile Manager</a></li>
		    	</ul>
		    	<ul class="nav navbar-nav navbar-right">			      
		      		<li><a href="<?php echo base_url("welcome/logout"); ?>">Log Out</a></li>
		    	</ul>
		  	</div>
		</nav>
		<div class="container">
		    <input type="hidden" name="id" value="<?php $id = $this->session->userdata('id'); ?>">
			<form action="<?php echo base_url("welcome/update_password/$id"); ?>" method="post">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4>Change Password</h4>
					</div>
					<div class="panel-body">
						<b>Previous Password:</b><input class="form-control" type="password" name="prev_password" value="<?php echo set_value('prev_password'); ?>">
						<?php if($this->session->flashdata('pass_change')): ?>
						<div class="text-danger">
							<?php echo $this->session->flashdata('pass_change'); ?>
						</div>
						<?php endif; ?>
						<br>
						<b>New Password:</b><input class="form-control" type="password" name="new_password" value="<?php echo set_value('new_password'); ?>">
						
						<?php echo form_error('new_password'); ?>
						<br>
						<b>Confirm New Password:</b><input class="form-control" type="password" name="c_new_password" value="<?php echo set_value('c_new_password'); ?>">
						
						<?php echo form_error('c_new_password'); ?>
						<br>
					</div>
					<div class="panel-footer">
						<button class="btn btn-info">Submit</button>
					</div>					
				</div>
			</form>
		</div>