<!DOCTYPE html>
<html lang="en">
<head>
    <title>Test</title>
</head>
<body>
    <?php
        class GameObject{
            public $name;
            public $maxhp;
            public $hp;
            public $ap;

            public function __construct($name, $maxhp, $ap){
                $this->name = $name;
                $this->maxhp = $maxhp;
                $this->hp = $maxhp;
                $this->ap = $ap;
            }

            public function attack($target){
                echo $this->name . " attack " . $target->name . "<br>";
                echo $target->name . " get " . $this->ap . " damage<br>";
                $target->hp = $target->hp - $this->ap;
                echo $target->name . " has " . $target->hp . " hp left<br>";
            }

            public function getstats(){
                echo $this->name . " has " . $this->hp . " hp and " . $this->ap . " ap<br>";
            }
        }
        
        $player1 = new GameObject("John", 100, 10);
        $player2 = new GameObject("Cena", 100, 20);
        $player1->attack($player2);

        class Player extends GameObject{
            public function heal($amount){
                echo $this->name . " heal " . $amount . " hp<br>";
                $this->hp = $this->hp + $amount;
                if($this->hp > $this->maxhp){
                    $this->hp = $this->maxhp;
                }
                echo $this->name . " has " . $this->hp . " hp left<br>";
            }
        }
        class Enemy extends GameObject{
            public function isdeath(){
                if($this->hp <= 0){
                    $this->hp = 0;
                    echo $this->name . " is dead<br>";
                }
            }
        }

        $player = new Player("James", 100, 15);
        $enemy = new Enemy("Cameron", 10, 5);
        $player->getstats();
        $enemy->getstats();
        $enemy->attack($player);
        $player->heal(10);
        $player->attack($enemy);
        $enemy->isdeath();
    ?>
</body>
</html>