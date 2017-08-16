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
			<form action="<?php echo base_url("welcome/do_upload_items"); ?>" method="post" enctype="multipart/form-data">
	      		<div class="panel panel-primary">	      		
	        		<div class="panel-heading">	          			
	          			<h4>Add Items</h4>
	        		</div>
	        		<div class="panel-body">
	           			<input type="hidden" name="id" value="<?php echo $category_info[0]['id']; ?>">
	           			<b>Name:</b> <input class="form-control" type="text" name="name" value="<?php echo set_value('name'); ?>">
                          
	           			<br>
	            		<b>Category:</b> <select class="form-control" name="category">
	            			<?php foreach($category_info as $c): ?>
	            			<option value="<?php echo $c['id']; ?>"><?php echo $c['name']; ?></option>
	            			<?php endforeach; ?>
	            		</select><br>
	            		<b>Description:</b><textarea class="form-control" name="description"><?php echo set_value('description'); ?></textarea>
                        <?php echo form_error('description'); ?>
	            		<br>
						<b>Upload Img:</b><input type="file" name="userfile" size="20">
						<?php if($this->session->flashdata('file')): ?>
						<div class="text-danger">
							<?php echo $this->session->flashdata('file'); ?>
						</div>
					    <?php endif; ?>
	        		</div>
	        		<div class="panel-footer">
	          			<button class="btn btn-info">Submit</button>
	        		</div>	        		
	      		</div>
	        </form>	  	
		</div>
	</body>
</html>		