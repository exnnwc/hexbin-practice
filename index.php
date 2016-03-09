<?php 
session_start();
if (empty($_POST['match'])):
?>
    YO
<?php endif; ?>

<?php
    $_SESSION=$_POST;
var_dump($_POST);
$captions=["dec"=>"decimal", "hex"=>"hexadecimal", "bin"=>"binary"];

 ?>
<form method="post" action="">
<h3 style='margin-bottom:0px;'>Start with:</h3>
<div>

Decimal <input name='start' type='radio' value='dec' 
<?php if (!isset($_SESSION['start']) || (isset($_SESSION['start']) && $_SESSION['start']=='dec')):?>
   checked 
<?php endif; ?>
/>
Hexadecimal <input name='start' type='radio' value='hex' 
    <?php if(isset($_SESSION['start']) && $_SESSION['start']=='hex'):?>
        checked
    <?php endif; ?>
/>
Binary <input name='start' type='radio' value='bin'
    <?php if(isset($_SESSION['start']) && $_SESSION['start']=='bin'):?>
        checked
    <?php endif; ?>
/>
</div>
<h3 style='margin-bottom:0px;'>Convert to:</h3>
<div>

Decimal <input name='convert' type='radio' value='dec' 

<?php if (!isset($_SESSION['convert']) || (isset($_SESSION['convert']) && $_SESSION['convert']=='dec')):?>
   checked 
<?php endif; ?>
/>
Hexadecimal <input name='convert' type='radio' value='hex'

    <?php if(isset($_SESSION['convert']) && $_SESSION['convert']=='hex'):?>
        checked
    <?php endif; ?>

/>
Binary <input name='convert' type='radio' value='bin'

    <?php if(isset($_SESSION['convert']) && $_SESSION['convert']=='bin'):?>
        checked
    <?php endif; ?>
/>
<div>
Convert 
<?php
    echo    isset($_SESSION['start'])
              ? $captions[$_SESSION['start']]
              : $captions[0];
?> 
number (<?php
$rand_num=rand(1,100000);
    echo    isset($_SESSION['start'])
              ? convert($rand_num, $_SESSION['start'])
              : $rand_num;
?>) to a 
<?php
    echo    isset($_SESSION['convert'])
              ? $captions[$_SESSION['convert']]
              : $captions[0];
?> number!
</div>
<input name='match' type='text' />
<input name='convert_to' type='hidden'  value='
    <?php echo isset($_SESSION['convert'])
                ? convert($rand_num, $_SESSION['convert'])
                : $rand_num;
    ?>
  ' />
<input type='submit' value='Match' />
</form>
</div>
<?php

function convert($num, $type){
    if ($type=='dec'){
        return $num;
    } else if ($type=='bin'){
        return decbin($num);
    } else if ($type=='hex'){
        return dechex($num);
    } 
}
