<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	  public function __construct()
        {
                parent::__construct();
                // Your own constructor code
      			$this->load->helper('url'); 
                $this->load->model('m_welcome');
                $data  = ['index','login_check','signup'];
                $test = ! in_array($this->uri->segment(2),$data);
                if($this->uri->segment(2) and  $test  ){
                	 $email_id = $this->session->userdata('email_id');
               		 $password=  $this->session->userdata('password');
                	if(!($email_id and $password)){
                		redirect('/welcome/');
                	}		              
                }

                // work for pagination
                 $this->total = 8;
                 $this->pages =0;
        }


    public function index()
	{	
		$this->load->view('login');
	}
	public function signup(){
		$data=[];
		$data['name']= $this->input->post('name');
		$data['email_id']= $this->input->post('email_id');
		$data['password'] =$this->input->post('paswd');

		$type	= explode('.', $_FILES['pic']['name']);
		$type = $type[count($type)-1];
		$data['image_name'] = $data['email_id'].'.'.$type;
		// $data['image_name'] = str_replace('@','',str_replace('.','', $data['email_id'])).'.'.$type;
		move_uploaded_file($_FILES['pic']['tmp_name'], "./upload/profile/".$data['image_name']);
		$this->m_welcome->signup($data);
		$this->setSession($data);
		redirect('welcome/home');
	}

	private function setSession($data){
		$this->session->set_userdata($data);
	}


	private function same_image($data,$loc){
		$number=count(scandir("./upload/".$loc."/"))-2;
		if(move_uploaded_file($data['pic']['tmp_name'], "./upload/".$loc."/".$number.".png")){
			return $number.".png";
		}
		return false;
	}

	public function login_check(){
		$name = $this->input->post('name');
		$pass = $this->input->post('paswd');

		$res = $this->m_welcome->logincheck($name,$pass);
		if($res){
			redirect('welcome/home');
		}else{
			redirect('welcome');
		}
	}

	public function home(){
		$data = $this->m_welcome->articles();
		$this->load->view('home',$data);
	}

	public function write(){
		$this->load->view('write');
	}

	public function write_insert(){
		$email_id = $this->session->userdata('email_id');
		$headline = $this->input->post('headline');
		$type	= explode('.', $_FILES['pic']['name']);
		$type = $type[count($type)-1];
		$image_name = $this->m_welcome->write_articles($email_id,$headline,$type);
		move_uploaded_file($_FILES['pic']['tmp_name'], "./upload/article/".$image_name);
		//echo "<pre>".$_POST['content']."</pre>";
		$this->load->view('write');

	}

	public function own(){
		$data = $this->m_welcome->articles('session');
		$this->load->view('own',$data);

	}

	public function read($article_id){

		$data = $this->m_welcome->read($article_id);
		$data['article_id']=$article_id;
		$this->load->view('read',$data);
	}

	public function ajaxCall($by,$num){
		$data = $this->m_welcome->articles($by,$num-1);
		echo json_encode($data['all']);
	}

	public function like_update($data,$article_id,$cmd){
		$this->m_welcome->like_update($article_id,$data,$cmd);
	}


	public function comment($article_id){
		$comment = $this->input->post('comment');
		$this->m_welcome->comment($comment,$article_id);


	}


	public function logout(){
		$this->session->sess_destroy();
		redirect("/welcome/");
	}


}
