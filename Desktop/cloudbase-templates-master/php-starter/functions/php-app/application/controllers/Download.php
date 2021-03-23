<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use QCloud_WeApp_SDK\Mysql\Mysql as DB;
header('Content-Type:application/json');//这个类型声明非常关键  

class Download extends CI_Controller {
    public function index() {
      $sid = $_GET['user_id'];
      $res = 'no find';
      $res1 = DB::select('stucourseinfo', ['*'], compact('sid'));
      
      $result = array(
        'res' => $res1
      );
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