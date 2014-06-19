Const MAZE_X = 15;
Const MAZE_Y = 15;

$cDir = array_fill(0, 4, array('X' => NULL, 'Y' => NULL));
$blnMaze = array_fill(0, MAZE_X, array_fill(0, MAZE_Y, NULL));

function RandomDirections($cDir) {
	
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

function IsFree($cF) {
    if($cF['X'] < MAZE_X and $cF['X'] > 1 and $cF['Y'] < MAZE_Y and $cF['Y'] > 1) {
        return $blnMaze[$cF['X']][$cF['Y']] = 0;
    }
}

$cDir = array_fill(0, 4, array('X' => NULL, 'Y' => NULL));
$cDir = RandomDirections($cDir);
var_dump($cDir);
