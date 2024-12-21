<?php
highlight_file(__FILE__);
//以下是class.php文件内容：
class backdoor
{
    public $cmd;

    function __destruct()
    {
        $cmd = $this->cmd;
        system($cmd);
    }
}

class B
{
    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    function greet()
    {
        echo "<h3>hello " . $this->name . "</h3><br>";
    }

    function __destruct()
    {
        echo "<a href='chal13nge.php' class='link-button'>欢迎来到挑战，点击挑战</a><br>";
        echo "<!--There's something in the hI3t.php-->";
    }
}
//主要文件内容部分源码：
//
//<?php
//error_reporting(0);
//include "class.php";
//
//if (isset($_POST['image_path'])) {
//    $image_path = $_POST['image_path'];
//    echo "The owner ID of the file is: ";
//    echo fileowner($image_path) . "<br><br>";
//    echo "文件信息如下：" . "<br>";
//    $m = getimagesize($image_path);
//    if ($m) {
//        echo "宽度: " . $m[0] . " 像素<br>";
//        echo "高度: " . $m[1] . " 像素<br>";
//        echo "类型: " . $m[2] . "<br>";
//        echo "HTML 属性: " . $m[3] . "<br>";
//        echo "MIME 类型: " . $m['mime'] . "<br>";
//    } else {
//        echo "无法获取图像信息，请确保文件为有效的图像格式。";
//    }
//}