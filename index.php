<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$database = "tutorial";
$conn = mysqli_connect($server_name, $user_name, $password, $database);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get file 
    $fileName = basename($_FILES["item_img"]["name"]);
    // Select file type
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);


    // Valid file extensions
    $allowType = array('jpg', 'jpeg', 'png', 'gif');

    // Allow certain file formats 
    if (in_array($fileType, $allowType)) {
        $image = $_FILES['item_img']['tmp_name'];
        $item_img = addslashes(file_get_contents($image));
        // Insert image
        $sql = "INSERT INTO images(name)values('$item_img')";
        if($result = mysqli_query($conn,$sql))
        {
            echo "inserted";
        }else{
            echo mysqli_error($conn);
        }
    }else{
        echo "choose a valid type";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>image</title>
</head>
<body>
    <h1>save image on database</h1>
    <form action="." method="post" enctype='multipart/form-data'>
        <input type="file" name="item_img" id="my_img">
        <input type="submit" value="Submit">
    </form>
    <?php
    $sql = "SELECT name FROM images";
    $result = mysqli_query($conn,$sql);
    while($images = mysqli_fetch_assoc($result))
    {
        $src = 'data:image/jpg;charset=utf8;base64,'.base64_encode($images['name']);
        echo "<img style='width:300px;height:300px'src='$src' alt='image'>";
    }
     ?>
    
</body>
</html>