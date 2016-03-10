<?php 
define("SELECTED", 2);
session_start();
if (!empty($_POST['match'])){
	if ($_POST['match'] == $_POST['convert_to']){
		echo $_POST['match'] . " = " . $_POST['convert_to'] . "(". $_POST['actual'] .") Match successful!";
	} else if ($_POST['match'] != $_POST['convert_to']){
		echo $_POST['match'] . " != " . $_POST['convert_to'] . "(". $_POST['actual'] .") Match unsuccessful!";
	}
}
$_SESSION=$_POST;

$captions=["dec"=>"decimal", "hex"=>"hexadecimal", "bin"=>"binary"];
?>
<form method="post" action="">
Maximum Number Of Digits:
<select name='num_of_digits' style='width:35px'>
<?php
$num_of_digits = range(1,9);
foreach ($num_of_digits as $digit){
	echo "<option value='$digit'";
	if ((!isset($_POST['num_of_digits']) && $digit==SELECTED) || (isset($_POST['num_of_digits']) && $digit==$_POST['num_of_digits'])){
		echo " selected";
		
	}
	echo ">$digit</option>";
}
 ?>
 </select>

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
              : $captions['dec'];
?> 
number (<?php
$num_of_digits=	isset ($_POST['num_of_digits'])
					? $_POST['num_of_digits']
					: SELECTED;			
$max_num="";					
for ($digits=0;$digits<$num_of_digits;$digits++){
	$max_num=$max_num."9";
}
$max_num = (int) $max_num;

$rand_num=rand(1, $max_num);
    echo    isset($_SESSION['start'])
              ? convert($rand_num, $_SESSION['start'])
              : $rand_num;
?>) to a 
<?php
    echo    isset($_SESSION['convert'])
              ? $captions[$_SESSION['convert']]
              : $captions['dec'];
?> number!
</div>
<input name='match' type='text' autofocus/>
<input name='convert_to' type='hidden'  value='<?php 
	echo isset($_SESSION['convert'])
		? convert($rand_num, $_SESSION['convert'])
        : $rand_num;
    ?>' />
  
  <input name='actual' type='hidden'  value='<?php echo $rand_num;?>' />
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
