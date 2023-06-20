<?php

error_reporting(E_ALL);

ini_set('display_errors', '1');?>

<?php include "dbconfig.php"; ?>
<?php include "navbar.html"; ?>
<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>자유게시판</title>
    <link rel="stylesheet" type="text/css" href="/community.css">
    <style>
        .us-cursor { cursor: pointer; }
    </style>
</head>
<body>
    <div id="board_area"> 
        <h1>자유게시판</h1>
        <h4>분리수거 방법이 궁금하거나 잘 알고 있다면 의견을 공유해 보세요.</h4>
        <table class="list-table">
            <thead>
                <tr>
                    <th width="70">번호</th>
                    <th width="500">제목</th>
                    <th width="120">글쓴이</th>
                    <th width="100">작성일</th>
                    <th width="100">조회수</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = $conn->query("SELECT * FROM board ORDER BY idx DESC LIMIT 0, 10");
                while ($board = $sql->fetch_array()) {
                    $title = $board["title"]; 
                    if (strlen($title) > 30) { 
                        $title = str_replace($board["title"], mb_substr($board["title"], 0, 30, "utf-8")."...",$board["title"]);
                    }
                    $idx = $board["idx"]; 
                    $name = $board["name"]; 
                    $date = $board["date"]; 
                    $hit = $board["hit"]; 
                    ?>
                    <tr>
                        <td width="70"><a href="view.php?idx=<?php echo $idx; ?>"><?php echo $idx; ?></a></td>
                        <td width="500"><a href="view.php?idx=<?php echo $idx; ?>"><?php echo $title; ?></a></td>
                        <td width="120"><a href="view.php?idx=<?php echo $idx; ?>"><?php echo $name; ?></a></td>
                        <td width="100"><a href="view.php?idx=<?php echo $idx; ?>"><?php echo $date; ?></a></td>
                        <td width="100"><a href="view.php?idx=<?php echo $idx; ?>"><?php echo $hit; ?></a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div id="write_btn">
            <a href="write.html"><button>글쓰기</button></a>
        </div>
    </div>
</body>
</html>
