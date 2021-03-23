<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use QCloud_WeApp_SDK\Mysql\Mysql as DB;
header('Content-Type:application/json');//这个类型声明非常关键  

class Select extends CI_Controller {
    public function index() {
      
      $res = 'no find';
      $res1 = DB::select('sc_classinfo', ['*']);
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
    public function confirm() {
      $sid = $_GET['user_id'];
      $sname = $_GET['user_name'];
      $cname = $_GET['selected_cname'];
      $cid = $_GET['selected_cid'];
      $tname = $_GET['selected_tname'];
      $tid = $_GET['selected_tid'];
      $score = 0;
      $absence = 0;
      
      $res1 = DB::insert('sc_stucourseinfo', compact('sid', 'cid', 'cname', 'tname', 'score', 'sname', 'tid','absence'));
      $res = DB::select('sc_classtimeinfo', ['*'], compact('cid'));
      foreach ($res as $key) {
        $week = $key->week;
        $cindex = $key->cindex;
        $duration = $key->duration;
        $res2 = DB::insert('sc_stu_timetable', compact('sid', 'cid', 'cname', 'week', 'cindex', 'duration'));
      }
      $result = array(
        'res' => $res
      );
      echo json_encode($result);
    }

}