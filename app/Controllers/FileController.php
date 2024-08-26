<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LogModel;

class FileController extends Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    private function logActivity($username, $activity, $data)
    {
        $logModel = new LogModel();
        $details = json_encode($data);

        $logData = [
            'username' => $username,
            'activity' => $activity,
            'details' => $details,
            'date_record' => date('Y-m-d H:i:s'),
        ];

        $logModel->insert($logData);
    }

    public function view($filename)
    {
        $path = FCPATH . 'public/assets/uploads/' . $filename;

        if (!file_exists($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found: " . $filename);
        }

        // Debug output
        echo "File Path: " . $path . "<br>";
        echo "MIME Type: " . $this->getMimeType($path) . "<br>";
        echo "File Size: " . filesize($path) . " bytes<br>";

        exit;

        $mime = $this->getMimeType($path);

        return $this->response
                    ->setHeader('Content-Type', $mime)
                    ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
                    ->setHeader('Content-Length', filesize($path))
                    ->setBody(file_get_contents($path));
    }

    public function download($filename)
    {
        $filePath = FCPATH . 'public/assets/uploads/' . $filename;

        if (!file_exists($filePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File not found');
        }

        $username = $this->session->get('login_username');

        // Debugging statements
        log_message('debug', 'Session Data: ' . print_r($this->session->get(), true));
        log_message('debug', 'Username for file download: ' . $username);

        if (empty($username)) {
            log_message('error', 'Username is null or empty during file download for ' . $filename);
        }

        // Log the activity
        $this->logActivity($username, 'Service Bulletins File Download', ['filename' => $filename]);

        // Set headers for file download
        return $this->response->download($filePath, null)->setFileName($filename);
    }

    private function getMimeType($path)
    {
        $file = new \CodeIgniter\Files\File($path);
        return $file->getMimeType();
    }
}
