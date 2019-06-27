<?php

//_____________________________________________________
class Scene
{
    public $perform;
    public $viewers;

    function __construct($viewers, $perform)
    {
        $this->viewers = $viewers;
        $this->perform = $perform;
        echo 'Итак, вас собралось ' . $this->viewers 
        . ' разумных. Разумных ли? Вы готовы это увидеть?... вот это вот? Что ж... да начнется ' . $this->perform;
        $a = new Perform ();     
    }
}

//___________________________________________________
class Viewers
{
    function __construct ($talant)
    {
        if ($talant<=2){
            echo '<hr>В кукловода полетели какашки и какахи...';
        }
        if ($talant>2 && $talant <=5){
            echo '<hr>В зале жидкие хлопки...';
        }
        if($talant>5 && $talant <9){
            echo '<hr>Сочные овации от публики...';
        }
        if($talant>=9){
            echo '<hr>Публика рукоплещет, а местами даже рукоплескает (.)(.)';
        }
    }
}

//__________________________________________________
class Perform
{
    public $puppeteers;

    function __construct ()
    {
        $name = ['Данияр' , 'Алексей' , 'Биржан' , 'Бекет' , 'Толганай'];
        $type = ['Лисица','Волчара','Заяц','Панда','Ленивец'];
        $text = ['хитрая лисица','вою на луну','белый и пушистый','ем пельмени!','ку ка ре ку'];
        $color = ['red','blue','green','yellow','purple'];
        $gender =['девочка','мальчик'];

        $dolls = [];
        for ($i=0; $i<4; $i++){
            $dolls[]= new Doll(
            $name[rand(0,4)],
            $type[rand(0,4)],
            $gender[rand(0,1)],
            $color[rand(0,4)],
            $text[rand(0,4)]
            );
        }
        $a = new Puppeteer('Крокодил Гена', [$dolls[0],$dolls[1]], rand(0,10));
        $b = new Viewers($a->talant);
        $c = new Puppeteer('Чебурашка', [$dolls[2], $dolls[3]], rand(0,10));
        $d = new Viewers ($c->talant);        
    }
}

//________________________________________________
class Puppeteer
{
    public $name;
    public $dolls = [];
    public $gender = [];
    public $age;
    public $talant;


    
    public function __construct($name,$dolls,$talant)
    {
        $this->name=$name;
        $this->dolls=$dolls;
        $this->talant=$talant;
        $this->perform();
        
    }
    public function perform()
    {
        echo '<hr>Выступает <strong>' . $this->name . '</strong>' 
        . '... По секрету говоря, таланта у него на ' . $this->talant . '<hr>';
        
        foreach($this->dolls as $doll){
        $doll->perform();
        }
    }
}

class Doll
{
    public $name;
    public $type;
    public $gender;
    public $color;
    public $text;

    public function __construct ($name, $type, $gender, $color, $text)
    {
        $this->name=$name;
        $this->type=$type;
        $this->gender=$gender;
        $this->color=$color;
        $this->text=$text;
    }

    public function perform ()
    {
        echo 'Привет, меня зовут ' . $this->name . ' и я - <span style="color:' . $this->color . '">' 
        . $this->gender . ' ' . $this->type . '</span><br>' . $this->text . '<br>';  
    }
}

$a = new Scene (300, 'Вакханалия');
