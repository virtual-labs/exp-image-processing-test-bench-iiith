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
at http://jquery.com <script type="text/javascript" src="js/jquery-1.4.2.min.js"> -->
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
//case 2: $("#nextBox").html("Observe the hostogram, try making changes to the bin size and observe the trends.");
case 2: $("#nextBox").html("Note down the results");
break;
case 3: $("#nextBox").html("Click on each of the four subgraphs to view the full size.");
break;
}
jstate=state;
}

</script>

<script tyre="text/javascript">


function set_crop() {
    set_state(1);


    var ias = $('#Mosaic').imgAreaSelect({ instance: true });
	var sel=ias.getSelection();

    //alert('sdfsd');

    var aurl='x=' + sel.x1 + '&y=' + sel.y1 + '&w=' + sel.width + '&h=' + sel.height + '&exp=histo';


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
	
	var checkBoxes = $("input[name=choice1]");
	
	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = $(this).attr('value');
          	}	
        });

	if(args=="1") {
	checkBoxes = $("input[name=quad]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = $(this).attr('value');
           	
			if($(this).attr('value')=='1') {
			$("#overlay").css("display","none");
			}

       }
        });

	checkBoxes = $("input[name=binning]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
			args = args + "&bins=" + $(this).attr('value');	
          	}	
        });
		
		} else {
			$("#overlay").css("display","none");
	
checkBoxes = $("input[name=option2]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = $(this).attr('value');
			
			
          	}	
        });
	
	
		checkBoxes = $("input[name=filtsize]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = args + "&size=" + $(this).attr('value');
			
			
          	}	
        });
		checkBoxes = $("input[name=windsize]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = args + "&wsize=" + $(this).attr('value');
			
			
          	}	
        });

	
	}

	if(!($('#Mosaic').is(":visible"))) {
	
	var aurl = "trns.php?opn=histo&mode=" + args;
       $("#slider").remove();	
       $.ajax({ url: aurl, type: "GET", async: false, dataType: "html", success: function(data){
		$(".content-conveyor", $("#sliderContent")).html(data);	
	}});
	$("#sliderContent").append('<div id="slider"></div>');
    
	var conveyor2 = $(".content-conveyor", $("#sliderContent")),
	item2 = $(".item", $("#sliderContent"));
	conveyor2.css("left","0px");
	
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
if($("#quad4").attr("checked")) {
set_state(3);



     		 $(".item").each(function() {
    		 $(this).click(function() {
$("#hist_title").html($("h2",$(this)).html()); 
$("#hist_prop").html($("dt:last",$(this)).html()); 
$("img",$("#Layer-5")).attr("src",$("img",$(this)).attr("src"));

});});

$("#overlay").css("display","block");
        	} else {set_state(2);}

$("#hist_title").html($("h2",$(".item:last")).html()); 
$("#hist_prop").html($("dt:last",$(".item:last")).html()); 


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
buttId="button1";
    <?php if($_GET["exp"]=="piping" || isset($_GET["assess"])) {
	echo "set_state(1);"; } else { echo "set_state(0);"; ;
	} 
	
  if(isset($_GET["mode"])) {
 echo '	
 
 if('.$_GET["mode"].'<3) {
	$.each($("input[name=quad]"), function() {
                $(this).removeAttr("checked");
        
        });
		
		$.each($("input[name=quad]"), function() {
                if ($(this).attr("value")=='.$_GET["mode"].') {
					$(this).attr("checked","true");
					}        
        });
		
		} else {
		$("#Advanced-rad").click();
		$(".simple").hide(); $("#Advanced").show(); 
		
					
		$.each($("input[name=option2]"), function() {
                if ($(this).attr("value")=='.$_GET["mode"].') {
					$(this).click();
					}        
        });
		
		}
		
		';
		}
		
		if(isset($_GET["bins"])) {
		
		echo '
			$.each($("input[name=binning]"), function() {
                $(this).removeAttr("checked");
        
        });
		
		$.each($("input[name=binning]"), function() {
                if ($(this).attr("value")=="'.$_GET["bins"].'") {
					$(this).attr("checked","true");
					}        
        });
		';
		
}

		if(isset($_GET["size"])) {
		
		echo '
			$.each($("input[name=filtsize]"), function() {
                $(this).removeAttr("checked");
        
        });
		
		$.each($("input[name=filtsize]"), function() {
                if ($(this).attr("value")=="'.$_GET["size"].'") {
					$(this).attr("checked","true");
					}        
        });
		';
		
}
		if(isset($_GET["wsize"])) {
		
		echo '
			$.each($("input[name=windsize]"), function() {
                $(this).removeAttr("checked");
        
        });
		
		$.each($("input[name=windsize]"), function() {
                if ($(this).attr("value")=="'.$_GET["wsize"].'") {
					$(this).attr("checked","true");
					}        
        });
		';
		
}
  ?>
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
 <?php if($_GET["exp"]!="piping" && !isset($_GET["assess"])) { echo ' set_state(0);'; } 
		else { echo 'set_state(1);'; }?>
$("#overlay").css("display","none");
    $("dims","#imgInfo").html("____ x ____ ");
    $("img",$("#Layer-5")).attr("src","images/Layer-5.jpg");  
<?php  if( $_GET["exp"]!="piping" ) { ?> 
 $("img",$("#Layer-4")).attr("src","<?php if(isset($_GET["assess"])) { echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'_result.png'; } 
		else { echo 'images/Layer-4.jpg'; } ?>"); <?php } ?>
$("#sliderContent").replaceWith('      <div id="sliderContent" class="ui-corner-all">		<div class="viewer ui-corner-all">	  <div class="content-conveyor ui-helper-clearfix">	    <div class="item">	      <h2><?php if(isset($_GET["assess"])) {	  echo 'Assessment';	  } else { echo 'Start'; } ?></h2>	      <img src="<?php if(isset($_GET["assess"])) {	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.png';	  } else { echo 'images/Mosaichisto.png'; } ?>" alt="picture" width="140px" height="140px"/>	      <dl class="details ui-helper-clearfix">		<dt><?php if(isset($_GET["assess"])) {	  echo 'This is the Input Image. Perform Operations to get the above result.';	  } else { echo 'Select a portion of the Mosaic on the Right and Transform... '; } ?></dt>	      </dl>	    </div>	  </div>	</div>	<div id="slider"></div>      </div>');
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
    $("#choice").buttonset();
  $("#choice").button("refresh");
  
   $('#Advanced').hide(); 
   	$("button7","#Layer-2").button();
	$("button7","#Layer-2").click( function() {
		if(jstate>1) {
			var answer = confirm("Retain Changes?")
			if (answer) {
				var aurl="item=" + $(".item:last").html();

				$.ajax({url: "write.php" , type: "POST", data: aurl, async: false, dataType: "html", success: function(data) {
				window.location.href="piping.php?exp=piping";

				}});
			}
		else {
			window.location.href="piping.php?exp=piping";
		}
		}
	});
	
	<?php 
	if($_GET["exp"]=="piping") {
	echo '	$("#Advanced-rad").click();
			$("#choice").hide(); ';
	}
	?>
});



</script>
</head>


<body>

  <!-- This is 'Backgound_bkgnd_center_jpg' -->
  <div id="Layer-1" class="Backgound_bkgnd_center_jpg"  >
    

    <!-- This is 'Mosaic_jpg' -->
    <div id="Mosaic" class="Mosaic_jpg"  >
      <img src="images/Mosaichisto.png" width="513" height="513" alt="Mosaic" /></div>

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
	  } else { echo 'images/Mosaichisto.png'; } ?>" alt="picture" width="140px" height="140px"/>
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
      <img src="images/Layer-5.jpg" alt="outputLayer" width="281px"
      height="281px"/></div>
