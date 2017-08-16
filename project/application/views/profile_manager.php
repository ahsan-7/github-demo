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
			<?php if($this->session->flashdata('msg')): ?>
			<div class="alert alert-danger">
				<b>Error: </b><?php echo $this->session->flashdata('msg'); ?>
			</div>
		    <?php endif; ?>
		    <?php if($this->session->flashdata('cmsg')): ?>
			<div class="alert alert-success">
				<b>Success: </b><?php echo $this->session->flashdata('cmsg'); ?>
			</div>
		    <?php endif; ?>
	        <div class="row">
	            <div class="col-lg-offset-4 col-lg-6">
	         	    <div class="profile-img">
 	         	   		<img class="bg-img img-rounded" style="width: 305px;height: 245px;" src="<?php echo base_url().'uploads/'.$this->session->userdata('image'); ?>" class="img-responsive">
	                    
	                </div>         	
	         	</div>
	         	<div class="col-lg-2">
	         		<div class="text-alignment">
	         		    <h3><a href="<?php echo base_url("welcome/edit_profile"); ?>">Edit Profile</a></h3>
	         	    </div>
	         	</div>
	        </div>
	        
	        <div class="data-alignment">
	        <hr>
	        <form>
	        	<div class="row">

	        		<div class="col-lg-12">
	        			<div class="text-font">
	        				<strong>Name:</strong><input class="form-control" type="text" name="name" value="<?php echo $this->session->userdata('name'); ?>" readonly>
	        		    </div>
	        		</div>
	        		
	        	</div>
	        	<hr>
	        	<div class="row">
	        		<div class="col-lg-12">
	        			<div class="text-font">
	        				<strong>Username:</strong><input class="form-control" type="text" name="name" value="<?php echo $this->session->userdata('email'); ?>" readonly>
	        		    </div>
	        		</div>
	        		
	        	</div>
	        	<hr>
	        	</form>
	        </div>	
        </div>
	</body>
</html>	