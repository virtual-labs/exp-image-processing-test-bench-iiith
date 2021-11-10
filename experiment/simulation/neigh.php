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
at http://jquery.com <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"> -->
<script type="text/javascript" src="js/jquery-1.4.2.min.js"> </script> 


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

<style> 
input[type="text"] {
margin: 0px 20px 5px 20px; 
font-family: "courier new";
font-size: 16px;}

</style>

<!--for Flot -->
<script type="text/javascript" src="js/jquery.flot.js"></script> 

<!--for COntent Slider - Jquery Slider/-->
 <link rel="stylesheet" type="text/css" href="css/jquery-slider.css">


<script type="text/javascript">

function verify(inp) {
var myRegxp1 = /^( )*([-]*[\.\d]{1,5}( )+){3}( )*$/;
var myRegxp2 = /^( )*([-]*[\.\d]{1,5}( )+){5}( )*$/;
   if(inp==1) {
     if(myRegxp2.test($("#r"+inp).attr("value")+" ")){
       standard=2;
     } else {
       if(myRegxp1.test($("#r"+inp).attr("value")+" ")) { 
         standard=1; 
       } else {
         $("#r"+inp).css("color","red"); return 0;
       }
     }
   } else {
     if((myRegxp2.test($("#r"+inp).attr("value")+" ") & standard==2) | (myRegxp1.test($("#r"+inp).attr("value")+" ") & standard==1) | ($("#r"+inp).attr("value")=='') & standard==1 & (inp==4 | inp==5)) { 
       $("#r"+inp).css("color","#FFFFFF"); 
     } else {
       $("#r"+inp).css("color","red"); return 0;
     }

   }
   return 1;

}

function values(a,b,c,d,e) { 
$("#r1").attr("value",a);
$("#r2").attr("value",b);
$("#r3").attr("value",c);
$("#r4").attr("value",d);
$("#r5").attr("value",e);

}

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


//

function set_crop() {
    set_state(1);


    var ias = $('#Mosaic').imgAreaSelect({ instance: true });
	var sel=ias.getSelection();

    //alert('sdfsd');

    var aurl='x=' + sel.x1 + '&y=' + sel.y1 + '&w=' + sel.width + '&h=' + sel.height;


    $.ajax({url: "crop.php" , type: "POST", data: aurl, async: false, dataType: "html", success: function(data) {
		$("#Layer-4").html(data);		


	       
	     }});
$("#start").css("display","block");
$("#end").css("display","block");


}


</script>




