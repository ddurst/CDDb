<?php
	$limit = 20; /*what should we limit our results to. Possibly unecessary long term once we have a confident handle on things*/
	include('./includes/dbconnect.php'); 
		switch ($selectSQL) {
	        /*Gives all arguments associated[E1.supportingArgID] to argument at hand(AAH)[E1.targArgID] + aggregated weight [AggWeight] + all endorse types[E1.endorseType] + phrasing[P1.phrasing]
	        Used by: 
	        	dynamic-styling[dynamic-styling_CDDb.php] to maintain multiple buttons acting indepently on click*/
	        /*TODO Do we not need to filter inactive from active here?*/
	    case 1:
        	
        	$param1 = $_SESSION['currentArg'];
			$sql = "SELECT E1.targArgID, E1.endorseType, E1.supportingArgID, SUM(E1.weight)/TotalUsers AS AggWeight, P1.currentPhrasing
				FROM ENDORSEMENT E1
					JOIN (SELECT targArgID, endorseType, COUNT(DISTINCT profileID) AS TotalUsers
						FROM ENDORSEMENT
						WHERE targArgID = $param1 AND active = TRUE
						GROUP BY endorseType) E2 
					ON E1.endorseType = E2.endorseType
						JOIN (SELECT argumentID, currentPhrasing
							FROM PHRASING) P1
						ON E1.supportingArgID = P1.argumentID
    			WHERE E1.targArgID = $param1
    			GROUP BY E1.endorseType, E1.supportingArgID, P1.currentPhrasing
					ORDER BY CASE WHEN E1.endorseType = 'Because' THEN '1'
						WHEN E1.endorseType = 'Therefore' THEN '2'
						WHEN E1.endorseType = 'Rebuttal' THEN '3'
						ELSE E1.endorseType END ASC, AggWeight DESC";
			$result = mysqli_query($mysqli, $sql);
            break;

        /*Gives current most popular among all users phrasing of assertion of argument + count of acceptors of argument + percent acceptors represent - only displays first row
	        Used by: argument_at_hand.php	
	    */
        case 2:

            $param1 = $_SESSION['currentArg'];
			$sql = "SELECT argumentID, currentPhrasing, 
		    	(SELECT COUNT(acceptance) FROM OPINION WHERE argumentID = $param1 AND acceptance = TRUE) AS AcceptCount,
		    	(SELECT COUNT(acceptance) FROM OPINION WHERE argumentID = $param1) AS AssertCount, 
		    	((SELECT COUNT(acceptance) FROM OPINION WHERE argumentID = $param1 AND acceptance = TRUE) /
		      		(SELECT COUNT(acceptance) FROM OPINION WHERE argumentID = $param1)) AS percentAccept
		    	FROM PHRASING
		    	WHERE argumentID = $param1";
			$result = mysqli_query($mysqli, $sql);
            break;
        case 3:
        	$param1 = $_SESSION['currentArg'];
			$sql = "SELECT COUNT(profileID) AS explicationVote,
			    hyperlink, publisher, authorFName, authorLName, title, metaPub, metaName, metaWildcard 
			    FROM EXPLICATION
			    WHERE argumentID = $param1 AND active = TRUE
			    GROUP BY hyperlink, publisher, authorFName, authorLName, title, metaPub, metaName, metaWildcard 
			    ORDER BY explicationVote DESC
			    LIMIT $limit";
			$result = mysqli_query($mysqli, $sql);
            break;

        /*Gives logged in user's opinion on the argument at hand if one exists. 
	        Used by: 
	        	argument_at_hand.php
		*/
        case 4:
        	$param1 = $_SESSION['currentArg'];
        	$param2 = $_SESSION['profile'];
			$sql = "SELECT acceptance 
		        FROM OPINION
		        WHERE argumentID = $param1
		        AND profileID = $param2";
			$result = mysqli_query($mysqli, $sql);
            break;
        case 5:
        	$param1 = $_SESSION['currentArg'];
			$sql = "SELECT currentPhrasing, putForthID
				FROM PUT_FORTH
				WHERE argumentID = $param1";
			$result = mysqli_query($mysqli, $sql);
            break;	
    }	
 ?>