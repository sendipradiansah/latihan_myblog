<?php


Class Blog_model extends CI_Model{

	public function login($username, $password){
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		return $this->db->get('login');
	}

	public function getBlogs($limit, $offset){
		$filter = $this->input->get('field');
		$this->db->like('title', $filter);
		$this->db->limit($limit, $offset);
		$this->db->order_by('date', 'desc');
		return $this->db->get('blog');
	}

	public function getTotalBlogs(){
		$filter = $this->input->get('field');
		$this->db->like('title', $filter);
		return $this->db->count_all_results('blog');
	}

	public function getOneBlog($field, $value){
		$this->db->where($field, $value);
		return $this->db->get('blog');
	}

	public function insertBlog($data){
		$this->db->insert('blog', $data);
		return $this->db->insert_id();

	}

	public function updateBlog($id, $post){
		$this->db->where('id', $id);
		$this->db->update('blog', $post);
		return $this->db->affected_rows();
	}

	public function deleteBlog($id){
		$this->db->where('id', $id);
		$this->db->delete('blog');
		return $this->db->affected_rows(); 
	}
}

?>