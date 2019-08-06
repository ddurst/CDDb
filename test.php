

<?php
  /*include('simple_html_dom.php');
  $html = file_get_html("https://slate.com/news-and-politics/2018/03/retiring-gop-congressman-ryan-costello-talks-donald-trumps-chaos.html");
  foreach($html->find("meta") as $thing){
    echo $html->getAttribute($thing);
  }*/
    echo "works";
?>

!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!CDDb Working!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
<?php 
  session_start(); 
  $currentArgID = intval($_GET["arg"]); 
  $_SESSION['returnToArg']= $currentArgID;
  require_once('argument_at_hand.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>The Collective Dialectic Database</title>
  <meta charset="utf-8"/>
  <meta name="keywords" content="arguments, dialectic, formalize, anti-troll, discussion, debate, non-social network, anti-social network"/>
  <meta name="copyright" content="Copyright 2015 Craig Danz Seattle, WA USA">  
  <meta name="robots" content="follow"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- This meta viewport tag 
                        right here is gonna save you a future headache. It's the thing that "convinces your 
                        phone that it's a phone". Without it, this page would appear desktop when loaded on 
                        your phone browser. This fixes it. -->
  <link rel="stylesheet" href="style_CDDb.css">
  <script src="jquery-3.3.1.min.js"></script>
  <script src="script_CDDb.js"></script>
  <style>
    <?php
      include('weigh_associated_styles.php');
    ?>
  </style>
</head>
                      <!-- End Header -->
<body>

<!-- Deal with overlays here -->
<div id="overlay">
  <!-- TODO I clearly can't figure out how to properly adjust the height of this overlay window -->
  <div id="overContain">
    <!-- Because overlay -->
    <div id="overWeighBecause">
      <section class="weighHeader" style=" background-color:var(--cddbBlue);">
          <strong>"<?php echo $phrasing; ?>" Is correct because...</strong>
      </section>
      <section class="weighContent">
        <?php
          $endorseType = 'Because';
          $baseURL = "http://localhost:8888/CDDb_working.php";
          include('weigh_associated.php');
        ?>
        </br>
        <form action="functions.php" method="POST">
          Not Listed <input style="display: inline-block; width: 80%;" type="text" name="assertion" placeholder="If no similar arguments exist to support position, add your own...">
          <input style="display: inline-block;" type="submit" value="Add">
          <input type="hidden" name="carriedType" value="Because" /> 
          <input type="hidden" name="weighInWith" id="weighInWith" value="" /> 
        </form>
      </section>
      <section class="weighFooter" style="background-color:var(--cddbBlue);">
        <button onclick="becauseOff()" class="button weighBecause" name="buttonClicked" value="weighBecause"><strong>Cancel</strong></button> 

        <button onclick="becauseClearData()" class="button weighBecause" name="buttonClicked" value="weighBecause"><strong>&#x27F2;</strong></button> 

        <form action="functions.php" method="POST">
          <button type="submit" class="button weighBecause" name="buttonClicked" value="weighBecause"><strong>Submit</strong></button>
          <!-- This hidden field handles an input array the user populates in "weigh in" overlays -->
          <input type="hidden" name="weighInWith" id="weighInWith" value="" /> 
        </form>
      </section>
    </div>
    <!-- Therefore overlay -->
    <div id="overWeighTherefore">
      <section class="weighHeader" style="background-color:var(--cddbGreen);">
          <strong>"<?php echo $phrasing; ?>" Is correct therefore...</strong>
      </section>
      <section class="weighContent">
        <?php
          $endorseType = 'Therefore';
          $baseURL = "http://localhost:8888/CDDb_working.php";
          include('weigh_associated.php');
        ?>
        </br>
        <form action="functions.php" method="POST">
          Not Listed <input style="display: inline-block; width: 80%;" type="text" name="assertion" placeholder="If no similar arguments exist to support position, add your own...">
          <input style="display: inline-block;" type="submit" value="Add">
          <input type="hidden" name="carriedType" value="Therefore" /> 
          <input type="hidden" name="weighInWith" id="weighInWith" value="" /> 
        </form>
      </section>
      <section class="weighFooter" style="background-color:var(--cddbGreen);">
        <button onclick="thereforeOff()" class="button weighTherefore" name="buttonClicked" value="weighTherefore"><strong>Cancel</strong></button> 

        <button onclick="thereforeClearData()" class="button weighTherefore" name="buttonClicked" value="weighTherefore"><strong>&#x27F2;</strong></button> 

        <form action="functions.php" method="POST">
          <button type="submit" class="button weighTherefore" name="buttonClicked" value="weighTherefore"><strong>Submit</strong></button>
          <!-- This hidden field handles an input array the user populates in "weigh in" overlays -->
          <input type="hidden" name="weighInWith" id="weighInWith" value="" /> 
        </form>
      </section>
    </div>
    <!-- Rebuttal overlay -->
    <div id="overWeighRebuttal">
      <section class="weighHeader" style="background-color:var(--cddbRed);">
          <strong>"<?php echo $phrasing; ?>" Is wrong because...</strong>
      </section>
      <section class="weighContent">
        <?php
          $endorseType = 'Rebuttal';
          $baseURL = "http://localhost:8888/CDDb_working.php";
          include('weigh_associated.php');
        ?>
        </br>
        <form action="functions.php" method="POST">
          Not Listed <input style="display: inline-block; width: 80%;" type="text" name="assertion" placeholder="If no similar arguments exist to support position, add your own...">
          <input style="display: inline-block;" type="submit" value="Add">
          <input type="hidden" name="carriedType" value="Rebuttal" /> 
          <input type="hidden" name="weighInWith" id="weighInWith" value="" /> 
        </form>
      </section>
      <section class="weighFooter" style="background-color:var(--cddbRed);">
        <button onclick="rebuttalOff()" class="button weighRebuttal" name="buttonClicked" value="weighRebuttal"><strong>Cancel</strong></button> 
        
        <button onclick="rebuttalClearData()" class="button weighRebuttal" name="buttonClicked" value="weighRebuttal"><strong>&#x27F2;</strong></button> 
      
        <form action="functions.php" method="POST">
          <button type="submit" class="button weighRebuttal" name="buttonClicked" value="weighRebuttal"><strong>Submit</strong></button>
          <!-- This hidden field handles an input array the user populates in "weigh in" overlays -->
          <input type="hidden" name="weighInWith" id="weighInWith" value="" /> 
        </form>
      </section>
    </div>
    <!-- New Assertion overlay -->
    <div id="overAssertion">
      <section class="weighHeader" style="background-color:var(--cddbGrey);">
          <strong>Err towards convergence. Choose something as close as possible, rephrase later as needed.</strong>
      </section>
      <section class="weighContent">
        <?php
          include('new_assertion.php');
        ?>
      </section>
      <section class="weighFooter" style="background-color:var(--cddbGrey);">
        Nah, "<?php echo $_SESSION["assertion"];?>" is something new, unique, and necessary. 
        <form action="functions.php" method="POST">
          <button type="submit" class="button newAssertion" name="buttonClicked" value="addAssertion"><strong>Add It</strong></button>
        </form>

      </section>
    </div>
    <!-- End of overlays -->
  </div>  
</div>

<!-- Jumpt to another step on the page -->
<?php
  if(isset($_SESSION["jumpTo"])) {
    switch ($_SESSION["jumpTo"]) {
      case "reviewAssert":
        echo '<script type="text/javascript">',
         'assertOn();',
         '</script>';
        unset($_SESSION["jumpTo"]);
        break;
      case "backToBecause":
        echo "<script type=\"text/javascript\">rebuildWeights('".$_SESSION["carriedWeights"]."','".$_SESSION["carriedType"]."');</script>";
        echo '<script type="text/javascript">',
         'becauseOn();',
         '</script>';
        unset($_SESSION["jumpTo"]);
        unset($_SESSION["carriedWeights"]);
        break;
      case "backToTherefore":
        echo "<script type=\"text/javascript\">rebuildWeights('".$_SESSION["carriedWeights"]."','".$_SESSION["carriedType"]."');</script>";
        echo '<script type="text/javascript">',
         'thereforeOn();',
         '</script>';
        unset($_SESSION["jumpTo"]);
        unset($_SESSION["carriedWeights"]);
        break;
      case "backToRebuttal":
        echo "<script type=\"text/javascript\">rebuildWeights('".$_SESSION["carriedWeights"]."','".$_SESSION["carriedType"]."');</script>";
        echo '<script type="text/javascript">',
         'rebuttalOn();',
         '</script>';
        unset($_SESSION["jumpTo"]);
        unset($_SESSION["carriedWeights"]);
        break;
    }
  }
?>

<div class="row-1">
  <div class="header">
    <section style="
      color: white;
      font-size: 15vh;
    ">
      <span style="text-shadow: 5px 5px 10px var(--cddbBlue);">C</span><span style="text-shadow: 5px 5px 10px var(--cddbGreen);">D</span><span style="text-shadow: 5px 5px 10px var(--cddbRed);">Db</span>
    </section>
    <section 
      style=" 
        color: white;
        font-size: 1rem;
        position: absolute;
        bottom: .2rem;
        text-align: right;
      ">
      <a href="login.php?arg=<?php echo $_SESSION['returnToArg'];?>">Login</a> 
    </section> <!--TODO link floats down when window narrows - fix -->
  </div>
  
  <div class="because">
    <section 
      style=" 
        font-size: 120%;
        color: white;
        background-color:var(--cddbBlue);
        padding-left: .5rem;   
        padding-bottom: .5rem;    
      ">
      <table border='0' width='100%'><tr><td>
      <strong>Because...</strong>
    </td><td style="width:10%; min-width:100px;">
        <?php if($_SESSION['opinion'] > 0){ ?> 
            <button onclick="becauseOn()" class="button weighBecause" name="buttonClicked" value="weighBecause">Weigh In</button> 
    <?php } ?>
    </td></tr>
    </table>
    </section>
    <section 
      style="padding-left: .5rem;">
    <?php 
      $endorseType = 'Because';
      $baseURL = "http://localhost:8888/CDDb_working.php";
      include('display_associated.php');
    ?>
  </section>
  </div>

</div>

<!-- You can add multiple classes to a div. Just separate them by a space. -->
<!-- Just like this here ▼ -->
<div class="container1 argu-butt">

  <div class="argument">
    <section 
      style=" 

        font-size: 120%;
        color: white;
        background-color:var(--cddbBlack);
        padding-left: .5rem;   
        padding-bottom: .5rem;    
      ">
      <table border='0' width='100%'> <tr><td><strong><?php echo "Argument: " . intval($_GET["arg"])?> 

      <!--Green check or Red X-->
      <?php if($_SESSION['opinion'] > 0){ ?>
        <span style="color: #10a020; font-size: 1.5rem;">&#x2714;</span>
      <?php } ?>
      <?php if($_SESSION['opinion'] < 0){ ?>
        <span style="color: #af1a17; font-size: 1.5rem;">&#x2718;</span>
      <?php } ?></br></strong>
    
    </td>

    <!-- 4 possible states for the Accept/Reject buttons. One if profile is not set, sending users to \
    login page and 3 conditioned on current opinion (if one exists). -->

    <td style="width:20%; min-width:160px;">

    <?php if(!isset($_SESSION['profile'])){ ?>
      <div class="btn-group">
            <form action="login.php?arg=<?php echo $currentArgID; ?>" method="POST">
              <button type="submit" class="button acAvail" name="buttonClicked" value="accept">Accept</button> 
            </form>
            <form action="login.php?arg=<?php echo $currentArgID; ?>" method="POST">
              <button type="submit" class="button reAvail" name="buttonClicked" value="reject">Reject</button> 
            </form>
      </div>
    <?php } ?>

    <?php if(isset($_SESSION['profile']) and ($_SESSION['opinion'] == 0)){ ?>
      <div class="btn-group">
            <form action='functions.php' method="POST">
              <button type="submit" class="button acAvail" name="buttonClicked" value="accept">Accept</button> 
            </form>
            <form action='functions.php' method="POST">
              <button type="submit" class="button reAvail" name="buttonClicked" value="reject">Reject</button> 
            </form>
      </div>
    <?php } ?>

    <?php if(isset($_SESSION['profile']) and ($_SESSION['opinion'] > 0)){ ?>
      <div class="btn-group">
            <button type="submit" class="button acSet" name="buttonClicked" value="accept">Accepted</button> 
            <form action='functions.php' method="POST">
              <button type="submit" class="button reAvail" name="buttonClicked" value="reject">Reject</button> 
            </form>
      </div>
    <?php } ?>

    <?php if(isset($_SESSION['profile']) and ($_SESSION['opinion'] < 0)){ ?>
      <div class="btn-group">
            <form action='functions.php' method="POST">
              <button type="submit" class="button acAvail" name="buttonClicked" value="accept">Accept</button> 
            </form>

        <button type="submit" class="button reSet" name="buttonClicked" value="reject">Rejected</button> 
      </div>
    <?php } ?>
    </td></tr></table>
    </section>
    <section 
      style="padding-left: .5rem;">

<!-- End of Accept/Reject Button-->

    <div class="argRow1">
      <div class="argContain1">
        <span style="font-size: 3.3rem; letter-spacing: 0px;"> <!-- Big numbers left of decimal -->
        <?php
        $rateAsString = strval($rate);
        if ($rate < 10) $leftOfDec = substr($rateAsString,0,1);
        else if($rate < 100) $leftOfDec = substr($rateAsString,0,2);
        else $leftOfDec = substr($rateAsString,0,3);
        echo $leftOfDec;
        ?></span>
        <span style="font-size: 2rem; letter-spacing: 0px;"> <!-- Small numbers right of decimal -->
        .<?php // <the leading decimal is before php.
        $rateAsString = strval($rate);
        if ($rate < 10) $rightOfDec = substr($rateAsString,2,1);
        else if($rate < 100) $rightOfDec = substr($rateAsString,3,1);
        else $rightOfDec = substr($rateAsString,4,1);
        echo $rightOfDec;
        ?>%</span> <!-- percentage sign outside php too -->
        <span style="font-size: .3rem; letter-spacing: 0px; color: #939393; vertical-align: text-top;"><br>Opinion of <?php echo $assertions; ?> <?php if($assertions != 1) echo "people"; else echo "person";?></span>
      </div>
      <div class="argContain2">
        <?php
          echo $phrasing;
        ?>
      </div>
    </div>
    <div class="argRow2">
      <div class="argContain3">
        <?php 
          if(isset($link)) {
            echo "<a href=" . $link . ">
              <div style=\"margin: 1rem; padding: 1rem; height: 80%; border-radius: 10px; border: 3px solid #939393;\">".$link."<br>
              </div>
            </a>";
          }
        ?>  
      </div>
      <div class="argContain4">
        <br><br><br><br> <!-- TODO Use a less lazy way to position button -->
        <?php if($_SESSION['opinion'] > 0 && isset($_SESSION['profile'])){ ?>
          <form action='functions.php' method="POST">
            <button type="submit" class="button alter" name="buttonClicked" value="improve">Improve</button> 
          </form>
        <?php } ?>
      </div>

      
    </div>

    </section>
    <!--  Ball test  -->
    <table>
      <tr>
        <td>

        </td>
      </tr>
    </table>

  </div>

  <div class="rebuttal">
    <section 
      style=" 
        font-size: 120%;
        color: white;
        background-color:var(--cddbRed);
        padding-left: .5rem;   
        padding-bottom: .5rem;    
      ">
     <table border='0' width='100%'><tr><td>
      <strong>Rebuttal</strong>
    </td><td style="width:10%; min-width:100px;">
      <?php if($_SESSION['opinion'] < 0){ ?> 
        <button onclick="rebuttalOn()" class="button weighRebuttal" name="buttonClicked" value="weighRebuttal">Weigh In</button> 
      <?php } ?>
    </td></tr>
    </table>
    </section>
 
    <section 
      style="padding-left: .5rem; background-color:white;">
    <?php
      $endorseType = 'Rebuttal';
      $baseURL = "http://localhost:8888/CDDb_working.php";
      include('display_associated.php');
    ?>
    </section>
  </div>
  
  
</div> <!-- End Main Div -->

<!--Row 3 -->

<div class="container2 so-tags">
  <div class="so">

    <section 
      style=" 
        font-size: 120%;
        color: white;
        background-color:var(--cddbGreen);
        padding-left: .5rem;   
        padding-bottom: .5rem;    
      ">
      <table border='0' width='100%'><tr><td>
      <strong>Therefore...</strong>
    </td><td style="width:10%; min-width:100px;">
      <?php if($_SESSION['opinion'] > 0){ ?> 
        <button onclick="thereforeOn()" class="button weighTherefore" name="buttonClicked" value="weighTherefore">Weigh In</button>  
      <?php } ?>
    </td></tr>
    </table>
    </section>
    <section 
      style="padding-left: .5rem;">
    <?php
       $endorseType = 'Therefore';
      $baseURL = "http://localhost:8888/CDDb_working.php";
      include('display_associated.php');
    ?>
  </div>

    <div class="tags">    
      <section 
      style=" 
        font-size: 120%;
        color: white;
        background-color:#0e0e0e;
        padding-left: .5rem;   
        padding-bottom: .5rem;    
      ">
      <strong>Filters(Coming Soon)</strong>
    </section>
    <section 
      style="padding-left: .2rem;">
      <table>
        <tr><td><strong>Groups</strong></td><td>Affiliations, organizing bodies.</td></tr>
        <tr><td><strong>Topics</strong></td><td>Exposition tagged for specificity.</td></tr>
        <tr><td><strong>Positions</strong></td><td>Cross-reference other opinons.</td></tr>
      </table>
    </section>
  </div>
</div>
</div>

</body>
</html>



!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!script CDDb!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
var totalClicks = 0;
var clickArr = [];

function updateWeighInValue() {
  var arrayAsString = "";
  for (var i = 0; i < clickArr.length; i++) {
      arrayAsString = arrayAsString + clickArr[i][0] + ","; 
      arrayAsString = arrayAsString + ((clickArr[i][1]/totalClicks)*100).toFixed(5) + (i == clickArr.length-1 ? "" : ","); //no comma if it is the last element, otherwise you get an extra element in your rebuilt array
  }

  document.getElementById("weighInWith").value = arrayAsString;
}

//Because functions
function becauseOn() {
  document.getElementById("overlay").style.display = "block";
  document.getElementById("overContain").style.display = "flex";
  document.getElementById("overWeighBecause").style.display = "flex";
}
function becauseOff() {
  document.getElementById("overlay").style.display = "none";
  document.getElementById("overContain").style.display = "none";
  document.getElementById("overWeighBecause").style.display = "none";
  for (var i = 0; i < clickArr.length; i++) {
    document.getElementById("buttonBecause"+clickArr[i][0]).style.backgroundColor = "var(--cddbGrey)"; 
    document.getElementById("buttonBecause"+clickArr[i][0]).style.width = "1rem"; 
    document.getElementById("buttonBecause"+clickArr[i][0]).style.height = "1rem";
    document.getElementById("buttonBecause"+clickArr[i][0]).innerHTML = "";   
  }
  clickArr.length = 0;
  totalClicks = 0;
}
function becauseClearData() {
  for (var i = 0; i < clickArr.length; i++) {
    document.getElementById("buttonBecause"+clickArr[i][0]).style.backgroundColor = "var(--cddbGrey)"; 
    document.getElementById("buttonBecause"+clickArr[i][0]).style.width = "1rem"; 
    document.getElementById("buttonBecause"+clickArr[i][0]).style.height = "1rem";  
    document.getElementById("buttonBecause"+clickArr[i][0]).innerHTML = "";  
  }
  clickArr.length = 0;
  totalClicks = 0;
}

function becauseClickTheButton(argID) {
  totalClicks++;
  var found = false;
  var iterator = 0;
  var foundIndex;
  var clickRatio;
  var clickRatioStyle;
  var clickRatioType;
  var clickRatioSyleType;
  while (found == false && iterator < clickArr.length) {
    if(clickArr[iterator][0] == argID){
      found = true;
      clickArr[iterator][1]++;
      foundIndex = iterator;
    }
    iterator++;
  }
  if (found == false) {
    foundIndex = clickArr.length;
    clickArr.push([argID,1]);  
    document.getElementById("buttonBecause"+argID).style.backgroundColor = "var(--cddbBlue)";
  }
  for (var i = 0; i < clickArr.length; i++) {
    clickRatio = .7+(((clickArr[i][1])/totalClicks)*5);
    clickRatioSyle = clickRatio + "rem";
    clickRatioType = 2.5*(clickArr[i][1]/totalClicks);
    clickRatioSyleType = clickRatioType + "rem";
    percentCode = "<span style='font-size:"+clickArr[i][1]/totalClicks+"rem'>%</span>";
    document.getElementById("buttonBecause"+clickArr[i][0]).style.width = clickRatioSyle; 
    document.getElementById("buttonBecause"+clickArr[i][0]).style.height = clickRatioSyle; 
    document.getElementById("buttonBecause"+clickArr[i][0]).style.fontSize = clickRatioSyleType; 
    if(((clickArr[i][1]/totalClicks)*100)>=20)
      document.getElementById("buttonBecause"+clickArr[i][0]).innerHTML = Math.floor((clickArr[i][1]/totalClicks)*100) + percentCode; 
    else
      document.getElementById("buttonBecause"+clickArr[i][0]).innerHTML = ""; 
  }
  updateWeighInValue();
}

//Therefore functions
function thereforeOn() {
  document.getElementById("overlay").style.display = "block";
  document.getElementById("overContain").style.display = "flex";
  document.getElementById("overWeighTherefore").style.display = "flex";
}
function thereforeOff() {
  document.getElementById("overlay").style.display = "none";
  document.getElementById("overContain").style.display = "none";
  document.getElementById("overWeighTherefore").style.display = "none";
  for (var i = 0; i < clickArr.length; i++) {
    document.getElementById("buttonTherefore"+clickArr[i][0]).style.backgroundColor = "var(--cddbGrey)"; 
    document.getElementById("buttonTherefore"+clickArr[i][0]).style.width = "1rem"; 
    document.getElementById("buttonTherefore"+clickArr[i][0]).style.height = "1rem";
    document.getElementById("buttonTherefore"+clickArr[i][0]).innerHTML = "";   
  }
  clickArr.length = 0;
  totalClicks = 0;
}
function thereforeClearData() {
  for (var i = 0; i < clickArr.length; i++) {
    document.getElementById("buttonTherefore"+clickArr[i][0]).style.backgroundColor = "var(--cddbGrey)"; 
    document.getElementById("buttonTherefore"+clickArr[i][0]).style.width = "1rem"; 
    document.getElementById("buttonTherefore"+clickArr[i][0]).style.height = "1rem";  
    document.getElementById("buttonTherefore"+clickArr[i][0]).innerHTML = "";  
  }
  clickArr.length = 0;
  totalClicks = 0;
}

function thereforeClickTheButton(argID) {
  totalClicks++;
  var found = false;
  var iterator = 0;
  var foundIndex;
  var clickRatio;
  var clickRatioStyle;
  var clickRatioType;
  var clickRatioSyleType;
  while (found == false && iterator < clickArr.length) {
    if(clickArr[iterator][0] == argID){
      found = true;
      clickArr[iterator][1]++;
      foundIndex = iterator;
    }
    iterator++;
  }
  if (found == false) {
    foundIndex = clickArr.length;
    clickArr.push([argID,1]);  
    document.getElementById("buttonTherefore"+argID).style.backgroundColor = "var(--cddbGreen)";
  }
  for (var i = 0; i < clickArr.length; i++) {
    clickRatio = .7+(((clickArr[i][1])/totalClicks)*5);
    clickRatioSyle = clickRatio + "rem";
    clickRatioType = 2.5*(clickArr[i][1]/totalClicks);
    clickRatioSyleType = clickRatioType + "rem";
    percentCode = "<span style='font-size:"+clickArr[i][1]/totalClicks+"rem'>%</span>";
    document.getElementById("buttonTherefore"+clickArr[i][0]).style.width = clickRatioSyle; 
    document.getElementById("buttonTherefore"+clickArr[i][0]).style.height = clickRatioSyle; 
    document.getElementById("buttonTherefore"+clickArr[i][0]).style.fontSize = clickRatioSyleType; 
    if(((clickArr[i][1]/totalClicks)*100)>=20)
      document.getElementById("buttonTherefore"+clickArr[i][0]).innerHTML = Math.floor((clickArr[i][1]/totalClicks)*100) + percentCode; 
    else
      document.getElementById("buttonTherefore"+clickArr[i][0]).innerHTML = ""; 
  }
  updateWeighInValue();
}

//Rebuttal functions
function rebuttalOn() {
  document.getElementById("overlay").style.display = "block";
  document.getElementById("overContain").style.display = "flex";
  document.getElementById("overWeighRebuttal").style.display = "flex";
}
function rebuttalOff() {
  document.getElementById("overlay").style.display = "none";
  document.getElementById("overContain").style.display = "none";
  document.getElementById("overWeighRebuttal").style.display = "none";
  for (var i = 0; i < clickArr.length; i++) {
    document.getElementById("buttonRebuttal"+clickArr[i][0]).style.backgroundColor = "var(--cddbGrey)"; 
    document.getElementById("buttonRebuttal"+clickArr[i][0]).style.width = "1rem"; 
    document.getElementById("buttonRebuttal"+clickArr[i][0]).style.height = "1rem";
    document.getElementById("buttonRebuttal"+clickArr[i][0]).innerHTML = "";   
  }
  clickArr.length = 0;
  totalClicks = 0;
}
function rebuttalClearData() {
  for (var i = 0; i < clickArr.length; i++) {
    document.getElementById("buttonRebuttal"+clickArr[i][0]).style.backgroundColor = "var(--cddbGrey)"; 
    document.getElementById("buttonRebuttal"+clickArr[i][0]).style.width = "1rem"; 
    document.getElementById("buttonRebuttal"+clickArr[i][0]).style.height = "1rem";  
    document.getElementById("buttonRebuttal"+clickArr[i][0]).innerHTML = "";  
  }
  clickArr.length = 0;
  totalClicks = 0;
}

function rebuttalClickTheButton(argID) {
  totalClicks++;
  var found = false;
  var iterator = 0;
  var foundIndex;
  var clickRatio;
  var clickRatioStyle;
  var clickRatioType;
  var clickRatioSyleType;
  while (found == false && iterator < clickArr.length) {
    if(clickArr[iterator][0] == argID){
      found = true;
      clickArr[iterator][1]++;
      foundIndex = iterator;
    }
    iterator++;
  }
  if (found == false) {
    foundIndex = clickArr.length;
    clickArr.push([argID,1]);  
    document.getElementById("buttonRebuttal"+argID).style.backgroundColor = "var(--cddbRed)";
  }
  for (var i = 0; i < clickArr.length; i++) {
    clickRatio = .7+(((clickArr[i][1])/totalClicks)*5);
    clickRatioSyle = clickRatio + "rem";
    clickRatioType = 2.5*(clickArr[i][1]/totalClicks);
    clickRatioSyleType = clickRatioType + "rem";
    percentCode = "<span style='font-size:"+clickArr[i][1]/totalClicks+"rem'>%</span>";
    document.getElementById("buttonRebuttal"+clickArr[i][0]).style.width = clickRatioSyle; 
    document.getElementById("buttonRebuttal"+clickArr[i][0]).style.height = clickRatioSyle; 
    document.getElementById("buttonRebuttal"+clickArr[i][0]).style.fontSize = clickRatioSyleType; 
    if(((clickArr[i][1]/totalClicks)*100)>=20)
      document.getElementById("buttonRebuttal"+clickArr[i][0]).innerHTML = Math.floor((clickArr[i][1]/totalClicks)*100) + percentCode; 
    else
      document.getElementById("buttonRebuttal"+clickArr[i][0]).innerHTML = ""; 
  }
  updateWeighInValue();
}


//New assertion functions
function assertOn() {
  document.getElementById("overlay").style.display = "block";
  document.getElementById("overContain").style.display = "flex";
  document.getElementById("overAssertion").style.display = "flex";
}
//Rebuild clicks
function rebuildWeights(stringWeights,type) {
  var weighArray = stringWeights.split(",");
  var i;
  for (i = 0; i < weighArray.length-1; i+=2) { 
    clickArr.push([weighArray[i],weighArray[i+1]]);
  }
  //array has weights but needs an integer for clicks instead. 
  var lowWeight = 101;
  for (i = 1; i < weighArray.length; i+=2) { 
    if(weighArray[i]<lowWeight){
      lowWeight = weighArray[i];
    }
  }
  //use the low weight as a baseline worth one click - extrapolate from that
  var fakedClicks = 0;
  totalClicks = 0;
  for (i = 0; i < clickArr.length; i++) { 
    fakedClicks = Math.round(clickArr[i][1]/lowWeight);
    clickArr[i][1] = fakedClicks;
    totalClicks += fakedClicks;
  }
  var buttonColor;
  switch(type) {
    case "Because":
        buttonColor = "var(--cddbBlue)";
        break;
    case "Therefore":
        buttonColor = "var(--cddbGreen)";
        break;
    case "Rebuttal":
        buttonColor = "var(--cddbRed)";
        break;
    default:
        buttonColor = "var(--cddbGrey)";
  }
  var clickRatio;
  var clickRatioStyle;
  var clickRatioType;
  var clickRatioSyleType;
  for (i = 0; i < clickArr.length; i++) {
    clickRatio = .7+(((clickArr[i][1])/totalClicks)*5);
    clickRatioSyle = clickRatio + "rem";
    clickRatioType = 2.5*(clickArr[i][1]/totalClicks);
    clickRatioSyleType = clickRatioType + "rem";
    percentCode = "<span style='font-size:"+clickArr[i][1]/totalClicks+"rem'>%</span>";
    document.getElementById("button"+type+clickArr[i][0]).style.width = clickRatioSyle; 
    document.getElementById("button"+type+clickArr[i][0]).style.height = clickRatioSyle; 
    document.getElementById("button"+type+clickArr[i][0]).style.fontSize = clickRatioSyleType; 
    document.getElementById("button"+type+clickArr[i][0]).style.backgroundColor = buttonColor;
    if(((clickArr[i][1]/totalClicks)*100)>=20)
      document.getElementById("button"+type+clickArr[i][0]).innerHTML = Math.floor((clickArr[i][1]/totalClicks)*100) + percentCode; 
    else
      document.getElementById("button"+type+clickArr[i][0]).innerHTML = ""; 
  }
  updateWeighInValue();
}




!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!weigh associated!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
<?php
  session_start();
  header("Content-Type: text/html; charset=ISO-8859-1");//insure symbols in text are recognized.
  //print_r($_SESSION);
  //print_r($_POST);
  echo '<script type="text/javascript">',
         'document.write(clickArr);',
         '</script>';
  $tooSmall = 20; //The numbers get too small to read at somepoint. What is that point?
  $startingDiameter = 1; 
  include('connect.php');
  $sql = "SELECT SUM(E.weight) / 
    ( SELECT COUNT(DISTINCT profileID) 
      FROM ENDORSEMENT 
      WHERE targArgID = $currentArgID
        AND endorseType = '$endorseType') AS aggWeight, 
    E.supportingArgID, Ph.phrasing, E.endorseType
      FROM ENDORSEMENT E, PHRASING Ph
        WHERE Ph.argumentID = E.supportingArgID 
      AND E.targArgID = $currentArgID
      AND E.endorseType = '$endorseType'
    GROUP BY E.supportingArgID
    ORDER BY aggWeight DESC";
  $result = mysqli_query($conn, $sql);
  $lowCaseEndorseType = strtolower($endorseType);
  if (mysqli_num_rows($result) > 0) {
      $styleColor = 'neutralCircle';
      echo "<table border = '0'>\n";
      // output data of each row
      echo "<tr>\n";
    while($row = mysqli_fetch_row($result)) {
      //Calculate circle diameter based on percent of weight
      $diameter = $startingDiameter;
      $rateAsString = "";

      if ($row[0]< 10) $leftOfDec = substr($rateAsString,0,1);
      else if($row[0] < 100) $leftOfDec = substr($rateAsString,0,2);
      else $leftOfDec = substr($rateAsString,0,3);

      echo "<tr>\n";  
      echo "<td><div style=\"height: 100%; width: 100%; display:flex; justify-content:center; 
        align-items: center;\"><button class=\"overlayButtons\" id=\"button" . $row[3] . $row[1] . 
        "\" onclick=\"".$lowCaseEndorseType."ClickTheButton(" . $row[1] . ")\"></button></div></td>"; 
      echo "<td>" . "<a href=" . $baseURL . "?arg=" . $row[1] . ">$row[2]</a>" . "</td>\n";
      echo "</tr>\n";
    }
      echo "</table>\n";
  } else {
    echo "0 results";
  }
  mysqli_free_result($result);
  mysqli_close($conn);
  //print_r($_SESSION);
  //print_r($_POST);
?>






!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!weigh associated styles!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
<?php
  session_start();
  header("Content-Type: text/html; charset=ISO-8859-1");
  include('connect.php');
  $sql = "SELECT E.supportingArgID, Ph.phrasing, E.endorseType
      FROM ENDORSEMENT E, PHRASING Ph
        WHERE Ph.argumentID = E.supportingArgID 
      AND E.targArgID = $currentArgID
    GROUP BY E.supportingArgID";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
          echo ".overlayButtons {
          float: left;
          margin: 0;
          color: var(--cddbWhite);
          font-weight: bold;
          text-align: center;
          border-width: 0;
          border-style: solid;
          border-radius: 50%;
        }\n";
    while($row = mysqli_fetch_row($result)) {
          echo "\n#button" . $row[2] . $row[0] . " {
          background-color: var(--cddbGrey);
          border-color: var(--cddbGrey); 
          font-size: 1rem;
          width: 1rem;
          height: 1rem;           
        }";
    }
  } else {
    echo "0 results";
  }
  mysqli_free_result($result);
  mysqli_close($conn);
