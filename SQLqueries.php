<?php
	include('connect.php');
	switch ($selectSQL) {
        case 1:
        	/*Gives all arguments associated with the argument at hand and provides aggregate weight for all endorse types*/
        	$param1 = $_SESSION['currentArg'];
			$sql = "SELECT E1.targArgID, E1.endorseType, E1.supportingArgID, SUM(E1.weight)/TotalUsers AS AggWeight
				FROM ENDORSEMENT E1
					JOIN (SELECT targArgID, endorseType, COUNT(DISTINCT profileID) AS TotalUsers
						FROM ENDORSEMENT
						WHERE targArgID = $param1
						GROUP BY endorseType) E2 
					ON E1.endorseType = E2.endorseType
    			WHERE E1.targArgID = $param1
    			GROUP BY E1.endorseType, E1.supportingArgID
    			ORDER BY E1.endorseType, AggWeight DESC";
			$result = mysqli_query($conn, $sql);
            break;
        case 2:
            $param1 = $_SESSION['currentArg'];
			$sql = "CALL assertOpinion($param1,$param2,$param3)";
			$result = mysqli_query($conn, $sql);
            break;
        case 3:
        	$param1 = $_SESSION['currentArg'];
			$sql = "CALL assertOpinion($param1,$param2,$param3)";
			$result = mysqli_query($conn, $sql);
            break;
        case 4:
        	$param1 = $_SESSION['currentArg'];
			$sql = "CALL assertOpinion($param1,$param2,$param3)";
			$result = mysqli_query($conn, $sql);
            break;
        case 5:
        	$param1 = $_SESSION['currentArg'];
			$sql = "CALL assertOpinion($param1,$param2,$param3)";
			$result = mysqli_query($conn, $sql);
            break;	
    }	
 ?>
