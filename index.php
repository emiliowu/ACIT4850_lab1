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
			$squares = $_GET['board'];
			$game = new Game($squares);
			if ($game­->winner('x'))
				echo 'You win. Lucky guesses!';
			else if ($game­->winner('o'))
				echo 'I win. Muahahahaha';
			else
				echo 'No winner yet, but you are losing.';
		?>
    </body>
</html>

<?php
	class Game {
		var $position = '---------';
		
		function __construct($squares) {
			$this­->position = str_split($squares);
		}
		
		function winner($token) {
			$won = false;
			$result = false;
			
			for($row=0; $row<3; $row++) {
				if (($this->$position[3*$row] == $token) && 
					($this->$position[3*$row+1]== $token) && 
					($this->$position[3*$row+2] == $token))
						$result = true;
			}
			for($col=0; $col<3; $col++) {
				if (($this->$position[3*$col] == $token) && 
					($this->$position[3*$col+1]== $token) && 
					($this->$position[3*$col+2] == $token))
						$result = true;
			}
			if (($this->$position[0] == $token) && 
				($this->$position[4]== $token) && 
				($this->$position[8] == $token))
					$result = true;
			if (($this->$position[2] == $token) && 
				($this->$position[4]== $token) && 
				($this->$position[6] == $token))
					$result = true;
			
			if ($result == true)
				$won = true;
				
			return $won;
		}
	}
?>