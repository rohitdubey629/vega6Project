<?php

namespace App\Controllers;

use App\Models;
use App\Models\Data_model;
use PDO;

class Home extends BaseController
{

    public function index()
    {
        return view('registration');
    }

    public function login()
    {

        return view('pages/login');
    }

    public function fPassword()
    {
        return view('pages/forgetPassword');
    }



    public function user_regis()
    {
        $userModel = new Data_model();
        $table = "users";
        $imagefile = $this->request->getFile('img1');
        $newName = $imagefile->getRandomName();
        $imagefile->move('uploads/userProfile', $newName);
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'user_pic' => $newName,
            'created_at	' => date("Y-m-d H:i:s"),
        ];

        $addContact = $userModel->add_data($table, $data);
        $responce['status'] = true;
        $responce['msg'] = "Record Inserted! Please Wait...";
        echo json_encode($responce);
    }

    public function checkLogin()
    {


        $userModel = new Data_model();
        $table = "users";
        $data = [

            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        $loginStatus = $userModel->check_login($table, $data);

        if (!empty($loginStatus)) {
            $session = \Config\Services::session();
            $session->start();

            $sess_array = [
                'id' => $loginStatus['id'],
                'email' => $loginStatus['email'],
                'name' => $loginStatus['name'],
            ];

            $session->set('loginData', $sess_array);
            $session->set('is_login', true);
            $responce['status'] = true;
            $responce['id'] = $loginStatus['id'];
            $responce['msg'] = "Login Successfully Please Wait...";
        } else {

            $responce['status'] = false;
            $responce['msg'] = "Something Went Wrong";
        }

        echo json_encode($responce);
    }


    public function dashboard()
    {
        $session = \Config\Services::session();
        if ($session->get('is_login')) {

            $userData = $session->get('loginData');


            $userModel = new Data_model();
            $table = "users";
            $data['userData'] = $userModel->getuser($table, $userData['id']);

            return view('pages/home', $data);
        }
    }


    public function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }


    public function changePassword()
    {

        $userModel = new Data_model();
        $table = "users";
        $loginStatus = $userModel->getsingleDataId($table, $this->request->getPost('email'));
        if (!empty($loginStatus)) {
            $data = [

                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
            ];

            $loginStatus = $userModel->update_data($table, $data);
            $responce['status'] = true;
            $responce['msg'] = "Record Updated! Please Wait...";
        } else {
            $responce['status'] = false;
            $responce['msg'] = "Something went wrong";
        }



        echo json_encode($responce);
    }


    public function userprofile()
    {
        $session = \Config\Services::session();
        if ($session->get('is_login')) {

            $userData = $session->get('loginData');


            $userModel = new Data_model();
            $table = "users";
            $data['user_all_data'] = $userModel->getuser($table, $userData['id']);

            return view('pages/user_profile', $data);
        }
    }



    public function editUser()
    {
        $session = \Config\Services::session();
        if ($session->get('is_login')) {


            $id = $this->request->getPost('id');

            $userModel = new Data_model();
            $table = "users";
            $userData = $userModel->getuser($table, $id);

            $responce['status'] = true;
            $responce['userData'] = $userData;
            echo json_encode($responce);
        }
    }


    public function userUpdate()
    {


        $userModel = new Data_model();
        $table = "users";
        $user_id = $this->request->getPost('user_id');
        $userData = $userModel->getuser($table, $user_id);
        $uld_pic = $userData[0]['user_pic'];
        $imagefile = $this->request->getFile('edit_img1');


        if ($imagefile->isValid()) {

            //remove the previos image
            if (file_exists("uploads/userProfile/" . $uld_pic)) {
                unlink("uploads/userProfile/" . $uld_pic);
            }

            $newName = $imagefile->getRandomName();
            $imagefile->move('uploads/userProfile', $newName);
        } else {
            $newName =  $uld_pic;
        }


        $data = [
            'name' => $this->request->getPost('edit_name'),
            'email' => $this->request->getPost('edit_email'),
            'password' => $this->request->getPost('edit_password'),
            'user_pic' => $newName,
            'id' => $user_id,
            'created_at	' => date("Y-m-d H:i:s"),
        ];

        $addContact = $userModel->userUpdate($table, $data);
        $responce['status'] = true;
        $responce['msg'] = "Record Updated! Please Wait...";
        echo json_encode($responce);
    }


    function search()
    {
        return view('pages/search');
    }
}
