<?php
include('navbar.html');

session_start();

if (!isset($_SESSION['edit_idx'])) {
    header("Location: community.php");
    exit();
}

$idx = $_SESSION['edit_idx'];

include($_SERVER['DOCUMENT_ROOT'] . "/dbconfig.php");

$sql = $conn->prepare("SELECT * FROM board WHERE idx = ?");
$sql->bind_param("i", $idx);
$sql->execute();
$result = $sql->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    header("Location: community.php");
    exit();
}

$sql->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자유게시판</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="mt-4 mb-3">
            <span class="h2">자유게시판</span>
        </div>
        <div class="mb-2 d-flex gap-2">
            <input type="text" name="name" value="<?= $row['name'] ?>" class="form-control w-25" placeholder="작성자" autocomplete="off" id="id_name">
            <input type="password" name="pw" class="form-control w-25" placeholder="비밀번호" autocomplete="off" id="id_pw">
        </div>
        <div>
            <input type="text" name="title" value="<?= $row['title'] ?>" class="form-control mb-2" autocomplete="off" id="id_title">
        </div>

        <div id="summernote"><?= $row['content'] ?></div>

        <div class="mt-2 d-flex gap-2 justify-content-end">
            <button class="btn btn-primary" id="btn_submit">수정</button>
            <button class="btn btn-secondary" onclick="window.location.href='community.php'">취소</button>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 300,
                placeholder: '내용을 입력하세요',
                tabsize: 2,
                callbacks: {
                    onImageUpload: function (files) {
                        // 이미지 업로드
                    }
                }
            });

            $('#btn_submit').click(function () {
                var name = $('#id_name').val();
                var pw = $('#id_pw').val();
                var title = $('#id_title').val();
                var content = $('#summernote').summernote('code');

                $.ajax({
                    url: 'process.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        mode: 'edit',
                        idx: <?= $idx ?>,
                        name: name,
                        pw: pw,
                        title: title,
                        content: content
                    },
                    success: function (response) {
                        if (response.result === 'edit_success') {
                            alert('수정되었습니다.');
                            location.href = 'community.php';
                        } else if (response.result === 'empty_name') {
                            alert('작성자를 입력해주세요.');
                        } else if (response.result === 'wrong_password') {
                            alert('비밀번호가 일치하지 않습니다.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr);
                    }
                });
            });
        });
    </script>
</body>
</html>
