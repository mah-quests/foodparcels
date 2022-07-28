<form method="post">
<?php
for ($i=1; $i <8 ; $i++) 
{ 
    echo'<input type="checkbox" value="'.$i.'" name="checkbox[]"/>';
} 
?>
<input type="submit" name="submit" class="form-control" value="Submit">  
</form>

<?php 
if(isset($_POST['submit']))
{
    $check=implode(", ", $_POST['checkbox']);
    print_r($check);
}     
?>