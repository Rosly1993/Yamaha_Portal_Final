<?php

namespace App\Controllers;
use App\Models\Servicemanuals_model;
use App\Models\Servicebulletins_model;

class Main extends BaseController
{   
    protected $request;
    protected $session;
    protected $serviceManualModel;
    protected $serviceBulletinModel;
    protected $data;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->serviceManualModel = new Servicemanuals_model();
        $this->serviceBulletinModel = new Servicebulletins_model();
        $this->data = ['session' => $this->session];
    }

    public function index()
    {
        $this->data['page_title'] = "Home";
        $this->data['manual_count'] = $this->serviceManualModel->countCurrentMonthYear();
        $this->data['bulletin_count'] = $this->serviceBulletinModel->countCurrentMonthYear();
        return view('pages/home', $this->data);
    }
}
