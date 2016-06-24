<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<html>
<head>
	<style type="text/css">
	table{
		width:50%;
		align:center;
		border: 1px solid LightSeaGreen;
		border-collapse: collapse;
		margin: 10px;
	}
	th{
		background-color: LightSkyBlue ;
		border: 1px solid LightSeaGreen;
	}
	td, tr{
		border: 1px solid LightSeaGreen;
		border-collapse: collapse;
	}
	#td_num{
		text-align:center;
	}
	#td_content{
		 height: 150px;
	}
	</style>
	
</head>
<body>

	<h1>나의 게시판</h1>
	<hr>
	<div class="content">	
		<?php
			require_once('board_functions.php');
		
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				$post_id = $_GET['post_id'];
			}	
			$conn = get_sqlserver_conn();
			
			$select_query = sprintf("SELECT * FROM post WHERE post_id='%d'", $post_id);
			$result = mysqli_query($conn, $select_query);// result_set
			if (($post = mysqli_query($conn, $select_query)) === false) {
				echo mysqli_error($conn);
			}
			
			$post = mysqli_fetch_assoc($result);
			
			printf("<form action='modify_process.php' method='post'>");
			printf("<input type='hidden' name='post_id' value='%d'>", $post['post_id']);
			printf("<table>");
			printf("<tr><th>글번호</th> <td>%d</td></tr>", $post['post_id']);
			printf("<tr><th>작성자</th> <td><input type='text' name='writer' value='%s'></td></tr>", $post['writer']);
			printf("<tr><th>조회수</th> <td>%d</td></tr>", $post['hits']);
			printf("<tr><th>작성일</th> <td>%s</td></tr>", $post['last_update']);
			printf("<tr><th>제목</th> <td><input type='text' name='title' value='%s'></td></tr>",  $post['title'] );
			printf("<tr><td height='10' colspan='2'></td></tr>");
			printf("<tr><th colspan='2' align='center'>내 용</th></tr>");
			printf("<tr><td id='td_content' colspan='2' align='center'><textarea name='content' rows='12' cols='135'>%s</textarea>", $post['content']);
			printf("<br><input type='submit' value='확인'></td></tr>");
			printf("</table>");
			printf("</form>");

			mysqli_free_result($result);
			mysqli_close($conn);
		?>	
		<a href="./board_write.php"><button>글작성</button></a>
		<a href="./index.php"><button>글목록</button></a> <br>
	</div>
	<hr>
	
</body>
</html>