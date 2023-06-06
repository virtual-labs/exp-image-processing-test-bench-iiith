<?php
session_start();
$exp=$_GET["exp"];
 
include './'.$exp.'/quiz.php';

$starttime = (!isset($_POST['starttime']) ? time() : $_POST['starttime']);
$answers = (!isset($_POST['answers']) ? "0 0 0" : $_POST['answers']);
$answer = (isset($_POST['quiz']) ? $_POST['quiz']: 0);
$ques_no= (!isset($_POST['qnumber']) ? 0 : $_POST['qnumber']);
 

if($ques_no>0) {
 $answers_k = explode(" ",$answers);
 $answers_k[$ques_no-1]=$answer;
 $answers=implode(" ",$answers_k);
}

$curr_time=time()-$starttime;
?>

<head>
<script class='gtm'>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-W59SWTR');</script>

<title> Quiz - Virtual Lab in Image Processing</title>
<!-- The Primary External CSS style sheet. -->
<link rel="stylesheet" type="text/css" href="./css/psd2css.css" media="screen" />

<!-- We use the jquery javascript library for DOM manipulation and
some javascript tricks.  We serve the script from Google because it's
faster than most ISPs.  Get more information and documentation
at http://jquery.com 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> -->
<script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>

<!-- All the javascript generated for your design is in this file -->
<script type="text/javascript" src="./js/psd2css.js"></script>

<!--http://www.cssmenumaker.com/builder/menu_info.php?menu=057-->
<link type="text/css" rel="StyleSheet" href="./menu/menu_style.css" />


</head>


<body>

  <!-- This is 'Backgound_bkgnd_center_jpg' -->
  <div id="Layer-1" class="Backgound_bkgnd_center_jpg"  >
    

    <!-- This is 'TopBar_jpg' -->
    <div id="Layer-3" class="TopBar_jpg"  >
      <img src="./images/Layer-3.jpg" width="894" height="96" alt="TopBar" />
      <!-- This is 'IIIT' -->
      <div id="Layer-6" class="IIIT"  >
        <img src="./images/iiit.png" width="100" height="70" alt="IIIT" class="pngimg" />
	</div>
	
			<div id="topMenu">
			<h1>VIRTUAL LAB in IMAGE PROCESSING</h1>
<div class="home">
<a href="index.html">home</a>
</div>

			<div class="menu">
<ul>
<li><a href="objective.php?exp=<?php echo $exp; ?>" target="_self" >Objective</a>
</li>
<li><a href="intro.php?exp=<?php echo $exp; ?>" target="_self" >Introduction</a>
</li>
<li><a href="theory.php?exp=<?php echo $exp; ?>" target="_self" >Theory</a>
</li>
<li><a href="procedure.php?exp=<?php echo $exp; ?>" target="_self" >Procedure</a>
</li>
<li><a href="<?php echo $exp; ?>.php" target="_self" >Experiment</a>
</li>
<li><sel><a href="#" target="_self" >Assessment</a></sel>
				<ul>
					<li><a href="quiz.php?exp=<?php echo $exp; ?>">Quiz</a></li>
					<li><a href="assign.php?exp=<?php echo $exp; ?>">Assignment</a></li>
			   </ul>

</li>
<li><a href="./references.php?exp=<?php echo $exp; ?>" target="_self" >References</a>
</li>
</ul>
</div>
</div>
<div class="experiment front" style="text-indent: 20px; background-color: #DDDDDD;" >


<?php 

if($_POST["mode"]!="results") {

if($ques_no+1<=$no_ques) {
echo '

<form name="quizform" action="quiz.php?exp='.$exp.'" method="post">
<input type="hidden" name="starttime" value="'.$starttime.'">
<input type="hidden" name="answers" value="'.$answers.'">
<input type="hidden" name="qnumber" value="'.($ques_no+1).'">

<table width="100%" border="0" cellspacing="0" cellpadding="1" style="color:black;">
<tr>
<th align="left">&nbsp;'.$exp_name.' QUIZ</th>
<th  align="right">&nbsp;</th>
</tr>
<tr>
<td  colspan="2"><br />
<table style="color:black;">
<tr><td valign="top"><b>&nbsp;'.($ques_no+1).'. </td>
<td valign="top"><b>'.$questions[$ques_no+1].'</b></td></tr></table><br />

<table border="0" style="color:black;">

<tr> <td valign="top"><input type="radio" name="quiz" value="1" /></td>
<td>'.$option[1][$ques_no+1].'</td></tr>

<tr><td valign="top"><input type="radio" name="quiz" value="2"/></td>
<td>'.$option[2][$ques_no+1].'</td></tr>

<tr><td valign="top"><input type="radio" name="quiz" value="3"/></td>
<td>'.$option[3][$ques_no+1].'</td></tr>

<tr><td valign="top"><input type="radio" name="quiz" value="4"/></td>
<td>'.$option[4][$ques_no+1].'</td></tr>

<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
</table>

<br />
&nbsp;<input type="submit" value=" Next ">
<br /><br />
</td>
</tr>
<tr>
<th  align="left">&nbsp;Total '.$no_ques.' questions</th>
<th  align="right">Time spent ';
printf("%02d:%02d",(int)($curr_time/60),($curr_time%60));
echo '&nbsp;</th>
</tr></table>

</form>
 ';

} else {
$c_answers=0;

$correct_k = explode(" ",$correct);
$answers_k = explode(" ",$answers);

for($i=0;$i<$no_ques;$i++) {
	if($answers_k[$i]==$correct_k[$i]) {
              $c_answers++;
}}


echo '

<center><h2>Result:</h2>'.$c_answers.' of '.$no_ques.'<p><b>'.(int)($c_answers*100/$no_ques).'%</b></p><p>You must study
harder!</p><p><b>Time Spent</b></p><p>';
printf("%02d:%02d",(int)($curr_time/60),($curr_time%60));
echo '</p></center>

<form action="quiz.php?exp='.$exp.'" method="post">
<input type="hidden" name="points" value="'.$c_answers.'">
<input type="hidden" name="mode" value="results">
<input type="hidden" name="percentPoints" value="'.(int)($c_answers*100/$no_ques).'">
<input type="hidden" name="answers" value="'.$answers.'">

<input type="hidden" name="timespent" value="';
printf("%02d:%02d",(int)($curr_time/60),($curr_time%60));
echo '">

<table width="100%"><tr>
<td><input type="submit" value="Check your answers"></td>
<td align="right"><input type="button" value="Try again"
onclick="location=\'./quiz.php?exp='.$exp.'\'"></td>
</tr></table>
</form>';


}} else {



$correct_k = explode(" ",$correct);
$answers_k = explode(" ",$answers);
echo '

<h2> '.$exp_name.' QUIZ RESULTS</h2>
<p><b>'.$_POST["percentPoints"].'% answered correctly.</b></p><h2>Review:</h2>';
for($i=1;$i<=$no_ques;$i++) {
echo '<p>'.$i.'. <b>'.$questions[$i].'</b></p>';
	if($answers_k[$i-1]==$correct_k[$i-1]) {
              echo '<p style="color: green;">You answered Correctly</p>';
	} else {
              echo '<p style="color: red;">Wrong: You chose <i>'.$option[$answers_k[$i-1]][$i].'</i>.</p>';
}
}
echo '<input type="button" value="Try again"
onclick="location=\'./quiz.php?exp='.$exp.'\'">';
}


?>
</div>
</div>
</body>
