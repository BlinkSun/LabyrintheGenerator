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

function GenerateMaze() {
    $cN = array('X' => NULL, 'Y' => NULL);
    $cS = array('X' => NULL, 'Y' => NULL);
    $intDir = NULL;
    $intDone = NULL;
    $blnBlocked = 0;
    //Erase blnMaze
    Do {
        $cS['X'] = 2 + (round(rand(0, MAZE_X - 1) / 2) * 2);
        $cS['Y'] = 2 + (round(rand(0, MAZE_Y - 1) / 2) * 2);

        if($intDone = 0) {
             $blnMaze($cS['X'], $cS['Y']) = 1;
        }
        if($blnMaze($cS['X'], $cS['Y'])) {

            $cDir = RandomDirections($cDir);
            Do
                $cDir = RandomDirections($cDir);
                $blnBlocked = True;

                For intDir = 0 To 3
                    ' work out where this direction is
                    cN.X = cS.X + (cDir(intDir).X * 2)
                    cN.Y = cS.Y + (cDir(intDir).Y * 2)
                    ' check if the tile can be used
                    If IsFree(cN) Then
                        ' create a path
                        blnMaze(cN.X, cN.Y) = True
                        ' and the square inbetween
                        blnMaze(cS.X + cDir(intDir).X, cS.Y + cDir(intDir).Y) = True
                        ' this is now the current square
                        cS.X = cN.X
                        cS.Y = cN.Y
                        blnBlocked = False
                        ' increment paths created
                        intDone = intDone + 1
                        Exit For
                    End If
                Next
            ' loop until a path was created
            Loop Until blnBlocked
        }
    } while ($intDone + 1 < ((MAZE_X - 1) * (MAZE_Y - 1)) / 4);
}


$cDir = array_fill(0, 4, array('X' => NULL, 'Y' => NULL));

var_dump($cDir);
