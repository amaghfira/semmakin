<?php 
class Sinotif
{
    private $appkey = 'q2Wd5cFtykL8';             // wajib, key untuk mengakses api notifikasi
    private $nip = array('198010022002121005');      // optional, jika notifikasi hanya ke user tertentu


    private $ch;
    private $data = array();
    private $response = null;
    private $success = 0;

    public function __construct()
    {
        $this->ch = curl_init();
    }

    function __destruct() 
    {
        if($this->ch)
            curl_close($this->ch);
    }

    // proses data sebelum kirim notifikasi
    public function kirim($data) 
    {
log_message('error',json_encode($data));
        if(!isset($data['nip']) && $this->nip)
            $data['nip'] = $this->nip;

        if(isset($data['nip']) && isset($data['subject']) && isset($data['message'])){
            $this->data['nip'] = $data['nip'];
            $this->data['subject'] = $data['subject'];
            $this->data['message'] = $data['message'];

            if(isset($data['url']))
                $this->data['url'] = $data['url'];

            $this->send($data);
        } else {
            $this->response = 'data tidak lengkap';
        }

        return $this->get_result();
    }

    // kirim request ke server
    private function send($data)
    {
        if(!isset($data['appkey']))
            $data['appkey'] = $this->appkey;

        curl_setopt_array($this->ch, array(
          CURLOPT_URL => 'https://localhost/jateng/apinotif/v1/kirim_notifikasi',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
          CURLOPT_COOKIEFILE => '.cookie',
          CURLOPT_COOKIEJAR => '.cookies',
        ));

        $this->response = curl_exec($this->ch);

        if (curl_errno($this->ch)) 
            $this->response = curl_error($this->ch);
        else
            $this->success = 1;
    }

    // mendapatkan status hasil pengiriman data
    public function get_result()
    {
        return array('success'=>$this->success, 'response'=>$this->response);
    }

}