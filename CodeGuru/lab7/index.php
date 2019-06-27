<?php

class Player
{
    public $name = '';
    public $heroes=[];

    public function __construct($name, $heroes)
    {
        $this->name = $name;
        $this->heroes = $heroes;
    }
    public function step ($player)
    {
        $heroes=$this->getLiveHeroes();
        if(count($heroes)==0){
            return $player;
        }
        echo 'Ход игрока: ' . $this->name . '<br>';
        foreach($heroes as $hero){
            $enemyHeroes=$player->getLiveHeroes();

            if (count($enemyHeroes)==0){
                return $this;
            }

            foreach ($enemyHeroes as $enemyHero){
                $hero->attack($enemyHero);
            }
        }
        echo '<hr>';
        return null;
    }
    public function getLiveHeroes()
    {
        $return=[];
        foreach ($this->heroes as $hero){
            if($hero->hp > 0){
                $return[]=$hero;
            }
        }
        return $return;
    }
}

class Hero
{
    public $name='';
    public $hp=0;
    public $damage=0;

    public function __construct($name, $hp, $damage)
    {
        $this->name=$name;
        $this->hp=$hp;
        $this->damage=$damage;
    }
    public function attack($hero)
    {
        echo 'Герой' . $this->getStats($this) . 'атакует героя' . $this->getStats($hero) . '<br>';
        $hero->fixDamage($this->damage);

    }

    public function fixDamage($damage)
    {
        $currentHP=$this->hp;
        $this->hp-=rand(0,$damage);
        if ($currentHP<0){
            echo '<span style= "color:red">Ооо, нееет' . $this->name . 'умер!!! </span><br>';
        }
    }

    public function getStats($hero)
    {
        return $hero->name . '(' . $hero->hp . ',' . $hero->damage . ')';
    }

}

$heroNames1=['Thanos','Galaktus','Dormamu','Altron','Gitler'];
$heroNames2=['Thor','Halk','IronMan','DrStrange','Bakhtiyar'];

$heroes1=$heroes2=[];

for($i=0;$i<5;$i++){
    $heroes1[]= new Hero ($heroNames1[$i], rand(1000,2500), rand(20,170));
    $heroes2[]= new Hero ($heroNames2[$i], rand(1000,2500), rand(20,170));
    
}

$kazyna = new Player ('Kazyna',$heroes1);
$birzhan = new Player ('Birzhan', $heroes2);

for($i=0; $i<1;$i+=0){
    echo 'Раунд <hr>';

    $winner=$birzhan->step($kazyna);
    
    if ($winner != null){
        echo 'Winner' . $winner->name . '<hr>';
        break;
    }
    
    if ($winner == null){
        $winner=$kazyna->step($birzhan);
    }
}


