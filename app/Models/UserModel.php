<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {

    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        $this->user = $this->db->table('users');
    }

    public function login($username,$password) {
        $user = $this->user->where('username',$username)->get()->getRow();

        if (!empty($user->username)) {
            if ($user->password != sha1($user->salt.$password)) {
                // jika password tidak sesuai
                return null;
            } else {
                // jika password sesuai
                return $user;
            }
        } else {
            // jika username not found 
            return null;
        }
    }

    public function getUsers() {
        return $this->user
                    ->select(['userid','instansi','role','username','email'])
                    ->get();
    }

    public function deleteUser($id) {
        $result = $this->user
                        ->where('userid', $id)
                        ->delete();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($id, $array) {
        $user = $this->user
                        ->where('userid', $id)
                        ->get()->getRow();

        if (!empty($user->userid)) {
            // if user is found then update data 
            if (!empty($array['password'])) {
                $array['salt'] = sha1(time());
                $array['password'] = sha1($array['salt'].$array['password']);
            }

            // update data
            $result = $this->user
                            ->where('userid', $id)
                            ->update($array);

            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function addUser($array) {
        if (!empty($array['username'])) {
            // check if username exist
            if (!empty($this->user->where('username', $array['username'])->get()->getRow())) {
                return false; 
            } else {
                if (!empty($array['password'])) {
                    $array['salt'] = sha1(time());
                    $array['password'] = sha1($array['salt'].$array['password']);
                }

                // add data
                $result = $this->user->insert($array);

                if ($result) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
}

?>