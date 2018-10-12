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

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
	        <?php echo $this->session->flashdata('message'); ?>
        <form method="GET">
			<input type="text" name="field">
			<button type="submit" class="btn btn-primary">Cari</button>
			<a href="<?php echo site_url(); ?>"><button type="submit"  class="btn btn-danger">Reset</button></a>	
		</form>
		<br/>
		<?php foreach ($blogs as $key => $blog): ?>	
          <div class="post-preview">
            <a href="post.html">
              <h2 class="post-title">
                <a href="<?php echo site_url('blog/detail/'.$blog['url']); ?>"><?php echo $blog['title']; ?></a>
              </h2>
            </a>
            <p class="post-meta">Posted <?php echo $blog['date']; ?>
            <?php if(isset($_SESSION['username'])): ?> 
            <a href="<?php echo site_url('blog/edit/'.$blog['id']); ?>">Edit</a> |
			<a href="<?php echo site_url('blog/delete/'.$blog['id']); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Delete</a>
			<?php else: ?>
			<?php endif;?>
          	</p>
          </div>
		<?php endforeach; ?>
          <hr>
       		<?php echo $this->pagination->create_links(); ?>
      
          <!-- Pager
         <!--  <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
          </div> -->
        </div>
      </div>
    </div>
    <hr>

 <?php $this->load->view('partials/footer'); ?>


