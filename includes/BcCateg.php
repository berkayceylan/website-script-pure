<?php 
class BcCateg extends BcDb{

    private $admCategs;
  
    public $admCategsName = array();
  
    public $admCategsLink = [];
  
    public $admCategIsSub = [];
  
    public $admCategKey = [];
  
    private $currentAdmCateg = -1;
  
  
  
    private $usrCategs;
  
    public $usrCategsName = array();
  
    public $usrCategsLink = [];
  
    public $usrCategIsSub = [];
  
    public $usrCategKey = [];
  
    private $currentUsrCateg = -1;
  
  
  
    function __construct(){
  
      $this -> createAdmCateg();
  
      $this -> createUsrCateg();
  
    }
  
    public function createUsrCateg(){
  
      $query = $GLOBALS["db"] -> prepare("SELECT value FROM bc_settings WHERE setting = ?");
  
      $query -> execute(array("userCateg"));
  
  
  
      $fetch = $query -> fetch(PDO::FETCH_ASSOC);
  
      $str = $fetch["value"];
  
  
  
      $this -> usrCategs = explode(";",$str);
  
      $i = 0;
  
  
  
      foreach($this -> usrCategs as $row){
  
        $arr = explode(",",$row);
  
  
  
        array_push($this -> usrCategKey, trim($arr[0]));
  
  
  
        $this -> usrCategsName[$this -> usrCategKey[$i]] = $arr[1];
  
  
  
        $this -> usrCategsLink[$this -> usrCategKey[$i]] = trim($arr[2]);
  
        $i++;
  
      }
  
      return explode(";",$str);
  
    }
  
    public function createAdmCateg(){
  
      $query = $GLOBALS["db"] -> prepare("SELECT value FROM bc_settings WHERE setting = ?");
  
      $query -> execute(array("adminCateg"));
  
  
  
      $fetch = $query -> fetch(PDO::FETCH_ASSOC);
  
      $str = $fetch["value"];
  
  
  
      $this -> admCategs = explode(";",$str);
  
      $i = 0;
  
      foreach($this -> admCategs as $row){
  
        $arr = explode(",",$row);
  
  
  
        array_push($this -> admCategKey, trim($arr[0]));
  
        $this -> admCategsName[$this -> admCategKey[$i]] = trim($arr[1]);
  
        $this -> admCategsLink[$this -> admCategKey[$i]] = trim($arr[2]);
  
        $i++;
  
      }
  
  
  
      return explode(";",$str);
  
    }
  
  
  
    public function haveCateg(){
  
  
  
      if($this -> currentAdmCateg < count($this -> admCategs) -1){
  
        $this -> currentAdmCateg++;
  
        return true;
  
      }
  
  
  
      return false;
  
  
  
    }
  
    public function returnCateg($type){
  
      if($type == "name"){
  
  
  
      }elseif($type == "url"){
  
        return $this -> admCategsLink[$this -> currentAdmCateg];
  
      }
  
    }
  
    public function returnIsSub(){
  
      return $this -> admCategIsSub[$this -> currentAdmCateg];
  
    }
  
  }


?>