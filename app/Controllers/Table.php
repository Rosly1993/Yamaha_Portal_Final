<?php

namespace App\Controllers;
use App\Models\Auth;

class Table extends BaseController
{
    protected $request;
    protected $session;
    protected $auth_model;
    protected $data;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->auth_model = new Auth();
        $this->data = ['session' => $this->session];
    }

    public function index()
    {
        $this->data['page_title'] = "Table";
        return view('pages/user_table', $this->data);
    }

    public function add()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'firstname' => 'required',
                'middlename' => 'required',
                'lastname'  => 'required',
                'username'  => 'required|is_unique[users.username]',
                'password'  => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/]',
                'email'     => 'required|valid_email|is_unique[users.email]',
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }

            $userData = [
                'firstname' => $this->request->getPost('firstname'),
                'middlename' => $this->request->getPost('middlename'),
                'lastname'  => $this->request->getPost('lastname'),
                'username'  => $this->request->getPost('username'),
                'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'email'     => $this->request->getPost('email'),
            ];

            $this->auth_model->insert($userData);

            return $this->response->setJSON(['success' => true]);
        }

        return redirect()->back();
    }

    public function edit($id)
    {
        $user = $this->auth_model->find($id);
        if ($user) {
            return $this->response->setJSON(['success' => true, 'data' => $user]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found']);
        }
    }

    public function update($id)
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'firstname' => 'required',
                'middlename' => 'required',
                'lastname'  => 'required',
                'username'  => 'required|is_unique[users.username,id,{id}]',
                'password'  => 'permit_empty|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/]',
                'email'     => 'required|valid_email|is_unique[users.email,id,{id}]',
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
            }

            $userData = [
                'firstname' => $this->request->getPost('firstname'),
                'middlename' => $this->request->getPost('middlename'),
                'lastname'  => $this->request->getPost('lastname'),
                'username'  => $this->request->getPost('username'),
                'email'     => $this->request->getPost('email'),
            ];

            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $this->auth_model->update($id, $userData);

            return $this->response->setJSON(['success' => true]);
        }

        return redirect()->back();
    }
    public function getUsers()
    {
        $users = $this->auth_model->findAll();
        return $this->response->setJSON(['data' => $users]);
    }
  
    public function activate($id)
    {
    if ($this->request->isAJAX()) {
        $model = new Auth(); // Ensure this is the correct model
        
        try {
            // Update the 'is_active' field to 0 instead of deleting the record
            $result = $model->update($id, ['is_active' => 1]);

            if ($result) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Update failed']);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    return redirect()->back();
}

public function deactivate($id)
{
    if ($this->request->isAJAX()) {
        $model = new Auth(); // Ensure this is the correct model
        
        try {
            // Update the 'is_active' field to 0 instead of deleting the record
            $result = $model->update($id, ['is_active' => 0]);

            if ($result) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Update failed']);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    return redirect()->back();
}

   
 
}
    
    

