<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use QCloud_WeApp_SDK\Mysql\Mysql as DB;
header('Content-Type:application/json');//这个类型声明非常关键  

class Assign extends CI_Controller {
    public function index() {
      $sid = $_GET['user_id'];
      $res2 = DB::select('sc_stu_timetable', ['*'],compact('sid'));
      $res = 'no find';
      $result = array(
        'res' => $res2,
      );
      echo json_encode($result);
    }
}