<?php

namespace App\Controller;
use App\Models\Posts;
use App\Models\User;

class PostController extends Controller
{

    private  $userModel;
    private  $postModel;

    public function __construct(){
        $this->userModel = new User();
        $this->postModel = new Posts();
    }


    public function add()
    {
        if (!isset($_SESSION['usersId'])) {
            flash("home", "please Login First");
            redirect(ROOT_URL);
        }

        $this->getView('site\post\create');
    }
    public function edit()
    {
        $post=$this->postModel->findById($_GET['target']);
        if (!isset($post)) {
            flash("home", "Post Not Found");
            redirect(ROOT_URL);
        }
        if (!isset($_SESSION['usersId'])) {
            flash("home", "please Login First");
            redirect(ROOT_URL);
        }
        if ($_SESSION['usersId'] != $post->user_id) {
            flash("home", "You Are Not The Author");
            redirect(ROOT_URL);
        }
        $this->post = $post; // Get only the latest X posts
        $this->getView('site\post\edit');
    }

    public function store(){
        if (!isset($_SESSION['usersId'])) {
            flash("home", "please Login First");
            redirect(ROOT_URL);
        }
        //Process form

        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body']),
            'user_id' => $_SESSION['usersId'],
            'createdDate' =>  date('Y-m-d H:i:s')
        ];

        //Validate inputs
        if(empty($data['title']) || empty($data['body']) ||
            empty($data['user_id'])){
            flash("create", "Please fill out all inputs");
              redirect(ROOT_URL."?p=PostController&a=add");
        }


        if(strlen($data['title']) > 250){
            flash("create", "Invalid title max is 255 character");
            redirect(ROOT_URL."?p=PostController&a=add");
        }

        if($this->postModel->store($data)){
            success("home","Your Post Created Successfully");
            redirect(ROOT_URL);
        }else{
            die("Something went wrong");
        }
    }
    public function update(){
        $post=$this->postModel->findById($_GET['target']);
        if (!isset($post)) {
            flash("home", "Post Not Found");
            redirect(ROOT_URL);
        }
        if (!isset($_SESSION['usersId'])) {
            flash("home", "please Login First");
            redirect(ROOT_URL);
        }
        if ($_SESSION['usersId'] != $post->user_id) {
            flash("home", "You Are Not The Author");
            redirect(ROOT_URL);
        }

        //Process form

        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body']),
            'user_id' => $_SESSION['usersId'],
            'createdDate' =>  date('Y-m-d H:i:s')
        ];

        //Validate inputs
        if(empty($data['title']) || empty($data['body']) ||
            empty($data['user_id'])){
            flash("create", "Please fill out all inputs");
              redirect(ROOT_URL."?p=PostController&a=add");
        }


        if(strlen($data['title']) > 250){
            flash("create", "Invalid title max is 255 character");
            redirect(ROOT_URL."?p=PostController&a=add");
        }

        if($this->postModel->update($post->id,$data)){
            success("home","Your Post Updated Successfully");
            redirect(ROOT_URL);
        }else{
            die("Something went wrong");
        }
    }
    public function delete(){
        $post=$this->postModel->findById($_GET['target']);
        if (!isset($post)) {
            flash("home", "Post Not Found");
            redirect(ROOT_URL);
        }
        if (!isset($_SESSION['usersId'])) {
            flash("home", "please Login First");
            redirect(ROOT_URL);
        }
        if ($_SESSION['usersId'] != $post->user_id) {
            flash("home", "You Are Not The Author");
            redirect(ROOT_URL);
        }

        if($this->postModel->delete($post->id)){
            success("home","Your Post Deleted Successfully");
            redirect(ROOT_URL);
        }else{
            die("Something went wrong");
        }
    }
    public function show(){
        $post=$this->postModel->findById($_GET['target']);
        $this->post = $post;
        $this->getView('site\post\show');
    }

}