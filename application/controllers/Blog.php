<?php


Class Blog extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$this->load->model('Blog_model');
		$this->load->library('session');

	}

	public function index($offset = 0){

		$this->load->library('pagination');

		$config['base_url'] = site_url('blog/index');
		$config['total_rows'] = $this->Blog_model->getTotalBlogs();
		$config['per_page'] = 3;

        //$this->load->library('pagination');
        //config library pagination dengan style twitter bootstrap css
     
       $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';


		$this->pagination->initialize($config);
 		

		// $this->load->database();
		$query = $this->Blog_model->getBlogs($config['per_page'], $offset);
		$data['blogs'] = $query->result_array();	

		$this->load->view('blog', $data);
	}
	
	public function detail($url){

		// $query = $this->db->query('SELECT * FROM blog WHERE url = "'.$url.'"');
		$query = $this->Blog_model->getOneBlog('url', $url);
		$data['blog'] = $query->row_array();

		// print_r($data);
		// exit;
		$this->load->view('detail', $data);
	}

	public function add(){

		// if(isset($_GET['title'])){
		// 	$data['title'] = $_GET['title'];
		// 	$data['content'] = $_GET['content'];
		// }
		$this->form_validation->set_rules('title', 'Judul', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required|alpha_dash');
		$this->form_validation->set_rules('content', 'content', 'required');

		if($this->form_validation->run() == TRUE){	
			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('content');
			$data['url'] = $this->input->post('url');

			//print_r($data);
				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $config['max_width']            = 1024;
                $config['max_height']           = 1024;

                $this->load->library('upload', $config);

            	if ( ! $this->upload->do_upload('cover'))
                {
                       echo $this->upload->display_errors();

                }
                else
                {
                       $data['cover'] = $this->upload->data()['file_name'];
                }

			$id = $this->Blog_model->insertBlog($data);

			if ($id){
				// return header('location:'.base_url());
				$this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil ditambah 
					</div>');
				redirect('/');
			}
			else{
				$this->session->set_flashdata('message', '<div class="alert alert-warning">Data gagal ditambah</div>');
				redirect('/');
			}
		}
		
		$this->load->view('form_add');
	}

	public function edit($id){

		$query = $this->Blog_model->getOneBlog('id', $id);
		$data['blog'] = $query->row_array();

		$this->form_validation->set_rules('title', 'Judul', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required|alpha_dash');
		$this->form_validation->set_rules('content', 'content', 'required');

		if($this->form_validation->run() == TRUE){	
			$post['title'] = $this->input->post('title');
			$post['content'] = $this->input->post('content');
			$post['url'] = $this->input->post('url');

			//print_r($data);
				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $config['max_width']            = 1024;
                $config['max_height']           = 1024;

                $this->load->library('upload', $config);
                $this->upload->do_upload('cover');

            	if (!empty($this->upload->data()['file_name']))
                {
                       $post['cover'] = $this->upload->data()['file_name'];
                }

			// $id = $this->Blog_model->updateBlog($id, $post);
			$id = $this->Blog_model->updateBlog($id, $post);

			if ($id){
				// return header('location:'.base_url());
				$this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil diubah </div>');
				redirect('/');
			}
			else{
				$this->session->set_flashdata('message', '<div class="alert alert-warning">Data gagal diubah</div>');
				redirect('/');
			}

			// if ($id)
			// return header('location:'.base_url());
			// else
			// 	echo "Data gagal diubah";
		}

		$this->load->view('form_edit', $data);
	}

	public function delete($id){
		
		$id = $this->Blog_model->deleteBlog($id);

		if ($id){
				$this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil dihapus</div>');	
				redirect('/');
				// return header('location:'.base_url());	
		}
		else{
				$this->session->set_flashdata('message', '<div class="alert alert-warning"Data gagal dihapus</div>');	
				redirect('/');
		}
	}

	public function login(){
		
		if($this->input->post()){


			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$query = $this->Blog_model->login($username, $password);
			$data = $query->row_array();

			// print_r($data);
			// exit;

			if($data){
				$_SESSION['username'] = $data['username'];
				$_SESSION['nama'] = $data['nama'];
				// print_r($_SESSION['username']);
				// exit;
				redirect ('/');
			}
			else{
				$this->session->set_flashdata('message', '<div class="div alert alert-warning">Username/Password tidak valid!</div>');
				redirect('blog/login');
			}

		}
			$this->load->view('login');

	}

	public function logout(){

		$this->session->sess_destroy();
		redirect ('/');

	}

}
?>