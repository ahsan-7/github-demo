<!DOCTYPE html>
<html>
<head>
  <title></title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/loginform.css"); ?>">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background-image: url(<?php echo base_url(); ?>assets/img/img-3.jpg); background-size: 1200px;">
    <div class="container">
        <div class="top">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <form action="<?php echo base_url('welcome/validate'); ?>" method="post">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="email">Username:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"> 
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        </span>
                                        <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>">
                                                             
                                    </div>
                                    <?php echo form_error('email'); ?>                     
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Password:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </span>
                                        <input type="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>"  >
                                        
                                    </div>
                                    <?php echo form_error('password'); ?>                   
                                </div>                  
                            </div>
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-default pull-right">Log In</button>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                    <?php //echo validation_errors(); ?>
                    <?php if($this->session->flashdata('msg')):  ?>
                    <div class="alert alert-danger">
                        <strong>Error</strong> <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                    <?php endif; ?>
                    <?php if($this->session->flashdata('umsg')):  ?>
                    <div class="alert alert-success">
                        <strong>Success</strong> <?php echo $this->session->flashdata('umsg'); ?>
                    </div>
                    <?php endif; ?>
                    <?php if($this->session->flashdata('form')):  ?>
                    <div class="alert alert-danger">
                        <strong>Error</strong> <?php echo $this->session->flashdata('form'); ?>
                    </div>
                    <?php endif; ?>
                    <div align="center">
                        <a href="<?php echo base_url("welcome/form"); ?>"><button class="btn btn-primary">Create Account</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>