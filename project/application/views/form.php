<!DOCTYPE html>
<html>
<head>
  <title></title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/form.css"); ?>">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background-image: url(<?php echo base_url(); ?>assets/img/img-3.jpg); background-size: 1200px;">

    <div class="container">
        <div class="top">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <form action="<?php echo base_url("welcome/insertToDB"); ?>" method="post">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="pwd">Name:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                        <input placeholder="Enter your name..." type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>">
                                        
                                    </div>
                                     <?php echo form_error('name'); ?>                                  
                                </div>
                                <div class="form-group">
                                    <label for="email">Username:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        </span>
                                        <input placeholder="Enter your email..." type="text" class="form-control" name="email" value="<?php echo set_value('email'); ?>">
                                        
                                    </div>
                                    <?php echo form_error('email'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Password:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </span>
                                        <input placeholder="Enter your password..." type="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>">
                                        
                                    </div>
                                    <?php echo form_error('password'); ?>
                                    <p style="font-size: 12px; text-align: center;">Your password must contain one Uppercase,one Lowercse,one Numeric,and one Special character.</p>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Confirm Password:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </span>
                                        <input placeholder="Confirm your password..." type="password" class="form-control" name="c_password" value="<?php echo set_value('c_password'); ?>">      
                                    </div>
                                    <?php echo form_error('c_password'); ?>
                                </div>                                  
                            </div>
                            <div class="panel-footer">
                                  <button type="submit" class="btn btn-default pull-right">Register</button>
                                  <div class="clearfix"></div>
                            </div>
                        </div>
                        <div align="center">
                            <a href="<?php echo base_url("welcome/loginform"); ?>" class="btn btn-primary">Already Have an Account</a>
                        </div>
                    </form>                          
                </div>
            </div>
        </div>
    </div>  
</body>
</html>


