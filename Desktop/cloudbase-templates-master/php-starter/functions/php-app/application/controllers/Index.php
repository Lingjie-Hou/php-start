<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use QCloud_WeApp_SDK\Mysql\Mysql as DB;

class Index extends CI_Controller {
    public function index() {
      $res1 = 'zjw';
      $res = 'test1'.'-test2';
      $username = $res1;
      $res2 = DB::row('user', ['*'], compact('username'));
      if ($res2 === NULL) {
           $res ='no find';
      } else {
         $res ='find--'.$res2->id.'--'.$res2->password.'--';
      }
        $this->json([
            'data' => [
                'msg' => $res.$res1
            ]
        ]);
    }
}