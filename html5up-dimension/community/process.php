<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include($_SERVER['DOCUMENT_ROOT'] . "/dbconfig.php");
    
    $mode = $_POST['mode'];
    $idx = $_POST['idx'];
    $pw = $_POST['pw'];
    
    $sql = $conn->prepare("SELECT * FROM board WHERE idx = ?");
    $sql->bind_param("i", $idx);
    $sql->execute();
    $result = $sql->get_result();
    $board = $result->fetch_assoc();
    
    if ($board) {
        // 비밀번호 확인
        if ($pw === $board['pw']) {
            if ($mode == 'delete') {
                // 삭제 처리
                $sql = "DELETE FROM board WHERE idx=:idx";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':idx', $idx);
                $stmt->execute();
                
                $arr = ['result' => 'delete_success'];
                die(json_encode($arr));
            } else if ($mode == 'edit') {
                // 수정 화면으로 이동
                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $title = isset($_POST['title']) ? $_POST['title'] : '';
                $content = isset($_POST['content']) ? $_POST['content'] : '';
                
                if (empty($name)) {
                    // name 값이 비어있는 경우 처리할 내용 작성
                    $arr = ['result' => 'empty_name'];
                    die(json_encode($arr));
                }
                
                $sql = $conn->prepare("UPDATE board SET name=?, title=?, content=? WHERE idx=?");
                $sql->bind_param("sssi", $name, $title, $content, $idx);
                $sql->execute();
                $sql->close();
                
                // JSON 형식으로 반환할 배열 생성
                $response = array(
                    'result' => 'edit_success' // 수정 성공 시 결과를 'edit_success'로 설정
                );
                
                echo json_encode($response); // JSON 형식으로 데이터 반환
                exit(); // 처리 후 종료
            }
        } else {
            $arr = ['result' => 'wrong_password'];
            die(json_encode($arr));
        }
    }
    
    $sql->close();
    $conn->close();
}
?>
