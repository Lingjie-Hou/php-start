<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use QCloud_WeApp_SDK\Mysql\Mysql as DB;
header('Content-Type:application/json');//这个类型声明非常关键  

class Weixin extends CI_Controller {
    public function index() {
      $sid = $_GET['user_id'];
      $tid = $_GET['user_id'];
      $pass = $_GET['user_password'];
      $res = 'no find';
      $res1 = DB::row('sc_teacherinfo', ['*'], compact('tid'));
      $res2 = DB::row('sc_studentinfo', ['*'], compact('sid'));
      $logged = false;
      $identify = -1;
      
      if ($res1 != NULL) {
        $identify = 1;
        if ($res1->password === $pass){
              $logged = true;
        }
        $res =$res1->tid.'--'.$res1->tname.'--'.$res1->password.'--'.$res1->department.'--'.$res1->title.'--'.$res1->area;
      } else if($res2 != NULL){
        $identify = 0;
        if ($res2->password === $pass)
        {
          $logged = true;
        }
        $res =$res2->sid.'--'.$res2->sname.'--'.$res2->password.'--'.$res2->department.'--'.$res2->major;
      }else{
        $res = 'no find';
      }
      if($identify === 0) {
        $result = array(
          'msg' => $res,
          'name' => $res2->sname,
          'department' => $res2->department,
          'major' => $res2->major,
          'check' => $logged,
          'identify' => $identify,
        );
      }
      if($identify === 1) {
        $result = array(
          'msg' => $res,
          'name' => $res1->tname,
          'department' => $res1->department,
          'title' => $res1->title,
          'area' => $res1->area,
          'check' => $logged,
          'identify' => $identify,
        );
      }
      echo json_encode($result);
        // $this->json([
        //     'data' => [
        //         'msg' => $res,
        //         'check' => $logged,
        //         'identity' => $identify

        //     ]
        // ]);
    }
}