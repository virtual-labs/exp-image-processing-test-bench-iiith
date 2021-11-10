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
	$_SESSION["state"]=1;
	}


$slope=(isset($_GET["m"]))?$_GET["m"]:45;
$const=(isset($_GET["c"]))?$_GET["c"]:0;

$r=106; 

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
some javascript tricks.  We serve the script from Google because it's
faster than most ISPs.  Get more information and documentation
at http://jquery.com  <script type="text/javascript" src="js/jquery-1.4.2.min.js">-->
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> 


<!-- All the javascript generated for your design is in this file -->
<script type="text/javascript" src="js/psd2css.js"></script>

<!-- For Jquery UI-->
<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/dark-hive/jquery-ui-1.8.4.custom.css" />


<!--http://www.cssmenumaker.com/builder/menu_info.php?menu=057-->
<link type="text/css" rel="StyleSheet" href="menu/menu_style.css" />


<!--for ImgSelect - http://odyniec.net/projects/imgareaselect/-->
<link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />  
<script type="text/javascript" src="js/jquery.imgareaselect.js"></script> 

<style> 
#smImages img {
margin: 5px 0px 5px 5px;
display: inline;
height: 130px;
width: 130px;
}

.CMY {
display:none;
}

.RGB {
display:none;
}

.adv_only {
display:none;
}
</style>
<!--


.smImage:hover, .smImage img{
height: 281px;
width: 281px;
}

-->

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
blinker(6);
break;
case 1: $("#nextBox").html("Select appropriate parameters and click on 'Run'.");
buttId="button2";
blinker(6);
break;
//case 2: $("#nextBox").html("Observe the hostogram, try making changes to the bin size and observe the trends.");
case 2: $("#nextBox").html("Note down the results");
break;
case 3: $("#nextBox").html("Click on each of the four subgraphs to view the full size.");

}
jstate=state;

}


  function toggleMosaic()    {
  var ias = $('#Mosaic').imgAreaSelect({ instance: true });
      if($("#Mosaic").is(":visible")) {
        ias.setOptions({ hide: true });
        $("#Mosaic").hide("slow");
        if(jstate>1) {
              $("#start").show("slow");
              $("#end").show("slow");}
      } else {
        $("#start").hide("slow");
        $("#end").hide("slow");
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
 
    var aurl='x=' + sel.x1 + '&y=' + sel.y1 + '&w=' + sel.width + '&h=' + sel.height + '&exp=col';


    $.ajax({url: "crop.php" , type: "POST", data: aurl, async: false, dataType: "html", success: function(data) {
		$("#inpImages").html(data);		


	       
	     }});
		 $("img","#Layer-4").attr("src",$("#both").attr("src"));
$("#start").css("display","block");
$("#end").css("display","block");


}


</script>




<script type="text/javascript">
function doTransform(){

k=0;

    	if(jstate == 0) {
	    alert("First click on Mosaic and select the Input Image.");
            return;

    	}

	var args;

	
	var checkBoxes = $("input[name=choice1]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = $(this).attr('value');

        	}	
        });

		if(args=='1') {
		
		k=1;
		checkBoxes = $("input[name=otype]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = args + "&spc=" + $(this).attr('value');

        	}	
        });
		 
		} else {
		
			checkBoxes = $("input[name=otype2]");

			$.each(checkBoxes, function() {
			    if ($(this).attr('checked')){
				args = args + "&space=" + $(this).attr('value');
            }
        });
		
					checkBoxes = $("input[name=option1]");

			$.each(checkBoxes, function() {
			    if ($(this).attr('checked')){
				args = args + "&" + $(this).attr('value') + "=1";
				k=2;
            }
			
			
        });
		
		if(k == 0) {
	    alert("Select at least one Plane to perform processing on.");
            return;

    	}
		
		
if(document.getElementById("Linear-rad").checked) {
args = args + "&opt=lin&m= " + $("#slider-cSa").slider("option","value") + "&c=" + $("#slider-cSb").slider("option","value");
} else {
		checkBoxes = $("input[name=option2]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = args + "&opt=" + $(this).attr('value');

        	}	
		
		});
				checkBoxes = $("input[name=windsize]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = args + "&wsize=" + $(this).attr('value');
			
			
          	}	
        });
		}}


	if(!($('#Mosaic').is(":visible"))) {
	var aurl = "trns.php?opn=colour&args=" + args;
	if(k==1) {
       $.ajax({ url: aurl, type: "GET", async: false, dataType: "html", success: function(data){
	$("#outImages").html(data);	

	}}); } else {
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
	$("dims","#imgInfo").html("300 x 300");
}
	
	
set_state(2);}}

