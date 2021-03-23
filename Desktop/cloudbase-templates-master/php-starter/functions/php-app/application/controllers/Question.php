<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use QCloud_WeApp_SDK\Mysql\Mysql as DB;
header('Content-Type:application/json');//这个类型声明非常关键  

class Question extends CI_Controller {
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
      $question = $_GET['question'];
      $a = $_GET['a'];
      $b = $_GET['b'];
      $c = $_GET['c'];
      $d = $_GET['d'];
      $answer = $_GET['ans'];
      $date = $_GET['date'];
      $res = DB::row('sc_classinfo', ['*'], compact('cid'));
      $cname = $res->cname;
      $res1 = DB::insert('sc_subjectinfo', compact('cid',  'cname', 'question', 'a', 'b', 'c','d', 'answer'));
      $res2 = DB::select('sc_stucourseinfo',['*'],compact('cid'));
      foreach ($res2 as $key) {
        $sid = $key->sid;
        $res = DB::insert('sc_stu_subjecttable', compact( 'question','sid','cname','a','b','c','d','answer','date'));
      }
      $result = array(
        'res' => $res2
      );
      echo json_encode($result);
    }

}