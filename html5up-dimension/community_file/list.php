<?php

    include 'config.php';
    include 'dbconfig.php';
    include 'lib.php';

    $limit = 5;
    $page_limit = 5;

    $page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page -1) * $limit;
    
    $sql = "SELECT COUNT(*) cnt FROM mboard WHERE code='".$code."'";
    $stmt = $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $row = $stmt->fetch();
    $total = $row['cnt'];

    $sql = "SELECT * FROM mboard WHERE code='".$code."' ORDER BY idx DESC LIMIT $start, $limit";
    $stmt= $conn->prepare($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $rs = $stmt->fetchAll();
?>