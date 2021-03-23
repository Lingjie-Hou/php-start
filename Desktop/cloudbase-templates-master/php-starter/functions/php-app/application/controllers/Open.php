<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use QCloud_WeApp_SDK\Mysql\Mysql as DB;
header('Content-Type:application/json');//这个类型声明非常关键  

class Open extends CI_Controller {
    public function index() {
      $cname = $_GET['cname'];
      $tid = $_GET['tid'];
      $tname = $_GET['tname'];
      $stu_amount = $_GET['camount'];
      $date = $_GET['date'];
      $week = $_GET['week'];
      $cindex = $_GET['cindex'] + 1;
      $duration = $_GET['duration'] + 1;
      $res1 = DB::insert('sc_classinfo', compact( 'cname', 'tid', 'stu_amount','tname'));
      $res2 = DB::row('sc_classinfo', ['*'], compact('cname','tid'));
      $cid = $res2->cid;
      $res3 = DB::insert('sc_classtimeinfo', compact( 'cid', 'tid','cname', 'date', 'cindex', 'duration', 'week'));
      $result = array(
        'class' => $res1,
        'res' => $res2,
        'time' => $res3
        );
      echo json_encode($result);
    }
}