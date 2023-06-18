<?php
include($_SERVER['DOCUMENT_ROOT'] . "/dbconfig.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $content = $_POST['content'];
    $boardIdx = isset($_GET['idx']) ? $_GET['idx'] : null; // 게시글의 고유번호

    if ($boardIdx) {
        // 댓글을 DB에 저장하는 쿼리 실행
        $sql = $conn->prepare("INSERT INTO comments (board_idx, name, content) VALUES (?, ?, ?)");
        $sql->bind_param("iss", $boardIdx, $name, $content);
        $sql->execute();
        $sql->close();
    }
}

$conn->close();
header("Location: view.php?idx=" . $boardIdx); // 댓글 등록 후 게시글 상세 페이지로 이동
exit();
?>