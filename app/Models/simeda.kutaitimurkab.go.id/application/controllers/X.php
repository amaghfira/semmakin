<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class X extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
		if(!$this->session->userdata('login'))
			redirect('login');
	}

	public function index($mulai=null)
	{
	    if(!$mulai)
	        $mulai = date('Y-m-d', strtotime("this week"));;
        $akhir = date('Y-m-d', strtotime($mulai)+6*24*60*60);
	        
        for ($time = strtotime($mulai); $time <= strtotime($akhir); $time += (86400)) {
            $arr_date[] = date('dm', $time);
        }

        $sql = "select * from surat_usul
            where 
            (tgl_jalanmulai between '$mulai' and '$akhir') and 
            (tgl_jalanakhir between '$mulai' and '$akhir') 
            order by tgl_jalanmulai, tgl_jalanakhir";
        
        $res = $this->db->query($sql)->result();
        foreach($res as $row){
            foreach(explode(' ',$row->kodesat) as $kab){
                if(intval($kab)>1 && intval($kab)<=76){
                    for ($time = strtotime($row->tgl_jalanmulai); $time <= strtotime($row->tgl_jalanakhir); $time += (86400)) {
                        $data[$kab][$row->id][date('dm',$time)] = array('kode_bag'=>substr($row->kode_bag,0,1), 'label'=>$row->maksud);
                    }
                }
            }
        }
        
        if(!empty($data))
            ksort($data);
        
        echo anchor('x/index/'.date('Y-m-d', strtotime($mulai.' -1 week')), '&laquo; prev');
        echo anchor('x/index/'.date('Y-m-d', strtotime($mulai.' +1 week')), 'next &raquo;', array('style'=>'float:right'));

        echo '<table border=1 colspan=3 width=100%>
            <thead>
                <tr><th>KAB</th>';
        foreach($arr_date as $date) echo '<th>'.substr($date,0,2).'/'.substr($date,2).'</th>';
        echo '</tr>
            </thead>
            <tbody>';
        if(!empty($data)){
            $tmp = null;
            foreach($data as $kab=>$row) {
                foreach($row as $id=>$val){
                    echo '<tr><td>'.($kab==$tmp?'':$kab).'</td>';
                    foreach($arr_date as $date) {
                        if(!empty($val[$date]))
                            echo '<td class=b'.$val[$date]['kode_bag'].'>'.$val[$date]['label'].'</td>';
                        else 
                            echo '<td></td>';
                    }
                    echo '</tr>';
                    if($tmp!=$kab)
                        $tmp=$kab;
                }
            }            
        }
        echo '</tbody>
        </table>';
        
        echo anchor('x/index/'.date('Y-m-d', strtotime($mulai.' -1 week')), '&laquo; prev');
        echo anchor('x/index/'.date('Y-m-d', strtotime($mulai.' +1 week')), 'next &raquo;', array('style'=>'float:right'));
        
        echo '<style>
        body {font-family:monospace}
        td.b2 {background:lightskyblue}
        td.b3 {background:lightgreen}
        td.b4 {background:orange}
        td.b5 {background:mediumpurple}
        td.b6 {background:pink}
        a {text-decoration:none; color:blue}
        </style>';
    }
}
