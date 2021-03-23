<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use QCloud_WeApp_SDK\Mysql\Mysql as DB;
header('Content-Type:application/json');//这个类型声明非常关键  

class Test extends CI_Controller {
    public function index() {
      $sid = $_GET['user_id'];
      $date = $_GET['date'];
      $res = DB::select('sc_stu_subjecttable', ['*'], compact('sid','date'));
      $result = array(
        'res' => $res
        );
      echo json_encode($result);
    }
}