<script type="text/javascript">
function doTransform(){

    	if(jstate == 0) {
	    alert("First click on Mosaic and select the Input Image.");
            return;

    	}

	var args,size;

	
	var checkBoxes = $("input[name=type]");

	$.each(checkBoxes, function() {
                if ($(this).attr('checked')){
           	args = $(this).attr('value');

        	}	
        });



 if(args=="4") {

              if(verify('1') && verify('2') && verify('3') && verify('4') && verify('5')) {
               if(standard == 2) {
               args="4_5_";

    } else { args="4_3_";}
               args= args + " " + $("#r1").attr("value") + " " + $("#r2").attr("value") + " " + $("#r3").attr("value") + " " + $("#r4").attr("value") + " " + $("#r5").attr("value"); 
    }

    else {
    alert("Please verify the Custom Filter Entries");
    return;
    }
    }



    checkBoxes = $("input[name=size]");

        $.each(checkBoxes, function() {
                if ($(this).attr('checked')){

                size = parseFloat($(this).attr('value'));
                }       

        });

    if(args=="1")
    {


    args="1_"+size+"_";
    var i,j;
    for(i=1;i<=size;i++) {
    for(j=1;j<=size;j++) {
    args = args + " 1";}
    }}



    if(args=="2") {
    args="2_"+size+"_";
    var i,j;
    for(i=0;i<size;i++) {
    for(j=0;j<size;j++) {
    if(i+j<(size/2)-1 | i-j>(size/2) | j-i>(size/2) | j+i>size-1+size/2) {
    args = args + " 0";
    }

    else { args=args+" 1";
    }}}}

    if(args=="3") {
    if(size=="3") {args="3_3_";
    args=args + " 0.0113 0.0838 0.0113 0.0838 0.6193 0.0838 0.0113 0.0838 0.0113";
    } else if(size=="5") { args="3_5_";
	args=args + " 300  133  219  133  300 133  596  983  596  133 219  983  162.1  983  219 133  596  983  596  133 300  133  219  133  300";
	} else if(size=="7") { args="3_7_";
	args=args + " 49 92 134 152 134 92 49 92 172 250 283 250 172 92 134 250 364 412 364 250 134 152 283 412 467 412 283 152 134 250 364 412 364 250 134 92 172 250 283 250 172 92 49 92 134 152 134 92 49";


	}
	}

    if(args=="5") {
    args="5_2_ "+size;
    }



	if(!($('#Mosaic').is(":visible"))) {
	var aurl = "trns.php?opn=neigh&args=" + args;
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

set_state(2);

       

    $("img",$("#Layer-5")).attr("src",$("img",$(".item:last")).attr("src")); 

       
var myImage = new Image();
myImage.name = $("img",$("#Layer-5")).attr("name");
myImage.src = $("img",$("#Layer-5")).attr("src");
myImage.onload = function () {
  $("dims","#imgInfo").html(this.height + " x " + this.width);
}}}

 
function confirmTo(url) {
	var response = confirm('You will lose Session Data: Continue?');
	if(response) {
		window.location.href=url;
	}
}
 

  $(document).ready (function() {
  buttId="button1";
      <?php if($_GET["exp"]=="piping"  || isset($_GET["assess"])) {
	echo "set_state(1);"; } else {echo "set_state(0);"; ;
	} ?>
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
    $("dims","#imgInfo").html("____ x ____ ");
    $("img",$("#Layer-5")).attr("src","images/Layer-5.jpg");  
  <?php  if( $_GET["exp"]!="piping" ) { ?>
  $("img",$("#Layer-4")).attr("src","<?php if(isset($_GET["assess"])) { echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'_result.png'; } 
		else { echo 'images/Layer-4.jpg'; }?>"); <?php } ?>
$("#sliderContent").replaceWith('      <div id="sliderContent" class="ui-corner-all">		<div class="viewer ui-corner-all">	  <div class="content-conveyor ui-helper-clearfix">	    <div class="item">	      <h2><?php if(isset($_GET["assess"])) {	  echo 'Assessment';	  } else { echo 'Start'; } ?></h2>	      <img src="<?php if(isset($_GET["assess"])) {	  echo 'images/temp/'.$_SESSION["id"].'_'.$_SESSION["currentS"].'.png';	  } else { echo 'images/Mosaic.png'; } ?>" alt="picture" width="140px" height="140px"/>	      <dl class="details ui-helper-clearfix">		<dt><?php if(isset($_GET["assess"])) {	  echo 'This is the Input Image. Perform Operations to get the above result.';	  } else { echo 'Select a portion of the Mosaic on the Right and Transform... '; } ?></dt>	      </dl>	    </div>	  </div>	</div>	<div id="slider"></div>      </div>');
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

    <?php if(isset($_GET["type"])) {
		echo 'var checkBoxes = $("input[name=type]");
				$.each(checkBoxes, function() {
					if ($(this).attr("value")=="'.$_GET["type"].'"){
						$(this).click(); }
					});
						
	checkBoxes= $("input[name=size]");

	$.each(checkBoxes, function() {
                if ($(this).attr("value")=="'.$_GET["size"].'"){
           	$(this).click();
        	}	
        });
	'; }
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
    <div id="Layer-5" class="outputLayer_jpg">
      <img src="images/Layer-5.jpg" alt="outputLayer" width="281px" height="281px"/></div>


    <!-- This is 'InputLayer_jpg' -->
    <div id="Layer-4" class="InputLayer_jpg">
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
<div class="home">
<a onclick="confirmTo('index.html')">home</a>
</div>

			<div class="menu">


<ul>
<li><a href="objective.php?exp=neigh" target="_self" >Objective</a>


</li>
<li><a href="intro.php?exp=neigh" target="_self" >Introduction</a>


</li>
<li><a href="theory.php?exp=neigh" target="_self" >Theory</a>


</li>
<li><a href="procedure.php?exp=neigh" target="_self" >Procedure</a>


</li>
<li><sel><a href="neigh.php" target="_self" >Experiment</a>

</sel>
</li>
<li><a href="#" target="_self" >Assessment</a>
				<ul>
					<li><a href="quiz.php?exp=neigh">Quiz</a></li>
					<li><a href="assign.php?exp=neigh">Assignment</a></li>
			   </ul>

</li>
<!--
<li><a href="references.php?exp=neigh" target="_self" >References</a>
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

	  <h2 style="text-align: center;">Neighbourhood Operations</h2>
<div id="nextBox">
</div>
 
 
      <?php if (!isset($_GET["assess"]) && $_GET["exp"]!="piping")  {echo "<button1>Select Image</button1>";} ?>
      <button4>Reset</button4>
      <button2>Run</button2>
	 <?php if($_GET["exp"]=="piping") { ?> <button7>Return to Piping</button7> <?php } ?>
     

<div class="Parameters">
<table>
<tr><td width="200px">
<h3>&nbsp;Linear Filtering</h3>
<div id="type" class="param">	
<input type="radio" name="type" value="1" onclick="$('#placeholder').css('display','none');" checked/>Straight Average<br />
<input type="radio" name="type" value="2" onclick="$('#placeholder').css('display','none');" />Triangular Filter<br/>
<input type="radio" name="type" value="3" onclick="$('#placeholder').css('display','none');" />Gaussian Filter<br/>
<div style="display:none">
<input type="radio" name="type" value="4" onclick="$('#placeholder').css('display','block');" id="cf" />Custom Filter<br/>
</div>

</td><td>
<b>Size of <br/>Neig'hood</b>
<input type="radio" name="size" value="3" /> 3x3 <br/>
<input type="radio" name="size" value="5" checked /> 5x5 <br/>
<input type="radio" name="size" value="7" /> 7x7 <br/>
</td></tr></table>
<h3>&nbsp;Non-Linear Operations</h3>
<input type="radio" name="type" value="5" onclick="$('#placeholder').css('display','none');" />Median<br/>
<input type="radio" name="type" value="6" onclick="$('#placeholder').css('display','none');" />Unsharp<br/>

</div>

<div id="placeholder" style="margin-left: 30px; margin-bottom: 10px; width:220px; padding-top: 10px;
			     border: solid grey 1px;height: auto; display: none">
          <form name="matrix" id="matrix">
            <input type="text" name="r1" id="r1" onblur="verify('1')" size="15" value="1 1 1 1 1" />
			<input type="text" name="r2" id="r2" onblur="verify('2')" size="15" value="1 1 1 1 1" />
			<input type="text" name="r3" id="r3" onblur="verify('3')" size="15" value="1 1 1 1 1" />
			<input type="text" name="r4" id="r4" onblur="verify('4')" size="15" value="1 1 1 1 1" />
			<input type="text" name="r5" id="r5" onblur="verify('5')" size="15" value="1 1 1 1 1" />
          </form>


</div>
</body>


