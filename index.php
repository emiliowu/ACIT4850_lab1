<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACIT 4850 -- Lab1</title>
    </head>
    <body>
		<?php
			// put your code here
			if (!isset($_GET['board'])) {
				$squares = '---------';
			} else {
				$squares = $_GET['board'];
			}
			$game = new Game($squares);
			//$game->pick_move();
			$game->display();
			if ($game->winner('x')) {
				echo 'You win. Lucky guesses!';
			} else if ($game->winner('o')) {
				echo 'I win. Muahahahaha';
			 }else {
				echo 'No winner yet, but you are losing.';
			}
		?>
    </body>
</html>

<?php
	class Game {
		var $position;

		function __construct($squares) {
			$this->position = str_split($squares);
		}

		function winner($token) {
			$won = false;
			$result = false;

			for($row=0; $row<3; $row++) {
				if (($this->position[3*$row] == $token) && ($this->position[3*$row+1]== $token) && ($this->position[3*$row+2] == $token))
					$result = true;
			}
			for($col=0; $col<3; $col++) {
				if (($this->position[$col] == $token) && ($this->position[$col+3]== $token) && ($this->position[$col+6] == $token))
					$result = true;
			}
			if (($this->position[0] == $token) && ($this->position[4]== $token) && ($this->position[8] == $token))
				$result = true;
			if (($this->position[2] == $token) && ($this->position[4]== $token) && ($this->position[6] == $token))
				$result = true;

			if ($result == true) {
				$won = true;
			}

			return $won;
		}
		
		function display() {
			echo 'Welcome to Jarvis, the evil Tic-Tac-Toe Game.';
			echo '<table style="font-size:500%; font-weight:bold;">';
			echo '<tr>'; // open the first row
			for ($pos=0; $pos<9;$pos++) {
				echo $this->show_cell($pos);
				if ($pos %3 == 2) echo '</tr><tr>'; // start a new row for the next square
			}
			echo '</tr>'; // close the last row
			echo '</table>';
		}
		
		function show_cell($which) {
			$token = $this->position[$which];
			$new = $this->position;
			// deal with the easy case
			if ($token <> '­-') {
				// now the hard case
				//$this­->newposition = $this­->position; // copy the original
				//$this­->newposition[$which] = 'x'; // this would be their move
				//$move = implode($this­->newposition); // make a string from the board array
				$url = $_SERVER['PHP_SELF'];
				$new[$which] = 'x';
				$query = implode($this->pick_move($new));
				$link = $url . '?board=' . $query; // this is what we want the link to be
				// so return a cell containing an anchor and showing a hyphen
				return '<td><a href="'.$link.'">'.$token.'</a></td>';
				//return '<td>'.$token.'</td>';
			}
		}
		
		function pick_move($new) {
			$num = rand(0,8);
			if (($new[$num] == '-') || ($new[$num] != 'x')) {
				$new[$num] = 'o';
			} else {
				$this->pick_move($new);
			}
			return $new;
		}
	}
?>