function redrawGraph (temp) {
    var plot=$.plot($("#placeholder"),
           [ { color: "cyan" , data: temp} ], {
               series: {
                   lines: { show: true },
                   points: { show: false }
               },
               grid: { hoverable: false, clickable: false },
               yaxis: { min: 0, max: 255 }
             });
}
 
function confirmTo(url) {
	var response = confirm('You will lose Session Data: Continue?');
	if(response) {
		window.location.href=url;
	}
}
 
  $(document).ready (function() {
  buttId="button1";
    $("#choice").buttonset();
    $("#choice2").buttonset();
  $('#Histo').hide();
  $('#Advanced').hide();
  
    <?php if(isset($_GET["source"]) | isset($_GET["assess"])) {
	echo "set_state(1);"; } else { echo "set_state(0);"; ;
	} ?>

  	<?php
	if(isset($_GET["assess"])) {
	echo'
 $("#Advanced-rad").click();
 $("#choice").hide();
	';
	}
	
  if(isset($_GET["mode"])) {

 
 if($_GET["mode"]==1) {
 echo '		
 $("#Simple-rad").click();
 $.each($("input[name=otype]"), function() {
                $(this).removeAttr("checked");
        
        });
		
		$.each($("input[name=otype]"), function() {
                if ($(this).attr("value")=='.$_GET["space"].') {
					$(this).attr("checked","true");
					}        
        });';
 } else {
 echo '
 $("#Advanced-rad").click();
 
	$.each($("input[name=otype2]"), function() {
                $(this).removeAttr("checked");
        
        });
		
		$.each($("input[name=otype2]"), function() {
                if ($(this).attr("value")=='.$_GET["space"].') {
					$(this).click();
					}        
        });';
		
		$plane=$_GET["plane"];
		if($plane-4>0) {
			echo '$("#third").attr("checked","true");';
		} 
if(($plane/2)%2==1) {
			echo '$("#second").attr("checked","true");';
		} else {
			echo '$("#second").removeAttr("checked");';
}		
if($plane%2==1) {
			echo '$("#first").attr("checked","true");';
		} 
		
		if($_GET["mode2"]!=1) {
		echo '
		$("#Histo-rad").click();
	$.each($("input[name=opt2]"), function() {
                $(this).removeAttr("checked");
        
        });
					
		$.each($("input[name=opt2]"), function() {
                if ($(this).attr("value")=='.$_GET["mode2"].') {
					$(this).click();
					if($(this).attr("value")!=1) {
								$.each($("input[name=wsize]"), function() {
								$(this).removeAttr("checked");
						
						});
						}
						}
						});
						
						$.each($("input[name=wsize]"), function() {
								if ($(this).attr("value")=='.$_GET["wsize"].') {
									$(this).attr("checked","true");
									}        
						});';
					}
					}        
        }?>

  
    cont = [], log = [];
  {
var a = Math.tan(<?php echo $slope; ?>*(Math.PI/180)).toPrecision(2);
var b = <?php echo $const; ?>;
  for(var i = 0; i < 256 ; i+=1) {
	log.push([i, (<?php echo $r; ?> * Math.log(i + 1)/Math.LN10)]);
	
		if((a*i)+ b > 0) {
	 cont.push([i, (a*i)+ b]);
	 } else {
	 cont.push([i , 0]);
	 }
}} 
redrawGraph(cont);
  $(".imageFull").hide();
  $("#popUp").hide();
     $("button1","#Layer-2").button();
  $("button1","#Layer-2").click( function() {
  toggleMosaic();
  });

  $("button2","#Layer-2").button();
  $("button2","#Layer-2").click ( function () {
  doTransform();
  });
   

  $("button4","#Layer-2").button();
  $("button4","#Layer-2").click ( function () {
  <?php
   if(isset($_GET["assess"])) { echo 'set_state(1);'; } 
		else { echo 'set_state(0);'; }
  ?>

        $('#inpImages').html('<img src="images/Layer-4.jpg"  alt="InputLayer" />  <img src="images/Layer-4.jpg"  alt="InputLayer" />  <img src="images/Layer-4.jpg"  alt="InputLayer" />  <img src="images/Layer-4.jpg"  alt="InputLayer" />' );
		$('#outImages').html('<img src="images/Layer-4.jpg"  alt="InputLayer" />  <img src="images/Layer-4.jpg"  alt="InputLayer" />  <img src="images/Layer-4.jpg"  alt="InputLayer" />  <img src="images/Layer-4.jpg"  alt="InputLayer" />' );
		
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
  
});



</script>
</head>


<body>

  <!-- This is 'Backgound_bkgnd_center_jpg' -->
  <div id="Layer-1" class="Backgound_bkgnd_center_jpg"  >
    
    <!-- This is 'Thumbnails_jpg' -->
    <div id="Layer-7" class="Thumbnails_jpg adv_only"  >
      <div id="sliderContent" class="ui-corner-all">	
	<div class="viewer ui-corner-all">
	  <div class="content-conveyor ui-helper-clearfix">
	    <div class="item">
	      <h2><?php if(isset($_GET["assess"])) {
	  echo 'Assessment';
	  } else { echo 'Start'; } ?></h2>
	      <img src="<?php if(isset($_GET["assess"])) {
	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.jpg';
	  } else { echo 'images/Mosaiccol.jpg'; } ?>" alt="picture" width="140px" height="140px"/>
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
    <div id="Layer-5" class="adv_only">
      <img src="images/Layer-5.jpg" alt="outputLayer" width="281px" height="281px"/></div>


    <!-- This is 'InputLayer_jpg' -->
    <div id="Layer-4" class="adv_only">
      <img src="<?php if(isset($_GET["source"])) {
	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.jpg';
	  } else { if(isset($_GET["assess"])) { echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'_result.jpg'; } 
		else { echo 'images/Layer-4.jpg'; }} ?>" width="281" height="281" alt="InputLayer" /></div>

	
    <!-- This is 'Mosaic_jpg' -->
    <div id="Mosaic" class="Mosaic_jpg"  >
      <img src="images/Mosaiccol.jpg" width="513" height="513" alt="Mosaic" /></div>

	<div id="smImages" style="position: absolute; left:325px; top: 124px; width: 580px; " class="bas_only">
   <h3> Input Images </h3> 
    <!-- This is 'InputLayer_jpg' -->
	<div style="border: solid 1px yellow; padding: 5px; margin: 0 0 10px 0;" id="inpImages">
  <?php if(isset($_GET["source"])) {
  echo '
  <table style="text-align:center;"> <tr> <td>
 <img src="images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.jpg" id="both" alt="InputLayer" width="130px" height="130px"/> </td><td>
	<img src="images/temp/'.$_SESSION["id"].'_'.($_SESSION["currentS"]).'s1'.'.jpg" class="rgb" alt="InputLayer" width="130px"  height="130px"/> </td><td>
	<img src="images/temp/'.$_SESSION["id"].'_'.($_SESSION["currentS"]).'s2'.'.jpg" class="rgb" alt="InputLayer" width="130px"  height="130px"/> </td><td>
	<img src="images/temp/'.$_SESSION["id"].'_'.($_SESSION["currentS"]).'s3'.'.jpg" class="rgb" alt="InputLayer" width="130px"  height="130px"/> </td></tr><tr>
	<td>Original</td><td>Red Plane</td><td>Green Plane</td><td>Blue Plane</td></tr></table>'; 	
} else {
	echo '<img src="images/Layer-4.jpg"  alt="InputLayer" />
  <img src="images/Layer-4.jpg"  alt="InputLayer" />
  <img src="images/Layer-4.jpg"  alt="InputLayer" />
  <img src="images/Layer-4.jpg"  alt="InputLayer" />';

    }?>
   </div>
   <h3> Output Images </h3>
   	<div style="border: solid 1px yellow; padding: 5px; margin: 0 0 20px 0;" id="outImages">
    
      <img src="images/Layer-4.jpg"  alt="InputLayer" />
	  
  <img src="images/Layer-4.jpg"  alt="InputLayer" />
  <img src="images/Layer-4.jpg"  alt="InputLayer" />
  <img src="images/Layer-4.jpg"  alt="InputLayer" />
  </div>
 </div>

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
<li><a href="objective.php?exp=colour" target="_self" >Objective</a>
</li>
<li><a href="intro.php?exp=colour" target="_self" >Introduction</a>
</li>
<li><a href="theory.php?exp=colour" target="_self" >Theory</a>


