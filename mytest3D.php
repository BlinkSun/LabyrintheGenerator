<?PHP
function RandomDirections() {
	$cDir = array_fill(0, 6, array('X' => 0, 'Y' => 0, 'Z' => 0));
	switch (rand(0,5)) {
		Case 0:
		$cDir[0]['X'] = -1;
		$cDir[1]['X'] = 1;
		$cDir[2]['Y'] = -1;
		$cDir[3]['Y'] = 1;
		$cDir[4]['Z'] = -1;
		$cDir[5]['Z'] = 1;
		break;
		Case 1:
		$cDir[5]['X'] = -1;
		$cDir[4]['X'] = 1;
		$cDir[3]['Y'] = -1;
		$cDir[2]['Y'] = 1;
		$cDir[1]['Z'] = -1;
		$cDir[0]['Z'] = 1;
		break;
		Case 2:
		$cDir[2]['X'] = -1;
		$cDir[3]['X'] = 1;
		$cDir[4]['Y'] = -1;
		$cDir[5]['Y'] = 1;
		$cDir[0]['Z'] = -1;
		$cDir[1]['Z'] = 1;
		break;
		Case 3:
		$cDir[1]['X'] = -1;
		$cDir[0]['X'] = 1;
		$cDir[5]['Y'] = -1;
		$cDir[4]['Y'] = 1;
		$cDir[3]['Z'] = -1;
		$cDir[2]['Z'] = 1;
		break; 
		Case 4:
		$cDir[4]['X'] = -1;
		$cDir[5]['X'] = 1;
		$cDir[0]['Y'] = -1;
		$cDir[1]['Y'] = 1;
		$cDir[2]['Z'] = -1;
		$cDir[3]['Z'] = 1;
		break;
		Case 5:
		$cDir[3]['X'] = -1;
		$cDir[2]['X'] = 1;
		$cDir[1]['Y'] = -1;
		$cDir[0]['Y'] = 1;
		$cDir[5]['Z'] = -1;
		$cDir[4]['Z'] = 1;
		break;
	}
	return $cDir;
}


function GenerateMaze($MAZE_X, $MAZE_Y, $MAZE_Z) {


	$cN = array('X' => NULL, 'Y' => NULL, 'Z' => NULL);
	$cS = array('X' => NULL, 'Y' => NULL, 'Z' => NULL);
	$intDir = 0;
	$intDone = 0;
	$blnBlocked = False;
	$cDir = array();
	$blnMaze = array_fill(1, $MAZE_X, array_fill(1, $MAZE_Y, array_fill(1, $MAZE_Z, False)));

	
/*for($x = 1; $x <= $MAZE_X; $x++)
{
    for($y = 1; $y <= $MAZE_Y; $y++)
    {
        for($z = 1; $z <= $MAZE_Z; $z++)
        {
            $blnMaze[$x][$y][$z] = False;
        }
    }
}*/
	
	
	//echo "Let start it !<br>";

	Do {
		//echo "Loop #" . $intDone . "<br>";
		
		$cS['X'] = round(rand(1, $MAZE_X - 1) / 2) * 2;
		$cS['Y'] = round(rand(1, $MAZE_Y - 1) / 2) * 2;
		$cS['Z'] = round(rand(1, $MAZE_Z - 1) / 2) * 2;
		
		//echo "checking blnMaze(" . $cS['X'] . "," . $cS['Y'] . "," . $cS['Z'] . ")...(".$blnMaze[$cS['X']][$cS['Y']][$cS['Z']].")<br>";
		
		if($intDone == 0) {
		
			$cS['X'] = 2;
			$cS['Y'] = 2;
			$cS['Z'] = 2;
			$blnMaze[$cS['X']][$cS['Y']][$cS['Z']] = True;
			
		}
		if($blnMaze[$cS['X']][$cS['Y']][$cS['Z']] == True) {
			Do {
				$blnBlocked = True;
				$cDir = RandomDirections();
				for($intDir = 0; $intDir <= 5; $intDir++) {
					$cN['X'] = $cS['X'] + ($cDir[$intDir]['X'] * 2);
					$cN['Y'] = $cS['Y'] + ($cDir[$intDir]['Y'] * 2);
					$cN['Z'] = $cS['Z'] + ($cDir[$intDir]['Z'] * 2);
					if($cN['X'] < $MAZE_X and $cN['X'] > 1 and $cN['Y'] < $MAZE_Y and $cN['Y'] > 1 and $cN['Z'] < $MAZE_Z and $cN['Z'] > 1) {
						//echo "blnMaze(" . $cN['X'] . "," . $cN['Y'] . "," . $cN['Z'] . ") = ".$blnMaze[$cN['X']][$cN['Y']][$cN['Z']]."<br>";
						if($blnMaze[$cN['X']][$cN['Y']][$cN['Z']] == False) {
						
							//echo "blnMaze(" . $cN['X'] . "," . $cN['Y'] . "," . $cN['Z'] . ") = True<br>";
						
							$blnMaze[$cS['X']][$cS['Y']][$cS['Z']] = True;
							$blnMaze[$cS['X'] + $cDir[$intDir]['X']][$cS['Y'] + $cDir[$intDir]['Y']][$cS['Z'] + $cDir[$intDir]['Z']] = True;
							$cS['X'] = $cN['X'];
							$cS['Y'] = $cN['Y'];
							$cS['Z'] = $cN['Z'];
							$blnBlocked = False;
							$intDone++;
							break;
						}
					}
				}
			} while ($blnBlocked == False);
		}
	} while ($intDone + 1 < (($MAZE_X - 1) * ($MAZE_Y - 1) * ($MAZE_Z - 1)) / 8);

	//$blnMaze[1][2] = True;					//Start hole
	//$blnMaze[$MAZE_X][$MAZE_Z - 1] = True;	//Exit hole

	//echo "<br>".($intDone + 1). " / " . (($MAZE_X - 1) * ($MAZE_Y - 1) * ($MAZE_Z - 1)) / 8 . "<br><br>";
	
echoMaze($MAZE_X,$MAZE_Y,$MAZE_Z,$blnMaze);
}
function echoMaze($MAZE_X,$MAZE_Y,$MAZE_Z,$blnMaze) {

	For($y = 1; $y <= $MAZE_Y; $y++) {
		$output = "Level ".$y.":<br><pre>";
		For($z = 1; $z <= $MAZE_Z; $z++) {
			For($x = 1; $x <= $MAZE_X; $x++) {
				If($blnMaze[$x][$y][$z] == True) {
				
					if($blnMaze[$x][$y + 1][$z] == True or $blnMaze[$x][$y - 1][$z] == True) {
						$output = $output . "S";
					} else {
						$output = $output . "&nbsp;";
					}
					
				} Else {
					$output = $output . "#";
				}
			}
			$output = $output . "<br>";
		}
		echo $output . "</pre><br>";
	}

}
GenerateMaze(25, 7, 15);
?>
