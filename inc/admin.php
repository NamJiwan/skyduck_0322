<?php
    class Admin {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function login($id, $pw){
            $sql = "SELECT Password FROM sd_Admin WHERE username = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            
            $stmt->execute();
            
            if ($stmt->rowCount()) {
                $row = $stmt->fetch();
                
                // Compare plaintext passwords directly (not recommended for security reasons)
                if ($pw === $row['Password']) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        
        public function logout(){
            session_start();

            // 만약 세션 시작 시간이 저장되어 있지 않다면, 현재 시간으로 저장합니다.
            if (!isset($_SESSION['start_time'])) {
                $_SESSION['start_time'] = time();
            }

            // 세션 시작 시간과 현재 시간의 차이를 계산하여 유효 기간을 확인합니다.
            $sessionDuration = time() - $_SESSION['start_time'];
            $oneHourInSeconds = 10; // 1시간 = 60분 * 60초 = 3600초

            // 만약 유효 기간이 1시간을 초과하면 세션을 파기합니다.
            if ($sessionDuration > $oneHourInSeconds) {
                session_destroy();
                die('<script>self.location.href="../index.php"</script>');
            }else{
                session_destroy();
                die('<script>self.location.href="../index.php"</script>');
            }
        }
    }
?>