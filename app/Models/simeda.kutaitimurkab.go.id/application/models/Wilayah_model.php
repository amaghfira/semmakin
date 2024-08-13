<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Wilayah_model extends CI_Model
{

    public $table = 'wilayah';

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default',true);
    }

        function get_by_id($id)
        {
            $this->db->where('id', $id);
            return $this->db->get($this->table)->row();
        }

        function get_all($where=null)
        {
            $this->db->order_by('id','asc');
            if($where)
                $this->db->where($where);
            
            return $this->db->get($this->table)->result();
        }

        function arr_all($where=null)
        {
            $result = array();
            foreach($this->get_all($where) as $row){
                $result[$row->id] = $row->id.'. '.$row->wilayah;
            }
            return $result;
        }

        function exec($sql)
        {
            return $this->db->query($sql);
        }

        function query($sql)
        {
            return $this->db->query($sql)->result();
        }

        function get_by_field($field,$value)
        {
            $this->db->where($field, $value);
            return $this->db->get($this->table)->row();
        }
         
        function blank()
        {
            return (object)array(
                'id'=>null,
                'wilayah'=>null,
            );
        }

        function insert($data)
        {
            if($this->db->insert($this->table, $data))
                return true;
        }

        function update($id, $data)
        {
            $this->db->where('id', $id);
            if($this->db->update($this->table, $data))
                return true;
        }


}