?>







!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!functions!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
<?php
  session_start(); 
  header("Content-Type: text/html; charset=ISO-8859-1"); //insure symbols in text are recognized.
  if(isset($_POST["buttonClicked"])) {
    switch ($_POST["buttonClicked"]) {
          case "accept":
              $_SESSION['opinion']=1;
              include('connect.php');
              $param1 = $_SESSION['opinion'];
              $param2 = $_SESSION['returnToArg'];
              $param3 = $_SESSION['profile'];
        $sql = "CALL assertOpinion($param1,$param2,$param3)";
        mysqli_query($conn, $sql);
        mysqli_close($conn);  
              header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
              break;
          case "reject":
              $_SESSION['opinion']=-1;
              include('connect.php');
              $param1 = $_SESSION['opinion'];
              $param2 = $_SESSION['returnToArg'];
              $param3 = $_SESSION['profile'];
        $sql = "CALL assertOpinion($param1,$param2,$param3)";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
              header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
              break;
          case "weighBecause":
            $arrayOfWeighIns = explode(",",$_POST["weighInWith"]); //Caution: explode an empty string and get an array of size 1 with a null element value
              include('connect.php');
              $type = "Because";
              $argAtHand = intval($_SESSION['returnToArg']);
              $profileID = intval($_SESSION['profile']);


        for ($i = 0; $i < (count($arrayOfWeighIns)-2); $i+=2) {
          $supportArgVal = intval($arrayOfWeighIns[$i]);
          $weightVal = floatval($arrayOfWeighIns[$i+1]);
          if($i == 0){
            $query = "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
          }
          else {
            $query .= "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
          }
        }
        $query .= "CALL resolveOldWithNewEndorse(\"".$type."\",".$argAtHand.",".$profileID.");";
        
        /*Execute queries */
        if(mysqli_multi_query($conn, $query)){
          mysqli_close($conn);
          header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
        }
        else 
          echo "Query Failed";
        mysqli_close($conn);
              
              break;
          case "weighTherefore":
            $arrayOfWeighIns = explode(",",$_POST["weighInWith"]); //Caution: explode an empty string and get an array of size 1 with a null element value
              include('connect.php');
              $type = "Therefore";
              $argAtHand = intval($_SESSION['returnToArg']);
              $profileID = intval($_SESSION['profile']);


        for ($i = 0; $i < (count($arrayOfWeighIns)-2); $i+=2) {
          $supportArgVal = intval($arrayOfWeighIns[$i]);
          $weightVal = floatval($arrayOfWeighIns[$i+1]);
          if($i == 0){
            $query = "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
          }
          else {
            $query .= "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
          }
        }
        $query .= "CALL resolveOldWithNewEndorse(\"".$type."\",".$argAtHand.",".$profileID.");";
        
        /*Execute queries */
        if(mysqli_multi_query($conn, $query)){
          mysqli_close($conn);
          header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
        }
        else 
          echo "Query Failed";
        mysqli_close($conn);
              
              break;
          case "weighRebuttal":
            $arrayOfWeighIns = explode(",",$_POST["weighInWith"]); //Caution: explode an empty string and get an array of size 1 with a null element value
              include('connect.php');
              $type = "Rebuttal";
              $argAtHand = intval($_SESSION['returnToArg']);
              $profileID = intval($_SESSION['profile']);


        for ($i = 0; $i < (count($arrayOfWeighIns)-2); $i+=2) {
          $supportArgVal = intval($arrayOfWeighIns[$i]);
          $weightVal = floatval($arrayOfWeighIns[$i+1]);
          if($i == 0){
            $query = "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
          }
          else {
            $query .= "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
          }
        }
        $query .= "CALL resolveOldWithNewEndorse(\"".$type."\",".$argAtHand.",".$profileID.");";
        
        /*Execute queries */
        if(mysqli_multi_query($conn, $query)){
          mysqli_close($conn);
          header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
        }
        else 
          echo "Query Failed";
        mysqli_close($conn);
              
              break;
          case "addAssertion":
        $currentArgID = $_SESSION['returnToArg'];
              $profileID = $_SESSION['profile'];
              $type = $_SESSION["carriedType"];
              $assertionPhrased = $_SESSION["assertion"];
        include('connect.php');
        
        //set up a new argument in the Db 
        
        $sql = "INSERT INTO ARGUMENT (createdBy, createdDate, lastVisited) 
            VALUES ($profileID,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        mysqli_query($conn, $sql);
        $newArgID = mysqli_insert_id($conn);
        
        
        $sql = "INSERT INTO OPINION VALUES($newArgID,$profileID,1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);";
        $sql .= "INSERT INTO PHRASING VALUES($newArgID,$profileID,'$assertionPhrased',$profileID,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
        $sql .= "INSERT INTO ENDORSEMENT VALUES($currentArgID,$profileID,'$type',$newArgID,100,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
        $sql .= "CALL resolveOldWithNewEndorse(\"".$type."\",".$currentArgID.",".$profileID.");";

        if (mysqli_multi_query($conn, $sql)) {
            echo $newArgID;
        }
        else {
          echo "Query Failed";
        }
        
        mysqli_close($conn);
        
        //append the array of weights with the new 
        $arrayOfWeighIns = explode(",",$_SESSION["carriedWeights"]);
        $lowWeight = floatval(100);
        //First, find the lowest weigh in value
        for ($i = 0; $i < (count($arrayOfWeighIns)-1); $i+=2) {
          if($arrayOfWeighIns[$i+1]<$lowWeight){
            $lowWeight = $arrayOfWeighIns[$i+1];
          }
        }
        //Add new argument to the array along with a weight equal to current lowest
        if(count($arrayOfWeighIns) == 1){
          $arrayOfWeighIns = array($supportArgVal,$lowWeight);
        }
        else {
          array_push($arrayOfWeighIns,$supportArgVal,$lowWeight);
        }
        //recalculate weights with extra baggage
        for ($i = 0; $i < (count($arrayOfWeighIns)-1); $i+=2) {
          $arrayOfWeighIns[$i+1] = number_format((float)(($arrayOfWeighIns[$i+1]/(100+$lowWeight))*100), 5, '.', '');
        }
        //rebuild string
        $arrayAsString = "";
        for ($i = 0; $i < count($arrayOfWeighIns); $i++) {
          $arrayAsString = $arrayAsString.$arrayOfWeighIns[$i].($i == count($arrayOfWeighIns)-1 ? "" : ","); //no comma if it is the last element, otherwise you get an extra element in your rebuilt array
        }
        $_SESSION["carriedWeights"] = $arrayAsString;
        $_SESSION["jumpTo"] = "backTo".$type;
        print_r($_SESSION);
        header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
              break;    
      }
  }
  else if(isset($_POST["useInstead"])){
    $currentArgID = $_SESSION['returnToArg'];
        $profileID = $_SESSION['profile'];
        $type = $_SESSION["carriedType"];
        $supportArgVal = $_POST["useInstead"];
        //Endorse the alternative as supportive of the arg
        include('connect.php');
        
    //set up a new argument in the Db 
    
    $sql = "INSERT INTO ENDORSEMENT VALUES($currentArgID,$profileID,'$type',$supportArgVal,100,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
    $sql .= "CALL resolveOldWithNewEndorse(\"".$type."\",".$currentArgID.",".$profileID.");";
    mysqli_multi_query($conn, $sql);
    mysqli_close($conn);


    //append the array of weights with the new 
    $arrayOfWeighIns = explode(",",$_SESSION["carriedWeights"]);
    echo "explode a null and get: ".$arrayOfWeighIns;
    $lowWeight = floatval(100); 
    //First, find the lowest weigh in value
    for ($i = 0; $i < (count($arrayOfWeighIns)-1); $i+=2) {
      if($arrayOfWeighIns[$i+1]<$lowWeight){
        $lowWeight = $arrayOfWeighIns[$i+1];
      }
    }
    //Add new argument to the array along with a weight equal to current lowest
    if(count($arrayOfWeighIns) == 1){
      $arrayOfWeighIns = array($supportArgVal,$lowWeight);
    }
    else {
      array_push($arrayOfWeighIns,$supportArgVal,$lowWeight);
    }
    //recalculate weights with extra baggage
    for ($i = 0; $i < (count($arrayOfWeighIns)-1); $i+=2) {
      $arrayOfWeighIns[$i+1] = number_format((float)(($arrayOfWeighIns[$i+1]/(100+$lowWeight))*100), 5, '.', '');
    }
    //rebuild string
    $arrayAsString = "";
    for ($i = 0; $i < count($arrayOfWeighIns); $i++) {
      $arrayAsString = $arrayAsString.$arrayOfWeighIns[$i].($i == count($arrayOfWeighIns)-1 ? "" : ","); //no comma if it is the last element, otherwise you get an extra element in your rebuilt array
    }
    $_SESSION["carriedWeights"] = $arrayAsString;
    $_SESSION["jumpTo"] = "backTo".$type;
    print_r($_SESSION);
    header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
  }
  else if(isset($_POST["assertion"])){
    $_SESSION["assertion"] = $_POST["assertion"];
    $_SESSION["jumpTo"] = "reviewAssert";
    $_SESSION["carriedWeights"] = $_POST["weighInWith"];
    $_SESSION["carriedType"] = $_POST["carriedType"];
    header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
  }
  else
    echo "ERROR<br>";
 ?>




!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!new assertion!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
<?php
  session_start(); 
  header("Content-Type: text/html; charset=ISO-8859-1"); //insure symbols in text are recognized.
  //print_r($_SESSION);
    //print_r($_POST);
    echo '<script type="text/javascript">',
         'document.write(clickArr);',
         '</script>';
    include('connect.php');
    $currentArgID = intval($_SESSION['returnToArg']);
    $endorseType = $_SESSION["carriedType"];
    $sql = "SELECT DISTINCT phrasing, argumentID FROM PHRASING WHERE phrasing NOT IN
    (SELECT Ph.phrasing
        FROM ENDORSEMENT E, PHRASING Ph
          WHERE Ph.argumentID = E.supportingArgID 
        AND E.targArgID = $currentArgID
        AND E.endorseType = '$endorseType'
          GROUP BY E.supportingArgID)";
  $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      echo "<table class=\"highlightTbl\">\n";
      // output data of each row
      echo "<tr>\n";
      while($row = mysqli_fetch_row($result)) {
        echo "<tr>\n";  
        echo "<td>" . $row[0] . "</td>";
        echo "<td>
        <form action=\"functions.php\" method=\"POST\">
        <button type=\"submit\" class=\"buttonSmall newAssertion\" name=\"useInstead\" value=\"".$row[1]."\">Use</button>
        </form></td>\n";
        echo "</tr>\n";
    }
    echo "</table>\n";
  } else {
    echo "0 results";
  }
  mysqli_free_result($result);
  mysqli_close($conn);
  //print_r($_SESSION);
  //print_r($_POST);
?>
