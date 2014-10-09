<?php
class LuckyFruitAction extends LotteryBaseAction{
    public $lotteryType;
    public $lotteryTypeName;
    public function _initialize(){
        parent :: _initialize();
        $function = M('Function') -> where(array('funname' => 'wedding')) -> find();
       
        $this -> lotteryType = 4;
        $this -> lotteryTypeName = '水果达人';
        $this -> assign('lotteryTypeName', $this -> lotteryTypeName);
    }
    public function cheat(){
        parent :: cheat();
        $this -> display();
    }
    public function index(){
        parent :: index($this -> lotteryType);
        $this -> display();
    }
    public function sn(){
        parent :: sn($this -> lotteryType);
        $this -> display();
    }
    public function add(){
        parent :: add($this -> lotteryType);
    }
    public function edit(){
        parent :: edit($this -> lotteryType);
    }
}
?>