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

$orders[1]="Scaling";
$orders[2]="Rotation";
$orders[3]="Translation";

if(isset($_GET["assess"])) {
	$_SESSION["currentS"]=1;
	$_SESSION["id"]=$_GET["assess"];
	$_SESSION["state"]=100;
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
<meta name="description" content="Affine Transsformation Experiment in Image Processing Lab" />
<meta name="keywords" content="Affine, Image Processing Lab, Virtual Lab" />
<meta name="generator" content="Partially Generated from psd2css.com />

<!-- The CSS Reset from Eric Meyers -->
<link rel="stylesheet" type="text/css" href="cssreset.css" media="screen" />

<!-- The Primary External CSS style sheet -->
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

<!--http://www.cssmenumaker.com/builder/menu_info.php?menu=057-->
<link type="text/css" rel="StyleSheet" href="menu/menu_style.css" />

<!--for ImgSelect - http://odyniec.net/projects/imgareaselect/-->
<link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />  
<script type="text/javascript" src="js/jquery.imgareaselect.js"></script> 

<!--for Content Slider - Jquery Slider/-->
 <link rel="stylesheet" type="text/css" href="css/jquery-slider.css">

<script type="text/javascript">

function blinker(i) {
  if (buttId != "cancel" && i > 0) {
    $($(buttId), "#Layer-2").toggleClass("ui-state-hover");
    setTimeout("blinker(" + (i - 1) + ")", 500);
  }
}

function set_state(state) {
  switch (state) {
  case 0:
    $("#nextBox").html("Start the Experiment by clicking on 'Select Image' and selecting an Input Image from the Mosaic");
    buttId = "button1";
    blinker(10);
    break;
  case 1:
    $("#nextBox").html("Select appropriate parameters and click on 'Run'.");
    buttId = "button2";
    blinker(10);
    break;
  case 2:
    $("#nextBox").html("Click on the 'View Full Size Image' Button to view a closeup of the two images or on 'Reset' to start again at the beginning.");
    buttId = "button3";
    blinker(8);
    break;
  }
  jstate = state;
}

function toggleMosaic() {
  var ias = $('#Mosaic').imgAreaSelect({
    instance: true
  });
  if ($("#Mosaic").is(":visible")) {
    ias.setOptions({
      hide: true
    });
    $("#Mosaic").hide("slow");
  } else {
    $("#Mosaic").show("slow", function () {
      ias.setOptions({
        show: true
      });
      ias.update();
    });
  }
}

function para_pop(text, div) {
  $("#para_pop").html(text);
  $("#para_pop").css("display", "block");
  $("#para_pop").css("top", ($(div).offset()).top);
  $("#para_pop").show();
}

function set_crop() {
  set_state(1);
  var ias = $('#Mosaic').imgAreaSelect({
    instance: true
  });
  var sel = ias.getSelection();
  //alert('sdfsd');
  var aurl = 'x=' + sel.x1 + '&y=' + sel.y1 + '&w=' + sel.width + '&h=' + sel.height;
  $.ajax({
    url: "crop.php",
    type: "POST",
    data: aurl,
    async: false,
    dataType: "html",
    success: function (data) {
      $("#Layer-4").html(data);
    }
  });
}
//http://forgottoattach.com/javascript-dom/how-to-move-element-up-down-to-set-order-of-form-fields-in-a-table

function moveElementDown(i) {
  //swap
  var x = (i) % (3);
  var y = x + 1;
  var j = i;
  var p = $("#el" + y).attr("value");
  $("#el" + y).attr("value", $("#el" + j).attr("value"));
  $("#el" + j).attr("value", p);
  for (p = 1; p <= 3; p++) {
    if ($("input[name=order_" + p + "]").attr("value") == j) {
      j = p;
      break;
    }
  }
  for (p = 1; p <= 3; p++) {
    if ($("input[name=order_" + p + "]").attr("value") == y) {
      y = p;
      break;
    }
  }
  var k = $("input[name=order_" + y + "]").attr("value");
  $("input[name=order_" + y + "]").attr("value", $("input[name=order_" + j + "]").attr("value"));
  $("input[name=order_" + j + "]").attr("value", k);
}

function moveElementUp(i) {
  var y = (i - 1 >= 1) ? i - 1 : 3;
  var j = i;
  var p = $("#el" + y).attr("value");
  $("#el" + y).attr("value", $("#el" + j).attr("value"));
  $("#el" + j).attr("value", p);
  for (p = 1; p <= 3; p++) {
    if ($("input[name=order_" + p + "]").attr("value") == j) {
      j = p;
      break;
    }
  }
  for (p = 1; p <= 3; p++) {
    if ($("input[name=order_" + p + "]").attr("value") == y) {
      y = p;
      break;
    }
  }
  var k = $("input[name=order_" + y + "]").attr("value");
  $("input[name=order_" + y + "]").attr("value", $("input[name=order_" + j + "]").attr("value"));
  $("input[name=order_" + j + "]").attr("value", k);
}

function doTransform() {
  if (jstate == 0) {
    alert("First click on Mosaic and select the Input Image.");
    return;
  }
  var ang_val = "0";
  var xtr_val = "0";
  var ytr_val = "0";
  var sc_val = "&sc1=0&sc2=0";
  if (single1 == '1') {
    if (document.getElementById("mag").checked) {
      if ((document.getElementById("Slider4-display").value) == 0) {
        alert("Select a value on the slider.");
        return;
      }
      sc_val = "&sc1=" + (document.getElementById("Slider4-display").value);
      if (document.getElementById("magnify1").checked) {
        sc_val = sc_val + "&sc2=0";
      } else {
        sc_val = sc_val + "&sc2=1";
      }
    }
    if (document.getElementById("rot").checked) {
      ang_val = document.getElementById("Slider1-display").value;
      if (ang_val == 0) {
        alert("Select a value on the slider.");
        return;
      }
    }
    if (document.getElementById("trans").checked) {
      ytr_val = document.getElementById("Slider3-display").value;
      xtr_val = document.getElementById("Slider2-display").value;
    }
  } else {
    ang_val = document.getElementById("Slider1-display").value;
    xtr_val = document.getElementById("Slider2-display").value;
    ytr_val = document.getElementById("Slider3-display").value;
    sc_val = "&sc1=" + (document.getElementById("Slider4-display").value);
    if (document.getElementById("magnify1").checked) {
      sc_val = sc_val + "&sc2=0";
    } else {
      sc_val = sc_val + "&sc2=1";
    }
  }
  order = document.getElementById("order_1").value;
  order = order + " " + document.getElementById("order_2").value;
  order = order + " " + document.getElementById("order_3").value;
  set_state(2);
  var i;
  for (i = 0; i < document.Interpol.interTech.length; i++) {
    if (document.Interpol.interTech[i].checked == true) {
      args = "inter=" + document.Interpol.interTech[i].value;
      break;
    }
  }
  args = args + sc_val + "&ang=" + ang_val + "&xtr=" + xtr_val + "&ytr=" + ytr_val + "&order=" + order;
  if (args != "0 0 0 0" && !($('#Mosaic').is(":visible"))) {
    var aurl = 'trns.php?opn=affine&' + args;
    $("#slider").remove();
    $.ajax({
      url: aurl,
      type: "GET",
      async: false,
      dataType: "html",
      success: function (data) {
        $(".content-conveyor", $("#sliderContent")).html(data);
      }
    });
    $("#sliderContent").append('<div id="slider"></div>');
    var conveyor2 = $(".content-conveyor", $("#sliderContent")),
        item2 = $(".item", $("#sliderContent"));
    //set length of conveyor
    conveyor2.css("width", item2.length * parseInt(item2.css("width")));
    conveyor2.css("left", "-" + ((item2.length * parseInt(item2.css("width"))) - parseInt($(".viewer", $("#sliderContent")).css("width"))) + "px");
    //config
    var sliderOpts = {
      max: (item2.length * parseInt(item2.css("width"))) - parseInt($(".viewer", $("#sliderContent")).css("width")),
      value: (item2.length * parseInt(item2.css("width"))) - parseInt($(".viewer", $("#sliderContent")).css("width")),
      slide: function (e, ui) {
        conveyor2.css("left", "-" + ui.value + "px");
      }
    };
    //create slider
    $("#slider").slider(sliderOpts);
    $("img", $("#Layer-5")).attr("src", $("img", $(".item:last")).attr("src"));
    $(".item").each(function () {
      $(this).click(function () {
        $(this).popUpImg();
      });
    });
  } else {
    alert("Select some paramters first");
  }
  var myImage = new Image();
  myImage.name = $("img", $("#Layer-5")).attr("name");
  myImage.src = $("img", $("#Layer-5")).attr("src");
  myImage.onload = function () {
    $("dims", "#imgInfo").html(this.height + " x " + this.width);
    $("img", $("#Layer-5")).css("height", this.height * .93666);
    $("img", $("#Layer-5")).css("width", this.width * .93666);
  }
}

jQuery.fn.popUpImg = function () {
  var o = $(this[0]) // It's your element
  $("#fullImg", $(".imageFull", "#Layer-1")).attr("src", $("img", $(o)).attr("src"));
  $(".imageFull").show("slow");
};

function disableRest(name) {
  if (name == "#tran") {
    $("#Interpol").addClass('transdiv');
    $("input", "#Interpol").attr("disabled", "true");
  } else {
    $("#Interpol").removeClass('transdiv');
    $("input", "#Interpol").removeAttr("disabled");
  }
  $("input", ".param").attr("disabled", "disabled");
  $("input", name).removeAttr("disabled");
  $('.paraSlider', '.param').each(function (index) {
    $(this).slider("disable");
  });
  $('.paraSlider', name).slider("enable");
  $('.param').addClass('transdiv');
  $(name).removeClass('transdiv');
}
  
  
function confirmTo(url) {
	var response = confirm('You will lose Session Data: Continue?');
	if(response) {
		window.location.href=url;
	}
}
  
  $(document).ready (function() {

<?php
if(isset($_GET["order"])) {
	if($_GET["order"]=="1 2 3") {
		echo '
		$.each($("input[name=para]"), function() {
					$(this).removeAttr("checked");
			
			});';
		if($_GET["sc2"]>0) {
		echo '$("#mag").click();';
	} else {
		if($_GET["ang"]>0) {
			echo '$("#rot").click();';
			} else {
				echo '$("#trans").click();';
			}
		}
	} else {
		echo '$("radio2").click();';
		$order = explode(" ", $_GET["order"]);
		echo '$("#order_1").attr("value","'.$order[1].'");
		$("#order_2").attr("value","'.$order[2].'");
		$("#order_3").attr("value","'.$order[3].'");
		';
	}
}

	
if(isset($_GET["inter"])) {
 echo '	
	$.each($("input[name=Operatn]"), function() {
                $(this).removeAttr("checked");
        
        });
	document.Interpol.interTech['.($_GET["inter"]-1).'].checked = true;';
}


if(isset($_GET["sc2"])) {
 echo '	

	$.each($("input[name=magnify]"), function() {
                $(this).removeAttr("checked");
        
        });
	$("#magnify'.($_GET["sc2"]+1).'").attr("checked","true");';
}


if($_GET["exp"]=="piping"  || isset($_GET["assess"])) {
	echo 'set_state(1);';
} else {
	echo 'set_state(0);';
}

?>


	$(".imageFull").hide();
	$("#popUp").hide();

	$("#radio").buttonset();
	$("#radio").button("refresh");
	$("button1","#Layer-2").button();
	$("button1","#Layer-2").click( function() {
		toggleMosaic();
	});


	$("button2","#Layer-2").button();

	$("button5",".Parameters").button();
	$("button5",".Parameters").click( function () {
		$("#popUp").show();
	});
	$("button5",".Parameters").hide();

	$("button6","#popUp").button();
	$("button6","#popUp").click( function () {
		$("#popUp").hide();
	});
	$("button4","#Layer-2").button();
	$("button4","#Layer-2").click ( function () {
		$(".paraSlider").slider("option","value","0");
		$("dims","#imgInfo").html("__ x __");
 <?php if($_GET["exp"]!="piping" && !isset($_GET["assess"])) { echo ' set_state(0);'; } 
		else { echo 'set_state(1);'; }?>
		$("img",$("#Layer-5")).attr("src","images/Layer-5.jpg");  
		<?php  if( $_GET["exp"]!="piping" ) { ?>
		$("img",$("#Layer-4")).attr("src","<?php if(isset($_GET["assess"])) { echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'_result.png'; } 
		else { echo 'images/Layer-4.jpg'; } ?>"); <?php } ?>
		$("#sliderContent").replaceWith('      <div id="sliderContent" class="ui-corner-all">		<div class="viewer ui-corner-all">	  <div class="content-conveyor ui-helper-clearfix">	    <div class="item">	      <h2><?php if(isset($_GET["assess"])) {	  echo 'Assessment';	  } else { echo 'Start'; } ?></h2>	      <img src="<?php if(isset($_GET["assess"])) {	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.png';	  } else { echo 'images/Mosaic.png'; } ?>" alt="picture" width="140px" height="140px"/>	      <dl class="details ui-helper-clearfix">		<dt><?php if(isset($_GET["assess"])) {	  echo 'This is the Input Image. Perform Operations to get the above result.';	  } else { echo 'Select a portion of the Mosaic on the Right and Transform... '; } ?></dt>	      </dl>	    </div>	  </div>	</div>	<div id="slider"></div>      </div>');
		resetPos();
	});

	$("button2","#Layer-2").click ( function () {
		doTransform();
	});

	$("button3","#zoom").button();
	$("button3","#zoom").click( function() {
		if($("img","#Layer-5").attr("height") < 281) {
			  alert("This is the full size.");
			  return;
		}

		if(jstate==2) {
			$("#Layer-5").popUpImg();
		} else {
			alert("'Run' and get an output first.");
		}
	});
	single1='1';

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
	  
	  
});

</script>


</head>


<body>

  <!-- This is 'Backgound_bkgnd_center_jpg' -->
  <div id="Layer-1" class="Backgound_bkgnd_center_jpg"  >

    <div id="para_pop"> </div>

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
    <div id="Layer-5" class="outputLayer_jpg"  style="overflow: auto;">
      <img src="images/Layer-5.jpg" alt="outputLayer" /></div>

    <!-- This is 'InputLayer_jpg' -->
    <div id="Layer-4" class="InputLayer_jpg"  >
      <img src="<?php if(isset($_GET["source"]) || $_GET["exp"]=="piping") {
	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.png" width="281" height="281" ';
	  } else { if(isset($_GET["assess"])) { echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'_result.png" '; } 
		else { echo 'images/Layer-4.jpg" width="281" height="281"'; }} ?> alt="InputLayer" /></div>

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
<li><a href="objective.php?exp=affine" target="_self" >Objective</a>
</li>
<li><a href="intro.php?exp=affine" target="_self" >Introduction</a>
</li>
<li><a href="theory.php?exp=affine" target="_self" >Theory</a>
</li>
<li><a href="procedure.php?exp=affine" target="_self" >Procedure</a>
</li>
<li><sel><a href="affine.php" target="_self" >Experiment</a>
</sel></li>
<li><a href="#" target="_self" >Assessment</a>
				<ul>
					<li><a href="quiz.php?exp=affine">Quiz</a></li>
					<li><a href="assign.php?exp=affine">Assignment</a></li>
			   </ul>

</li>
<!--<li><a href="references.php?exp=affine" target="_self" >References</a>
</li> -->
<li><a href="summary.php" target="_blank" >Summary</a>
</li>
</ul>
</div>
			</div>
			

    </div>

	<div id="imgInfo">
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
	
	<div id="zoom">
	<button3>View Full Size Image</button3>
	</div>
	

	
    <!-- This is 'Parameters_jpg' -->
    <div id="Layer-2">

	  <h2 style="text-align: center;"> Affine Transformation</h2>
<div id="nextBox"></div>
 
     <?if (!isset($_GET["assess"]) && $_GET["exp"]!="piping")  {echo "<button1>Select Image</button1>";} ?>
      <button4>Reset</button4>
      <button2>Run</button2>
	 <?if($_GET["exp"]=="piping") { ?> <button7>Return to Piping</button7> <?php } ?>
      <br/><br/>
      <div id="radio">
	<input type="radio" id="single" name="choice" checked="checked"
	       onclick="$('input[name=para]','.Parameters').attr('style','margin-right: 12px;');	
		   $('input[name^=order]').attr('style','display:none;');			   
		   $('button5','.Parameters').hide();
	       disableRest('#magn'); $('#mag').attr('checked','true'); single1='1';"/><label for="single">Single Choice</label>
	<input type="radio" id="radio2" name="choice"
	       onclick="$('input[name=para]','.Parameters').attr('style','display:none');
		   $('input[name^=order]').attr('style','text-align: center; border: 1px cyan solid;');
	       $('input','.param').removeAttr('disabled');
	       $('.param').removeClass('transdiv');
	       $('button5','.Parameters').show();
	       $('input','#Interpol').attr('disabled','true');
	       $('input','#Interpol').removeAttr('checked');
	       $('#ytrans').attr('checked','checked');
	       $('#xtrans').attr('checked','checked');
	       $('#Interpol').addClass('transdiv'); single1='0';
	       $('#popUp').show();
		$('.paraSlider','.param').each(function(){$(this).slider('enable');});
	       $('#inter1').attr('checked','true'); "/><label for="radio2">Multiple Choice</label>
      </div>


      
      <div class="Parameters">
<table>	
<tr><td width="150px">
	<h3><input id="mag" type="radio" name="para" value="1" checked
	   onclick="disableRest('#magn');" style="margin-right: 12px"/> <input type="text"
	   id="order_1" name="order_1" size="1" maxlength="1" value="1" style="text-align:
	   right; display:none" READONLY/>
Scaling (2^x) </h3>
	<div id="magn" class="param">
	  <input id="magnify1" type="radio" name="magnify" value="1"/> Upscale
	  <br/>
	  <input id="magnify2" type="radio" name="magnify" value="2" checked /> Downscale
	  <br/>x : <input type="text" id="Slider4-display" maxlength="10"
	  value="0" size="3" READONLY/>
	  <div id="slider-4" class="paraSlider"></div>
	  
	  <script type="text/javascript">
	    $(function() {
	    $("#slider-4").slider({
	  value:<?php if(isset($_GET["sc1"])) { echo $_GET["sc1"]; } else {echo "0";} ?>,
	  min: 0,
 	  max: 5,
	  step: 1,
	  slide: function(event, ui) {
	  $("#Slider4-display").attr("value",ui.value); 
	  }
	  });
	  $("#Slider4-display").attr("value",$("#slider-4").slider("option","value"));
	});
	</script>

</div>
</td><td width="50px">
<div id="Interpol">
	Interpolation Technique : 
<form name="Interpol">
<input id="inter1" type="radio" name="interTech" value="1" checked/>Nearest<br />
<input type="radio" name="interTech" value="2" />Bilinear<br/>
<input type="radio" name="interTech" value="3" />Bicubic<br/>
</form> 
</div>

</td>

</tr>

<tr><td colspan="2">

<h3><input id="rot" name="para" type="radio" value="2"
	   onclick="disableRest('#rotn');" style="margin-right: 12px"/> <input type="text"
	   id="order_2" name="order_2" size="1" maxlength="1" value="2" style="text-align:
	   right; display:none" READONLY/>
Rotation </h3> 
<div id="rotn" class="param transdiv">	
	(Anti-clockwise 0-360&deg;)<br/>
	Angle in degrees: <input type="text" id="Slider1-display"
	maxlength="10" value="0" size="3"/>
	<div id="slider-1" class="paraSlider"></div>

	<script type="text/javascript">
	$(function() {
	  $("#slider-1").slider({
	  value:<?php if(isset($_GET["ang"])) { echo $_GET["ang"]; } else {echo "0";} ?>,
	  min: 0,
 	  max: 360,
	  step: 2,
	  slide: function(event, ui) {
	  $("#Slider1-display").attr("value",ui.value); 
	  }
	  });
	  $("#Slider1-display").change( function () {
	    var k = $("#Slider1-display").attr("value");   
	    if( k > 360 ) {
	      $("#slider-1").slider("option","value",360);
	      $("#Slider1-display").attr("value",360);
	    } else { 
	      if ( k < 0 ) {
  	        $("#slider-1").slider("option","value",0);
	        $("#Slider1-display").attr("value",0);
	      } else {
 		if(k >= 0 && k<= 360) { 
				 $("#slider-1").slider("option","value",$("#Slider1-display").attr("value"));
}
              }
            }
	  });
	  $("#Slider1-display").attr("value",$("#slider-1").slider("option","value"));
	});
	</script>
</div>
</tr></table>

	<h3><input id="trans" type="radio" name="para" value="3"  onclick="disableRest('#tran');" style="margin-right: 12px"/> <input type="text"
	   id="order_3" name="order_3" size="1" maxlength="1" value="3" style="text-align:
	   right; display:none" READONLY/>
	  Translation</h3>
	<div id="tran" class="param transdiv">	X-Translation (Pixels) <input type="text" id="Slider2-display" maxlength="10" value="0" size="3"/>
	<div id="slider-2" class="paraSlider"></div>

	<script type="text/javascript">
	$(function() {
	  $("#slider-2").slider({
	  value:<?php if(isset($_GET["xtr"])) { echo $_GET["xtr"]; } else {echo "0";} ?>,
	  min: 0,
 	  max: 300,
	  step: 2,
	  slide: function(event, ui) {
	  $("#Slider2-display").attr("value",ui.value); 
	  }
	  });
	  $("#Slider2-display").change( function () {
	    var k = $("#Slider2-display").attr("value");   
	    if( k > 360 ) {
	      $("#slider-2").slider("option","value",360);
	      $("#Slider2-display").attr("value",360);
	    } else { 
	      if ( k < 0 ) {
  	        $("#slider-2").slider("option","value",0);
	        $("#Slider2-display").attr("value",0);
	      } else {
		if(k >= 0 && k<= 300) { 
 		$("#slider-2").slider("option","value",$("#Slider2-display").attr("value"));
              }}
            }
	  });
	  $("#Slider2-display").attr("value",$("#slider-2").slider("option","value"));
	});
	</script>


	<br/>Y-Translation (Pixels) <input type="text" id="Slider3-display" maxlength="10" value="0" size="3"/>
	<div id="slider-3" class="paraSlider"></div>

	<script type="text/javascript">
	$(function() {
	  $("#slider-3").slider({
	  value:<?php if(isset($_GET["ytr"])) { echo $_GET["ytr"]; } else {echo "0";} ?>,
	  min: 0,
 	  max: 300,
	  step: 2,
	  slide: function(event, ui) {
	  $("#Slider3-display").attr("value",ui.value); 
	  }
	  });
	  $("#Slider3-display").change( function () {
	    var k = $("#Slider3-display").attr("value");   
	    if( k > 360 ) {
	      $("#slider-3").slider("option","value",360);
	      $("#Slider3-display").attr("value",360);
	    } else { 
	      if ( k < 0 ) {
  	        $("#slider-3").slider("option","value",0);
	        $("#Slider3-display").attr("value",0);
	      } else {
		if(k >= 0 && k<= 300) { 
 		$("#slider-3").slider("option","value",$("#Slider3-display").attr("value"));
              }}
            }
	  });
	  $("#Slider3-display").attr("value",$("#slider-3").slider("option","value"));
	});
</script>
</div>
<br/>
<button5>Change Order of Operations</button5>
	  

    </div>

      </div>
          <div class="imageFull">
 <div id="closeBut" style="position: absolute; right: 15px; top: 5px;">
	     <img src="images/close.png" onclick="$('.imageFull').hide('slow'); return false;"> 
	 </div>
		

     <div style="max-height: 680px; max-width: 680px; overflow: auto;"><img id="fullImg" href="#"> </div>
	</div>
	  
	  <div id="popUp">
	  <h4> Change Order of Operation </h4>(first to last)
		<form action="#" method="post">
		<table style="	border-width: 1px;
	border-spacing: 3px;
	border-style: dashed;
	border-color: gray;
	border-collapse: separate; margin: 15px;">
		<tr>
		  <td><input type="text" size="20" value="Scaling" id="el1"></td>
		  <td>
			<input type="button" onClick="moveElementUp(1); " value="&uarr;">
			<input type="button" onClick="moveElementDown(1); " value="&darr;">
		  </td>
		</tr>
		<tr>
		  <td><input type="text" size="20" value="Rotation" id="el2"></td>
		  <td>
			<input type="button" onClick="moveElementUp(2);" value="&uarr;">
			<input type="button" onClick="moveElementDown(2);" value="&darr;">
		  </td>
		</tr>
		<tr>
		  <td><input type="text" size="20" value="Translation" id="el3"></td>
		  <td>
			<input type="button" onClick="moveElementUp(3);" value="&uarr;">
			<input type="button"  onClick="moveElementDown(3);" value="&darr;">
		  </td>
		</tr>
		</table>
		</form>
		<button6>Done</button6>
		
		</div>
	</div>
  </body>
</html>
