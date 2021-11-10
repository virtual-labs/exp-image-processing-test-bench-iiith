<?php
session_start();

if(isset($_GET["source"]) && isset($_GET["id"])) {
$_SESSION["currentS"]=$_GET["source"];
$_SESSION["id"]=$_GET["id"]; 
} else {
$_SESSION["id"]=time();
$_SESSION["state"]=0;
}

if(isset($_GET["assess"])) {
	$_SESSION["currentS"]=1;
	$_SESSION["id"]=$_GET["assess"];
	$_SESSION["state"]=time();
	}


?> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script class='gtm'>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-W59SWTR');</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- This file was originally generated at http://psd2cssonline.com on September 16, 2010, 10:04 am -->
<!-- psd2css Online version 1.85 -->

<title>Virtual Lab in Image Processing</title>

<!-- Some META tags to help with Search Engine Optimization.  Please 
note however that META tags are NOT a magic bullet to get your web page
to the top of search engine rankings.  They are just part of that effort.  You 
can get more information by googling SEO or visiting the psd2css Online forums. -->
<meta name="description" content="Put the description of this page here" />
<meta name="keywords" content="Put keywords for this page here separated by commas" />
<meta name="generator" content="psd2css Online - Dynamic Web Pages from your Photoshop Design in seconds" />

<!-- The CSS Reset from Eric Meyers -->
<!-- <link rel="stylesheet" type="text/css" href="cssreset.css" media="screen" /> -->

<!-- The Primary External CSS style sheet. -->
<link rel="stylesheet" type="text/css" href="css/psd2css.css" media="screen" />

<!-- We use the jquery javascript library for DOM manipulation and
some javascript tricks.  We serve the script from Google because its
faster than most ISPs.  Get more information and documentation
at http://jquery.com 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> 
-->
<script type="text/javascript" src="js/jquery-1.4.2.min.js"> </script>
<!-- All the javascript generated for your design is in this file -->
<script type="text/javascript" src="js/psd2css.js"></script>

<!-- For Jquery UI-->
<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/dark-hive/jquery-ui-1.8.4.custom.css">

<!-- For Slider - http://carpe.ambiprospect.com/slider/-->
<link type="text/css" rel="StyleSheet" href="css/carpe-slider.css" />
<script type="text/javascript" src="js/carpe-slider.js"></script>

<!--http://www.cssmenumaker.com/builder/menu_info.php?menu=057-->
<link type="text/css" rel="StyleSheet" href="menu/menu_style.css" />

<!--for ImgSelect - http://odyniec.net/projects/imgareaselect/-->
<link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />  
<script type="text/javascript" src="js/jquery.imgareaselect.js"></script> 

<!--for Flot -->
<script type="text/javascript" src="js/jquery.flot.js"></script> 

<!--for COntent Slider - Jquery Slider/-->
 <link rel="stylesheet" type="text/css" href="css/jquery-slider.css">


<script type="text/javascript">

function blinker(i){
if(buttId!="cancel" && i>0) {
$($(buttId),"#Layer-2").toggleClass("ui-state-hover");
setTimeout("blinker("+(i-1)+")",500);
}
}

function set_state(state) {
switch (state) {
case 0: $("#nextBox").html("Start the Experiment by clicking on 'Select Image' and selecting an Input Image from the Mosaic");
buttId="button1"; 
blinker(10);
break;
case 1: $("#nextBox").html("Select the secondary image, select appropriate parameters and click on 'Run'.");
buttId="button2";
blinker(10);
break;
case 2: $("#nextBox").html("Observe the result and try different operations with different secondary Images.");
break;
}
jstate=state;
}


  function toggleMosaic()    {
  var ias = $('#Mosaic').imgAreaSelect({ instance: true });
      if($("#Mosaic").is(":visible")) {
        ias.setOptions({ hide: true });
        $("#Mosaic").hide("slow");
      } else {
        $("#Mosaic").show("slow", function() {
          ias.setOptions({ show: true });
          ias.update();
        });
      }
  }
</script>

<script tyre="text/javascript">

