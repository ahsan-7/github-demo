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
			<form action="<?php echo base_url("welcome/do_upload_edit_category"); ?>" method="post" enctype="multipart/form-data">
			    <input type="hidden" name="id" value="<?php echo $id = $prev_info['id']; ?>">
			    <div class="panel panel-primary">	
	        		<div class="panel-heading">
	          			<h4 class="modal-title">Update Category</h4>
	        		</div>
	        		<div class="panel-body">
	           			<b>Name:</b> <input class="form-control" type="text" name="name" value="<?php echo $prev_info['name']; ?>"><br>
	            		<b>Description:</b><textarea class="form-control" name="description"><?php echo $prev_info['description']; ?></textarea><br>
	            		<div style="width: 200px"><img src="<?php echo base_url().'uploads/'.$prev_info['image']; ?>" class="img-responsive"></div>
						<b>Upload Img:</b><input type="file" name="userfile" size="20">
	        		</div>
	        		<div class="panel-footer">
	          			<input type="submit" name="submit" class="btn btn-info" value="Submit">
	        		</div>
			  	</div>
			</form>  	
		</div>
	</body>
</html>	