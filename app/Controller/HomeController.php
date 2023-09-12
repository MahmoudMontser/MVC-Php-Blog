<?php

namespace App\Controller;
use App\Models\Posts;
use App\Models\User;

class HomeController extends Controller
{

    private  $userModel;
    private  $postModel;

    public function __construct(){
        $this->userModel = new User();
        $this->postModel = new Posts();
    }

    public function index()
    {
        $this->posts = $this->postModel->posts(); // Get only the latest X posts
        $this->getView('site\home');
    }
}