function set_crop() {
set_state(1);
	
    var ias = $('#Mosaic').imgAreaSelect({ instance: true });
	var sel=ias.getSelection();

    //alert('sdfsd');

    var aurl='x=' + sel.x1 + '&y=' + sel.y1 + '&w=' + sel.width + '&h=' + sel.height;


    $.ajax({url: "crop.php" , type: "POST", data: aurl, async: false, dataType: "html", success: function(data) {
		$("#Layer-4").html(data);		
	       
	     }});
}
</script>


<script type="text/javascript">
function doTransform(){

    	if(jstate == 0) {
	    alert("First click on Mosaic and select the Input Image.");
            return;
    	}

	var args;
	
	var checkBoxes = $("input[name=Operatn]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = $(this).attr('value');
        	}	
        });

	checkBoxes= $("input[name=fitting]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = args + "&fitting=" + $(this).attr('value');
        	}	
        });
	
	checkBoxes = $("input[name=inpImage]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = args + "&image=" + $(this).attr('value');
        	}	
        });


	if(!($('#Mosaic').is(":visible"))) {
	var aurl = "trns.php?opn=arith&opt=" + args;

set_state(2);

       $("#slider").remove();	
       $.ajax({ url: aurl, type: "GET", async: false, dataType: "html", success: function(data){
		$(".content-conveyor", $("#sliderContent")).html(data);	
	}});
	$("#sliderContent").append('<div id="slider"></div>');
    
	var conveyor2 = $(".content-conveyor", $("#sliderContent")),
	item2 = $(".item", $("#sliderContent"));
	
	//set length of conveyor
	conveyor2.css("width", item2.length * parseInt(item2.css("width")));
        conveyor2.css("left","-" + ((item2.length * parseInt(item2.css("width"))) - parseInt($(".viewer", $("#sliderContent")).css("width"))) + "px");
			
	//config
	var sliderOpts = {
	  max: (item2.length * parseInt(item2.css("width"))) - parseInt($(".viewer", $("#sliderContent")).css("width")),
	  value:  (item2.length * parseInt(item2.css("width"))) - parseInt($(".viewer", $("#sliderContent")).css("width")),
	  slide: function(e, ui) { 
		conveyor2.css("left", "-" + ui.value + "px");
	  }
	};
	
	//create slider
	$("#slider").slider(sliderOpts);

        $("img",$("#Layer-5")).attr("src",$("img",$(".item:last")).attr("src")); 
  
       
       }

