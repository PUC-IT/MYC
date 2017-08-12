<div class="container">
        <div style="width: 500px; margin: 50px auto;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" class="well">
                <center><h2>Login To Account</h2></center>
                <hr/>
                  <div class="form-group">
                  <label class="col-md-4 control-label" for="textinput">Username</label>
                  <div class="col-md-4">
                    <input id="textinput" name="textinput" type="text" placeholder="placeholder" class="form-control input-md" required="">
                    <span class="help-block">help</span>
                  </div><br/>
                </div>
                <div class="form-group">
                    <label for="username" class="control-label">Username</label>
                    <input type="text" name="username" class="form-control">
                    <span class="text-danger"><?php if(isset($errorUsername)) echo $errorUsername; ?></span>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" autocomplete="off">
                    <span class="text-danger"><?php if(isset($errorEmail)) echo $errorEmail; ?></span>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <input type="password" name="password" class="form-control" autocomplete="off">
                    <span class="text-danger"><?php if(isset($errorPassword)) echo $errorPassword; ?></span>
                </div>
              
                <div class="form-group">
                    <center><input type="submit" name="btn-register" value="Login" class="btn btn-primary btn-block"></center>
                </div>
                <hr/>
                <p>Not yet have account? <a href="<?= base_url()?>youraccount/create">Register Now</a></p>
            </form>
        </div>
    </div>


<!-- <section id="main">
      <div class="container">

        <div class="row">
          <div style="width: 500px; margin: 50px auto;">
          <center><h2>Register</h2></center>
                <hr/>
            <form id="login" action="index.html" class="well">
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" class="form-control" placeholder="Enter Email">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-default btn-block">Login</button>
              </form>
              <p>Don't have account? <a href="<?= base_url()?>youraccount/create">Register Now</a></p>
          </div>
        </div>
        
      </div>
    </section> -->

