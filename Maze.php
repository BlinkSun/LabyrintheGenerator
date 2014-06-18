<?php
/*
__PocketMine Plugin__
name=Maze
description=Maze Generator
version=0.1
author=BlinkSun
class=Maze
apiversion=11,12
*/


class Maze implements Plugin {
	private $api;
	private $RANDOMISATION;
	private $MAZE_X;
	private $MAZE_Y;

  class COORDS { 
      var $X; 
      var $Y; 
  }

	public function __construct(ServerAPI $api, $server = false) {
		$this->api = $api;
		$this->RANDOMISATION = 0;
		$this->MAZE_X = 25;
		$this->MAZE_Y = 25;
	}


	public function init() {
		$this->config = new Config($this->api->plugin->configPath($this)."config.yml", CONFIG_YAML, array("wallblock"=>"18","wallheight"=>"3"));
		$this->api->console->register('maze', "[X] [Y] Generate a maze of (x,y).",array($this, 'commandHandle'));
		$this->api->console->alias("mz", "maze");
	}


	public function commandHandle($cmd, $params, $issuer, $alias){
		switch($cmd){
			case 'maze':
				if(isset($params[0])) {
					$output = $this->GenMaze();
				}else{
					$output = "Usage: /$cmd [X] [Y]\n";
				}
			break;
		}
		return $output;
	}

	public function GenMaze() {
	  return "Done!";
	}

	public function __destruct() {
	}
}
