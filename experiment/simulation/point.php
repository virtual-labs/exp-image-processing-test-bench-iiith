<?php
session_start();

if($_GET["exp"]!="piping") {
if(isset($_GET["source"]) && isset($_GET["id"])) {
$_SESSION["currentS"]=$_GET["source"];
$_SESSION["id"]=$_GET["id"]; 
} else {
$_SESSION["id"]=time();
$_SESSION["state"]=0;
}
}

if(isset($_GET["assess"])) {
	$_SESSION["currentS"]=1;
	$_SESSION["id"]=$_GET["assess"];
	$_SESSION["state"]=1;
	}

$slope=45;
$const=0;

$r=106;

$a=50;
$b=200;

$a1=100;
$b1=150;

$beta1=45;
$beta2=45;
if(isset($_GET["opt"])) {
	$opt=$_GET["opt"];
	switch ($opt) {
	case "1": 
		$slope=$_GET["m"];
		$const=$_GET["c"];
		break;
	case "2":
		$r=$_GET["c"];
		break;
	case "3":
		$a=$_GET["a"];
		$b=$_GET["b"];
		$beta1=$_GET["beta"]*45;
	break;
	case "4":
		$a1=$_GET["a"];
		$b2=$_GET["b"];
		$beta2=$_GET["beta"]*45;
	break;
	}
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
some javascript tricks.  We serve the script from Google because it's
faster than most ISPs.  Get more information and documentation
at http://jquery.com 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> -->
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>

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
case 1: $("#nextBox").html("Select appropriate parameters and click on 'Run'.");
buttId="button2";
blinker(10);
break;
case 2: $("#nextBox").html("Click on 'Reset' to start again.");
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

if(document.getElementById("Linear-rad").checked) {
args = "1&m= " + $("#slider-cSa").slider("option","value") + "&c=" + $("#slider-cSb").slider("option","value");
}
if(document.getElementById("nonLinear-rad").checked) {
args = "2&c=" + $("#slider-logc").slider("option","value");
}
if(document.getElementById("Clipper-rad").checked) {
args = "3&a=" + $("#Clipper-a-display").attr("value") + "&b=" +
$("#Clipper-b-display").attr("value") + "&beta=" + $("#Clipper-beta-display").attr("value")
} 
if(document.getElementById("Windower-rad").checked) {
args = "4&a=" + $("#Windower-a-display").attr("value") + "&b=" +
$("#Windower-b-display").attr("value") + "&beta=" + $("#Windower-beta-display").attr("value")
} 


set_state(2);		
	
	
	if(!($('#Mosaic').is(":visible"))) {
	var aurl = "trns.php?opn=point&opt=" + args;

       $("#slider").remove();	
       $.ajax({ url: aurl, type: "GET", async: false, dataType: "html", success: function(data){
		$(".content-conveyor", $("#sliderContent")).html(data);	
	}});
	$("#sliderContent").append('<div id="slider"></div>');
    
	var conveyor2 = $(".content-conveyor", $("#sliderContent")),
	item2 = $(".item", $("#sliderContent"));
	
	//set length of conveyor
	conveyor2.css("width", item2.length * parseInt(item2.css("width")));
        conveyor2.css("left","0px");
			
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
</script>

<script type="text/javascript">

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
<?php if($_GET["exp"]=="piping"  || isset($_GET["assess"])) {
	echo 'set_state(1);';
	} else {
	echo 'set_state(0);';
	}

?>
  $(".imageFull").hide();
  $("#popUp").hide();
  wind = [], cont = [], log = [], clip = [];
  {
var m1 = Math.tan(<?php echo $beta1; ?>*(Math.PI/180)).toPrecision(2);
var m2 = Math.tan(<?php echo $beta2; ?>*(Math.PI/180)).toPrecision(2);

var a = Math.tan(<?php echo $slope; ?>*(Math.PI/180)).toPrecision(2);
var b = <?php echo $const; ?>;
  for(var i = 0; i < 256 ; i+=1) {
	log.push([i, (<?php echo $r; ?> * Math.log(i + 1)/Math.LN10)]);

	if((a*i)+ b > 0) {
	 cont.push([i, (a*i)+ b]);
	 } else {
	 cont.push([i , 0]);
	 }
	
	
if(i<<?php echo $a; ?> || i><?php echo $b; ?>) {
     if(i><?php echo $b; ?>) { clip.push([i , 255]); } else {clip.push([i, 0]);}
} else { 
	clip.push([i,i*m1]);}
if(i<<?php echo $a1; ?> || i><?php echo $b1; ?>) {
wind.push([i,0]);
} else {
    wind.push([i,i*m2]); }}


  
redrawGraph(cont);
}
  $("button1","#Layer-2").button();
  $("button1","#Layer-2").click( function() {
  toggleMosaic();
  });
  
  $("button2","#Layer-2").button();
  $("#choice").buttonset();
  $("#choice").button("refresh");
  $(".Parameters").hide(); $("#Linear").show();
  $("button5","#Parameters").button();
  $("button5","#Parameters").click( function () {
  	$("#popUp").show();
	}	);
$("button5","#Parameters").hide();
	
	$("button6","#popUp").button();
	$("button6","#popUp").click( function () {
		$("#popUp").hide();
		});
  $("button4","#Layer-2").button();
  $("button4","#Layer-2").click ( function () {
  $("#slider-cSa").slider("option","value",45);
  $("#slider-cSb").slider("option","value",0);
 <?php if($_GET["exp"]!="piping" && !isset($_GET["assess"])) { echo ' set_state(0);'; } 
		else { echo 'set_state(1);'; }?>
  $("dims","#imgInfo").html("____ x ____ ");
  $("img",$("#Layer-5")).attr("src","images/Layer-5.jpg");  
<?php  if( $_GET["exp"]!="piping" ) { ?>
  $("img",$("#Layer-4")).attr("src","<?php if(isset($_GET["assess"])) { echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'_result.png'; } 
		else { echo 'images/Layer-4.jpg'; } ?>"); <?php } ?>
 $("#sliderContent").replaceWith('      <div id="sliderContent" class="ui-corner-all">		<div class="viewer ui-corner-all">	  <div class="content-conveyor ui-helper-clearfix">	    <div class="item">	      <h2><?php if(isset($_GET["assess"])) {	  echo 'Assessment';	  } else { echo 'Start'; } ?></h2>	      <img src="<?php if(isset($_GET["assess"])) {	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.png';	  } else { echo 'images/Mosaic.png'; } ?>" alt="picture" width="140px" height="140px"/>	      <dl class="details ui-helper-clearfix">		<dt><?php if(isset($_GET["assess"])) {	  echo 'This is the Input Image. Perform Operations to get the above result.';	  } else { echo 'Select a portion of the Mosaic on the Right and Transform... '; } ?></dt>	      </dl>	    </div>	  </div>	</div>	<div id="slider"></div>      </div>');

});
 
  $("button2","#Layer-2").click ( function () {
  doTransform();
  });

$("button3","#zoom").button();
  $("button3","#zoom").click( function() {
  if(jstate==2) {
  	var aurl = "trns.php?opn=histo&bins=256&mode=point";
         $("#slider").remove();	
       $.ajax({ url: aurl, type: "GET", async: false, dataType: "html", success: function(data){
		$(".content-conveyor", $("#sliderContent")).append(data);
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

  } else {
  alert("'Run' and get an output first.");}
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
  <?php 
  if(isset($_GET["opt"])) {
  		switch ($opt) {
			case "2": echo '$("#nonLinear-rad").click();';break;
			case "3": echo '$("#Clipper-rad").click();';break;
			case "4": echo '$("#Windower-rad").click();';break;
		}
		}
		?>
	  $("button7","#Layer-2").button();
  $("button7","#Layer-2").click( function() {
		if(jstate>1) {
  	var answer = confirm("Retain Changes?")
	if (answer){
		var aurl="item=" + $(".item:last").html();
		

    $.ajax({url: "write.php" , type: "POST", data: aurl, async: false, dataType: "html", success: function(data) {
		window.location.href="piping.php?exp=piping";
		   
	     }});}
	else{
		window.location.href="piping.php?exp=piping";
	}
	}
});	
		
		
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
      <img src="images/Layer-5.jpg" alt="outputLayer" overflow="hidden"/></div>

    <!-- This is 'InputLayer_jpg' -->
    <div id="Layer-4" class="InputLayer_jpg"  >
      <img src="<?php if(isset($_GET["source"]) || $_GET["exp"]=="piping") {
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
			<div class="menu">
<div class="home">
<a onclick="confirmTo('index.html')">home</a>
</div>
<ul>
<li><a href="objective.php?exp=point" target="_self" >Objective</a>
</li>
<li><a href="intro.php?exp=point" target="_self" >Introduction</a>
</li>
<li><a href="theory.php?exp=point" target="_self" >Theory</a>
</li>
<li><a href="procedure.php?exp=point" target="_self" >Procedure</a>
</li>
<li><sel><a href="point.php" target="_self" >Experiment</a>
</sel></li>
<li><a href="#" target="_self" >Assessment</a>
				<ul>
					<li><a href="quiz.php?exp=point">Quiz</a></li>
					<li><a href="assign.php?exp=point">Assignment</a></li>
			   </ul>

</li>
<!--<li><a href="references.php?exp=point" target="_self" >References</a>
</li>-->
<li><a href="summary.php" target="_blank" >Summary</a>
</li>
</ul>
</div>
			</div>
			

    </div>

	<div id="imgInfo">
	<table>
	<tr> <th width=290>
	<?php if(isset($_GET["assess"])) { ?>Expected Output Image<?php } else {?> Input Image <?php } ?> 
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

<div id="zoom">
	
	</div>
	
	
	
    <!-- This is 'Parameters_jpg' -->
    <div id="Layer-2">

	  <h2 style="text-align: center;">Point Operations</h2>
<div id="nextBox">
	</div>
 
      <?php if (!isset($_GET["assess"]) && $_GET["exp"]!="piping")  {echo "<button1>Select Image</button1>";} ?>
      <button4>Reset</button4>
      <button2>Run</button2>
	 <?php if($_GET["exp"]=="piping") { ?> <button7>Return to Piping</button7> <?php } ?>
     
      <br/><br/>

      <div id="choice">
	<input type="radio" id="Linear-rad" name="choice1" checked="true" onclick="$('.Parameters').hide();$('#Linear').show();redrawGraph(cont);"/><label for="Linear-rad">Linear</label>
	<input type="radio" id="nonLinear-rad" name="choice1" onclick="$('.Parameters').hide();$('#nonLinear').show();redrawGraph(log);"/><label for="nonLinear-rad">Non-Linear</label>
	<input type="radio" id="Clipper-rad" name="choice1" onclick="$('.Parameters').hide();$('#clipper').show();redrawGraph(clip);"/><label for="Clipper-rad">Clipping</label>
	<input type="radio" id="Windower-rad" name="choice1" onclick="$('.Parameters').hide();$('#windower').show();redrawGraph(wind);"/><label for="Windower-rad">Window</label>

      </div>

      
      <div class="Parameters" id="Linear">
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
<div class="Parameters" id="nonLinear" style="height: 86px";>	
	Log Function
	<br/>
	f(r) = <input type="text" READONLY id="SliderLog-display" maxlength="20" value="106" size="20"/>
	<br/>c: <div id="slider-logc" class="paraSlider"></div>
	
	<script type="text/javascript">
	$(function() {
	  $("#slider-logc").slider({
	  value:<?php echo $r; ?>,
	  min: 0,
 	  max: 254,
	  step: 2,
	  slide: function(event, ui) {
	  $("#SliderLog-display").attr("value",ui.value + " x log10 (1 + r)"); 
	  },
	change: function(event, ui) {
 	    var log2 = [] ;
	    var c = $("#slider-logc").slider("option","value")*1;
	    var r = $("#slider-logr").slider("option","value")*1;
	    for(var i=0; i < 255; i++) {
			     
			 log2.push([i, (c * Math.log(i + 1)/Math.LN10)]);
			 }	     
			 redrawGraph(log2);
			     log=log2;
		 
	 }
	  });

	
	  $("#SliderLog-display").attr("value","log10 (1 + r)"); 
	  	  });
	  </script>
</div>
<div id="clipper" class="Parameters">
Clipper
<br/>
Window Start: <input type="text" READONLY id="Clipper-a-display" maxlength="10" value="100" size="3"/>
End: <input type="text" READONLY id="Clipper-b-display" maxlength="10" value="150" size="3"/>

	<div id="clipper-range-slider" class="paraSlider"></div>
Slope: <input type="text" READONLY id="Clipper-beta-display" maxlength="10" value="0" size="3"/>

	<div id="clipper-beta-slider" class="paraSlider"></div>

	<script type="text/javascript">
	$(function() {
		$("#clipper-range-slider").slider({
			range: true,
			min: 0,
			max: 255,
			values: [<?php echo $a.','.$b; ?>],
			slide: function(event, ui) {
				$("#Clipper-a-display").attr("value",ui.values[0]);
				$("#Clipper-b-display").attr("value",ui.values[1]);
			},
	change: function(event, ui) {
 	    var clip2 = [] ;
	    var a = ui.values[0];
	    var b = ui.values[1];
	    var m = Math.tan($("#clipper-beta-slider").slider("option","value")*(Math.PI/180)).toPrecision(2);
		    for(var i=0; i < 256; i++) {
			 if(i>=a&&i<=b) {   
			 clip2.push([i, i*m]); } else {
					if(i>b) { clip2.push([i , 255]); }
		else { clip2.push([i , 0]); }
			 }	 
}
			 redrawGraph(clip2);
			     clip=clip2;
		 }


		});

$("#Clipper-a-display").attr("value",100);
$("#Clipper-b-display").attr("value",150);
				
	$("#clipper-beta-slider").slider({
	  value:<?php echo $beta1; ?>,
	  min: 0,
 	  max: 45,
	  step: 1,
	  slide: function(event, ui) {
	  $("#Clipper-beta-display").attr("value",Math.tan((ui.value)*(Math.PI/180)).toPrecision(2)); 
	  },
change: function(event, ui) {
 	    var clip2 = [] ;
	    var a = $("#Clipper-a-display").attr("value");
	    var b = $("#Clipper-b-display").attr("value");
	    var m = Math.tan((ui.value)*(Math.PI/180)).toPrecision(2);
		    for(var i=0; i <= 256; i++) {
			 if(i>=a&&i<=b) {    
			 clip2.push([i, i*m]); } else { 		if(i>b) { clip2.push([i , 255]); }
		else {
					clip2.push([i , 0]);
		}	 }	 
}
			 redrawGraph(clip2);
			     clip=clip2;

		 
	 }
	  });
	  $("#Clipper-beta-display").attr("value",Math.tan($("#clipper-beta-slider").slider("option","value")*(Math.PI/180)).toPrecision(2)); 
	  });
		</script>

</div>

<div id="windower" class="Parameters">
Windowing
<br/>

Window Start: <input type="text" READONLY id="Windower-a-display" maxlength="10" value="100" size="3"/>
End: <input type="text" READONLY id="Windower-b-display" maxlength="10" value="150" size="3"/>

	<div id="Windower-range-slider" class="paraSlider"></div>
Slope: <input type="text" READONLY id="Windower-beta-display" maxlength="10" value="0" size="3"/>

	<div id="Windower-beta-slider" class="paraSlider"></div>

	<script type="text/javascript">
	$(function() {
		$("#Windower-range-slider").slider({
			range: true,
			min: 0,
			max: 255,
			values: [<?php echo $a1.','.$b1; ?>],
			slide: function(event, ui) {
				$("#Windower-a-display").attr("value",ui.values[0]);
				$("#Windower-b-display").attr("value",ui.values[1]);
			},
	change: function(event, ui) {
 	    var wind2 = [] ;
	    var a = ui.values[0];
	    var b = ui.values[1];
	    var m = Math.tan($("#Windower-beta-slider").slider("option","value")*(Math.PI/180)).toPrecision(2);
		    for(var i=0; i < 256; i++) {
			 if(i>=a&&i<=b) {   
			 wind2.push([i, i*m]); } else {
					wind2.push([i , 0]); 
			 }	 
}
			 redrawGraph(wind2);
			     wind=wind2;
		 }


		});

$("#Windower-a-display").attr("value",100);
$("#Windower-b-display").attr("value",150);
				
	$("#Windower-beta-slider").slider({
	  value:<?php echo $beta2; ?>,
	  min: 0,
 	  max: 45,
	  step: 1,
	  slide: function(event, ui) {
	  $("#Windower-beta-display").attr("value",Math.tan((ui.value)*(Math.PI/180)).toPrecision(2)); 
	  },
change: function(event, ui) {
 	    var wind2 = [] ;
	    var a = $("#Windower-a-display").attr("value");
	    var b = $("#Windower-b-display").attr("value");
	    var m = Math.tan((ui.value)*(Math.PI/180)).toPrecision(2);
		    for(var i=0; i <= 256; i++) {
	 if(i>=a&&i<=b) {   
			 wind2.push([i, i*m]); } else {
					wind2.push([i , 0]); 
			 }	 
}
			 redrawGraph(wind2);
			     wind=wind2;
		 
		 
	 }
	  });
	  $("#Windower-beta-display").attr("value",Math.tan($("#Windower-beta-slider").slider("option","value")*(Math.PI/180)).toPrecision(2)); 
	  });
		</script>

</div>
<div id="placeholder" style="margin-left: 20px; width:220px; height: 220px"></div>

</div>
<br/>
</div>
</div>
  </body>
</html>
