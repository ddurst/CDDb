<?php 
	
	session_start(); 
	echo $_SESSION['profile'];
	require_once('connect.php');
		$profile = $_SESSION['profile'];
		$sql = "SELECT * FROM PROFILE WHERE profileID = '$profile'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_row($result);
		if (mysqli_num_rows($result) == 1) {
			echo "$row[1]";
			echo "</br>";
			echo "$row[2]";
			echo "</br>";
			echo "$row[3]";
			echo "</br>";
			echo "$row[4]";
			echo "</br>";
			echo "$row[5]";
			echo "</br>";
			echo "$row[6]";
			echo "</br>";
			echo "$row[7]";
			echo "</br>";
			echo "$row[8]";
			echo "</br>";
			echo "$row[9]";
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Collective Dialectic Database Profile</title>
	
	<!-- Alternate CSS files
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="test/css" href="styles.css">
	<link rel="stylesheet" type="test/css" href="style_CDDb.css"> 
	-->
	<link rel="stylesheet" type="test/css" href="style_CDDb.css"> 


	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	

</head>
<body>
	<div class="container">
				<!-- Test stuff here-->

		<?php if($_SESSION['opinion'] == 0){ ?>
			No Opinion
			<form action='functions.php' method="POST">
				<input type="submit" class="button" name="buttonClicked" value="accept"> 
				<input type="submit" class="button" name="buttonClicked" value="reject">
			</form>
		<?php } ?>

		<?php if($_SESSION['opinion'] > 0){ ?>
			<table border = '0'><tr><td><div class="selected">Accepted</div></td>
			<td>
			<form action='functions.php' method="POST">
				 <input type="submit" class="button" name="buttonClicked" value="reject">
			</form>
			</td>
			</tr>
			</table>
		<?php } ?>

		<?php if($_SESSION['opinion'] < 0){ ?>
			<table border = '0'><tr><td><form action='functions.php' method="POST">
				<input type="submit" class="button" name="buttonClicked" value="accept">
			</form></td>
			<td>
				<div class="selected">Rejected</div></td>
			</tr>
			</table>
		<?php } ?>

	</div>

	<div> <!-- Test the explication window here -->
		<button>	Twitter metatags build a clickable link </button>
		    <!-- Rectangular switch -->
	</div> 
		<label class="switch">
		  <input type="checkbox">
		  <span class="slider"></span>
		</label>

	<div> <!-- Test weigh in here -->
		<button>	submit button for form that handles "weigh in" </button>
	</div>
	<div> <!-- Create a DFS algorithm that searches for circular arguments -->
		Create a dynamic table that lists circular arguments identified through a depth first search of vertices in a digraph.
		
		<!--
		ALGORITHM DFS(G)
		//Implements a depth-first search traversal of a given graph
		//Input: Graph G = [angle brackets]V,E[angle brackets]
		//Output: Graph G with its vertices marked with consecutive integers
		//		in the order the are first encountered by the DFS traversal
		mark each vertex in V with 0 as a mark of being "unvisited"
		count = 0
		for each vertex v in V do
			if v is marked with 0
				dfs(v)

		dfs(v)
		//visits recursively all the unvisited vertices connected to the vertex v
		//by a path and numbers them in the order they are encountered 
		/via clobal variable count
		count = count + 1
		for each vertex w in V adjacent to v do
			if w is marked with 0
				dfs(w)

		The existence of a back edge indicates a directed cycle. 
		-->
	</div>
	<div> <!-- Experiment with a path of least resistance or most straightforward path between two vertices -->
		<!--
		ALGORITHM BFS(G)
		//Implements a breadth-first search traversal of a given graph
		//Input: Graph G = [angle brackets]V,E[angle brackets]
		//Output: Graph G with its vertices marked with consecutive integers
		//		in the order they are visited by BFS traversal
		mark each vertex in V with 0 as a mark of being "unvisited"
		count = 0
		for each vertex v in V do
			if v is marked with 0
				bfs(v)

		bfs(v)
		//visits all the unvisited vertices connected to vertex v
		//by a path and numbers them in the order they are visited
		/via clobal variable count
		count = count + 1
		mark v with count and initialize a queue with v
		while the queue is not empty do
			for each vertex w in V adjacent to the front vertex do
				if w is marked with 0
					count = count + 1
					mark w with count
					add w to the queue
			remove the front vertex from the queue
		-->
	</div>
		<div> <!-- Experiment with applying the idea of articulation points toward finding the crux of an argument -->
	</div>
</body>
</html>
