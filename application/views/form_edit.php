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
		<div class="col-md-8">
		<h1>Edit Artikel</h1>
		<div class="alert alert-warning">
			<?php echo validation_errors(); ?>
		</div>
		<?php echo form_open_multipart(); ?>
			<div class="form-group">
				<label>Judul Artikel</label>
				<?php echo form_input('title', set_value('title', $blog['title']), 'class="form-control"'); ?>
			</div>
			<div <div class="form-group">
				<label>Konten</label>
				<?php echo form_textarea('content', set_value('content', $blog['content']), 'class="form-control"'); ?>
				</textarea><br>
			</div>
			<div class="form-group">
				<label>URL</label>
				<?php echo form_input('url', set_value('url', $blog['url']), 'class="form-control"'); ?>
			</div>
			<div class="form-group">
				<label>Cover</label>
				<?php echo form_upload('cover', set_value('cover', $blog['cover']), 'class="form-control"'); ?>
			</div>
			<div>
				<button class="btn btn-primary" type="submit">Simpan</button>
			</div>
		</form>
		</div>
	</div>
</div>

<?php $this->load->view('partials/header'); ?>
