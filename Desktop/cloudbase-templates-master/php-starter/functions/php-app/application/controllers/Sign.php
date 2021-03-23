<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use QCloud_WeApp_SDK\Mysql\Mysql as DB;
header('Content-Type:application/json');//这个类型声明非常关键  

class Sign extends CI_Controller {
    public function index() {
      $sid = $_GET['user_id'];
      $sname = $_GET['user_name'];
      $res = 'no find';
      $res1 = DB::select('sc_stucourseinfo', ['*'],compact('sid'));
      $result = array(
        'res' => $res1
      );
      
      echo json_encode($result);
    }
    public function check() {
      $sid = $_GET['user_id'];
      $sname = $_GET['user_name'];
      $cname = $_GET['selected_cname'];
      $cid = $_GET['selected_cid'];
      $date = $_GET['date'];
      $time = $_GET['time'];
      $locate = $_GET['locate'];
      $res1 = DB::insert('sc_checkinfo', compact('sid', 'sname', 'cid', 'cname', 'date', 'time','locate'));
      $result = array(
        'res' => $res1
      );
      echo json_encode($result);
    }

}