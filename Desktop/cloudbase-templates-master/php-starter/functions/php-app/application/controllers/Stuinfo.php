<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use QCloud_WeApp_SDK\Mysql\Mysql as DB;
header('Content-Type:application/json');//这个类型声明非常关键  

class Stuinfo extends CI_Controller {
    public function index() {
      $tid = $_GET['user_id'];
      $res = 'no find';
      $res1 = DB::select('sc_classinfo', ['*'], compact('tid'));
      $result = array(
        'res' => $res1
        );
      
      echo json_encode($result);
    }

    public function lookup() {
      $cid = $_GET['cid'];
      $res1 = DB::select('sc_stucourseinfo', ['sid','sname','score','absence'], compact('cid'));
      $result = array(
        'res' => $res1
      );
      echo json_encode($result);
    }
}