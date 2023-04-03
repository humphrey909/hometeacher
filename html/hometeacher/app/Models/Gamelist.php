<?php namespace App\Models;

//use CodeIgniter\Model;
use App\Models\Management\ManageModel;

class Gamelist extends ManageModel {
    
    

    protected $table      = 'gamelist';
    protected $primaryKey = 'idx';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idx', 'uid', 'pkey', 'name', 'info', 'writecode', 'thumimg', 'display', 'regdate'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;





	public $db;
    public $builder;

	function __construct(){
		parent::__construct($this->table, $this->primaryKey, $this->primaryKey, $this->allowedFields);  //부모생성자 실행

      	
      	//$this->db = \Config\Database::connect($DBGroup, false);
      	 	//$this->session = \Config\Services::session($config);

        $this->builder = $this->db->table($this->table);
	} 
	

    //전체 리스트 불러오기
	/*public function getlist($conditionarray, $limit, $offset, $order) {//
        //log_message('alert', "order test ".$order['name']);
        //log_message('alert', "order test ".$order['type']);
        //log_message('alert', "order test ".json_encode($order[0]));

        
        $this->builder->orderBy($order['name'], $order['type']);
        $query = $this->builder->getWhere($conditionarray, $limit, $offset);
        $results = $query->getResult();
        return $results;
    }*/
    //전체 리스트 불러오기
    public function getlist($conditionarray, $pagehandler) {

        $this->BindRelation();

        $results = parent::SelectMachine($conditionarray, $pagehandler);

        //원래 코드
        //$query = $this->db->query("SELECT a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info FROM `nboardlist` as a INNER JOIN `user` b ON b.idx = a.uid INNER JOIN `gamelist` c ON c.idx = a.gid WHERE a.".$conditionarray->fieldname." = ".$conditionarray->fieldval." order By ".$order['name']." ".$order['type']."");
        //$results = $query->getResult();
        return $results;
    }
    //조인시 연결하는 부분
	public function BindRelation()
	{

        $oUser = new User();
        $oUser->SetKeyfeild("idx");

        $this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oUser, "Depth"=>"a", "Key"=>"uid")));
        //$this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oUser, "Depth"=>"a", "Key"=>"uid")));
        $this->TransformRelationModel();
		
	}



    //key로 idx 불러옴
    public function getdataone($key){
        //log_message('alert', json_encode($uid));
        $this->builder->where('pkey', $key);
    	$query = $this->builder->get();
    	$data = $query->getResult();

        return $data;
    }

    //key 중복체크할 것
    public function getoverlapchk($key){
        //log_message('alert', json_encode($uid));
        $this->builder->where('pkey', $key);
    	$query = $this->builder->get();
    	$data = $query->getResult();

        return count($data);
    }




    //맥스 데이터만 가져옴 -> idx 값도 같이 가져오기?
    public function getmaxdata($conditionarray){
        $this->builder->selectMax('score');
        $query = $this->builder->getWhere($conditionarray);
        $results = $query->getResult();
        return $results;
    }

    //전체의 몇번째 값인지 등수 정하기
    public function getRankcount($scoreidx, $gid){

       $query = $this->db->query("SELECT * FROM (SELECT idx , gid , score , DENSE_RANK() OVER (ORDER BY score DESC) AS RankNo FROM `Project`.`gameranklist` WHERE gid=".$gid.") A WHERE A.idx = ".$scoreidx."");
       $ranklist   = $query->getResultArray();
      // log_message('alert', json_encode($gid));
      // log_message('alert', json_encode($ranklist));
      // log_message('alert', $ranklist[0]['RankNo']);
       
        return $ranklist;
    }


    //전체 갯수 불러오기
    public function getlistcount() {
        $this->builder->selectCount('idx');
        $query = $this->builder->get();
    	$results = $query->getResult();
        return $results;
    }

    
    //추가
    public function getinsert($data) {
        $results = $this->builder->insert($data);

        
        return $results;
    }

    //id값 바로 가져오기 
    public function getinsertid(){
        $results = $this->db->insertID();

        return $results;
    }

    //업데이트
    public function getupdate($idx, $data) { //변경할 데이터, idx값
        $results = $this->builder->update($data, $idx);
        return $results;
    }

    //삭제
    public function getdelete($fieldname, $data) {
        
        foreach($data as $key => $value){

            
            $dataarr = array();
            $dataarr[$fieldname] = $value;

            log_message('alert', "게시판 데이터_ ".json_encode($dataarr));

            $results = $this->builder->delete($dataarr);
        }
        //$results = $this->builder->delete($data);
        //$results = $builder->delete(['idx' => '150']);
        return $results;
    }




}
