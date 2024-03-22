<?php
    include "./../../inc/dbconfig.php";

    $db = $pdo;

    include "./../../inc/reply.php";

    $reply = new Reply($db);

    $title = (isset($_POST['subject']) && $_POST['subject'] != '') ? $_POST['subject'] : '';
    $content = (isset($_POST['content']) && $_POST['content'] != '') ? $_POST['content'] : '';
    $target_idx = (isset($_POST['target_idx']) && $_POST['target_idx'] != '') ? $_POST['target_idx'] : '';
    $mode = (isset($_POST['mode']) && $_POST['mode'] != '') ? $_POST['mode'] : '';

    function processImages($content, $target_idx, $reply, $title) {
        preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $content, $matches);
        foreach ($matches[1] as $key => $row) {
            if (substr($row, 0, 5) != 'data:') {
                continue;
            }
            list($type, $data) = explode(';', $row);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            list(, $ext) = explode('/', $type);
            $ext = ($ext == 'jpeg') ? 'jpg' : $ext;
            
            // 파일 이름에서 부적절한 문자 제거
            $safeTitle = preg_replace("/[^a-zA-Z0-9가-힣]/", "", $title);
            $filename = $safeTitle . '.' . $ext;
    
            // 이미지 파일을 서버에 저장
            $file_path = '/src' . '/data/admin_reply' . '/' . $filename;
            file_put_contents('./../../data/admin_reply' . '/' . $filename, $data);
    
            $content = str_replace($row, $file_path, $content);
    
            // saveImageInfo 메서드를 호출하여 이미지 정보를 데이터베이스에 저장
            $reply_id = $target_idx;
            $reply->saveImageInfo($reply_id, $file_path, $filename);
        }
    
        return $content;
    }


    if ($mode == '') {
        die(json_encode(['result' => 'empty_mode']));
    };

    if ($mode == 'reply_input') { 
                // 이미지 처리 로직 호출
        $content = processImages($content, $target_idx, $reply, $title);
        
        // 제목과 내용에서 HTML 태그 제거
        $title = strip_tags($title);
        $content = strip_tags($content, '<p><br><img>'); // 필요한 태그만 허용
        
        // 내용이 빈 경우 처리
        if (empty($content) || $content == '<p><br></p>') {
            die(json_encode(['result' => 'empty_content']));
        }
        
        // 대상 인덱스가 빈 경우 처리
        if (empty($target_idx)) {
            die(json_encode(['result' => 'empty_target_idx']));
        }
        
        // 나머지 코드는 그대로 유지
        
        $arr = [
            'title' => $title,
            'content' => $content,
            'question_idx' => $target_idx
        ];
        
        $reply->input($arr);
        die(json_encode(["result" => "success"]));
        
    } else if ($mode == 'reply_edit') {
        // 기존 이미지 정보를 삭제
        $reply->deleteImagesByReplyId($target_idx);
    
        if ($title == '') {
            die(json_encode(['result' => 'empty_title']));
        }
    
        if ($content == '' || $content == '<p><br></p>') {
            die(json_encode(['result' => 'empty_content']));
        }
    
        if ($target_idx == '') {
            die(json_encode(['result' => 'empty_target_idx']));
        }
    
        // processImages 함수를 사용하여 이미지 처리
        $content = processImages($content, $target_idx, $reply, $title);
    
        $arr = [
            'title' => $title,
            'content' => $content,
            'question_idx' => $target_idx
        ];
    
        // 수정된 내용 저장
        $reply->edit($arr);
    
        die(json_encode(["result" => "success"]));
    }
?>