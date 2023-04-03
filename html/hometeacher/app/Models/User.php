<?php namespace App\Models;

//use CodeIgniter\Model;
use App\Models\Management\ManageModel;

class User extends ManageModel {
    
    //protected $DBGroup = 'default';

    protected $table      = 'user';
    protected $primaryKey = 'idx';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idx', 'usertype', 'email', 'password', 'name', 'nicname', 'pointscore', 'classconnectnum', 'loginregdate', 'regdate', 'views'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

	public $db;
    public $session;

	function __construct(){
		parent::__construct($this->table, $this->primaryKey, $this->primaryKey, $this->allowedFields);  //부모생성자 실행

    
        $this->builder = $this->db->table($this->table);
	} 
	

    //유저리스트 
//    public function getlist($usertype)    
//     {        
//     	//$builder=$this->db->table('user');
//     	$query  = $this->builder->get();
//     	$results = $query->getResult();

        
// 	/*foreach ($query->getResult() as $row)
// 	{
// 	  echo $row->name;
// 	}*/

//     	//print_r($query);
    	
//        //$query   = $this->db->query('SELECT * FROM user');
// 	//$results = $query->getResultArray();
	


//         return $results;
//     }

    //user 리스트
    public function getlist($conditionarray, $pagehandler) {
        log_message('alert', "55555555555555  ".json_encode("---------------------"));
         $results = parent::SelectMachine($conditionarray, $pagehandler);
 
         return $results;
     }



    //id값 바로 가져오기 
    public function getinsertid(){
        $results = $this->db->insertID();
    
        return $results;
    }

    //이메일로 이름 불러옴
    public function getdatatoemail($email){
         //log_message('alert', json_encode($uid));
         $this->builder->where('email', $email);
         $query = $this->builder->get();
        $data = $query->getResult();
    
        return $data;
    }

    //uid로 이름 불러옴
    public function getdataone($uid){
        //log_message('alert', json_encode($uid));
        $this->builder->where('idx', $uid);
    	$query = $this->builder->get();
    	$data = $query->getResult();

        return $data;
    }
    //email로 중복 체크
    public function getdataone_email($email){
       // echo $email;
       // log_message('alert', json_encode($uid));
        $this->builder->where('email', $email);
    	$query = $this->builder->get();
    	$data = $query->getResult();

        if(count($data) == 0){ //중복된 값이 없음
            return false;
        }else{ //중복된 값이 있음
            return true;
        }
    }
    //닉네임 중복 체크
    public function getnicnameoverlab($uid, $nicname){
        // echo $email;
        // log_message('alert', json_encode($uid));
        $this->builder->where('idx !=', $uid);
        $this->builder->where('nicname', $nicname);
        $query = $this->builder->get();
        $data = $query->getResult();
     
        if(count($data) == 0){ //중복된 값이 없음
            return false;
        }else{ //중복된 값이 있음
            return true;
        }
    }

    public function loginchk($id, $pw)    
    {     
        log_message('alert', json_encode($id));
        log_message('alert', json_encode($pw));
        
        $this->builder->where('email', $id);
        $this->builder->where('password', $pw);
    	$query = $this->builder->get();
    	$data = $query->getResult();
        
        return $data;
    }

    public function session_get(){

        $session = session(); // (2)3
        $session_value = $session->get();
        //$session_value = session_id(); //세션 아이디를 가져옴 
        //$session_value = session_id(); //세션 아이디를 가져옴 
        //$session_value = $_SERVER['HTTP_USER_AGENT']; //세션 아이디를 가져옴 


        //log_message('alert', json_encode($session_value));
       // $session_value = $session->member_id; // (8)
        return $session_value;
        //return  $session_value === null ? "세션 값이 없습니다." : "세션 값은 $session_value 입니다." ;
        
        //$is_session_exist = $session->member_id != null; // (3)
        //return $is_session_exist ? "세션 값이 존재합니다." : "세션 값이 없습니다."; // (4)
        //return "12";
    }

    public function session_remove() // (9)
    {
        $session = session();
        $array_items = ['idx', 'email', 'name', 'logged_in'];
        $session->remove($array_items); // (10)
        return "세션값이 삭제되었습니다.";
    }

    //$session->destroy();

    public function session_destroy() // (9)
    {
        $session = session();
        $session->destroy();
        return "세션값이 파괴되었습니다.";
    }


    //추가
    public function getinsert($data) {
        //log_message('alert', "joindata ".json_encode($data));

        $results = $this->builder->insert($data);
        return $results;
    }
    //업데이트
    public function getupdate($idx, $data) { //변경할 데이터, idx값

        //log_message('alert', "유저 데이터_ ".json_encode($idx->key));
        //log_message('alert', "유저 데이터_ ".json_encode($idx->value));
        //log_message('alert', "유저 데이터_ ".json_encode($idx['idx']));
        log_message('alert', "유저 데이터_ ".json_encode($idx));
        log_message('alert', "유저 데이터_ ".json_encode($data));

        $results = $this->builder->update($data, $idx);
        return $results;
    }



