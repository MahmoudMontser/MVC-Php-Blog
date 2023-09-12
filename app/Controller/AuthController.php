<?php

namespace App\Controller;
use App\Models\User;

class AuthController extends Controller
{

    private $userModel;

    public function __construct(){
        $this->userModel = new User();
    }

    public function login()
    {
        $this->getView('site\auth\login');
    }
    public function signup()
    {
        $this->getView('site\auth\signup');
    }

    public function register(){
        //Process form

        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //Init data
        $data = [
            'name' => trim($_POST['name']),
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'password_confirmation' => trim($_POST['password_confirmation'])
        ];

        //Validate inputs
        if(empty($data['name']) || empty($data['email']) ||
            empty($data['password']) || empty($data['password_confirmation'])){
            flash("register", "Please fill out all inputs");
              redirect(ROOT_URL."?p=AuthController&a=signup");
        }


        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            flash("register", "Invalid email");
              redirect(ROOT_URL."?p=AuthController&a=signup");
        }

        if(strlen($data['password']) < 6){
            flash("register", "Invalid password");
              redirect(ROOT_URL."?p=AuthController&a=signup");
        } else if($data['password'] !== $data['password_confirmation']){
            flash("register", "Passwords don't match");
              redirect(ROOT_URL."?p=AuthController&a=signup");
        }

        //User with the same email or password already exists
        if($this->userModel->findUserByEmailOrUsername($data['email'])){
            flash("register", "email already taken");
              redirect(ROOT_URL."?p=AuthController&a=signup");
        }
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        //Register User
        if($this->userModel->register($data)){
            redirect(ROOT_URL."?p=AuthController&a=login");
        }else{
            die("Something went wrong");
        }
    }
    public function auth(){
        //Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //Init data
        $data=[
            'email' => trim($_POST['email'] ?? null),
            'password' => trim($_POST['password'] ?? null)
        ];
        if(empty($data['email']) || empty($data['password'])){
            flash("login", "Please fill out all inputs");
            redirect(ROOT_URL."?p=AuthController&a=login");
            exit();
        }
        //Check for user/email
        if($this->userModel->findUserByEmailOrUsername($data['email'])){
            //User Found
            $loggedInUser = $this->userModel->login($data['email'], $data['password']);
            if($loggedInUser){
                //Create session
                $this->createUserSession($loggedInUser);
            }else{
                flash("login", "Password Incorrect");
                redirect(ROOT_URL."?p=AuthController&a=login");
            }
        }else{
            flash("login", "No user found");
            redirect(ROOT_URL."?p=AuthController&a=login");
        }
    }

    public function createUserSession($user){
        $_SESSION['usersId'] = $user->id;
        $_SESSION['UserName'] = $user->name;
        $_SESSION['UserEmail'] = $user->email;
        redirect(ROOT_URL);
    }
    public function logout(){
        unset($_SESSION['usersId']);
        unset($_SESSION['UserName']);
        unset($_SESSION['UserEmail']);
        session_destroy();
        redirect(ROOT_URL);
    }
}