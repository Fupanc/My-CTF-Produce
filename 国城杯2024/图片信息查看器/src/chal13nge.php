<?php
error_reporting(0);
include "class.php";

if (isset($_POST['image_path'])) {
    $image_path = $_POST['image_path'];
    echo "The owner ID of the file is: ";
    echo fileowner($image_path)."<br><br>";
    echo "文件信息如下：". "<br>";
    $m = getimagesize($image_path);
    if ($m) {
        echo "宽度: " . $m[0] . " 像素<br>";
        echo "高度: " . $m[1] . " 像素<br>";
        echo "类型: " . $m[2] . "<br>";
        echo "HTML 属性: " . $m[3] . "<br>";
        echo "MIME 类型: " . $m['mime'] . "<br>";
    } else {
        echo "无法获取图像信息，请确保文件为有效的图像格式。";
    }
}

$allowed_extensions = ['jpg', 'jpeg', 'gif', 'png'];
$upload_dir = __DIR__ . '/uploads/';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (in_array($file_ext, $allowed_extensions)) {
        $upload_path = $upload_dir . basename($file['name']);

        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            echo "上传成功！路径: " . 'uploads/' . basename($file['name']);
        } else {
            echo "文件上传失败，请重试。";
        }
    } else {
        echo "不支持的文件类型，仅支持: " . implode(", ", $allowed_extensions);
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>图片上传与信息获取</title>
</head>
<body>
<h2>图片上传</h2>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image" required>
    <button type="submit">上传图片</button>
</form>
<h2>获取图片信息</h2>
<form action="" method="post">
    <label for="image_path">请输入图片路径：</label>
    <input type="text" name="image_path" required>
    <button type="submit">获取图片信息</button>
</form>
</body>
<!--只需要从一个文件中获取到关键信息，这个文件在哪儿呢-->
</html>