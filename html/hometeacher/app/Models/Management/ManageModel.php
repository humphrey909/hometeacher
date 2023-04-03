<?php namespace App\Models\Management;

use CodeIgniter\Model;

class ManageModel extends Model {

    protected $DBGroup = 'default';
    public $db;
    
    public $Table = '';
    public $Feild;
    public $Defaultorderfield;
    public $PrimaryKey;
    public $Relation = null; //관계
    //public $RelationFields;
    //public $Joinbox = '';

    public $FIXWHEREVAL = "FIXWHEREVAL";


    
    function __construct($table, $keyfield, $defaultorderfield, $fields, $upload=null){	

        $this->Table = $table;
        $this->Feild = $fields;
        $this->Defaultorderfield = $defaultorderfield;
        $this->PrimaryKey = $keyfield;
        
        //db실행
        $this->db = \Config\Database::connect($DBGroup, false);
    
    }
    function __destruct(){
        //parent::__destruct();
    }

    public function SetKeyfeild($keyfield){$this->PrimaryKey = $keyfield;}

    public function SetRelation($Relation){$this->Relation = $Relation;}
    //public function SetRelationFields($Fields){$this->RelationFields = $Fields;}

    public function SetTable($table){ $this->Table = $table;}

    //join 실행시 table 새로 만들어서 넣어줌 from 뒤부터 where 전 까지
    public function TransformRelationModel(){
        
        $newtable = '';
        foreach($this->Relation as $key => $value){

            if($key == "originDepth"){
                $newtable = $this->Table." as ".$value." ";

            }else{
                $newtable .= "LEFT JOIN ";//$value["Obj"]->Table

                $newtable .= $value["Obj"]->Table." ".$key;
                $newtable .= " ON ".$key.".".$value["Obj"]->PrimaryKey." = ".$value["Depth"].".".$value["Key"]." ";
            }
        }

        log_message('alert', json_encode("@@@"));
        log_message('alert', json_encode($newtable));
        $this->SetTable($newtable);//table 변경함.

        log_message('alert', json_encode($this->Table));

    }

    //where 조건 - = like feild, logic, value
    //order 조건 - 기본이 고유값으로 처리되도록
    //join 조건 
    function SelectMachine($condition, $pagehandler){

        $CompleteQuery = '';
        $CompleteQuery .= "SELECT";

        if($condition['feild'] != null){
            $CompleteQuery .= " ".$condition['feild']." ";
        }else{
            $CompleteQuery .= " * ";
        }

        $CompleteQuery .= "FROM ";
        $CompleteQuery .= $this->Table;

        //웨어 처리
        if($condition['where'] != null){
            $wherecount = count($condition['where']); //조건 갯수
            $count = 0;
            $CompleteQuery .= " WHERE ";

            //조건 수에 맞춰 등록한다. 
            foreach($condition['where'] as $key => $value){
                $count++;

                log_message('alert', $key);
                log_message('alert', json_encode($value));
                log_message('alert', json_encode($value['logic']));
                log_message('alert', json_encode($value['value']));
                $CompleteQuery .= $key." ".$value['logic']." ".$value['value']."";

                //조건 개수에 따라서 and를 넣어준다.
                if($count >= 1 && $count < $wherecount){
                    $CompleteQuery .= " AND ";
                }
            }
            // $CompleteQuery .= " WHERE ".$condition['where']['feild']." ".$condition['where']['logic']." ".$condition['where']['value'];
        }

        if($condition[$this->FIXWHEREVAL] != null){
            $CompleteQuery .= $condition[$this->FIXWHEREVAL];
        }

        //오더 처리
        if($condition['order'] != null){
            
            //$CompleteQuery .= "WHERE ".$condition['where']." ".$condition['logic']." ".$condition['value']."";
            $CompleteQuery .= " ORDER BY ".$condition['order']['feild']." ".$condition['order']['value'];
            
        }else{
            $CompleteQuery .= " order By ".$this->Defaultorderfield." DESC";
        }
        
        //리밋 처리 
        if($pagehandler == null || $pagehandler['limit'] == '0'){
        }else{
            $CompleteQuery .= " LIMIT ".$pagehandler['offset'].", ".$pagehandler['limit'].";";
        }

        
       //log_message('alert', json_encode($condition));
    
       //$query = $this->db->query("SELECT a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info FROM `nboardlist` a INNER JOIN `user` b ON b.idx = a.uid INNER JOIN `gamelist` c ON c.idx = a.gid WHERE a.".$conditionarray->fieldname." = ".$conditionarray->fieldval." order By ".$order['name']." ".$order['type']."");
       //$query = $this->db->query("SELECT * FROM `nboardlist` WHERE a.".$conditionarray->fieldname." = ".$conditionarray->fieldval." order By ".$order['name']." ".$order['type']."");
       log_message('alert', json_encode($CompleteQuery));
       $query = $this->db->query($CompleteQuery);
       $results = $query->getResult();


        return $results;
    }


    function InsertMachine(){
        
        // log_message('alert', json_encode($this->feild));
    }
    function UpdateMachine(){
        
        // log_message('alert', json_encode($this->feild));
    }
    function DeleteMachine(){
        
        // log_message('alert', json_encode($this->feild));
    }
}