    //전체 리스트 조인해서 가져오기 uid gid rankid
    public function getlist_join_teacher($conditionarray, $pagehandler) {

        $this->BindRelation_teacher();
     
        $results = parent::SelectMachine($conditionarray, $pagehandler);
     
        //원래 코드
        //$query = $this->db->query("SELECT a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info FROM `nboardlist` as a INNER JOIN `user` b ON b.idx = a.uid INNER JOIN `gamelist` c ON c.idx = a.gid WHERE a.".$conditionarray->fieldname." = ".$conditionarray->fieldval." order By ".$order['name']." ".$order['type']."");
        //$results = $query->getResult();
        return $results;
    }
    public function getlist_join_studnet($conditionarray, $pagehandler) {

        $this->BindRelation_student();
     
        $results = parent::SelectMachine($conditionarray, $pagehandler);
     
        //원래 코드
        //$query = $this->db->query("SELECT a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info FROM `nboardlist` as a INNER JOIN `user` b ON b.idx = a.uid INNER JOIN `gamelist` c ON c.idx = a.gid WHERE a.".$conditionarray->fieldname." = ".$conditionarray->fieldval." order By ".$order['name']." ".$order['type']."");
        //$results = $query->getResult();
        return $results;
    }

    //조인시 연결하는 부분
	public function BindRelation_teacher()
	{

        //$oUser = new User();
        //$oUser->SetKeyfeild("idx");
        $oProfileTeacher = new ProfileTeacher();
        $oProfileTeacher->SetKeyfeild("uid");

        $this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oProfileTeacher, "Depth"=>"a", "Key"=>"idx")));
        //$this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oUser, "Depth"=>"a", "Key"=>"uid")));
        $this->TransformRelationModel();
		
	}
    public function BindRelation_student()
	{

        //$oUser = new User();
        //$oUser->SetKeyfeild("idx");
        $ProfileStudent = new ProfileStudent();
        $ProfileStudent->SetKeyfeild("uid");

        $this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $ProfileStudent, "Depth"=>"a", "Key"=>"idx")));
        //$this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oUser, "Depth"=>"a", "Key"=>"uid")));
        $this->TransformRelationModel();
		
	}


    
    //전체 리스트 조인해서 가져오기 uid gid rankid
    public function getlist_join_teacherimg($conditionarray, $pagehandler) {

        $this->BindRelation_teacherimg();
     
        $results = parent::SelectMachine($conditionarray, $pagehandler);
     
        //원래 코드
        //$query = $this->db->query("SELECT a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info FROM `nboardlist` as a INNER JOIN `user` b ON b.idx = a.uid INNER JOIN `gamelist` c ON c.idx = a.gid WHERE a.".$conditionarray->fieldname." = ".$conditionarray->fieldval." order By ".$order['name']." ".$order['type']."");
        //$results = $query->getResult();
        return $results;
    }

    
    //선생 이미지와 조인
	public function BindRelation_teacherimg()
	{

        //$oUser = new User();
        //$oUser->SetKeyfeild("idx");
        $oProfileTeacher = new ProfileTeacher();
        $oProfileTeacher->SetKeyfeild("uid");

        $oProfileImglist = new ProfileImglist();
        $oProfileImglist->SetKeyfeild("uid");

        $this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oProfileTeacher, "Depth"=>"a", "Key"=>"idx"), "c"=>array("Obj" => $oProfileImglist, "Depth"=>"a", "Key"=>"idx")));
        //$this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oUser, "Depth"=>"a", "Key"=>"uid")));
        $this->TransformRelationModel();
		
	}

    //전체 리스트 조인해서 가져오기 uid gid rankid
    public function getlist_join_studnetimg($conditionarray, $pagehandler) {

        $this->BindRelation_studentimg();
         
        $results = parent::SelectMachine($conditionarray, $pagehandler);
         
        //원래 코드
        //$query = $this->db->query("SELECT a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info FROM `nboardlist` as a INNER JOIN `user` b ON b.idx = a.uid INNER JOIN `gamelist` c ON c.idx = a.gid WHERE a.".$conditionarray->fieldname." = ".$conditionarray->fieldval." order By ".$order['name']." ".$order['type']."");
        //$results = $query->getResult();
        return $results;
    }

    //학생 이미지와 조인
    public function BindRelation_studentimg()
	{

        //$oUser = new User();
        //$oUser->SetKeyfeild("idx");
        $oProfileStudent = new ProfileStudent();
        $oProfileStudent->SetKeyfeild("uid");

        $oProfileImglist = new ProfileImglist();
        $oProfileImglist->SetKeyfeild("uid");

        $this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oProfileStudent, "Depth"=>"a", "Key"=>"idx"), "c"=>array("Obj" => $oProfileImglist, "Depth"=>"a", "Key"=>"idx")));
        //$this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oUser, "Depth"=>"a", "Key"=>"uid")));
        $this->TransformRelationModel();
		
	}


    //이미지만 조인
    public function getlist_joinimg($conditionarray, $pagehandler) {

        $this->BindRelation_img();
     
        $results = parent::SelectMachine($conditionarray, $pagehandler);
     
        //원래 코드
        //$query = $this->db->query("SELECT a.idx,a.gid,a.rankid,a.ntype,a.title,a.document,a.regdate,a.views,b.email,b.name as bname,c.name as cname,c.info FROM `nboardlist` as a INNER JOIN `user` b ON b.idx = a.uid INNER JOIN `gamelist` c ON c.idx = a.gid WHERE a.".$conditionarray->fieldname." = ".$conditionarray->fieldval." order By ".$order['name']." ".$order['type']."");
        //$results = $query->getResult();
        return $results;
    }
    //학생 이미지와 조인
    public function BindRelation_img()
	{

        $oProfileImglist = new ProfileImglist();
        $oProfileImglist->SetKeyfeild("uid");

        $this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oProfileImglist, "Depth"=>"a", "Key"=>"idx")));
        //$this->SetRelation(array("originDepth"=>"a", "b"=>array("Obj" => $oUser, "Depth"=>"a", "Key"=>"uid")));
        $this->TransformRelationModel();
		
	}
}
