<?php
    $mediaBaseUrl = 'http://localhost/upload/';
    $mediaRoot = '/var/www/html/upload/';

    $name = $_POST['name'];
    // 비밀번호 암호화
    $pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (isset($_FILES['files'])) {
        $files = $_FILES['files'];
        $countfiles = count($files['name']);

        for ($i = 0; $i < $countfiles; $i++) {
            $filename = $files['name'][$i];
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $filePath = uniqid() . '.' . $extension;

            if (move_uploaded_file($files['tmp_name'][$i], $mediaRoot . $filePath)) {
                $content = str_replace($filename, $mediaBaseUrl . $filePath, $content);
            } else {
                $error = $files['error'][0];
                die();
            }
        }
    }

    $length = strlen($pw);

    include $_SERVER['DOCUMENT_ROOT'] . "/dbconfig.php";
    $stmt = $conn->prepare("INSERT INTO board (name, pw, title, content) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $pw, $title, $content);
    $stmt->execute();
    echo $stmt->insert_id;
    $stmt->close();

    echo "성공";
?>
