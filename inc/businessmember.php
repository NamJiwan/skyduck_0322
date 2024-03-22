<?php
    class BusinessMemeber {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function id_exist($id)
        {
            $sql = "SELECT * FROM sd_BusinessUsers WHERE ID = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->rowCount() ? true : false;
        }

        public function email_format_check($email){
            return filter_has_var($email, FILTER_VALIDATE_EMAIL);
        }

        public function email_exists($email){
            $sql = "SELECT * FROM sd_BusinessUsers WHERE Email=:email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email',  $email);
            $stmt->execute();

            return $stmt->rowCount() ? true : false;
        }

        public function business_number_exists($business_number){
            $sql = "SELECT * FROM sd_BusinessUsers WHERE BusinessRegistrationNumber = :businessNumber";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':businessNumber', $business_number);
            $stmt->execute();
            return $stmt->rowCount() ? true : false;
        }

        public function input($marr){
            $new_hash_password = password_hash($marr['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO sd_BusinessUsers(ID, Password, CompanyName, CEOName, PhoneNumber, MobileNumber, FaxNumber, Email, Zipcode, Address, DetailAddress, BusinessRegistrationNumber, BusinessRegistrationImage, BusinessType, BusinessCategory, SignupDate) VALUES
            (:id, :password, :companyname, :ceoname, :phonenumber, :mobilenumber, :faxnumber, :email, :zipcode, :address, :detailaddress, :businessregistrationnumber, :businessregistrationimage, :businesstype, :businesscategory, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $marr['id']);
            $stmt->bindParam(':password', $new_hash_password);
            $stmt->bindParam(':companyname', $marr['companyname']);
            $stmt->bindParam(':ceoname', $marr['ceoname']);
            $stmt->bindParam(':mobilenumber', $marr['mobilenumber']);
            $stmt->bindParam(':phonenumber', $marr['phonenumber']);
            $stmt->bindParam(':faxnumber', $marr['faxnumber']);
            $stmt->bindParam(':email', $marr['email']);
            $stmt->bindParam(':zipcode', $marr['zipcode']);
            $stmt->bindParam(':address', $marr['address']);
            $stmt->bindParam(':detailaddress', $marr['detailaddress']);
            $stmt->bindParam(':businessregistrationnumber', $marr['businessregistrationnumber']);
            $stmt->bindParam(':businessregistrationimage', $marr['businessregistrationimage']);
            $stmt->bindParam(':businesstype', $marr['businesstype']);
            $stmt->bindParam(':businesscategory', $marr['businesscategory']);
            $stmt->execute();

            if ($stmt->rowCount() === 0){
                return false;
            }

            return true;
        }

        public function business_login($id, $pw, $number){
            $sql = "SELECT Password FROM sd_BusinessUsers WHERE ID = :id AND BusinessRegistrationNumber = :brn";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':brn', $number);

            $stmt->execute();

            if ($stmt->rowCount()) {
                $row = $stmt->fetch();

                if (password_verify($pw, $row['Password'])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public function getInfo($id) {
            $sql = "SELECT * FROM sd_BusinessUsers WHERE ID = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function list($page, $limit, $paramArr) {
            $start = ($page - 1) * $limit;
            $where = "";
        
            if ($paramArr['sn'] != '' && $paramArr['sf'] != '') {
                switch ($paramArr['sn']) {
                    case 1: $sn_str = 'ID'; break;
                    case 2: $sn_str = 'Email'; break;
                    case 3: $sn_str = 'CompanyName'; break;
                    case 4: $sn_str = 'CEOName'; break;
                    case 5: $sn_str = 'IDX'; break;
                }
        
                $where = " WHERE ".$sn_str." = :sf ";
            }
        
            $sql = "SELECT * 
            FROM sd_BusinessUsers " . $where . 
            " ORDER BY IDX DESC 
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
                    case 1: $sn_str = 'ID'; break;
                    case 2: $sn_str = 'Email'; break;
                    case 3: $sn_str = 'CompanyName'; break;
                    case 4: $sn_str = 'CEOName'; break;
                    case 5: $sn_str = 'IDX'; break;
                }
        
                $where = " WHERE ".$sn_str."=:sf ";
            }
        
            $sql = "SELECT COUNT(*) cnt FROM sd_BusinessUsers ". $where;
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
            $sql = "SELECT * FROM sd_BusinessUsers ORDER BY IDX ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getImageList($idx) {
            $sql = "SELECT BusinessRegistrationImage FROM sd_BusinessUsers WHERE IDX = :idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && isset($row['BusinessRegistrationImage'])) {
                return explode(',', $row['BusinessRegistrationImage']);
            }

            return [];
        }

        public function member_del($idx){
            $sql = "DELETE FROM sd_BusinessUsers WHERE IDX = :idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx);
            $stmt->execute();
        }

        public function getInfoFormIdx($idx){
            $sql = "SELECT * FROM sd_BusinessUsers WHERE IDX=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idx", $idx);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function getInfoFormId($id){
            $sql = "SELECT * FROM sd_BusinessUsers WHERE ID=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function admin_to_business_member_edit($arr) {
            if (isset($_SESSION['ses_id']) && $_SESSION['ses_id'] == 'skyduck_admin') {
                $sql = 'UPDATE sd_BusinessUsers SET CompanyName = :companyname, CEOName = :ceoname, MobileNumber = :mobilenumber, PhoneNumber = :phonenumber, FaxNumber = :faxnumber, Email = :Email, ZipCode = :zipcode, Address = :address, DetailAddress = :detailaddress, BusinessRegistrationNumber = :bnumber, BusinessRegistrationImage = :bimage, BusinessType = :btype, BusinessCategory = :bcategory';

                $params = [
                    ':companyname' => $arr['companyname'],
                    ':ceoname' => $arr['ceoname'], // ceoname에 해당하는 값을 $arr 배열에서 가져와야 합니다.
                    ':mobilenumber' => $arr['mobilenumber'],
                    ':phonenumber' => $arr['phonenumber'],
                    ':faxnumber' => $arr['faxnumber'], // fax에 해당하는 값을 $arr 배열에서 가져와야 합니다.
                    ':Email' => $arr['email'],
                    ':zipcode' => $arr['zipcode'],
                    ':address' => $arr['address'],
                    ':detailaddress' => $arr['detailaddress'],
                    ':bnumber' => $arr['businessregistrationnumber'], // bnumber에 해당하는 값을 $arr 배열에서 가져와야 합니다.
                    ':bimage' => $arr['businessregistrationimage'], // bimage에 해당하는 값을 $arr 배열에서 가져와야 합니다.
                    ':btype' => $arr['businesstype'], // btype에 해당하는 값을 $arr 배열에서 가져와야 합니다.
                    ':bcategory' => $arr['businesscategory'], // bcategory에 해당하는 값을 $arr 배열에서 가져와야 합니다.
                ];
                

                if ($arr['password'] != '') {
                    // 비밀번호를 위해 단방향 해시
                    $new_hash_password = password_hash($arr['password'], PASSWORD_DEFAULT);
                    $params[':password'] = $new_hash_password;
                    $sql .= ', Password=:password';
                };

                $sql .= ', SignupDate=NOW()';

                $params[':id'] = $arr['id'];
                $sql .= ' WHERE ID=:id';
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


        public function business_member_edit($arr) {
            $sql = 'UPDATE sd_BusinessUsers SET CompanyName = :companyname, CEOName = :ceoname, MobileNumber = :mobilenumber, PhoneNumber = :phonenumber, FaxNumber = :faxnumber, Email = :Email, ZipCode = :zipcode, Address = :address, DetailAddress = :detailaddress, BusinessRegistrationNumber = :bnumber, BusinessRegistrationImage = :bimage, BusinessType = :btype, BusinessCategory = :bcategory';

            $params = [
                ':companyname' => $arr['companyname'],
                ':ceoname' => $arr['ceoname'], // ceoname에 해당하는 값을 $arr 배열에서 가져와야 합니다.
                ':mobilenumber' => $arr['mobilenumber'],
                ':phonenumber' => $arr['phonenumber'],
                ':faxnumber' => $arr['faxnumber'], // fax에 해당하는 값을 $arr 배열에서 가져와야 합니다.
                ':Email' => $arr['email'],
                ':zipcode' => $arr['zipcode'],
                ':address' => $arr['address'],
                ':detailaddress' => $arr['detailaddress'],
                ':bnumber' => $arr['businessregistrationnumber'], // bnumber에 해당하는 값을 $arr 배열에서 가져와야 합니다.
                ':bimage' => $arr['businessregistrationimage'], // bimage에 해당하는 값을 $arr 배열에서 가져와야 합니다.
                ':btype' => $arr['businesstype'], // btype에 해당하는 값을 $arr 배열에서 가져와야 합니다.
                ':bcategory' => $arr['businesscategory'], // bcategory에 해당하는 값을 $arr 배열에서 가져와야 합니다.
            ];
            

            if ($arr['password'] != '') {
                // 비밀번호를 위해 단방향 해시
                $new_hash_password = password_hash($arr['password'], PASSWORD_DEFAULT);
                $params[':password'] = $new_hash_password;
                $sql .= ', Password=:password';
            };

            $sql .= ', SignupDate=NOW()';

            $params[':id'] = $arr['id'];
            $sql .= ' WHERE ID=:id';
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
        }
    }