<div id="ruler2" class="simple">
<tt style="bottom: 2px">0</tt>

<mm></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
</div>

    <!-- This is 'InputLayer_jpg' -->
    <div id="Layer-4" class="InputLayer_jpg"  >
      <img src="<?php if(isset($_GET["source"])  || $_GET["exp"]=="piping") {
	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.png';
	  } else { if(isset($_GET["assess"])) { echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'_result.png'; } 
		else { echo 'images/Layer-4.jpg'; }} ?>" width="281" height="281" alt="InputLayer"/></div>
<div class="simple" >
<div style="display: none; position: absolute;  left: 325px;  top: 124px;  z-index: 15;" id="overlay">       <img src="histo/overlay.png"/> </div> 
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
<li><a href="objective.php?exp=histo" target="_self" >Objective</a>
</li>
<li><a href="intro.php?exp=histo" target="_self" >Introduction</a>
</li>
<li><a href="theory.php?exp=histo" target="_self" >Theory</a>
</li>
<li><a href="procedure.php?exp=histo" target="_self" >Procedure</a>
</li>
<li><sel><a href="histo.php" target="_self" >Experiment</a>
</sel></li>
<li><a href="#" target="_self" >Assessment</a>
				<ul>
					<li><a href="quiz.php?exp=histo">Quiz</a></li>
					<li><a href="assign.php?exp=histo">Assignment</a></li>
			   </ul>
