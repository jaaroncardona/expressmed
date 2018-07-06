<html>    
    <head>
        <script>
            function validateForm(){
                var image = document.getElementById("image").value;
                var name = document.getElementById("name").value;
                if (image =='')
                {
                    return false;
                }
                if(name =='')
                {
                    return false;
                } 
                else 
                {
                    return true;
                } 
                return false;
            }
        </script>
    </head>

    <body>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="ext" size="30"/>
            <input type="text" name="name" id="name" size="30"/>
            <input type="file" accept="image/*" name="image" id="image" />
            <input type="submit" value='Save' name="submit" onclick="return validateForm()"/>
        </form>
    </body>

<?php  
if(isset($_POST['submit'])){
$name = $_POST['name'];
$ext = $_POST['ext'];
if (isset($_FILES['image']['name']))
{
    $saveto = "$name.jpgt";
    move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
    $typeok = TRUE;
    switch($_FILES['image']['type'])
    {
        case "image/gif": $src = imagecreatefromgif($saveto); break;
        case "image/jpeg": // Both regular and progressive jpegs
        case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
        case "image/png": $src = imagecreatefrompng($saveto); break;
        default: $typeok = FALSE; break;
    }
    if ($typeok)
    {
        list($w, $h) = getimagesize($saveto);
        $max = 100;
        $tw = $w;
        $th = $h;
        if ($w > $h && $max < $w)
        {
            $th = $max / $w * $h;
            $tw = $max;
        }
        elseif ($h > $w && $max < $h)
        {
            $tw = $max / $h * $w;
            $th = $max;
        }
        elseif ($max < $w)
        {
            $tw = $th = $max;
        }

        $tmp = imagecreatetruecolor($tw, $th);      
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
    
        imagejpeg($tmp, $saveto);
        imagedestroy($tmp);
        imagedestroy($src);
    }
}
}
?>

</html>