</li>
<li><a href="procedure.php?exp=colour" target="_self" >Procedure</a>


</li>
<li><a href="colour.php" target="_self" >Experiment</a>


</li>
<li><a href="#" target="_self" >Assessment</a>
				<ul>
					<li><a href="quiz.php?exp=colour">Quiz</a></li>
					<li><a href="assign.php?exp=colour">Assignment</a></li>
			   </ul>

</li>
<!--
<li><a href="references.php?exp=colour" target="_self" >References</a>
</li>
-->

<li><a href="summary.php" target="_blank" >Summary</a>
</li>
</ul>
</div>
			</div>
			
    </div>
	
	<div id="imgInfo" class="adv_only">
	<table>
	<tr> <th width=300>
	<?php if(isset($_GET["assess"])) { ?>Expected Output Image<?php } else {?> Input Image <?php } ?> 
	</th> <th>
	Output size
	</th> </tr>
	<tr> <td>
	300 x 300 
	</td> <td>
	<dims> __ x __ </dims>
	</td> </tr>
	</table>
	</div>

    <!-- This is 'Parameters_jpg' -->
    <div id="Layer-2">

	  <h2 style="text-align: center;">Colour Image Processing</h2>
<div id="nextBox">
</div>
 
      <?php if (!isset($_GET["assess"]))  {echo "<button1>Select Image</button1>";} ?>
      <button4>Reset</button4>
      <button2>Run</button2>
      <br/><br/>


    <div id="choice">
	<input type="radio" id="Simple-rad" value="1" name="choice1" onclick="$('.Parameters').hide(); $('#Simple').show(); $('.adv_only').hide(); $('.bas_only').show(); " checked="true"/><label for="Simple-rad">Colour Spaces</label>
	<input type="radio" id="Advanced-rad" value="2" name="choice1" onclick="$('.Parameters').hide(); $('#Advanced').show(); $('.adv_only').show(); $('.bas_only').hide(); "/><label for="Advanced-rad">Processing</label>
	</div>
	

