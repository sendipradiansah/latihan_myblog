<?php $this->load->view('partials/header'); ?>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('<?php echo base_url();?>assets/img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Welcome. . .</h1>
              <span class="subheading">This is My Blog</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
         <?php echo $this->session->flashdata('message'); ?>
        <?php echo form_open(); ?>
          <div class="form-group">
            <label>Username</label>
            <?php echo form_input('username', set_value('username'),'class="form-control"'); ?>
          </div>
          <div class="form-group">
            <label>Password</label>
            <?php echo form_input('password', set_value('password'), 'class="form-control"'); ?>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Login</div>
          </div>
        </form>
         
          </div>
      </div>
    </div>



 <?php $this->load->view('partials/footer'); ?>