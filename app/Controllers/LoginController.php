<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;

class LoginController extends BaseController
{
    protected $request;
    protected $loginModel;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->loginModel = new LoginModel;
    }
    public function index()
    {
        $data = [];
        $data['page_title'] = "Login";
        $session = session();
    
        if ($this->request->getMethod() == 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $user = $this->loginModel->where('username', $username)->first();
    
            if ($user) {
                if ($user['is_active'] == 1) {
                    $verify_password = password_verify($password, $user['password']);
                    if ($verify_password) {
                        // Update the last login date
                        $this->loginModel->update($user['IndexKey'], ['last_login_date' => date('Y-m-d H:i:s')]);
    
                        // Log successful login
                        $this->logActivity($username, 'Login', 'Successful login.');
    
                        // Set session data
                        foreach ($user as $k => $v) {
                            $session->set('login_'.$k, $v);
                        }
    
                        return redirect()->to('/Main');
                    } else {
                        // Log failed login due to incorrect password
                        $this->logActivity($username, 'Login', 'Failed login - Incorrect password.');
                        $session->setFlashdata('error', 'Incorrect Password');
                    }
                } else {
                    // Log failed login due to inactive account
                    $this->logActivity($username, 'Login', 'Failed login - Account inactive.');
                    $session->setFlashdata('error', 'Your account is inactive. Please contact the administrator.');
                }
            } else {
                // Log failed login due to non-existent username
                $this->logActivity($username, 'Login', 'Failed login - Username not found.');
                $session->setFlashdata('error', 'Incorrect Username or Password');
            }
        }
    
        $data['session'] = $session;
        return view('login/login', $data);
    }
    
    private function logActivity($username, $activity, $details)
{
    $logModel = new \App\Models\LogModel();
    $data = [
        'username' => $username,
        'activity' => $activity,
        'details' => $details,
        'date_record' => date('Y-m-d H:i:s'),
    ];
    $logModel->insert($data);
}

    
public function logout()
{
    $session = session();
    $username = $session->get('login_username');
    
    // Log the logout action
    $this->logActivity($username, 'Logout', 'User logged out.');

    $session->destroy();
    return redirect()->to('/');
}

    public function registration(){
        $session = session();
        $data=[];
        $data['session'] = $session;
        $data['data'] = $this->request;
        $data['page_title'] = "Registraion";
        if($this->request->getMethod() == 'post'){
            $firstname = $this->request->getPost('firstname');
            $middlename = $this->request->getPost('middlename');
            $lastname = $this->request->getPost('lastname');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $checkEmail = $this->loginModel->where('email', $email)->countAllResults();
            if($checkEmail > 0){
                $session->setFlashdata('error','Email is already taken.');
            }else{
                $idata = [  
                            'firstname' => $firstname,
                            'middlename' => $middlename,
                            'lastname' => $lastname,
                            'email' => $email,
                            'password' => password_hash($password, PASSWORD_DEFAULT),
                        ];
                $save = $this->loginModel->save($idata);
                if($save){
                    $session->setFlashdata('success','Your Account has been registered sucessfully.');
                    return redirect()->to('/');
                }
            }
        }
        return view('login/registration', $data);
    }
}
