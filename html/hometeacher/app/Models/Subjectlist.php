<?php namespace App\Models;

//use CodeIgniter\Model;
use App\Models\Management\ManageModel;

class Subjectlist extends ManageModel {
    
    

    protected $table      = 'subjectlist';
    protected $primaryKey = 'idx';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idx', 'subjectgroup', 'subjectname'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;





	
    public $builder;
    //public $field;

	function __construct(){
		parent::__construct($this->table, $this->primaryKey, $this->primaryKey, $this->allowedFields);  //부모생성자 실행
      	
      	//$this->db = \Config\Database::connect($DBGroup, false);
      	 	//$this->session = \Config\Services::session($config);

        $this->builder = $this->db->table($this->table);

        //$this->testacting();
	} 
	

    //전체 리스트 불러오기
	public function getlist_($conditionarray, $limit, $offset, $order) {//

        //parent::SelectMachine();

    	//$query  = $this->builder->get();
        //['gameidx' => '2', 'views' => '2']
        $this->builder->orderBy($order['name'], $order['type']);
        $query = $this->builder->getWhere($conditionarray, $limit, $offset);
    	$results = $query->getResult();
        return $results;
    }


        //전체 리스트 조인해서 가져오기 uid gid rankid
        public function getlist($conditionarray, $pagehandler) {

            //  $this->BindRelation();
      
              $results = parent::SelectMachine($conditionarray, $pagehandler);
      
              //원래 코드
              //$query = $this->db->query("SELECT a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info FROM `nboardlist` as a INNER JOIN `user` b ON b.idx = a.uid INNER JOIN `gamelist` c ON c.idx = a.gid WHERE a.".$conditionarray->fieldname." = ".$conditionarray->fieldval." order By ".$order['name']." ".$order['type']."");
              //$results = $query->getResult();
              return $results;
          }

          
    //전체 리스트 조인해서 가져오기 uid gid rankid
    public function getlist_join($conditionarray, $pagehandler) {

      //  $this->BindRelation();

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
        $oGamelist = new Gamelist();
        $oGamelist->SetKeyfeild("idx");

        $this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oUser, "Depth"=>"a", "Key"=>"uid"), "c"=>array("Obj" => $oGamelist, "Depth"=>"a", "Key"=>"gid")));
        //$this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oUser, "Depth"=>"a", "Key"=>"uid")));
        $this->TransformRelationModel();
		
	}

    //객체 하나만 가져오기
	public function getlistinfoone($conditionarray, $pagehandler, $ntype) {

        if($ntype == 3){
            $this->BindRelation_rank();
       //     $query = $this->db->query("SELECT a.idx,a.gid,a.rankid,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info,d.score FROM `nboardlist` a INNER JOIN `user` b ON b.idx = a.uid INNER JOIN `gamelist` c ON c.idx = a.gid INNER JOIN `gameranklist` d ON d.idx = a.rankid WHERE a.".$conditionarray['condid']." = ".$conditionarray['condval']."");
        }else{
            $this->BindRelation();
       //     $query = $this->db->query("SELECT a.idx,a.gid,a.rankid,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info FROM `nboardlist` a INNER JOIN `user` b ON b.idx = a.uid INNER JOIN `gamelist` c ON c.idx = a.gid WHERE a.".$conditionarray['condid']." = ".$conditionarray['condval']."");
        }
        //$results = $query->getResult();

        

        $results = parent::SelectMachine($conditionarray, $pagehandler);


        return $results;
    }
    //조인시 연결하는 부분
	public function BindRelation_rank()
	{

        $oUser = new User();
        $oUser->SetKeyfeild("idx");
        $oGamelist = new Gamelist();
        $oGamelist->SetKeyfeild("idx");
        $oGamelist = new Gamelist();
        $oGamelist->SetKeyfeild("idx");
        $oGameranklist = new Gameranklist();
        $oGameranklist->SetKeyfeild("idx");
        

        $this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oUser, "Depth"=>"a", "Key"=>"uid"), "c"=>array("Obj" => $oGamelist, "Depth"=>"a", "Key"=>"gid"), "d"=>array("Obj" => $oGameranklist, "Depth"=>"a", "Key"=>"rankid")));
        //$this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oUser, "Depth"=>"a", "Key"=>"uid")));
        $this->TransformRelationModel();
		
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

    //업데이트
    /*public function getupdate($data) {
        $results = $this->builder->replace($data);
        return $results;
    }*/
    //업데이트
    public function getupdate($idx, $data) { //변경할 데이터, idx값

       // log_message('alert', "게시판 데이터_ ".json_encode($idx));
        //log_message('alert', "게시판 데이터_ ".json_encode($data));
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

    //id값 바로 가져오기 
    public function getinsertid(){
        $results = $this->db->insertID();

        return $results;
    }


}
