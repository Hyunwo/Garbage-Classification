<?php include('navbar.html'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>자유게시판</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <style>
        #bbs_content img {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <?php
    // 게시글의 내용 DB에서 가져오기
    include($_SERVER['DOCUMENT_ROOT']."/dbconfig.php");
    $idx = $_GET['idx'];
    $sql = $conn->prepare("SELECT * FROM board WHERE idx = ?");
    $sql->bind_param("i", $idx);
    $sql->execute();
    $result = $sql->get_result();
    $board = $result->fetch_assoc();

    // 게시글이 존재하는 경우
    if ($board) {
        $title = $board['title'];
        $name = $board['name'];
        $date = $board['date'];
        $hit = $board['hit'];
        $content = $board['content'];
        $content = str_replace("\n", "<br>", $content);

        // 조회수 증가
        $hit = $hit + 1;
        $sql = $conn->prepare("UPDATE board SET hit = ? WHERE idx = ?");
        $sql->bind_param("ii", $hit, $idx);
        $sql->execute();
    } else {
        // 게시글이 존재하지 않는 경우
        echo "<div id='board_view'><table class='view-table'><tbody><tr><td colspan='4'>게시글이 존재하지 않습니다.</td></tr></tbody></table></div>";
    }
    $sql->close();
    // $conn->close();
    ?>
    
    <!-- Modal -->
    <div class="modal" id="modal" tabindex="-1">
        <div class="modal-dialog">
            <form method="post" name="modal_form" action="./process.php">
                <input type="hidden" name="mode" value="">
                <input type="hidden" name="idx" value="<?= $idx ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">비밀번호 확인</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="password" name="pw" class="form-control" id="password" placeholder="비밀번호를 입력해 주세요">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                        <button type="submit" class="btn btn-primary" id="btn_password_chk">확인</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="container mt-3 w-50">
        <span class="h2"><a href="community.php" style="text-decoration: none; color: black; font-weight: bolder;">자유게시판</a></span>
    </div>
    <div class="container my-3 border border-1 w-50 vstack">
        <div class="p-3">
            <span class="h3 fw-border"><?= $title; ?></span>
        </div>
        <div class="d-flex px-3 border border-top-0 border-start-0 border-end-0 border-bottom-1">
            <span><?= $name; ?></span>
            <span class="ms-5 me-auto"><?= $hit; ?>회</span>
            <span><?= $date; ?></span>
        </div>
        <div class="p-3" id="bbs_content">
            <?= $content; ?>
        </div>
        <div class="d-flex gap-2 p-3">
            <a href="community.php"><button class="btn btn-secondary" id="btn_list">목록</button></a>
            <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modal" data-mode="edit" id="btn_edit">수정</button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal" data-mode="delete" id="btn_delete">삭제</button>
        </div>
    </div>

    <div class="container my-3">
        <h3>댓글</h3>
        <form method="POST" action="add_comment.php">
            <div class="mb-3">
                <label for="name" class="form-label">이름</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">댓글 내용</label>
                <textarea class="form-control" id="content" name="content" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">댓글 등록</button>
        </form>
    </div>

    <?php
    // 댓글 목록 조회
    $sql = $conn->prepare("SELECT * FROM comments WHERE board_idx = ?");
    $sql->bind_param("i", $idx);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='container my-3'>";
        echo "<h4>댓글 목록</h4>";
        echo "<ul class='list-group'>";

        while ($row = $result->fetch_assoc()) {
            $commentName = $row['name'];
            $commentContent = $row['content'];

            echo "<li class='list-group-item'>";
            echo "<strong>{$commentName}</strong>: {$commentContent}";
            echo "</li>";
        }

        echo "</ul>";
        echo "</div>";
    }

    $sql->close();
    ?>


    <script>
        // 수정 또는 삭제 버튼 클릭 시 모달 설정
        const editBtn = document.getElementById("btn_edit");
        const deleteBtn = document.getElementById("btn_delete");
        const modalForm = document.forms["modal_form"];
        const modalTitle = document.getElementById("modal_title");
        const modeInput = document.querySelector("input[name='mode']");

        editBtn.addEventListener("click", function() {
            modalTitle.textContent = "게시글 수정";
            modeInput.value = "edit";
        });

        deleteBtn.addEventListener("click", function() {
            modalTitle.textContent = "게시글 삭제";
            modeInput.value = "delete";
        });
    </script>
</body>
</html>
