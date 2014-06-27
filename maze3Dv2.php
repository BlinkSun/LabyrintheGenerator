<?php

$maze_N = 1;
$maze_S = 2;
$maze_E = 4;
$maze_W = 8;
$maze_U = 16;
$maze_D = 32;
$maze_list = array(1, 2, 4, 8, 16, 32);
$maze_dx = array(1 => 0, 2 => 0, 4 => 1, 8 => -1, 16 => 0, 32 => 0);
$maze_dy = array(1 => -1, 2 => 1, 4 => 0, 8 => 0, 16 => 0, 32 => 0);
$maze_dz = array(1 => 0, 2 => 0, 4 => 0, 8 => 0, 16 => 1, 32 => -1);
$maze_opposite = array(1 => 2, 2 => 1, 4 => 8, 8 => 4, 16 => 32, 32 => 16);
$maze_grid = array();

function MazeGenerator($width, $height, $depth) {
	global $maze_dx, $maze_dy, $maze_dz, $maze_opposite, $maze_grid;
	//var carved, cell, cells, dir, index, nx, ny, nz, x, y, z, _i, _len, _ref;
	$maze_cells = array('x' => rand(0, $width - 1), 'y' => rand(0, $height - 1), 'z' => rand(0, $depth - 1));
        $maze_grid = array_fill(0, $depth, array_fill(0, $width, array_fill(0, $height, 0)));

	while(count($maze_cells) > 0) {
		$index = rand(0, 1) === 0 ? rand(0, count($maze_cells) - 1) : count($maze_cells) - 1;
		$maze_cell = $maze_cells[$index];
		$carved = false;
		$_ref = randomDirections();
		for($_i = 0, $_len = count($_ref); $_i < $_len; $_i++) {
			$dir = $_ref[$_i];
			$nx = $maze_cell['x'] + $maze_dx[$dir];
			$ny = $maze_cell['y'] + $maze_dy[$dir];
			$nz = $maze_cell['z'] + $maze_dz[$dir];

			if($nx >= 0 and $ny >= 0 and $nz >= 0 and $nx < $width and $ny < $height and $nz < $depth and $maze_grid[$nz][$ny][$nx] === 0) {
				$maze_grid[$maze_cell['z']][$maze_cell['y']][$maze_cell['x']] |= $dir;
				$maze_grid[$nz][$ny][$nx] |= $maze_opposite[$dir];
				array_push($maze_cells, array('x' => $nx, 'y' => $ny, 'z' => $nz));
				$carved = true;
				break;
			}
		}
		if(!$carved) {
			array_splice($maze_cells, $index, 1);
		}
	}
	$maze_grid[0][0][0] |= 8;
	$maze_grid[$depth - 1][$height - 1][$width - 1] |= 4;
	
	//return $maze_grid;
	EchoMaze($maze_grid, $width, $height, $depth);
}

function RandomDirections() {
	global $maze_list;
	//var i, j, list, _ref;
	$list = array_slice($maze_list, 0);
	$i = count($list) - 1;
	while ($i > 0) {
		$j = rand(0, $i);
		$_ref = array($list[$j], $list[$i]);
		$list[$i] = $_ref[0];
		$list[$j] = $_ref[1];
		$i--;
	}
	return $list;
}

function isNorth($x, $y, $z) {
    global $maze_grid, $maze_N;
    return $maze_grid[$z][$y][$x] === $maze_N;
}
function isSouth($x, $y, $z) {
    global $maze_grid, $maze_S;
    return $maze_grid[$z][$y][$x] === $maze_S;
}
function isEast($x, $y, $z) {
    global $maze_grid, $maze_E;
    return $maze_grid[$z][$y][$x] === $maze_E;
}
function isWest($x, $y, $z) {
    global $maze_grid, $maze_W;
    return $maze_grid[$z][$y][$x] === $maze_W;
}
function isUp($x, $y, $z) {
    global $maze_grid, $maze_U;
    return $maze_grid[$z][$y][$x] === $maze_U;
}
function isDown($x, $y, $z) {
    global $maze_grid, $maze_D;
    return $maze_grid[$z][$y][$x] === $maze_D;
}

function EchoMaze($maze, $width, $height, $depth) {
    //var cell, className, eastClass, html, row1, row2, southClass, x, y, z, _ref, _ref2, _ref3, _ref4;
    $html = "";
    for($z = 0, $_ref = $depth; 0 <= $_ref ? $z < $_ref : $z > $_ref; 0 <= $_ref ? $z++ : $z--) {
      $html .= "<div class='blockMaze' id='level_" . $z . "'";
      if($z > 0) {
        //$html .= " style='display: none;'";
      }
      $html .= ">\n<div class='nav'>";
      $html .= "Level " . ($z + 1) . ": ";
      if($z > 0) {
        $html .= "<a href='#' onclick='showLevel(" . ($z - 1) . "); hideLevel(" . $z . ");'>down</a>";
      }
      if((0 < $z and $z < $depth - 1)) {
        $html .= " | ";
      }
      if($z < $depth - 1) {
        $html .= "<a href='#' onclick='showLevel(" . ($z + 1) . "); hideLevel(" . $z . ");'>up</a>";
      }
      $html .= "</div>\n<div class='r'>";
      for($x = 0, $_ref2 = $width * 2 + 1; 0 <= $_ref2 ? $x < $_ref2 : $x > $_ref2; 0 <= $_ref2 ? $x++ : $x--) {
        $html .= "<div class='w'></div>";
      }
      $html .= "</div>\n";
      for($y = 0, $_ref3 = $height; 0 <= $_ref3 ? $y < $_ref3 : $y > $_ref3; 0 <= $_ref3 ? $y++ : $y--) {
        $className = isWest(0, $y, $z) ? "b" : "w";
        $row1 = "<div class='r'><div class='" . $className . "'></div>";
        $row2 = "<div class='r'><div class='w'></div>";
        for($x = 0, $_ref4 = $width; 0 <= $_ref4 ? $x < $_ref4 : $x > $_ref4; 0 <= $_ref4 ? $x++ : $x--) {
          $eastClass = isEast($x, $y, $z) ? "b" : "w";
          $southClass = isSouth($x, $y, $z) ? "b" : "w";
          $cell = "<div class='b'>";
          $cell .= "<div class='" . (isUp($x, $y, $z) ? 'u' : 'h') . "'></div>";
          $cell .= "<div class='" . (isDown($x, $y, $z) ? 'd' : 'h') . "'></div>";
          $cell .= "</div>";
          $row1 .= "" . $cell . "<div class='" . $eastClass . "'></div>";
          $row2 .= "<div class='" . $southClass . "'></div><div class='w'></div>";
        }
        $html .= $row1 . "</div>\n" . $row2 . "</div>\n";
      }
      $html .= "\n</div>\n";
    }
    echo $html;
 }

MazeGenerator(10, 10, 4);

?>