var myImage = new Image();
myImage.name = $("img",$("#Layer-5")).attr("name");
myImage.src = $("img",$("#Layer-5")).attr("src");
myImage.onload = function () {
  $("dims","#imgInfo").html(this.height + " x " + this.width);
}}

 
function confirmTo(url) {
	var response = confirm('You will lose Session Data: Continue?');
	if(response) {
		window.location.href=url;
	}
}
 

  $(document).ready (function() {
    <?php if($_GET["exp"]=="piping"  || isset($_GET["assess"])) {
	echo "set_state(1);"; } else {echo "set_state(0);"; ;
	} ?>
  $(".imageFull").hide();
  $("#popUp").hide();
  $("#radio").buttonset();
  $("#radio").button("refresh");
   $("button1","#Layer-2").button();
  $("button1","#Layer-2").click( function() {
  toggleMosaic();
  });



  $("button2","#Layer-2").button();
  $("#radio").buttonset();
  $("#radio").button("refresh");
 
  $("button4","#Layer-2").button();
  $("button4","#Layer-2").click ( function () {
  
   <?php if(!isset($_GET["assess"])) { echo ' set_state(0);'; } 
		else { echo 'set_state(1);'; }?>
  $("dims","#imgInfo").html("____ x ____ ");
  
  $("img",$("#Layer-5")).attr("src","images/Layer-5.jpg");  
  $("img",$("#Layer-4")).attr("src","<?php if(isset($_GET["assess"])) { echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'_result.png'; } 
		else { echo 'images/Layer-4.jpg'; }?>")
$("#sliderContent").replaceWith('      <div id="sliderContent" class="ui-corner-all">		<div class="viewer ui-corner-all">	  <div class="content-conveyor ui-helper-clearfix">	    <div class="item">	      <h2><?php if(isset($_GET["assess"])) {	  echo 'Assessment';	  } else { echo 'Start'; } ?></h2>	      <img src="<?php if(isset($_GET["assess"])) {	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.png';	  } else { echo 'images/Mosaic.png'; } ?>" alt="picture" width="140px" height="140px"/>	      <dl class="details ui-helper-clearfix">		<dt><?php if(isset($_GET["assess"])) {	  echo 'This is the Input Image. Perform Operations to get the above result.';	  } else { echo 'Select a portion of the Mosaic on the Right and Transform... '; } ?></dt>	      </dl>	    </div>	  </div>	</div>	<div id="slider"></div>      </div>');
});
 
  $("button2","#Layer-2").click ( function () {
  doTransform();
  });
  
  $("#Mosaic").imgAreaSelect({ 
  handles: true, 
  movable: true,
  persistent: true,
  resizable: false,
  x1: 300, y1: 300, x2: 600, y2: 600,
  hide: false,
  imageHeight: 900,
  imageWidth: 900,
  });
  toggleMosaic();
  
  <?php if(isset($_GET["opt"])) {
		echo 'var checkBoxes = $("input[name=Operatn]");
				$.each(checkBoxes, function() {
					if ($(this).attr("value")=="'.$_GET["opt"].'"){
						$(this).click(); }
					});
						
						checkBoxes= $("input[name=fitting]");

	$.each(checkBoxes, function() {
                if ($(this).attr("value")=="'.$_GET["fit"].'"){
           	$(this).click();
        	}	
        });
	
	checkBoxes = $("input[name=inpImage]");

	$.each(checkBoxes, function() {
                if ($(this).attr("value")=="'.$_GET["image"].'"){
           	$(this).click();
        	}	
        });	'; }
					?>
				
				
});



</script>
</head>


<body>

  <!-- This is 'Backgound_bkgnd_center_jpg' -->
  <div id="Layer-1" class="Backgound_bkgnd_center_jpg"  >
    

    <!-- This is 'Mosaic_jpg' -->
    <div id="Mosaic" class="Mosaic_jpg"  >
      <img src="images/Mosaic.png" width="513" height="513" alt="Mosaic" /></div>

    <!-- This is 'Thumbnails_jpg' -->
    <div id="Layer-7" class="Thumbnails_jpg"  >
      <div id="sliderContent" class="ui-corner-all">	
	<div class="viewer ui-corner-all">
	  <div class="content-conveyor ui-helper-clearfix">
	    <div class="item">
	      <h2><?php if(isset($_GET["assess"])) {
	  echo 'Assessment';
	  } else { echo 'Start'; } ?></h2>
	      <img src="<?php if(isset($_GET["assess"])) {
	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.png';
	  } else { echo 'images/Mosaic.png'; } ?>" alt="picture" width="140px" height="140px"/>
	      <dl class="details ui-helper-clearfix">
		<dt><?php if(isset($_GET["assess"])) {
	  echo 'This is the Input Image. Perform Operations to get the above result.';
	  } else { echo 'Select a portion of the Mosaic on the Right and Transform... '; } ?></dt>
	      </dl>
	    </div>
	  </div>
	</div>
	<div id="slider"></div>
      </div>
   
      
      
    </div>

    <!-- This Is 'outputLayer_jpg' -->
    <div id="Layer-5" class="outputLayer_jpg"  >
      <img src="images/Layer-5.jpg" alt="outputLayer" width="281px" height="281px"/></div>

    <!-- This is 'InputLayer_jpg' -->
    <div id="Layer-4" class="InputLayer_jpg"  >
      <img src="<?php if(isset($_GET["source"])) {
	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.png';
	  } else { if(isset($_GET["assess"])) { echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'_result.png'; } 
		else { echo 'images/Layer-4.jpg'; }} ?>" width="281" height="281" alt="InputLayer" /></div>

    <!-- This is 'TopBar_jpg' -->
    <div id="Layer-3" class="TopBar_jpg"  >
      <img src="images/Layer-3.jpg" width="894" height="96" alt="TopBar" />
      <!-- This is 'IIIT' -->
      <div id="Layer-6" class="IIIT"  >
        <img src="images/iiit.png" width="100" height="70" alt="IIIT" class="pngimg" />
	</div>
	
			<div id="topMenu">
			<h1 style="text-align: center;">Virtual Lab for IMAGE PROCESSING</h1>
