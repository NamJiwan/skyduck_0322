<!-- <?php
    include "./inc/dbconfig.php";

    $db = $pdo;

    include "./inc/portfolio.php";
    include "./inc/lib.php";

    $sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
    $sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';

    $port = new Portfolio($db);

    $paramArr = [ 'sn' => $sn, 'sf' => $sf];

    $total = $port->total($paramArr);
    $limit = $total; // 모든 항목을 가져오기 위해 limit을 총 항목 수로 설정
    $page_limit = 5;
    $page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

    $param = ''; 

    $portArr = $port->list($page, $limit, $paramArr);
    print_r($portArr);
?> -->
