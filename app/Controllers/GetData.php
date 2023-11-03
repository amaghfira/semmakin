<?php

namespace App\Controllers;
use App\Models\UploadModel;

class GetData extends BaseController {
   
    public function index() {
        $db = \Config\Database::connect();

        $query = $db->query("SELECT `name`, cacah_new * 100 / total as `data` FROM agregat");
        $data['dat'] = $query->getResultArray();
        // echo view('home',$data);
    }

    public function getBS() {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT total, cacah_new FROM `agregat`");
        $total_bs = $query->getResultArray();
        $query2 = $db->query("SELECT COUNT(*) as total FROM `monitoring` GROUP BY kode_wil");
        $upload_bs = $query2->getResultArray();
        $datatotal = [];

        // foreach ($query->getResultArray() as $row)
        // {
        // // echo $row['total'];
        // $datatotal = '[' . $row['total'] . ',';
        // echo $datatotal;
        // }

        $i = 0;
        $limit = 10;

        while ($i < $limit) {
            
            $datatotal[] = (int)$query->getRow($i)->total;
            $dataupload[] = (int)$query->getRow($i)->cacah_new;
            ++$i;
        }

        // $val = array($datatotal);
        // print_r($datatotal) ;
        // print_r($dataupload);
        return json_encode($dataupload);
        

        // return (json_encode($query->getResultArray()));
        
    }

    public function getMapsData() {
        // // ambil persentase data yg sudah terunggah 
        // $db = \Config\Database::connect();
        // $query = $db->query("SELECT cacah_new * 100 / total as persen FROM `agregat`");

        // // load maps 
        // $maps = file_get_contents(base_url('KAB6400.geojson'));
        // $decoded_maps = json_decode($maps,true); //true: read as array, false: read as object 

        // $features = $decoded_maps['features'];

        // foreach ($features as $feature) {
        //     $properties = $feature['properties'];
        //     foreach ($properties as $property) {
        //         // if ($property['kabkotno'] == '01') {}
        //     }
        // } 

        // return $decoded_maps['features'];

        // ambil data untuk choropleth map 
        $db = \Config\Database::connect();
        $i = 0;
        $limit = 10;
        $query = $db->query("SELECT cacah_new * 100 / total as persen FROM `agregat`");
        $datapersen = [];
        while ($i < $limit) {
            $datapersen[] = (int)$query->getRow($i)->persen;
            ++$i;
        }
        $data = json_encode($datapersen);

        return $data[0];
    }
    
}