<div class="home">
<a onclick="confirmTo('index.html')">home</a>
</div>
			<div class="menu">
<ul>
<li><a href="objective.php?exp=arith" target="_self" >Objective</a>
</li>
<li><a href="intro.php?exp=arith" target="_self" >Introduction</a>
</li>
<li><a href="theory.php?exp=arith" target="_self" >Theory</a>
</li>
<li><a href="procedure.php?exp=arith" target="_self" >Procedure</a>
</li>
<li><sel><a href="arith.php" target="_self" >Experiment</a>
</sel></li>
<li><a href="#" target="_self" >Assessment</a>
				<ul>
					<li><a href="quiz.php?exp=arith">Quiz</a></li>
					<li><a href="assign.php?exp=arith">Assignment</a></li>
			   </ul>
</li>
<!--
<li><a href="references.php?exp=arith" target="_self" >References</a>
</li>
-->
<li><a href="summary.php" target="_blank" >Summary</a>
</li>
</ul>
</div>
			</div>
			

    </div>

	<div id="imgInfo">
	<table>
	<tr> <th width=290>
	Input size
	</th> <th>
	Output size
	</th> </tr>
	<tr> <td>
	300 x 300  
	</td> <td>
	<dims> ____ x ____ </dims>
	</td> </tr>
	</table>
	</div>
	
	
    <!-- This is 'Parameters_jpg' -->
    <div id="Layer-2">

	  <h2 style="text-align: center;">Image Arithmetic</h2>
<div id="nextBox">
	</div>
 
      <?php if (!isset($_GET["assess"]))  {echo "<button1>Select Image</button1>";} ?>
      <button4>Reset</button4>
      <button2>Run</button2>
      <br/><br/>

<div class="Parameters">
<table><tr valign="top"><td>
<h3 style="margin-left: -5px;"> Select Operation</h3>
<form name="Operation">
<input type="radio" name="Operatn" value="1" checked/>Addition<br />
<input type="radio" name="Operatn" value="2" />Subtraction<br/>
<input type="radio" name="Operatn" value="3" />Difference<br/>
<input type="radio" name="Operatn" value="4" />Multiplication<br/>
<input type="radio" name="Operatn" value="5" />Division<br/>
</form> </td><td>

<form name="technique">
<h3 style="margin-left: 5px;">Select Fitting</h3>

<input type="radio" name="fitting" value="1" checked/>Clipping<br/>
<input type="radio" name="fitting" value="2" />Auto-Scaling<br />
</form> 
</td></tr></table>
<h3 style="margin: 5px">Select Secondary Image</h3>

      <div id="radio">
	<input type="radio" id="dully" name="inpImage" value="add2.png"
	onclick="$('img','#placeholder').attr('src','arith/add2.png');"
	checked="checked"/><label for="dully">Dull</label>
	<input type="radio" id="brighty" name="inpImage" value="add1.png"
	onclick="$('img','#placeholder').attr('src','arith/add1.png');"/>
	<label for="brighty">Bright</label>
	<input type="radio" id="grady" name="inpImage" value="add3.png"
	onclick="$('img','#placeholder').attr('src','arith/add3.png');"/>
	<label for="grady">Gradient</label>
      </div>

</div>
<div id="placeholder" style="margin-left: 30px; width:220px; padding: 5px;
border: solid grey 1px;height: 220px"><img src="arith/add2.png"
height="220px" width="220px"></div>


</div>
</div>
</body>


