
<?php
$name ="color";
echo('
<form action="" method="POST">
    Red<input type="checkbox" name="'.$name. '[]" id="color" value="red">
    Green<input type="checkbox" name="'.$name. '[]" id="color" value="green">
    Blue<input type="checkbox" name="'.$name. '[]" id="color" value="blue">
    Cyan<input type="checkbox" name="'.$name. '[]" id="color" value="cyan">
    Magenta<input type="checkbox" name="'.$name. '[]" id="color" value="Magenta">
    Yellow<input type="checkbox" name="'.$name. '[]" id="color" value="yellow">
    Black<input type="checkbox" name="'.$name. '[]" id="color" value="black">
    <input type="submit" value="submit">
</form>');




if(isset($_POST['color'])) {
$name = $_POST['color'];

$arrayanswer ="";
foreach ($name as $color){
$arrayanswer  = $arrayanswer.",".$color;
}

echo($arrayanswer);

} 




?>