<div id="Simple" class="Parameters">
<h3>&nbsp;Select Colour Space: </h3>
<input type="radio" name="otype" value="1" checked="true"/>HSI<br/>
<input type="radio" name="otype" value="2" />CMY<br/>
<input type="radio" name="otype" value="3" />YCbCr<br/>


</div>

<div id="Advanced" class="Parameters">

<h3>&nbsp;Select Colour Space: </h3> 
<input type="radio" name="otype2" value="2" onclick="$('.CMY').css('display','none');$('.RGB').css('display','none');$('.HSV').css('display','inline');" checked="true"/>HSI<br/>
<input type="radio" name="otype2" value="3" onclick="$('.CMY').css('display','inline');$('.RGB').css('display','none');$('.HSV').css('display','none');" />CMY<br/>
<input type="radio" name="otype2" value="1" onclick="$('.CMY').css('display','none');$('.RGB').css('display','inline');$('.HSV').css('display','none');" />RGB<br/>

Apply Parameters to: <br/>
<input type="checkbox" name="option1" id="first" value="first"><span class="HSV">(H)Hue</span><span class="CMY">(C)Cyan</span><span class="RGB">(R)Red</span><br>
<input type="checkbox" name="option1" id="second" value="second" checked><span class="HSV">(S)Saturation</span><span class="CMY">(M)Magenta</span><span class="RGB">(G)Green</span><br>
<input type="checkbox" name="option1" id="third" value="third"><span class="HSV">(I)Intensity</span><span class="CMY">(Y)Yellow</span><span class="RGB">(B)Blue</span><br> <br/>

