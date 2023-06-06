<?php
    include 'config.php';
    include 'dbconfig.php';

    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if ($idx == '') {
        exit('비정상적인 접근을 허용하지 않습니다.');
        //die('비정상적인 접근을 허용하지 않습니다.');
        //echo '비정상적인 접근을 허용하지 않습니다.';
        //die;
    }

    $sql = "UPDATE mboard SET hit=hit+1 WHERE idx=:idx";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idx', $idx);
    $stmt->execute();

    $sql = "SELECT * FROM mboard WHERE idx=:idx";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idx', $idx);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $row = $stmt->fetch();
?>