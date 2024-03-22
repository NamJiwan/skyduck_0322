<?php
    class Board {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }
        public function input($arr) {
            $sql = "INSERT INTO sd_Question_board(name, password, email, phone_number, title, content, attachments) VALUES(:name, :password, :email, :phone_number, :title, :content, :attachments)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $arr['name']);
            $stmt->bindParam(':password', $arr['password']);
            $stmt->bindParam(':email', $arr['email']);
            $stmt->bindParam(':phone_number', $arr['phone_number']);
            $stmt->bindParam(':title', $arr['title']);
            $stmt->bindParam(':content', $arr['content']);
            
            $attachments = implode(', ', $arr['attachment']); // 추가된 부분
            $stmt->bindParam(':attachments', $attachments); // 수정된 부분
            
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
                    case 1: $sn_str = 'idx'; break;
                    case 2: $sn_str = 'title'; break;
                }
        
                $where = " WHERE ".$sn_str." = :sf ";
            }
        
            $sql = "SELECT idx, name, email, phone_number, title, content, attachments, DATE_FORMAT(posting_time, '%Y-%m-%d %H:%i') AS posting_time 
                    FROM sd_Question_board ". $where ." 
                    ORDER BY idx DESC LIMIT ".$start.",".$limit;
        
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
                    case 1: $sn_str = 'idx'; break;
                    case 2: $sn_str = 'title'; break;
                }
        
                $where = "  WHERE ".$sn_str."=:sf ";
            }
        
            $sql = "SELECT COUNT(*) cnt FROM sd_Question_board ". $where;
            $stmt = $this->conn->prepare($sql);
        
            if($where != ''){
                $stmt->bindParam(':sf', $paramArr['sf']);
            }
        
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row['cnt'];
        }
        

        public function getImageList($idx) {
            $sql = "SELECT attachments FROM sd_Question_board WHERE idx = :idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && isset($row['attachments'])) {
                return explode(', ', $row['attachments']);
            }

            return [];
        }

        public function member_del($idx){
            $sql = "DELETE FROM sd_Question_board WHERE idx = :idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx);
            $stmt->execute();
        }

        public function getAllData(){
            $sql = "SELECT * FROM sd_Question_board ORDER BY idx ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getInfoFormIdx($idx){
            $sql = "SELECT * FROM sd_Question_board WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idx", $idx);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function verifyPasswordById($idx, $password){
            $sql = "SELECT password FROM sd_Question_board WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
        
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
        
                // 여기서는 입력된 비밀번호와 데이터베이스에 저장된 비밀번호를 직접 비교합니다.
                // 비밀번호가 해시로 저장되어 있는 경우 password_verify 함수를 사용하세요.
                if ($password == $row['password']) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
    }
?>