<div id="choice2">
	<input type="radio" id="Linear-rad" name="choice2" checked onclick="$('.Parameter').hide();$('#Linear').show(); $('#placeholder').show();"/><label for="Linear-rad">Linear</label>
	<input type="radio" id="Histo-rad" name="choice2" onclick="$('.Parameter').hide(); $('#Histo').show(); $('#placeholder').hide();"/><label for="Histo-rad">Histogram Processing</label>
</div>

      
      <div class="Parameter" id="Linear">
	  f(r) = <input type="text" READONLY id="cS-slider-display" maxlength="10" value="0" size="10"/>
		<br/>slope (m):
	  <div id="slider-cSa" class="paraSlider"></div>
		offset (c):
	  <div id="slider-cSb" class="paraSlider"></div>
	<script type="text/javascript">
	$(function() {
	  $("#slider-cSa").slider({
	  value:<?php echo $slope; ?>,
	  min: -89,
 	  max: 89,
	  step: 1,
	  slide: function(event, ui) {
	  $("#cS-slider-display").attr("value",Math.tan(ui.value*(Math.PI/180)).toPrecision(3) + "r + " + $("#slider-cSb").slider("option","value")); 
	  },
	  change: function(event, ui) {
 	    var cont2 = [] ;
	    var a = Math.tan($("#slider-cSa").slider("option","value")*(Math.PI/180)).toPrecision(2);
	    var b = $("#slider-cSb").slider("option","value")*1;
	    for(var i=0; i < 256; i++) {
	    	    	 if((a*i)+ b > 0) {
			 cont2.push([i, (a*i)+ b]);
			 } else {
			 cont2.push([i , 0]);
			 }
}
			 redrawGraph(cont2);
			     cont=cont2;
		 
	 }
			     
	 });
			 
			 
	  $("#slider-cSb").slider({
		  value:<?php echo $const; ?>,
			  min: -255,
			  max: 255,
			  step: 1,
			  slide: function(event, ui) {
			     if(ui.value>=0) {
				  $("#cS-slider-display").attr("value",Math.tan($("#slider-cSa").slider("option","value")*(Math.PI/180)).toPrecision(2)+
		  "r + " + ui.value); } else {
				  $("#cS-slider-display").attr("value",Math.tan($("#slider-cSa").slider("option","value")*(Math.PI/180)).toPrecision(2)+
		  "r " + ui.value); }
	    
			  },
              change: function(event, ui) {
 	    var cont2 = [] ;
	    var a = Math.tan($("#slider-cSa").slider("option","value")*(Math.PI/180)).toPrecision(2);
	    var b = $("#slider-cSb").slider("option","value")*1;
	    for(var i=0; i < 256; i++) {
	   	    	 if((a*i)+ b > 0) {
			 cont2.push([i, (a*i)+ b]);
			 } else {
			 cont2.push([i , 0]);
			 }

			 }	     
			 redrawGraph(cont2);
			     cont=cont2;
		 
	 }
	});
	  $("#cS-slider-display").attr("value","r"); 
	  	  });
	  </script>

</div>
<div class="Parameter" id="Histo">	
<h3>&nbsp;Select type:</h3>
<input type="radio" name="option2" onclick="$('#size').hide();" value="1" checked>Global Histogram Equalization<br>
<input type="radio" name="option2" onclick="$('#size').show();" value="2">Adaptive Histogram Equalization<br>

<div id="size" style="display:none; margin-left: 25px; font-size: 12px; ">
Window Size:  <br/>
<input type="radio" name="windsize" value="50" checked/> 50 x 50 pixels<br />
<input type="radio" name="windsize" value="100" /> 100 x 100 pixels<br/>
</size>
</div>
</div>
</div>
<div class="adv_only">
<div id="placeholder" style="margin-left: 20px; width: 220px; height: 220px" ></div>
</div> </div>
</div>
</body>


