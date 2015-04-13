<?php
//Decorator
class Person {
    public $name;
    public $age;
    function __construct($name_in, $age_in) {
        $this->name = $name_in;
        $this->age  = $age_in;
    }
    function getAge() {
        return $this->age;
    }
    function getName() {
        return $this->name;
    }
    function getNamerAndAge() {
      return $this->getName().' is '.$this->getAge().' years old';
    }
}
class PeopleNameDecorator{
    protected $person;
    protected $name;
   
    //doing this so original object is not altered
    public static function changeName($name_in, Person $person_in) {
        $person_in->name = $name_in;
    }
    
}

    $p = new Person("Luis",10);
    echo $p->getNamerAndAge();
    echo "<br>after changing luis name using a decorator<br>";
    PeopleNameDecorator::changeName("roberto", $p);
     echo $p->getNamerAndAge();

//end of decorator
//Singleton

class singletonOb{
static $value = null;
      public static function getInstance()
    {
        
        if (null === self::$value) {
            self::$value = 3;
        }

        return self::$value;
    }
    public static function decrease(){
       self::$value -= 1;
    }
}


echo "<br>singleton testing<br>";
echo "initial value : ". singletonOb::getInstance();
singletonOb::decrease();
echo "<br>End value  : ". singletonOb::getInstance();
//end of the singleton example

class PersonFactory{

    public static function create($name_in, $age_in){
        $ob = new Person($name_in, $age_in);
        return $ob;
    }


}

class PersonList{

    private $personL = array();
    private $count = 0;
     public function addPerson(Person $a){
       
        $this->personL[$this->count] = $a;
        $this->count++;
        
     }
     public function getArray(){
        return $this->personL;
     }
     public function getCount(){

        return $this->count;
     }





}

class PersonIterator{
    protected $personList;
    protected $current=0;

    public function __construct(PersonList $l){
        $this-> personList = $l;

    }
    public function getCurrentPerson(){
        $list = $this->personList->getArray();
        return $list[$this->current];
    }
    public function getNext(){

        $this->current++;
    }

    public function hasNext(){
        if($this->current == $this->personList->getCount()){
            return false;
        }
        return true;
    }
}

class  Dog{
    protected $name;
    public function __construct($a){
        $this->name = $a;
    }
    public function printer(){
        echo "the dog name is " .$this->name;
    }

    public function __destruct(){
        echo "destroying the object dog";
    }

}

echo "<br> Using factory to create a person";
$person1 = PersonFactory::create("jorge", 20);
echo "<br>".$person1->getNamerAndAge();

echo "<br>Creating a list of People<br>";

$person2 = PersonFactory::create("luis", 14);
$person3 = PersonFactory::create("pedro", 12);
$person4 = PersonFactory::create("meg", 22);

$list = new PersonList();
$list->addPerson($person1);
$list->addPerson($person2);
$list->addPerson($person3);
$list->addPerson($person4);

$iterator = new PersonIterator($list);
echo "Printin out the list of people created";

while($iterator->hasNext()){
    echo "<br>".$iterator->getCurrentPerson()->getNamerAndAge();
   
   $iterator->getNext();
}
echo "<br>cosntructor and destructor example<br>";

$animal = new Dog("bobby");
$animal->printer();
echo "<br>";
$animal = null;



?>