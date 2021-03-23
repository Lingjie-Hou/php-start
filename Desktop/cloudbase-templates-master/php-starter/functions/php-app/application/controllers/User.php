<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \QCloud_WeApp_SDK\Auth\LoginService as LoginService;
use QCloud_WeApp_SDK\Mysql\Mysql as DB;
use QCloud_WeApp_SDK\Constants as Constants;

class User extends CI_Controller {
    public function index() {
        $result = LoginService::check();

        if ($result['loginState'] === Constants::S_AUTH) {
            $this->json([
                'code' => 0,
                'data' => $result['userinfo']
            ]);
        } else {
            $this->json([
                'code' => -1,
                'data' => []
            ]);
        }
    }
    public function bind() {
      $open_id = $_GET['open_id'];
      $user_id = $_GET['user_id'];
      $role = $_GET['user_type'];
      $res1 = DB::update('cSessionInfo', compact('role','user_id'),compact('open_id'));
      $result = array(
        'openid' => $open_id,
        'userid' => $user_id,
        'role' => $role,
        'res' => $res1
      );
      echo json_encode($result);
    }
    
    public function login() {
      $open_id = $_GET['open_id'];
      $sid = null;
      $tid = null;
      $result = null;
      $logged = false;
      $res = DB::row('cSessionInfo', ['*'], compact('open_id'));
      $sid = $res->user_id;
      $tid = $res->user_id;
      $res1 = DB::row('sc_studentinfo',['*'],compact('sid'));
      $res2 = DB::row('sc_teacherinfo',['*'],compact('tid'));
      if($res1 != null) {
        $logged = true;
        $result = array(
          'id' => $sid,
          'name' => $res1->sname,
          'department' => $res1->department,
          'major' => $res1->major,
          'check' => $logged,
          'identify' => $res->role
        );
      }else if($res2 != null){
        $logged = true;
        $result = array(
          'id' => $tid,
          'name' => $res2->tname,
          'department' => $res2->department,
          'title' => $res2->title,
          'area' => $res2->area,
          'check' => $logged,
          'identify' => $res->role
        );
      }else{
        $result = array(
          'check' => $logged
        );
      }
      echo json_encode($result);
    }

    public function remove() {
       $open_id = $_GET['open_id'];
       $user_id = 0;
       $role = 0;
       $res1 = DB::update('cSessionInfo', compact('role','user_id'),compact('open_id'));
       $result = array(
          'res' => $res1
        );
      echo json_encode($result);
    }
      
}