</li>
<!--
<li><a href="references.php?exp=histo" target="_self" >References</a>
</li>
-->
<li><a href="summary.php" target="_blank" >Summary</a>
</li>
</ul>
</div>
			</div>
			

    </div>

	<div id="imgInfo">
<div id="ruler1" class="simple">
<tt style="left: 2px">0</tt>
<tt style="right: 4px">255</tt>
<mm></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
<mm><e2> </e2></mm>
<mm><ee> </ee></mm>
</div>
	<table style="margin-top: 25px">
	<tr> <th width=290>
	Input size
	</th> <th id="hist_title">
	Histogram Properties
	</th> </tr>
	<tr><td> 300 x 300 </td>
	<td id="hist_prop">
	Min= ___  Avg=___ Max=___
	</td> </tr>
	</table>
	</div>
	
	
    <!-- This is 'Parameters_jpg' -->
    <div id="Layer-2">

	  <h2 style="text-align: center;">Image Histogram</h2>
<div id="nextBox">
</div>
 
      <?if (!isset($_GET["assess"]) && $_GET["exp"]!="piping")  {echo "<button1>Select Image</button1>";} ?>
      <button4>Reset</button4>
      <button2>Run</button2>
	 <?if($_GET["exp"]=="piping") { ?> <button7>Return to Piping</button7> <?php } ?>
   <br/><br/>
	  
	  
<div id="choice">
	<input type="radio" id="Simple-rad" name="choice1" value="1" checked onclick=" $('.Parameters').hide(); $('.simple').show();"/><label for="Simple-rad">Histogram</label>
	<input type="radio" id="Advanced-rad" name="choice1" value="2" onclick="$('.simple').hide(); $('#Advanced').show(); "/><label for="Advanced-rad">Processing</label>
	</div>
	


<div class="Parameters simple">

<div id="binn" class="param" >

<div style="display:none;">	
<h3>&nbsp;Number of Bins</h3> 
<form name="bins">
<input type="radio" name="binning" value="256" checked/>256<br />
<input type="radio" name="binning" value="128" />128<br/>
<input type="radio" name="binning" value="64" />64<br/>
<input type="radio" name="binning" value="32" />32<br/>
</form> 
</div>


<h3>&nbsp;Histogram Type</h3> 
<input type="radio" name="quad" value="1" onclick="$('#placeholder').css('display','none');" checked /> Full Image Histogram <br/>
<input type="radio" name="quad" id="quad4" value="2" onclick="$('#placeholder').css('display','block');"/> Sub-image Histogram

</div>
</div>
<div class="Parameters" id="Advanced">

<h3>&nbsp;Processing Options:</h3> 
<input type="radio" name="option2" onclick="$('#size').hide();$('#size2').hide();" value="3" checked>Global Histogram Equalization<br>
<input type="radio" name="option2" onclick="$('#size').hide();$('#size2').show();" value="4">Adaptive Histogram Equalization<br>

<div id="size2" style="display:none; margin-left: 25px; font-size: 12px; ">
Window Size:  <br/>
<input type="radio" name="windsize" value="50" checked/> 50 x 50 pixels<br />
<input type="radio" name="windsize" value="100" /> 100 x 100 pixels<br/>
</size>
</div>

<input type="radio" id="sizes" name="option2" onclick="$('#size').show();$('#size2').hide();" value="5">Filtering on Histogram<br>

<div id="size" style="display:none; margin-left: 25px; font-size: 12px; ">
Size of Filter:  <br/>
<input type="radio" name="filtsize" value="2" checked/>2<br />
<input type="radio" name="filtsize" value="4" />4<br/>
<input type="radio" name="filtsize" value="6" />6<br/>
</size>

</div></div>
<div class="simple">
<div id="placeholder" style="margin-left: 30px; width:220px; padding: 5px; display: none; height: 220px"><img src="histo/quads.png" height="220px" width="220px"></div>
</div></div></div>



</body>


