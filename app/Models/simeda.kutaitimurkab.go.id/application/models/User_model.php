<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// 2021.06.07 menambahkan field salt, dan penggunaan sha1 untuk hash password

class User_model extends CI_Model
{

    public $table = 'users';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default',true);
    }

    function login($username, $password)
    {
    	$this->db->where('username',$username);
    	$row = $this->db->get($this->table)->row();
    	if($row && $row->password==sha1($row->salt.$password))
	        return $row;
    }

    function get($id)
    {
    	$this->db->where('userid',$id);
    	$row = $this->db->get($this->table)->row();
    	if($row)
	        return $row;
    }

    function add($data)
    {
        $data['salt'] = sha1(time());
        $data['password'] = sha1($data['salt'].$data['password']);
    	$insert_string = $this->db->insert_string($this->table, $data);
    	$insert_string = str_ireplace("INSERT", "INSERT IGNORE", $insert_string);
    	$this->db->query($insert_string);
    	return $this->db->affected_rows();
    }

    function edit($id, $data)
    {
    	$this->db->where('userid',$id);
    	$row = $this->db->get($this->table)->row();
    	if($row){
    		unset($data['userid']);
	    	$this->db->where('userid',$id);
	    	if(!empty($data['password'])){
	    	    $data['salt'] = sha1(time());
                $data['password'] = sha1($data['salt'].$data['password']);
	    	}
    		$this->db->update($this->table, $data);
    		return $this->db->affected_rows();
    	}
    }

    function del($id)
    {
    	$this->db->where('userid',$id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    function all($id_wilayah)
    {
        $where = "id_wilayah='".$id_wilayah."'";
        
        if($this->session->userdata('role')==2) // role bps
            $where .= " AND (role<='3')";
        else if($this->session->userdata('role')==3) // role diskominfo
            $where .= " AND (role='1' OR userid='".$this->session->userdata('userid')."')";
        else if($this->session->userdata('role')==1) // role opd
            $where .= " AND (userid='".$this->session->userdata('userid')."')";

        $this->db->where($where);
        $this->db->order_by('instansi');
        return $this->db->get($this->table)->result();
    }

    function arr_instansi($term=null)
    {
    	$result = array();
    	
    	$this->db->select('distinct(instansi) as instansi');
    	$this->db->like('instansi',$term);
    	$this->db->order_by('instansi');

        foreach($this->db->get($this->table)->result() as $row)
        	$result[] = $row->instansi;
        return $result;
    }

    function update_password($id, $password)
    {
        $salt = sha1(time());
        $password = sha1($salt.$password);
    	$this->db->where('userid',$id);
	    $this->db->update($this->table, array('salt'=>$salt, 'password'=>$password));
	    return $this->db->affected_rows();
    }

}