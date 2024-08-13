<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OAuth extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        require_once '../composer/vendor/autoload.php';
        
        // init configuration
        $this->ci =& get_instance();
        $this->ci->load->config('google');

        $clientID = $this->ci->config->item('clientId');
        $clientSecret = $this->ci->config->item('clientSecret');
        $redirectUri = $this->ci->config->item('redirectUri');
        
        // create Client Request to access Google API
        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");
        
        // authenticate code from Google OAuth Flow
        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            if(!isset($token['access_token']))
                redirect();

            $client->setAccessToken($token['access_token']);
            
            // get profile info
            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            $email =  $google_account_info->email;
            $name =  $google_account_info->name;

            $result = self::get_user($email);

            if($result){
                $this->session->set_userdata($result);
                redirect('site');
            }

        } else {
            redirect($client->createAuthUrl());
        }
    }

    private function get_user($gmail)
    {
        $this->load->model('pegawai_model');
        $row = $this->pegawai_model->get_by('gmail',$gmail)->row();
        if($row){
            return array(
                'username' => substr($row->email,0,stripos($row->email,'@')),
                'nama' => $row->nama,
                'niplama' => $row->niplama,
                'nipbaru' => $row->nipbaru,
                'id_wilayah' => $row->id_wilayah,
                'id_unitkerja' => substr($row->id_unitkerja,0,4),
                'id_eselon' => $row->id_eselon,
                'id_golongan' => $row->id_golongan,
                'gmail' => $email,
                'is_pegawai' => TRUE,
            );
        } else {
            $this->load->model('mitra_model');
            $row = $this->mitra_model->get_by('gmail',$gmail)->row();
            if($row){
                return array(
                    'username' => $row->gmail,
                    'nama' => $row->nama,
                    'niplama' => $row->nms,
                    'nipbaru' => $row->nik,
                    'id_wilayah' => $row->id_wilayah,
                    'id_unitkerja' => substr($row->id_unitkerja,0,4),
                    'id_eselon' => null,
                    'id_golongan' => null,
                    'gmail' => $gmail,
                    'is_pegawai' => FALSE,
                );
            } else {
                echo 'Email Anda ('.$gmail.') tidak terdaftar dalam sistem.<br>'.
                anchor('oauth','Klik di sini untuk login dengan user lain.');
                exit();
            }
        }
    }
}
 