<?php
    class Portfolio {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function input($arr) {
            // 'description' 키가 $arr에 있는지 확인
            if (!isset($arr['description'])) {
                // 존재하지 않으면 기본값 설정
                $arr['description'] = '특별한 설명이 없습니다';
            }
        
            $sql = "INSERT INTO sd_portfolio(Category, Name, description, ImageRoute, UploadDate) VALUES(:category, :name, :description, :imageRoute, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':category', $arr['Category']);
            $stmt->bindParam(':name', $arr['Name']);
            $stmt->bindParam(':description', $arr['description']);
            $stmt->bindParam(':imageRoute', $arr['ImageRoute']);
            $stmt->execute();
            
            // 삽입된 행의 수를 확인하여 성공 여부 판단
            if ($stmt->rowCount() === 0) {
                return false;
            }
        
            return true;
        }
        
        
        public function total($paramArr) {
            $where = "";
        
            if ($paramArr['sn'] != '' && $paramArr['sf'] != '') {
                switch ($paramArr['sn']) {
                    case 1: $sn_str = 'Name'; break;
                    case 2: $sn_str = 'idx'; break; // Changed from 'ID' to 'idx'
                    case 3: $sn_str = 'Category'; break; // Added case for Category
                }
        
                $where = " WHERE ".$sn_str." = :sf ";
            }
        
            $sql = "SELECT COUNT(*) cnt FROM sd_portfolio ". $where;
            $stmt = $this->conn->prepare($sql);
        
            if ($where != '') {
                $stmt->bindParam(':sf', $paramArr['sf']);
            }
        
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row['cnt'];
        }
        
        public function list($page, $limit, $paramArr) {
            $start = ($page - 1) * $limit;
            $where = "";
        
            if ($paramArr['sn'] != '' && $paramArr['sf'] != '') {
                switch ($paramArr['sn']) {
                    case 1: $sn_str = 'Name'; break;
                    case 2: $sn_str = 'idx'; break; // Changed from 'ID' to 'idx'
                    case 3: $sn_str = 'Category'; break; // Added case for Category
                }
        
                $where = " WHERE ".$sn_str." = :sf ";
            }
        
            $sql = "SELECT idx, Name, Category, description, ImageRoute, UploadDate 
                    FROM sd_portfolio ". $where ." 
                    ORDER BY idx DESC LIMIT ".$start.",".$limit;
        
            $stmt = $this->conn->prepare($sql);
        
            if ($where != '') {
                $stmt->bindParam(':sf', $paramArr['sf']);
            }
        
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getAllData(){
            $sql = "SELECT * FROM sd_portfolio ORDER BY idx ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        

        public function member_del($idx){
            $sql = "DELETE FROM sd_portfolio WHERE idx = :idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx);
            $stmt->execute();
        }

        // portfolio.php 파일에 추가

    // 이하 클래스의 다른 메서드들...

        public function getImageList($idx) {
            $sql = "SELECT ImageRoute FROM sd_portfolio WHERE idx = :idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && isset($row['ImageRoute'])) {
                return explode(',', $row['ImageRoute']);
            }

            return [];
        }

        public function getInfoFormIdx($idx){
            $sql = "SELECT * FROM sd_portfolio WHERE IDX=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idx", $idx);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function admin_portfolio_edit($arr) {
            if (!isset($arr['description'])) {
                // 존재하지 않으면 기본값 설정
                $arr['description'] = '특별한 설명이 없습니다';
            }

            if (isset($_SESSION['ses_id']) && $_SESSION['ses_id'] == 'skyduck_admin') {
                $sql = 'UPDATE `sd_portfolio` SET `Category` = :category, `Name` = :name, `description` = :description, `ImageRoute` = :imageRoute, `UploadDate` = NOW() WHERE `idx` = :idx';

                $params = [
                    ':category' => $arr['category'],
                    ':name' => $arr['name'],
                    ':description' => $arr['description'],
                    ':imageRoute' => $arr['imageRoute'],
                    ':idx' => $arr['idx']
                ];

                try {
                    $stmt = $this->conn->prepare($sql);
                    $success = $stmt->execute($params);
        
                    if ($success) {
                        // 사용자 프로필 업데이트 후 추가 코드가 필요한 경우
                        return ['success' => true];
                    } else {
                        return ['success' => false, 'error' => $stmt->errorInfo()];
                    }
                } catch (PDOException $e) {
                    return ['success' => false, 'error' => $e->getMessage()];
                }
            } else {
                // 'skyduck_admin'이 아닌 경우에는 업데이트를 허용하지 않음
                return ['success' => false, 'error' => '허가되지 않은 사용자입니다.'];
            }
        }
    }
?>