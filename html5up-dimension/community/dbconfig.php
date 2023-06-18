<?php
	$host = "13.125.36.142";
	$user = "hyeonu";
	$pw = "1234";
	$dbName = "community";

	$conn = new mysqli($host, $user, $pw, $dbName);

	/* DB 연결 확인 */
	if ($conn) {
		//echo "Connection established" . "<br>";
	} else {
		die('Could not connect: ' . mysqli_error($conn));
	}

	// 댓글 테이블 생성 쿼리 실행
	$query = "CREATE TABLE IF NOT EXISTS comments (
		id INT PRIMARY KEY AUTO_INCREMENT,
		post_id INT,
		content TEXT,
		author VARCHAR(255),
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)";

	if ($conn->query($query) === TRUE) {
		//echo "Table created successfully" . "<br>";
	} else {
		echo "Error creating table: " . $conn->error;
	}

	// 댓글 저장 함수
	function saveComment($post_id, $content, $author) {
		global $conn;
		$query = "INSERT INTO comments (post_id, content, author) VALUES (?, ?, ?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("iss", $post_id, $content, $author);
		$stmt->execute();
		$stmt->close();
	}

	// 댓글 조회 함수
	function getComments($post_id) {
		global $conn;
		$query = "SELECT * FROM comments WHERE post_id = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("i", $post_id);
		$stmt->execute();
		$result = $stmt->get_result();
		$comments = [];
		while ($row = $result->fetch_assoc()) {
			$comments[] = $row;
		}
		$stmt->close();
		return $comments;
	}
?>

