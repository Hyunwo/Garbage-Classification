<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>자유게시판</title>
    <style>
    body {
        padding: 1rem;
    }

    h1 {
        text-align: center;
    }

    #userInfoContainer {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    #title {
        width: 100%;
        font-size: xx-large;
    }
    </style>

</head>

<body>
    <?php
    $id = $_GET["id"];
    include $_SERVER['DOCUMENT_ROOT'] . "/dbconfig.php";
    $stmt = $conn->prepare("select * from board where id =?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
    ?>

    <h1>게시글 작성</h1>
    <div id="userInfoContainer">
        <div>
            작성자 : <?php echo $post['nickname'] ?>
        </div>
    </div>
    <div id="title">
        <?php echo $post['title'] ?>
    </div>
    <div id="contents">
        <?php echo $post['content'] ?>
    </div>
</body>

</html>