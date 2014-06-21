<?php
function RandomDirections() {
	$cDir = array_fill(0, 4, array('X' => 0, 'Y' => 0));
	switch (rand(0,3)) {
		Case 0:
		$cDir[0]['X'] = -1;
		$cDir[1]['X'] = 1;
		$cDir[2]['Y'] = -1;
		$cDir[3]['Y'] = 1;
		break;
		Case 1:
		$cDir[3]['X'] = -1;
		$cDir[2]['X'] = 1;
		$cDir[1]['Y'] = -1;
		$cDir[0]['Y'] = 1;
		break;
		Case 2:
		$cDir[2]['X'] = -1;
		$cDir[3]['X'] = 1;
		$cDir[0]['Y'] = -1;
		$cDir[1]['Y'] = 1;
		break;
		Case 3:
		$cDir[1]['X'] = -1;
		$cDir[0]['X'] = 1;
		$cDir[3]['Y'] = -1;
		$cDir[2]['Y'] = 1;
		break;
	}
	return $cDir;
}

function GenerateMaze($MAZE_X, $MAZE_Y) {

	$cN = array('X' => NULL, 'Y' => NULL);
	$cS = array('X' => NULL, 'Y' => NULL);
	$intDir = 0;
	$intDone = 0;
	$blnBlocked = False;
	$cDir = array();
	$blnMaze = array_fill(1, $MAZE_X, array_fill(1, $MAZE_Y, False));
	
	Do {
		$cS['X'] = round(rand(1, $MAZE_X - 1) / 2) * 2;
		$cS['Y'] = round(rand(1, $MAZE_Y - 1) / 2) * 2;
		if($intDone == 0) {
			$blnMaze[$cS['X']][$cS['Y']] = True;
		}
		if($blnMaze[$cS['X']][$cS['Y']] == True) {
			Do {
				$blnBlocked = True;
				$cDir = RandomDirections();
				for($intDir = 0; $intDir <= 3; $intDir++) {
					$cN['X'] = $cS['X'] + ($cDir[$intDir]['X'] * 2);
					$cN['Y'] = $cS['Y'] + ($cDir[$intDir]['Y'] * 2);
					if($cN['X'] < $MAZE_X and $cN['X'] > 1 and $cN['Y'] < $MAZE_Y and $cN['Y'] > 1) {
						if($blnMaze[$cN['X']][$cN['Y']] == False) {
							$blnMaze[$cN['X']][$cN['Y']] = True;
							$blnMaze[$cS['X'] + $cDir[$intDir]['X']][$cS['Y'] + $cDir[$intDir]['Y']] = True;
							$cS['X'] = $cN['X'];
							$cS['Y'] = $cN['Y'];
							$blnBlocked = False;
							$intDone++;
							break;
						}
					}
				}
			} while ($blnBlocked == False);
		}
	} while ($intDone + 1 < (($MAZE_X - 1) * ($MAZE_Y - 1)) / 4);
	$blnMaze[1][2] = True;			//Start hole
	$blnMaze[$MAZE_X][$MAZE_Y - 1] = True;	//Exit hole
	echoMaze($blnMaze, $MAZE_X, $MAZE_Y);
	return $blnMaze;
}

function echoMaze($rmaze, $xmax, $ymax) {
	$output = "<pre>";
	For($y = 1; $y <= $ymax; $y++) {
		For($x = 1; $x <= $xmax; $x++) {
			If($rmaze[$x][$y] == True) {
				$output = $output . "&nbsp;";
			} Else {
				$output = $output . "#";
			}
		}
		$output = $output . "<br>";
	}
	echo $output . "</pre>";
}

GenerateMaze(47, 25);
?>
