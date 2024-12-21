<?php
class backdoor{
    public $cmd;
    function __destruct(){
        $cmd = $this->cmd;
        system($cmd);
    }
}
class B{
    public $name;
    function __construct($name){
        $this->name = $name;
    }
    function greet(){
        echo "<h3>hello " . $this->name."</h3><br>";
    }
    function __destruct(){
        echo "<a href='chal13nge.php' class='link-button'>欢迎来到挑战，点击挑战</a><br>";
        echo "<!--There's something in the hI3t.php-->";
    }
}
?>