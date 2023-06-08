<?php

    $code = (isset($_GET['code']) && $_GET['code'] != '') ? $_GET['code'] : '';

    switch($code) {
        case 'freeboard' : $board_title = '자유게시판'; break;
        default : $code = 'freeboard'; $board_title = '자유게시판';
    }