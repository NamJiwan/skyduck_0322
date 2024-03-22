<?php
include "./inc/dbconfig.php";

try {
    // 쿼리를 준비
    // $stmt = $pdo->prepare('SELECT ImageRoute FROM sd_portfolio WHERE idx');
    $stmt = $pdo->prepare('SELECT ImageRoute FROM sd_portfolio WHERE Category = "ect"');

    // 쿼리 실행
    $stmt->execute();

    // 결과를 가져와서 JSON 형식으로 출력
    $images = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $images[] = $row['ImageRoute'];
    }
    echo json_encode(['ImageRoute' => $images]);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
