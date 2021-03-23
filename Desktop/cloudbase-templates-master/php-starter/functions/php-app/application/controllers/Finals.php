<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use QCloud_WeApp_SDK\Mysql\Mysql as DB;
header('Content-Type:application/json');//这个类型声明非常关键  

class Finals extends CI_Controller {
    public function index() {
      $tid = $_GET['user_id'];
      $res = 'no find';
      $res1 = DB::select('sc_classinfo', ['*'], compact('tid'));
      $result = array(
        'res' => $res1
        );
      
      echo json_encode($result);
    }
    public function confirm() {
      $cid = $_GET['cid'];
      $sid = $_GET['sid'];
      $sname = $_GET['sname'];
      $score = $_GET['score'];
      $res1 = DB::update('sc_stucourseinfo', compact('score'),compact('sid','cid'));
      $result = array(
        'res' => $res1
      );
      echo json_encode($result);
    }

}