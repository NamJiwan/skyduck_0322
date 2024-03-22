<?php
    class Qna {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function input($arr) {
            $sql = "INSERT INTO sd_Estimate_inquiry(author_id, member_table, name, contact_number, email, company_name, position, website, service_required, budget, timeline, additional_notes, created_at) 
                    VALUES (:author_id, :member_table, :name, :contact_number, :email, :company_name, :position, :website, :service_r, :budget, :timeline, :a_note, NOW())";            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':author_id', $arr['author_id']);
            $stmt->bindParam(':member_table', $arr['member_table']);
            $stmt->bindParam(':name', $arr['name']);
            $stmt->bindParam(':contact_number', $arr['c_number']);
            $stmt->bindParam(':email', $arr['email']);
            $stmt->bindParam(':company_name', $arr['company']);
            $stmt->bindParam(':position', $arr['position']);
            $stmt->bindParam(':website', $arr['website']);
            $stmt->bindParam(':service_r', $arr['service_r']);
            $stmt->bindParam(':budget', $arr['budget'], PDO::PARAM_STR);
            $stmt->bindParam(':timeline', $arr['schedule']);
            $stmt->bindParam(':a_note', $arr['a_note']);
            $stmt->execute();
            if ($stmt->rowCount() === 0) {
                return false;
            }
        
            return true;
        }
        

        public function list($page, $limit, $paramArr) {
            $start = ($page - 1) * $limit;
            $where = "";
        
            if ($paramArr['sn'] != '' && $paramArr['sf'] != '') {
                switch ($paramArr['sn']) {
                    case 1: $sn_str = 'company_name'; break;
                    case 2: $sn_str = 'name'; break;
                    case 3: $sn_str = 'idx'; break;
                }
        
                $where = " WHERE ".$sn_str." = :sf ";
            }
        
            $sql = "SELECT * 
            FROM sd_Estimate_inquiry " . $where . 
            " ORDER BY idx DESC 
            LIMIT " . $start . "," . $limit;
        
        
            $stmt = $this->conn->prepare($sql);
        
            if ($where != '') {
                $stmt->bindParam(':sf', $paramArr['sf']);
            }
        
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
        public function total($paramArr){
            $where = "";
        
            if($paramArr['sn'] != '' && $paramArr['sf'] != ''){
                switch($paramArr['sn']){
                    case 1: $sn_str = 'company_name'; break;
                    case 2: $sn_str = 'name'; break;
                    case 3: $sn_str = 'idx'; break;
                }
        
                $where = " WHERE ".$sn_str."=:sf ";
            }
        
            $sql = "SELECT COUNT(*) cnt FROM sd_Estimate_inquiry ". $where;
            $stmt = $this->conn->prepare($sql);
        
            if($where != ''){
                $stmt->bindParam(':sf', $paramArr['sf']);
            }
        
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row['cnt'];
        }
        

        public function getAllData(){
            $sql = "SELECT * FROM sd_Estimate_inquiry ORDER BY idx ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function member_del($idx){
            $sql = "DELETE FROM sd_Estimate_inquiry WHERE idx = :idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx);
            $stmt->execute();
        }

        public function getInfoFormIdx($idx){
            $sql = "SELECT * FROM sd_Estimate_inquiry WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idx", $idx);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function getAllInfoFromIdTable($id, $table) {
            $sql = "SELECT * FROM sd_Estimate_inquiry WHERE author_id = :id AND member_table = :table";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":table", $table);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll(); // 모든 행을 배열로 반환
        }
        
    }
?>