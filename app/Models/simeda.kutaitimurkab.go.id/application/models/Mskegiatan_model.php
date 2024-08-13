<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mskegiatan_model extends CI_Model
{

    public $table = 'ms_keg';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default',true);
    }

    function all($userid=null){
        if($userid){
            //$user = $this->db->where('userid',$userid)->get('users')->row();
            $this->db->where('userid',$userid);//->or_where('instansi',$user->instansi);                   
        }
        $this->db->order_by('id_wilayah, judul_kegiatan, tahun');
        return $this->db->get($this->table)->result();
    }

    function all_by_wilayah($id_wilayah=null){
        if($id_wilayah){
            $this->db->where('id_wilayah',$id_wilayah);                   
        }
        return $this->db->get($this->table)->result();
    }

    function add($data)
    {
        foreach($data as $key=>$val)
            $data[$key] = trim($val);

        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        $this->db->insert('ms_keg_blok_i',array('id_ms_keg'=>$id));
        $this->db->insert('ms_keg_blok_ii',array('id_ms_keg'=>$id));
        $this->db->insert('ms_keg_blok_iii',array('id_ms_keg'=>$id));
        $this->db->insert('ms_keg_blok_iv',array('id_ms_keg'=>$id));
        $this->db->insert('ms_keg_blok_v',array('id_ms_keg'=>$id));
        $this->db->insert('ms_keg_blok_vi',array('id_ms_keg'=>$id));
        $this->db->insert('ms_keg_blok_vii',array('id_ms_keg'=>$id));
        $this->db->insert('ms_keg_blok_viii',array('id_ms_keg'=>$id));

        return $id;
    }

    function get($id){
        $this->db->where('id_ms_keg',$id);
        return $this->db->get($this->table)->row();
    }

    function get_hash($id){
        $this->db->select('md5(concat(id_ms_keg,id_wilayah,judul_kegiatan,tahun)) as hash');
        $this->db->where('id_ms_keg',$id);

        $result = $this->db->get($this->table)->row();
        if($result) return $result->hash;
    }

    function get_by_hash($hash){
        $this->db->where('md5(concat(id_ms_keg,id_wilayah,judul_kegiatan,tahun))',$hash);
        return $this->db->get($this->table)->row();
    }

    function get_blok($id,$blok){
        $this->db->where('id_ms_keg',$id);
        return $this->db->get($this->table.'_blok_'.$blok)->row();
    }

    //

    function update($id, $data){
        foreach($data as $key=>$val)
            $data[$key] = trim($val);

        $this->db->where('id_ms_keg',$id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    function update_blok($id, $blok, $data){
        $this->db->where('id_ms_keg',$id);
        $this->db->update($this->table.'_blok_'.$blok, $data);
        $affected_rows = $this->db->affected_rows();

        foreach($data as $key=>$value){
            $item = array('id_ms_keg'=>$id, 'blok'=>$blok, 'field'=>$key, 'checklist'=>'0');
            if(!$this->db->where($item)->get('ms_keg_checklist')->row()){
	            $insert_string = $this->db->insert_string('ms_keg_checklist',$item);
	            $insert_string = str_ireplace('INSERT', 'INSERT IGNORE', $insert_string);
	            $this->db->query($insert_string);
	        }
        }
        return $affected_rows;
    }

    function delete($id){
        $this->db->where('id_ms_keg',$id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    function dashboard($id_wilayah=null){
    	if($id_wilayah){
    		$this->db->join('ms_keg','ms_keg.id_ms_keg = ms_keg_checklist.id_ms_keg');
    		$this->db->where('ms_keg.id_wilayah',$id_wilayah);
    	}

        $this->db->select('checklist, count(*) as jumlah');
        $this->db->group_by('checklist');

        $return = array('0'=>0, '1'=>0, '2'=>0, '3'=>0,'kegiatan'=>0);
        foreach($this->db->get('ms_keg_checklist')->result() as $row)
            $return[$row->checklist] = $row->jumlah;

    	if($id_wilayah){
    		$this->db->where('id_wilayah',$id_wilayah);
    	}
        $this->db->select('count(*) as jumlah');
        $return['kegiatan'] = $this->db->get('ms_keg')->row()->jumlah;
        return $return;
    }

    function dashboard_opd(){
        $id_ms_keg = array();
        $this->db->where('userid', $this->session->userdata('userid'),'or');
        $this->db->where('instansi', $this->session->userdata('instansi'));
        foreach ($this->db->get('ms_keg')->result() as $row) {
            $id_ms_keg[] = $row->id_ms_keg;
        }

        $return = array('0'=>0, '1'=>0, '2'=>0, '3'=>0,'kegiatan'=>0);
        if($id_ms_keg) {
            $this->db->select('checklist, count(*) as jumlah');
            $this->db->where_in('id_ms_keg',$id_ms_keg);
            $this->db->group_by('checklist');
    
            foreach($this->db->get('ms_keg_checklist')->result() as $row)
                $return[$row->checklist] = $row->jumlah;
    
            $return['kegiatan'] = sizeof($id_ms_keg);
        }
        return $return;
    }


    function save_cek_provinsi($id,$data)
    {
        $data['updated_on'] = time();
        
        $this->db->where('id_ms_keg', $id);
        if($this->db->get('cek_provinsi')->row()){
            $this->db->where('id_ms_keg', $id);
            $this->db->update('cek_provinsi', $data);
            return $this->db->affected_rows();
        } else {
            $data['id_ms_keg'] = $id;
            $this->db->insert('cek_provinsi', $data);
            return $this->db->insert_id();
        }
    }

    function get_cek_provinsi($id)
    {
        $this->db->where('id_ms_keg', $id);
        return $this->db->get('cek_provinsi')->row();
    }


    // VARIABEL

    function save_variabel($id, $data)
    {
        foreach($data as $key=>$val)
            $data[$key] = trim($val);
        
        if(isset($data['id_variabel']) && $data['id_variabel']){
            $data['id'] = $data['id_variabel'];
            unset($data['id_variabel']);

            $this->db->where('id', $data['id'], 'and');
            $this->db->where('id_ms_keg', $id);
            $this->db->update('ms_var', $data);
            return $this->db->affected_rows();
        } else {
            unset($data['id_variabel']);
            $data['id_ms_keg'] = $id;
            $this->db->insert('ms_var', $data);
            return $this->db->insert_id();
        }
    }

    function get_variabel($id)
    {
        $this->db->where('id_ms_keg', $id);
        return $this->db->get('ms_var')->result();
    }

    function get_all_variabel()
    {
        if($this->session->userdata('role')<9)
            $this->db->where('checklist', '1', 'and')
                ->where('left(dapat_diakses_umum,1)','1');
        $this->db->join('ms_keg k','k.id_ms_keg=ms_var.id_ms_keg');
        $this->db->order_by('nama_variabel');
        return $this->db->get('ms_var')->result();
    }

    function del_variabel($id_ms_keg, $id)
    {
        $this->db->where('id_ms_keg', $id_ms_keg, 'and');
        $this->db->where('id', $id);
        $this->db->delete('ms_var');
        return $this->db->affected_rows();
    }

    function dashboard_variabel($id_wilayah=null){
    	if($id_wilayah){
    		$this->db->join('ms_keg','ms_keg.id_ms_keg = ms_var.id_ms_keg');
    		$this->db->where('ms_keg.id_wilayah',$id_wilayah);
    	}
        $this->db->select('checklist, count(*) as jumlah');
        $this->db->group_by('checklist');

        $return = array('0'=>0, '1'=>0, '2'=>0, '3'=>0);
        foreach($this->db->get('ms_var')->result() as $row)
            $return[$row->checklist] = $row->jumlah;

        $return['variabel'] = array_sum($return);
        return $return;
    }

    function dashboard_variabel_opd(){
        $id_ms_keg = array();
        $this->db->where('userid', $this->session->userdata('userid'),'or');
        $this->db->where('instansi', $this->session->userdata('instansi'));
        foreach ($this->db->get('ms_keg')->result() as $row) {
            $id_ms_keg[] = $row->id_ms_keg;
        }

        $return = array('0'=>0, '1'=>0, '2'=>0, '3'=>0, 'variabel'=>0);
        if($id_ms_keg){
                $this->db->select('checklist, count(*) as jumlah');
                $this->db->where_in('id_ms_keg',$id_ms_keg);
                $this->db->group_by('checklist');
        
                foreach($this->db->get('ms_var')->result() as $row)
                    $return[$row->checklist] = $row->jumlah;
        
                $return['variabel'] = array_sum($return);
        }
        return $return;
    }

    function approval_variabel($id, $data)
    {
        if(isset($data['id_variabel']) && $data['id_variabel']){
            $data['id'] = $data['id_variabel'];
            unset($data['id_variabel']);

            $this->db->where('id', $data['id'], 'and');
            $this->db->where('id_ms_keg', $id);
            $this->db->update('ms_var', $data);
            return $this->db->affected_rows();
        }
    }

     function get_checklist_variabel($id, $id_variabel)
    {
        $this->db->where('id_ms_keg', $id, 'and');
        $this->db->where('id', $id_variabel);
        return $this->db->get('ms_var')->row();
    }


    // 
    function save_wilayah($id, $data)
    {
        foreach($data as $key=>$val)
            $data[$key] = trim($val);

        if(isset($data['id_wilayah']) && $data['id_wilayah']){
            $data['id'] = $data['id_wilayah'];
            unset($data['id_wilayah']);

            $this->db->where('id', $data['id'], 'and');
            $this->db->where('id_ms_keg', $id);
            $this->db->update('ms_keg_blok_iv_wilayah', $data);
            return $this->db->affected_rows();
        } else {
            unset($data['id_wilayah']);
            $data['id_ms_keg'] = $id;
            $this->db->insert('ms_keg_blok_iv_wilayah', $data);
            return $this->db->insert_id();            
        }
    }

    function get_wilayah($id)
    {
        $this->db->where('id_ms_keg', $id);
        $this->db->order_by('provinsi,kabupaten');
        return $this->db->get('ms_keg_blok_iv_wilayah')->result();
    }

    function del_wilayah($id_ms_keg, $id)
    {
        $this->db->where('id_ms_keg', $id_ms_keg, 'and');
        $this->db->where('id', $id);
        $this->db->delete('ms_keg_blok_iv_wilayah');
        return $this->db->affected_rows();
    }

    // indikator

    function save_indikator($id, $data)
    {
        foreach($data as $key=>$val)
            $data[$key] = trim($val);

        if(isset($data['id_indikator']) && $data['id_indikator']){
            $data['id'] = $data['id_indikator'];
            unset($data['id_indikator']);

            $this->db->where('id', $data['id'], 'and');
            $this->db->where('id_ms_keg', $id);
            $this->db->update('ms_ind', $data);
            return $this->db->affected_rows();
        } else {
            unset($data['id_indikator']);
            $data['id_ms_keg'] = $id;
            $this->db->insert('ms_ind', $data);
            return $this->db->insert_id();            
        }
    }

    function get_indikator($id)
    {
        $this->db->where('id_ms_keg', $id);
        return $this->db->get('ms_ind')->result();
    }

    function get_all_indikator()
    {
        $this->db->where('checklist', '1', 'and')
            ->where('left(dapat_diakses_umum,1)','1');
        $this->db->join('ms_keg k','k.id_ms_keg=ms_ind.id_ms_keg');
        $this->db->order_by('nama_indikator');
        return $this->db->get('ms_ind')->result();
    }

    function del_indikator($id_ms_keg, $id)
    {
        $this->db->where('id_ms_keg', $id_ms_keg, 'and');
        $this->db->where('id', $id);
        $this->db->delete('ms_ind');
        return $this->db->affected_rows();
    }

    function dashboard_indikator($id_wilayah=null){
    	if($id_wilayah){
    		$this->db->join('ms_keg','ms_keg.id_ms_keg = ms_ind.id_ms_keg');
    		$this->db->where('ms_keg.id_wilayah',$id_wilayah);
    	}
        $this->db->select('checklist, count(*) as jumlah');
        $this->db->group_by('checklist');

        $return = array('0'=>0, '1'=>0, '2'=>0, '3'=>0);
        foreach($this->db->get('ms_ind')->result() as $row)
            $return[$row->checklist] = $row->jumlah;

        $return['indikator'] = array_sum($return);
        return $return;
    }

    function dashboard_indikator_opd(){
        $id_ms_keg = array();
        $this->db->where('userid', $this->session->userdata('userid'),'or');
        $this->db->where('instansi', $this->session->userdata('instansi'));
        foreach ($this->db->get('ms_keg')->result() as $row) {
            $id_ms_keg[] = $row->id_ms_keg;
        }

        $return = array('0'=>0, '1'=>0, '2'=>0, '3'=>0, 'indikator'=>0);
        if($id_ms_keg){
                $this->db->select('checklist, count(*) as jumlah');
                $this->db->where_in('id_ms_keg',$id_ms_keg);
                $this->db->group_by('checklist');
        
                foreach($this->db->get('ms_ind')->result() as $row)
                    $return[$row->checklist] = $row->jumlah;
        
                $return['indikator'] = array_sum($return);
        }
        return $return;
    }

    function approval_indikator($id, $data)
    {
        if(isset($data['id_indikator']) && $data['id_indikator']){
            $data['id'] = $data['id_indikator'];
            unset($data['id_indikator']);

            $this->db->where('id', $data['id'], 'and');
            $this->db->where('id_ms_keg', $id);
            $this->db->update('ms_ind', $data);
            return $this->db->affected_rows();
        }
    }

     function get_checklist_indikator($id, $id_indikator)
    {
        $this->db->where('id_ms_keg', $id, 'and');
        $this->db->where('id', $id_indikator);
        return $this->db->get('ms_ind')->row();
    }


    // checklist
    function get_checklist_status($id){
        $this->db->select("id_ms_keg, sum(case when checklist='0' then 1 end) as kode_0, sum(case when checklist='1' then 1 end) as kode_1, sum(case when checklist='2' then 1 end) as kode_2, sum(case when checklist='3' then 1 end) as kode_3");
        $this->db->where('id_ms_keg',$id);
        return $this->db->get('ms_keg_checklist')->row();
    }

    function add_checklist($input){
    	$ignore = array('userid','id_wilayah','instansi','approval_on');
    	foreach($ignore as $f) unset($input[$f]);

    	$id_ms_keg = $input['id_ms_keg'];
    	$blok = $input['blok'];
    	
    	foreach($input as $key=>$val){
    		if(!in_array($key, array('id_ms_keg','blok'))){
    			$data = array('id_ms_keg'=>$id_ms_keg, 'blok'=>$blok, 'field'=>$key, 'checklist'=>0);
    			$insert_string = $this->db->insert_string('ms_keg_checklist', $data);
	    		$insert_string = str_ireplace('INSERT', 'INSERT IGNORE', $insert_string);
	    		$this->db->query($insert_string);
    		}
    	}
    }

    function get_checklist($id,$blok){
        $this->db->where('id_ms_keg',$id,'and');
        $this->db->where('blok',$blok);
        $arr = array();
        foreach($this->db->get('ms_keg_checklist')->result() as $row)
            $arr[$row->field] = $row->checklist;
        return $arr;
    }

    function get_check_blok($id,$blok){
        $this->db->where('id_ms_keg',$id,'and');
        $this->db->where('blok',$blok);
        $arr = array();
        foreach($this->db->get('ms_keg_checklist')->result() as $row)
            $arr[$row->field] = $row;
        return $arr;
    }

    function get_check_field($id,$blok,$field){
        $this->db->where('id_ms_keg',$id,'and');
        $this->db->where('blok',$blok,'and');
        $this->db->where('field',$field);
        return $this->db->get('ms_keg_checklist')->row();
    }

    function save_check_field($id,$data)
    {
        foreach($data as $key=>$val)
            $data[$key] = trim($val);

        if(empty($data['blok']) || !$data['blok'])
            $data['blok']='';
            
        $insert_string = $this->db->insert_string('ms_keg_checklist_awal', $data + array('id_ms_keg'=> $id));
	    $insert_string = str_ireplace('INSERT', 'INSERT IGNORE', $insert_string);
	    $this->db->query($insert_string);

        $this->db->where('id_ms_keg',$id,'and');
        $this->db->where('blok',$data['blok'],'and');
        $this->db->where('field',$data['field']);
        $row = $this->db->get('ms_keg_checklist')->row();

        if($row){
            $this->db->where('id_ms_keg',$id,'and');
            $this->db->where('blok',$data['blok'],'and');
            $this->db->where('field',$data['field']);
            $this->db->update('ms_keg_checklist', $data);
            return $this->db->affected_rows();            
        } else {
            $data['id_ms_keg'] = $id;
            $this->db->insert('ms_keg_checklist', $data);
            return $this->db->insert_id();                        
        }
        
    }

     function get_checklist_by_status($id, $status)
    {
        $this->db->where('id_ms_keg', $id, 'and');
        $this->db->where('checklist', $status);
        return $this->db->get('ms_keg_checklist')->result();
    }

    // approval
    function set_approval($id_ms_keg, $blok, $data)
    {
        $tabel = 'ms_keg_'.($blok? $blok.'_' : '').'check';
        $this->db->where('id_ms_keg', $id_ms_keg);

        $array[$data['field'].'_checklist'] = $data['value'];
        if(isset($data['feedback']))
            $array[$data['field'].'_feedback'] = $data['feedback'];            
        if(isset($data['feedback_2']))
            $array[$data['field'].'_feedback_2'] = $data['feedback_2'];            
        if(isset($data['respon']))
            $array[$data['field'].'_respon'] = $data['respon'];  

        if($this->db->get($tabel)->row()){
            $this->db->where('id_ms_keg', $id_ms_keg);
            $this->db->update($tabel, $array);    
//            return $this->db->affected_rows();
        } else {
            $array['id_ms_keg'] = $id_ms_keg;
            $this->db->insert($tabel, $array);
//            return $this->db->insert_id();        
        }
        $this->db->where($array);
        return $this->db->get($tabel)->row();
    }

    // approval kegiatan (final)
    function set_approval_kegiatan($id_ms_keg, $status)
    {
        $approval_on = $status=='1'? date('Y-m-d H:i:s') : '0000-00-00 00:00:00';

        $this->db->where('id_ms_keg', $id_ms_keg);
        $this->db->update($this->table, array('approval_on'=>$approval_on));
        return $this->db->affected_rows();
    }



    // getter untuk variabel di tabel yang lain

    function get_jml_variabel($id_ms_keg)
    {
        $this->db->where('id_ms_keg', $id_ms_keg);
        return $this->db->get('ms_var')->num_rows();      
    }

    function get_jml_indikator($id_ms_keg)
    {
        $this->db->where('id_ms_keg', $id_ms_keg);
        return $this->db->get('ms_ind')->num_rows();      
    }

    function get_jabatan_penanggung_jawab_teknis($id_ms_keg)
    {
        $this->db->where('id_ms_keg', $id_ms_keg);
        $row = $this->db->get('ms_keg_blok_ii')->row();
        return $row->jabatan_penanggung_jawab_teknis;
       
    }


// validasi
    function get_validasi($id, $page=null)
    {
        if($page && !in_array($page, array(1,2,3,4,5,6,7)))
            $page = null;

        $e = array(); // error list
        $d = array(''=>$this->mskegiatan_model->get($id)); // array data per blok
        foreach(array('i','ii','iii','iv','v','vi','vii','viii') as $blok)
            $d[$blok] = $this->mskegiatan_model->get_blok($id,$blok);

        // validasi halaman pertama
//->
        if(strlen($d['']->judul_kegiatan)<10) 
            $e['1'][] = '[Judul Kegiatan] kosong atau terlalu pendek';

//->
        if($d['']->tahun<2019 || $d['']->tahun>date('Y')) 
            $e['1'][] = '[Tahun] tidak boleh < 2019 atau > '.date('Y');

        if(!in_array($d['']->cara_pengumpulan_data, array('1','2','3','4'))) 
            $e['1'][] = '[Cara Pengumpulan Data] hanya boleh diisi angka 1,2,3,4';

        if(!intval($d['']->sektor_kegiatan) || intval($d['']->sektor_kegiatan)>22) 
            $e['1'][] = '[Sektor Kegiatan] hanya boleh diisi angka 1 s.d 22';

//        if($d['']->cara_pengumpulan_data=='2' && $d['']->apakah_mendapat_rekomendasi) 
//            $e['1'][] = '[Rekomendasi dari BPS] hanya terisi jika [Cara Pengumpulan Data] = 2';
//
//        if($d['']->cara_pengumpulan_data=='2' && !in_array($d['']->apakah_mendapat_rekomendasi, array('1','2'))) 
//            $e['1'][] = '[Rekomendasi dari BPS] hanya boleh diisi angka 1,2';

        if(!in_array($d['']->apakah_mendapat_rekomendasi, array('1','2'))) 
            $e['1'][] = '[Rekomendasi dari BPS] hanya boleh diisi angka 1,2';

//->
        if($d['']->apakah_mendapat_rekomendasi=='1' && strlen($d['']->identitas_rekomendasi)<3)
            $e['1'][] = 'Jika [Rekomendasi dari BPS] = 1, maka Identitas Rekomendasi minimal 3 karakter';

        if($d['']->apakah_mendapat_rekomendasi=='2' && $d['']->identitas_rekomendasi)
            $e['1'][] = 'Jika [Rekomendasi dari BPS] = 2, maka Identitas Rekomendasi harus dikosongkan';

        // validasi halaman 2
//->
        if(strlen($d['i']->instansi_penyelenggara)<10)
            $e['2'][] = '1.1. Instansi Penyelenggara terlalu pendek';

//->
        if(strlen($d['i']->alamat_lengkap_instansi_penyelenggara)<5)
            $e['2'][] = '1.2. Alamat Lengkap Instansi Penyelenggara terlalu pendek';

//->
        if($d['i']->telepon!='-' && strlen($d['i']->telepon)<10)
            $e['2'][] = '1.2. Nomor Telepon Instansi terlalu pendek';

//->
        if(strlen($d['i']->email)<10 && $d['i']->email!='-')
            $e['2'][] = '1.2. Email Instansi terlalu pendek';

//        if($d['i']->email!='-' && !filter_var($d['i']->email, FILTER_VALIDATE_EMAIL))
  //          $e['2'][] = '1.2. Email Instansi tidak valid';

//->
//        if(strlen($d['ii']->unit_penanggung_jawab_eselon1)<10)
//            $e['2'][] = '2.1. Unit Penanggung Jawab Eselon 1 terlalu pendek';
        if(strlen($d['ii']->unit_penanggung_jawab_eselon1)<1)
            $e['2'][] = '2.1. Unit Penanggung Jawab Eselon 1 tidak boloh kosong';

//->
        if(strlen($d['ii']->unit_penanggung_jawab_eselon2)<10)
            $e['2'][] = '2.1. Unit Penanggung Jawab Eselon 2 terlalu pendek';

//->
        if(strlen($d['ii']->jabatan_penanggung_jawab_teknis)<10)
            $e['2'][] = '2.2. Jabatan Penanggung Jawab Teknis terlalu pendek';

//->
        if(strlen($d['ii']->alamat_penanggung_jawab_teknis)<5)
            $e['2'][] = '2.2. Alamat Penanggung Jawab Teknis terlalu pendek';

//->
        if(strlen($d['ii']->telepon_penanggung_jawab_teknis)<10)
            $e['2'][] = '2.2. Telepon Penanggung Jawab Teknis terlalu pendek';

//->
        if($d['ii']->email_penanggung_jawab_teknis!='-' && strlen($d['ii']->email_penanggung_jawab_teknis)<10)
           $e['2'][] = '2.2. Email Penanggung Jawab Teknis terlalu pendek';

//        if(!filter_var($d['ii']->email_penanggung_jawab_teknis, FILTER_VALIDATE_EMAIL))
//           $e['2'][] = '2.2. Email Penanggung Jawab Teknis tidak valid';

//->
        if(strlen($d['iii']->latar_belakang_kegiatan)<50)
            $e['2'][] = '3.1. Latar Belakang Kegiatan terlalu pendek';

//->
        if(strlen($d['iii']->tujuan_kegiatan)<50)
            $e['2'][] = '3.2. Tujuan Kegiatan terlalu pendek';

        // validasi halaman 3
        if(!$d['iii']->perencanaan_kegiatan_awal || !$d['iii']->perencanaan_kegiatan_akhir || 
            strtotime($d['iii']->perencanaan_kegiatan_awal) > strtotime($d['iii']->perencanaan_kegiatan_akhir) )
            $e['3'][] = '3.3.A.1. Perencanaan Kegiatan : harus terisi lengkap, dan tanggal awal < tanggal akhir ';

        if(!$d['iii']->desain_awal || !$d['iii']->desain_akhir || 
            strtotime($d['iii']->desain_awal) > strtotime($d['iii']->desain_akhir) )
            $e['3'][] = '3.3.A.2. Desain : harus terisi lengkap, dan tanggal awal < tanggal akhir ';

        if(!$d['iii']->pengumpulan_data_awal || !$d['iii']->pengumpulan_data_akhir || 
            strtotime($d['iii']->pengumpulan_data_awal) > strtotime($d['iii']->pengumpulan_data_akhir) )
            $e['3'][] = '3.3.B.3. Pengumpulan Data : harus terisi lengkap, dan tanggal awal < tanggal akhir ';

        if(!$d['iii']->pengolahan_data_awal || !$d['iii']->pengolahan_data_akhir || 
            strtotime($d['iii']->pengolahan_data_awal) > strtotime($d['iii']->pengolahan_data_akhir) )
            $e['3'][] = '3.3.C.4. Pengolahan Data : harus terisi lengkap, dan tanggal awal < tanggal akhir ';

        if(!$d['iii']->analisis_awal || !$d['iii']->analisis_akhir || 
            strtotime($d['iii']->analisis_awal) > strtotime($d['iii']->analisis_akhir) )
            $e['3'][] = '3.3.D.5. Analisis : harus terisi lengkap, dan tanggal awal < tanggal akhir ';

        if(!$d['iii']->diseminasi_hasil_awal || !$d['iii']->diseminasi_hasil_akhir || 
            strtotime($d['iii']->diseminasi_hasil_awal) > strtotime($d['iii']->diseminasi_hasil_akhir) )
            $e['3'][] = '3.3.D.6. Diseminasi Hasil : harus terisi lengkap, dan tanggal awal < tanggal akhir ';

        if(!$d['iii']->evaluasi_awal || !$d['iii']->evaluasi_akhir || 
            strtotime($d['iii']->evaluasi_awal) > strtotime($d['iii']->evaluasi_akhir) )
            $e['3'][] = '3.3.D.7. Evaluasi : harus terisi lengkap, dan tanggal awal < tanggal akhir ';

        $variabel = sizeof($this->mskegiatan_model->get_variabel($id));
        if(!$variabel) 
            $e['3'][] = '3.4. Variabel (Karakteristik) yang Dikumpulkan, tidak boleh kosong';


        if(!in_array($d['iv']->kegiatan_ini_dilakukan, array('1','2'))) 
            $e['3'][] = '4.1. Kegiatan Ini Dilakukan, hanya boleh diisi angka 1,2';

        if($d['iv']->kegiatan_ini_dilakukan=='1' && $d['iv']->frekuensi_penyelenggaraan) 
            $e['3'][] = 'Jika 4.1. Kegiatan Ini Dilakukan : kode 1, maka 4.2. Frekuensi Penyelenggaraan harus dikosongkan';

        if($d['iv']->kegiatan_ini_dilakukan=='2' && !$d['iv']->frekuensi_penyelenggaraan) 
            $e['3'][] = 'Jika 4.1. Kegiatan Ini Dilakukan : kode 2, maka 4.2. Frekuensi Penyelenggaraan harus ada isian';

        if($d['iv']->kegiatan_ini_dilakukan=='2' && !in_array($d['iv']->frekuensi_penyelenggaraan, array('1','2','3','4','5','6','7','8'))) 
            $e['3'][] = '4.2. Frekuensi Penyelenggaraan, hanya boleh diisi angka 1 s.d 8';


        //verifikasi halaman 4
        if(!in_array($d['iv']->tipe_pengumpulan_data, array('1','2','3'))) 
            $e['4'][] = '4.3. Tipe Pengumpulan Data, hanya boleh diisi angka 1,2,3';

        if(!in_array($d['iv']->cakupan_wilayah_pengumpulan_data, array('1','2'))) 
            $e['4'][] = '4.4. Cakupan Wilayah Pengumpulan Data, hanya boleh diisi angka 1,2';

        $wilayah = sizeof($this->mskegiatan_model->get_wilayah($id));

        if($d['iv']->cakupan_wilayah_pengumpulan_data==1 && $wilayah>0) 
            $e['4'][] = 'Jika 4.4. Cakupan Wilayah Pengumpulan Data = 1, maka 4.5 tidak boleh terisi';

        if($d['iv']->cakupan_wilayah_pengumpulan_data==2 && !$wilayah) 
            $e['4'][] = 'Jika 4.4. Cakupan Wilayah Pengumpulan Data = 2, maka 4.5 harus ada wilayah yang terisi';

        if(!intval($d['iv']->metode_pengumpulan_data) || intval($d['iv']->metode_pengumpulan_data)>31 ) 
            $e['4'][] = '4.6. Metode Pengumpulan Data berisi nilai akumulasi pilihan, hanya boleh terisi angka 1 s.d 31';

        if(intval($d['iv']->metode_pengumpulan_data)<16 && $d['iv']->metode_pengumpulan_data_lainnya ) 
            $e['4'][] = '4.6. Metode Pengumpulan Data kode 16 tidak terpilih, tetapi isian Lainnya tidak kosong';

//->
        if(intval($d['iv']->metode_pengumpulan_data)>=16 && strlen($d['iv']->metode_pengumpulan_data_lainnya)<10 ) 
            $e['4'][] = '4.6. Metode Pengumpulan Data kode 16 terpilih, tetapi isian Lainnya kosong atau terlalu pendek';

        if(!intval($d['iv']->sarana_pengumpulan_data) || intval($d['iv']->sarana_pengumpulan_data)>63 ) 
            $e['4'][] = '4.7. Sarana Pengumpulan Data berisi nilai akumulasi pilihan, hanya boleh terisi angka 1 s.d 63';

        if(intval($d['iv']->sarana_pengumpulan_data)<32 && $d['iv']->sarana_pengumpulan_data_lainnya ) 
            $e['4'][] = '4.7. Sarana Pengumpulan Data kode 32 tidak terpilih, tetapi isian Lainnya tidak kosong';

//->
        if(intval($d['iv']->sarana_pengumpulan_data)>=32 && strlen($d['iv']->sarana_pengumpulan_data_lainnya)<3 ) 
            $e['4'][] = '4.7. Sarana Pengumpulan Data kode 32 terpilih, tetapi isian Lainnya kosong atau terlalu pendek';

        if(!intval($d['iv']->unit_pengumpulan_data) || intval($d['iv']->unit_pengumpulan_data)>15 ) 
            $e['4'][] = '4.8. Unit Pengumpulan Data berisi nilai akumulasi pilihan, hanya boleh terisi angka 1 s.d 15';

        if(intval($d['iv']->unit_pengumpulan_data)<8 && $d['iv']->unit_pengumpulan_data_lainnya ) 
            $e['4'][] = '4.8. Unit Pengumpulan Data kode 8 tidak terpilih, tetapi isian Lainnya tidak kosong';

//->
        if(intval($d['iv']->unit_pengumpulan_data)>=8 && strlen($d['iv']->unit_pengumpulan_data_lainnya)<10 ) 
            $e['4'][] = '4.8. Unit Pengumpulan Data kode 8 terpilih, tetapi isian Lainnya kosong atau terlalu pendek';

        //verifikasi halaman 5
    // jika cara pengumpulan data = Survei (2)
    if($d['']->cara_pengumpulan_data=='2'){
        if(!in_array($d['v']->jenis_rancangan_sampel, array('1','2'))) 
            $e['5'][] = 'Cara Pengumpulan Data = Survei, maka 5.1. Jenis Rancangan Sampel diisi angka 1 atau 2';

        if(!in_array($d['v']->metode_pemilihan_sampel_tahap_terakhir, array('1','2'))) 
            $e['5'][] = 'Cara Pengumpulan Data = Survei, maka 5.2. Metode Pemilihan Sampel Tahap Terakhir diisi angka 1 atau 2';

        if($d['v']->metode_pemilihan_sampel_tahap_terakhir=='1' && !in_array($d['v']->metode_yang_digunakan, array('1','2','3','4','5'))) 
            $e['5'][] = 'Jika “sampel probabilitas” (R.5.2. berkode 1), maka 5.3. Metode yang Digunakan harus antara 1 s.d 5';

        if($d['v']->metode_pemilihan_sampel_tahap_terakhir=='2' && !in_array($d['v']->metode_yang_digunakan, array('6','7','8','9','10'))) 
            $e['5'][] = 'Jika “sampel nonprobabilitas (R.5.2. berkode 2), maka 5.3. Metode yang Digunakan harus antara 6 s.d 10';

        if($d['v']->metode_pemilihan_sampel_tahap_terakhir=='1' && !$d['v']->kerangka_sampel_tahap_terakhir) 
            $e['5'][] = 'Jika “sampel probabilitas” (R.5.2. berkode 1), maka 5.4. Kerangka Sampel Tahap Terakhir tidak boleh kosong';

        if($d['v']->metode_pemilihan_sampel_tahap_terakhir=='2' && $d['v']->kerangka_sampel_tahap_terakhir) 
            $e['5'][] = 'Jika “sampel nonprobabilitas” (R.5.2. berkode 2), maka 5.4. Kerangka Sampel Tahap Terakhir tidak boleh terisi';

        if($d['v']->metode_pemilihan_sampel_tahap_terakhir=='1' && !in_array($d['v']->kerangka_sampel_tahap_terakhir, array('1','2'))) 
            $e['5'][] = '5.4. Kerangka Sampel Tahap Terakhir, hanya boleh diisi angka 1,2';

        if($d['v']->metode_pemilihan_sampel_tahap_terakhir=='1' && !$d['v']->fraksi_sampel_keseluruhan) 
            $e['5'][] = 'Jika “sampel probabilitas” (R.5.2. berkode 1), maka 5.5. Fraksi Sampel Keseluruhan tidak boleh kosong';

        if($d['v']->metode_pemilihan_sampel_tahap_terakhir=='2' && $d['v']->fraksi_sampel_keseluruhan) 
            $e['5'][] = 'Jika “sampel nonprobabilitas” (R.5.2. berkode 2), maka 5.5. Fraksi Sampel Keseluruhan tidak boleh terisi';

        if($d['v']->metode_pemilihan_sampel_tahap_terakhir=='1' && !$d['v']->nilai_perkiraan_sampling_error_variabel_utama) 
            $e['5'][] = 'Jika “sampel probabilitas” (R.5.2. berkode 1), maka 5.6. Nilai Perkiraan Sampling Error Variabel Utama tidak boleh kosong';

        if($d['v']->metode_pemilihan_sampel_tahap_terakhir=='2' && $d['v']->nilai_perkiraan_sampling_error_variabel_utama) 
            $e['5'][] = 'Jika “sampel nonprobabilitas” (R.5.2. berkode 1), maka 5.6. Nilai Perkiraan Sampling Error Variabel Utama tidak boleh terisi';
//->
        if(strlen($d['v']->unit_sampel)<5) 
            $e['5'][] = '5.7. Unit Sampel terlalu pendek';

//->
        if(strlen($d['v']->unit_observasi)<5) 
            $e['5'][] = '5.8. Unit Observasi terlalu pendek';

    } else { // jika selain survei

        if($d['v']->jenis_rancangan_sampel) 
            $e['5'][] = '5.1. Jenis Rancangan Sampel tidak perlu diisi jika Cara Pengumpulan Data bukan Survei';

        if($d['v']->metode_pemilihan_sampel_tahap_terakhir) 
            $e['5'][] = '5.2. Metode Pemilihan Sampel Tahap Terakhir tidak perlu diisi jika Cara Pengumpulan Data bukan Survei';

        if($d['v']->metode_yang_digunakan) 
            $e['5'][] = '5.3. Metode yang Digunakan tidak perlu diisi jika Cara Pengumpulan Data bukan Survei';

        if($d['v']->kerangka_sampel_tahap_terakhir) 
            $e['5'][] = '5.4. Kerangka Sampel Tahap Terakhir tidak perlu diisi jika Cara Pengumpulan Data bukan Survei';

        if($d['v']->fraksi_sampel_keseluruhan) 
            $e['5'][] = '5.5. Fraksi Sampel Keseluruhan tidak perlu diisi jika Cara Pengumpulan Data bukan Survei';

        if($d['v']->nilai_perkiraan_sampling_error_variabel_utama) 
            $e['5'][] = '5.6. Nilai Perkiraan Sampling Error Variabel Utama tidak perlu diisi jika Cara Pengumpulan Data bukan Survei';

        if($d['v']->unit_sampel) 
            $e['5'][] = '5.7. Unit Sampel tidak perlu diisi jika Cara Pengumpulan Data bukan Survei';

        if($d['v']->unit_observasi) 
            $e['5'][] = '5.8. Unit Observasi tidak perlu diisi jika Cara Pengumpulan Data bukan Survei';
    }

        if(!in_array($d['vi']->apakah_melakukan_uji_coba, array('1','2'))) 
            $e['5'][] = '6.1. Apakah Melakukan Uji Coba (Pilot Survey), hanya boleh diisi angka 1,2';

        // validasi halaman 6
        if(!intval($d['vi']->metode_pemeriksaan_kualitas_pengumpulan_data) || intval($d['vi']->metode_pemeriksaan_kualitas_pengumpulan_data)>15 ) 
            $e['6'][] = '6.2. Metode Pemeriksaan Kualitas Pengumpulan Data berisi nilai akumulasi pilihan, hanya boleh terisi angka 1 s.d 15';

        if(intval($d['vi']->metode_pemeriksaan_kualitas_pengumpulan_data)<8 && $d['vi']->metode_pemeriksaan_kualitas_pengumpulan_data_lainnya ) 
            $e['6'][] = '6.2. Metode Pemeriksaan Kualitas Pengumpulan Data kode 8 tidak terpilih, tetapi isian Lainnya tidak kosong';

//->
        if(intval($d['vi']->metode_pemeriksaan_kualitas_pengumpulan_data)>=8 && strlen($d['vi']->metode_pemeriksaan_kualitas_pengumpulan_data_lainnya)<10 ) 
            $e['6'][] = '6.2. Metode Pemeriksaan Kualitas Pengumpulan Data kode 8 terpilih, tetapi isian Lainnya kosong atau terlalu pendek';

        if(!in_array($d['vi']->apakah_melakukan_penyesuaian_nonrespon, array('1','2'))) 
            $e['6'][] = '6.3. Apakah Melakukan Penyesuaian Nonrespon, hanya boleh diisi angka 1,2';

// Pertanyaan 6.4 – 6.7 ditanyakan jika sarana pengumpulan data adalah PAPI, CAPI, atau CATI (Pilihan R.4.7. kode 1, 2, dan/atau 4 dilingkari) -> 1,2,3,4,5,6,7
// seharusnya : not in (8,16,24,32,40,48,56)

//        if(intval($d['iv']->sarana_pengumpulan_data) && $d['iv']->sarana_pengumpulan_data<=7){
        if(intval($d['iv']->sarana_pengumpulan_data) && !in_array($d['iv']->sarana_pengumpulan_data, array(8,16,24,32,40,48,56))){
            if(!in_array($d['vi']->petugas_pengumpulan_data, array('1','2','3')))
                $e['6'][] = '6.4. Petugas Pengumpulan Data harus terisi 1,2,3 karena 4.7. Sarana Pengumpulan Data kode 1,2,4 terpilih';

            if(!in_array($d['vi']->persyaratan_pendidikan_terendah_petugas_pengumpulan_data, array('1','2','3','4')))
                $e['6'][] = '6.5. Persyaratan Pendidikan Terendah Petugas Pengumpulan Data harus terisi 1,2,3,4 karena 4.7. Sarana Pengumpulan Data kode 1,2,4 terpilih';

            if(!intval($d['vi']->jumlah_petugas_supervisor))
                $e['6'][] = '6.6. Jumlah Petugas Supervisor/penyelia/pengawas harus terisi angka karena 4.7. Sarana Pengumpulan Data kode 1,2,4 terpilih';

            if(!intval($d['vi']->jumlah_petugas_enumerator))
                $e['6'][] = '6.6. Jumlah Petugas Pengumpul data/enumerator harus terisi angka karena 4.7. Sarana Pengumpulan Data kode 1,2,4 terpilih';

            if(intval($d['vi']->jumlah_petugas_supervisor) > intval($d['vi']->jumlah_petugas_enumerator))
                $e['6'][] = '6.6. Jumlah Petugas Supervisor/penyelia/pengawas tidak boleh lebih banyak dari Jumlah Petugas Pengumpul data/enumerator';

            if(!in_array($d['vi']->apakah_melakukan_pelatihan_petugas, array('1','2')))
                $e['6'][] = '6.7. Apakah Melakukan Pelatihan Petugas harus terisi 1 atau 2 karena 4.7. Sarana Pengumpulan Data kode 1,2,4 terpilih';
        } else {
            if($d['vi']->petugas_pengumpulan_data)
                $e['6'][] = '6.4. Petugas Pengumpulan Data ada isian, padahal 4.7. Sarana Pengumpulan Data kode 1,2,4 tidak ada yang terpilih';

            if($d['vi']->persyaratan_pendidikan_terendah_petugas_pengumpulan_data)
                $e['6'][] = '6.5. Persyaratan Pendidikan Terendah Petugas Pengumpulan Data ada isian, padahal 4.7. Sarana Pengumpulan Data kode 1,2,4 tidak ada yang terpilih';

            if($d['vi']->jumlah_petugas_supervisor)
                $e['6'][] = '6.6. Jumlah Petugas Supervisor/penyelia/pengawas ada isian, padahal 4.7. Sarana Pengumpulan Data kode 1,2,4 tidak ada yang terpilih';

            if($d['vi']->jumlah_petugas_enumerator)
                $e['6'][] = '6.6. Jumlah Petugas Pengumpul data/enumerator ada isian, padahal 4.7. Sarana Pengumpulan Data kode 1,2,4 tidak ada yang terpilih';

            if($d['vi']->apakah_melakukan_pelatihan_petugas)
                $e['6'][] = '6.7. Apakah Melakukan Pelatihan Petugas ada isian, padahal 4.7. Sarana Pengumpulan Data kode 1,2,4 tidak ada yang terpilih';
        }


        if(!in_array($d['vii']->tahapan_pengolahan_data_editing, array('1','2')))
            $e['6'][] = '7.1. Tahapan Pengolahan Data - Penyuntingan (Editing) harus terisi angka 1 atau 2';

        if(!in_array($d['vii']->tahapan_pengolahan_data_coding, array('1','2')))
            $e['6'][] = '7.1. Tahapan Pengolahan Data - Penyandian (Coding) harus terisi angka 1 atau 2';

        if(!in_array($d['vii']->tahapan_pengolahan_data_entry, array('1','2')))
            $e['6'][] = '7.1. Tahapan Pengolahan Data - Data Entry harus terisi angka 1 atau 2';

        if(!in_array($d['vii']->tahapan_pengolahan_data_validasi, array('1','2')))
            $e['6'][] = '7.1. Tahapan Pengolahan Data - Penyahihan (Validasi) harus terisi angka 1 atau 2';

        if(!in_array($d['vii']->metode_analisis, array('1','2','3')))
            $e['6'][] = '7.2. Metode Analisis harus terisi angka 1,2,3';


        // validasi halaman 7
        if(!intval($d['vii']->unit_analisis) || intval($d['vii']->unit_analisis)>15 ) 
            $e['7'][] = '7.3. Unit Analisis berisi nilai akumulasi pilihan, hanya boleh terisi angka 1 s.d 15';

        if(intval($d['vii']->unit_analisis)<8 && $d['vii']->unit_analisis_lainnya ) 
            $e['7'][] = '7.3. Unit Analisis kode 8 tidak terpilih, tetapi isian Lainnya tidak kosong';

//->
        if(intval($d['vii']->unit_analisis)>=8 && strlen($d['vii']->unit_analisis_lainnya)<3 ) 
            $e['7'][] = '7.3. Unit Analisis kode 8 terpilih, tetapi isian Lainnya kosong atau terlalu pendek';

        if(!intval($d['vii']->tingkat_penyajian_hasil_analisis) || intval($d['vii']->tingkat_penyajian_hasil_analisis)>31 ) 
            $e['7'][] = '7.4. Tingkat Penyajian Hasil Analisis berisi nilai akumulasi pilihan, hanya boleh terisi angka 1 s.d 31';

        if(intval($d['vii']->tingkat_penyajian_hasil_analisis)<16 && $d['vii']->tingkat_penyajian_hasil_analisis_lainnya ) 
            $e['7'][] = '7.4. Tingkat Penyajian Hasil Analisis kode 16 tidak terpilih, tetapi isian Lainnya tidak kosong';

//->
        if(intval($d['vii']->tingkat_penyajian_hasil_analisis)>=16 && strlen($d['vii']->tingkat_penyajian_hasil_analisis_lainnya)<3 ) 
            $e['7'][] = '7.4. Tingkat Penyajian Hasil Analisis kode 16 terpilih, tetapi isian Lainnya kosong atau terlalu pendek';

        if(!in_array($d['viii']->ketersediaan_produk_tercetak, array('1','2')))
            $e['7'][] = '8.1. Produk Kegiatan yang Tersedia untuk Umum - Tercetak (hardcopy) harus terisi angka 1 atau 2';

        if(!in_array($d['viii']->ketersediaan_produk_digital, array('1','2')))
            $e['7'][] = '8.1. Produk Kegiatan yang Tersedia untuk Umum - Digital (softcopy) harus terisi angka 1 atau 2';

        if(!in_array($d['viii']->ketersediaan_produk_mikrodata, array('1','2')))
            $e['7'][] = '8.1. Produk Kegiatan yang Tersedia untuk Umum - Data Mikro harus terisi angka 1 atau 2';

//->tahun < 2019
        $mktime = mktime(0,0,0,1,1,2019);
        if($d['viii']->ketersediaan_produk_tercetak=='1' && strtotime($d['viii']->rencana_jadwal_rilis_produk_tercetak) < $mktime)
            $e['7'][] = '8.2. Rencana Rilis Produk Kegiatan - Tercetak (hardcopy) tidak valid';

        if($d['viii']->ketersediaan_produk_tercetak=='2' && $d['viii']->rencana_jadwal_rilis_produk_tercetak!='0000-00-00')
            $e['7'][] = '8.2. Rencana Rilis Produk Kegiatan - Tercetak (hardcopy) ada isian, padahal 8.1. Produk Kegiatan yang Tersedia untuk Umum - Tercetak (hardcopy) kode 2';

        if($d['viii']->ketersediaan_produk_digital=='1' && strtotime($d['viii']->rencana_jadwal_rilis_produk_digital) < $mktime)
            $e['7'][] = '8.2. Rencana Rilis Produk Kegiatan - Digital (softcopy) tidak valid';

        if($d['viii']->ketersediaan_produk_digital=='2' && $d['viii']->rencana_jadwal_rilis_produk_digital!='0000-00-00')
            $e['7'][] = '8.2. Rencana Rilis Produk Kegiatan - Digital (softcopy) ada isian, padahal 8.1. Produk Kegiatan yang Tersedia untuk Umum - Digital (softcopy) kode 2';

        if($d['viii']->ketersediaan_produk_mikrodata=='1' && strtotime($d['viii']->rencana_jadwal_rilis_produk_mikrodata) < $mktime)
            $e['7'][] = '8.2. Rencana Rilis Produk Kegiatan - Data Mikro tidak valid';

        if($d['viii']->ketersediaan_produk_mikrodata=='2' && $d['viii']->rencana_jadwal_rilis_produk_mikrodata!='0000-00-00')
            $e['7'][] = '8.2. Rencana Rilis Produk Kegiatan - Data Mikro ada isian, padahal 8.1. Produk Kegiatan yang Tersedia untuk Umum - Data Mikro kode 2';

/*        
        $variabel = $his->mskegiatan_model->get_variabel($id);
        $exclude = array('');
        $no = 1;
        foreach($variabel as $var){
            if()   
        }
        
        $indikator = $his->mskegiatan_model->get_indikator($id);
        foreach($indikator as $ind){
            
        }
        
*/
        if(!$page)
            return $e;
        else
            return !empty($e[$page])? $e[$page] : array();
    } 

    function get_iv_wilayah($id)
    {
        $this->db->where('id_ms_keg', $id);
        return $this->db->get('ms_keg_blok_iv_wilayah')->result();
    }

    function get_validasi_indikator($id)
    {
        $errors = array(); // error list

        foreach($this->mskegiatan_model->get_indikator($id) as $v) {
            $e = array();
            if(!$v->nama_indikator || !$v->konsep || !$v->definisi || !$v->interpretasi || !$v->metode || !$v->ukuran || !$v->satuan || !$v->klasifikasi || !$v->indikator_komposit)
                $e[] = "Kolom (1) s.d (10) wajib diisi";

            if(substr($v->indikator_komposit,0,1)=='1' && (!$v->indikator_pembangun_publikasi || !$v->indikator_pembangun_nama))
                $e[] = "Cek Konsistensi : Jika kolom (10) kode 1, maka kolom (11) dan (12) harus ada isian";
            else if(substr($v->indikator_komposit,0,1)=='2') {
                if($v->indikator_pembangun_publikasi || $v->indikator_pembangun_nama)
                    $e[] = "Cek Konsistensi : Jika kolom (10) kode 2, maka kolom (11) dan (12) tidak boleh ada isian";
                if(!$v->variabel_pembangun_kegiatan || !$v->variabel_pembangun_kode || !$v->variabel_pembangun_nama)
                    $e[] = "Cek Konsistensi : Jika kolom (10) kode 2, maka kolom (13) s.d (15) harus ada isian";
            }

            if(!$v->level_estimasi || !$v->dapat_diakses_umum)
                $e[] = "Kolom (16) s.d (17) wajib diisi";

            if($e)
                $errors[$v->id] = $e;
        }

        return $errors;
    }

    function get_validasi_variabel($id)
    {
        $fields = array('nama_variabel', 'alias', 'konsep', 'definisi', 'referensi_pemilihan', 'referensi_waktu', 'tipe_data', 'klasifikasi_isian', 'aturan_validasi', 'kalimat_pertanyaan', 'dapat_diakses_umum');
        $errors = array(); // error list
        foreach($this->mskegiatan_model->get_variabel($id) as $v) {
            $e = array();
            for($i=0; $i<sizeof($fields); $i++) {
                if(!$v->{$fields[$i]})
                    $e[] = "Kolom (".($i+2).") ".ucwords(str_replace('_',' ',$fields[$i]))." : wajib diisi";
            }
            
            if($e)
                $errors[$v->id] = $e;
        }

        return $errors;
    }

    function var_by_wilayah($id_wilayah=null){
        if($id_wilayah){
            $this->db->join('omae_ms_keg','omae_ms_keg.id_ms_keg=omae_ms_var.id_ms_keg');
            $this->db->where('id_wilayah',$id_wilayah);                   
        }
        return $this->db->get('omae_ms_var')->result();
    }

    function ind_by_wilayah($id_wilayah=null){
        if($id_wilayah){
            $this->db->join('omae_ms_keg','omae_ms_keg.id_ms_keg=omae_ms_ind.id_ms_keg');
            $this->db->where('id_wilayah',$id_wilayah);                   
        }
        return $this->db->get('omae_ms_ind')->result();
    }

    function get_kegiatan($id_wilayah, $id_ms_keg)
    {
        $unset = array('instansi','sedang_verifikasi','approval_on','sesuai_standar','catatan_provinsi','created_on','kota_tanda_tangan','tanggal_tanda_tangan','jabatan_tanda_tangan','nama_tanda_tangan','nip_tanda_tangan');
        $k = $this->get($id_ms_keg);
        if($k && $k->id_wilayah==$id_wilayah){
            $result = array_merge(
                (array)$this->get($id_ms_keg), 
                array('blok_i'=>(array)$this->get_blok($id_ms_keg,'i')),
                array('blok_ii'=>(array)$this->get_blok($id_ms_keg,'ii')),
                array('blok_iii'=>(array)$this->get_blok($id_ms_keg,'iii')),
                array('blok_iv'=>(array)$this->get_blok($id_ms_keg,'iv')),
                array('blok_v'=>(array)$this->get_blok($id_ms_keg,'v')),
                array('blok_vi'=>(array)$this->get_blok($id_ms_keg,'vi')),
                array('blok_vii'=>(array)$this->get_blok($id_ms_keg,'vii')),
                array('blok_viii'=>(array)$this->get_blok($id_ms_keg,'viii')));

            foreach($unset as $u) unset($result[$u]);
            return $result;
        }
    }

}	