<?php
    class Reply {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function input($arr) {
            // posting_time은 기본적으로 현재 시각을 사용하므로 별도의 입력값이 필요하지 않습니다.
            // image_info 처리 로직이 필요하다면, 여기에 추가합니다. (이 예제에서는 생략)
            $sql = "INSERT INTO sd_admin_reply (title, content, question_idx) VALUES (:title, :content, :question_idx)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':title', $arr['title']);
            $stmt->bindParam(':content', $arr['content']);
            $stmt->bindParam(':question_idx', $arr['question_idx']); // 기존에 'target_idx'를 사용했지만, 'question_idx'로 변경합니다.
        
            $stmt->execute();
            if ($stmt->rowCount() === 0) {
                return false;
            };
        
            return true;
        }
        public function getImageList($idx) {
            $sql = "SELECT filename FROM sd_admin_reply_images WHERE reply_id = :idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            $filenames = [];
            if ($results) {
                foreach ($results as $row) {
                    $filenames[] = $row['filename'];
                }
            }
        
            return $filenames;
        }
        
        public function saveImageInfo($target_idx, $file_path, $filename) {
            // 이미지 정보를 데이터베이스에 저장하는 SQL 쿼리 준비
            $sql = "INSERT INTO sd_admin_reply_images (reply_id, file_path, filename) VALUES (:reply_id, :file_path, :filename)";
            $stmt = $this->conn->prepare($sql);
            
            // 파라미터 바인딩
           // 파라미터 바인딩
            $stmt->bindParam(':reply_id', $target_idx);
            $stmt->bindParam(':file_path', $file_path); // 여기가 수정되어야 합니다.
            $stmt->bindParam(':filename', $filename); // 여기가 수정되어야 합니다.

            // 쿼리 실행
            $stmt->execute();
            if ($stmt->rowCount() === 0) {
                // 데이터베이스에 정보 저장 실패
                return false;
            };
            
            // 성공적으로 저장됨
            return true;
        }
        
        
        
        public function getInfoBoardIdx($idx){
            $sql = "SELECT * FROM sd_admin_reply WHERE question_idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idx", $idx);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function isRowExists($idx) {
            $sql = "SELECT COUNT(*) FROM sd_admin_reply WHERE question_idx = :idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idx", $idx);
            $stmt->execute();
        
            // Fetching the count value
            $row_count = $stmt->fetchColumn();
        
            // If row count is greater than 0, the row exists
            return ($row_count > 0);
        }

        public function view($idx){
            $sql = "SELECT * FROM sd_admin_reply WHERE question_idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":idx" => $idx ];
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($params);
            return $stmt->fetch();
        }

        public function edit($arr){
            // SQL 쿼리문에서, sd_admin_reply 테이블의 title, content를 업데이트합니다.
            // 이때, 특정 question_idx 값을 가진 레코드를 대상으로 합니다.
            $sql = "UPDATE sd_admin_reply SET title=:subject, content=:content WHERE question_idx=:idx";
            
            // 데이터베이스에 대한 연결을 사용하여 SQL 쿼리를 준비합니다.
            $stmt = $this->conn->prepare($sql);
            
            // SQL 쿼리에 바인딩할 파라미터를 배열로 정의합니다.
            // 이 배열은 메서드로 전달된 배열에서 subject, content, question_idx 값을 사용합니다.
            $params = [
                ':subject' => $arr['title'],
                ':content' => $arr['content'],
                ':idx' => $arr['question_idx']
            ];
            
            // 준비된 쿼리를 실행하며, 위에서 정의한 파라미터를 사용합니다.
            $stmt->execute($params);
        }
        
        function deleteImagesByReplyId($reply_id) {
            // 해당 reply_id를 가진 이미지 파일명과 경로 조회
            $sql = "SELECT file_path, filename FROM sd_admin_reply_images WHERE reply_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$reply_id]);
            while ($row = $stmt->fetch()) {
                $fullPath = $row['file_path'];
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                } else {
                    // 파일이 존재하지 않는다는 로그를 남기거나 다른 처리를 수행
                    error_log("파일이 존재하지 않습니다: ".$fullPath);
                }        
            }
        
            // 데이터베이스에서 해당 레코드 삭제
            $sql = "DELETE FROM sd_admin_reply_images WHERE reply_id = ?";
            $stmt = $this->conn->prepare($sql); // 여기서 수정
            $stmt->execute([$reply_id]);
        }

        public function reply_del($idx){
            $sql = "DELETE FROM sd_admin_reply WHERE reply_id  = :idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx);
            $stmt->execute();
        }
    }
?>