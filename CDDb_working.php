
<?php 
  session_start(); 
  $currentArgID = intval($_GET["arg"]); 
  $_SESSION['returnToArg']= $currentArgID; /*TODO This session variable won't pass for some reason*/
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
  <style>
    :root{ 
      --cddbRed: #af1a17;
      --cddbGreen: #10a020;
      --cddbBlue: #2d58a8;
      --cddbBlack: #0e0e0e;
      --cddbWhite: white;
      --cddbGrey: #939393;
    }
    #buttonTest8 { 
      float: left;
      margin: 0;
      font-weight: bold;
      text-align: center;
      border-width: 0;
      border-style: solid;
      border-radius: 50%;
      letter-spacing: -6px;
      background-color: var(--cddbGrey); 
      border-color: var(--cddbGrey);  
      width: 1rem; 
      height: 1rem;             
    }
    #buttonTest5 { 
      float: left;
      margin: 0;
      font-weight: bold;
      text-align: center;
      border-width: 0;
      border-style: solid;
      border-radius: 50%;
      letter-spacing: -6px;
      background-color: var(--cddbGrey); 
      border-color: var(--cddbGrey);  
      width: 1rem; 
      height: 1rem;             
    }
    #buttonTest11 { 
      float: left;
      margin: 0;
      font-weight: bold;
      text-align: center;
      border-width: 0;
      border-style: solid;
      border-radius: 50%;
      letter-spacing: -6px;
      background-color: var(--cddbGrey); 
      border-color: var(--cddbGrey);  
      width: 1rem; 
      height: 1rem;             
    }
  </style>
</head>
                      <!-- End Header -->
<body>

<!-- Deal with overlays here -->
<div id="overlay">
  <!-- TODO I clearly can't figure out how to properly adjust the height of this overlay window -->
  <div id="overContain">
    <div id="overWeighBecause">
      <section 
        style=" 
          font-size: 120%;
          color: white;
          background-color:var(--cddbBlue);
          padding-left: .5rem;   
          padding-bottom: .5rem;    
        ">
          <strong>[Current Argument] is true because...</strong>
      </section>
      <section 
        style="padding-left: .5rem; overflow:auto;">
        <?php
          $endorseType = 'Because';
          $baseURL = "http://localhost:8888/CDDb_working.php";
          include('weigh_associated.php');
        ?>
      </section>
      <section 
        style=" 
          font-size: 120%;
          color: white;
          background-color:var(--cddbBlue);
          padding-left: .5rem;   
          padding-bottom: .5rem;    
        ">
          <table border='0' width='100%'><tr>
            <td style="width:20%;"></td>
            <td style="width:25%; min-width:100px;">
              <button onclick="off()" class="button weighBecause" name="buttonClicked" value="weighBecause"><strong>Cancel</strong></button> 
            </td>
            <td style="width:10%; min-width:100px;">
              <button onclick="clearData()" class="button weighBecause" name="buttonClicked" value="weighBecause"><strong>&#x27F2;</strong></button> 
            </td>
            <td style="width:25%; min-width:100px; align: left;">
              <button onclick="on()" class="button weighBecause" name="buttonClicked" value="weighBecause"><strong>Submit</strong></button> 
            </td>
            <td style="width:20%;"></td>
          </tr>
      </table>
      </section>
      <!-- Testing out javascript buttons -->
      
        <table border = '0'>
          <tr>
            <td><div style="height: 100%; width: 100%; display:flex; justify-content:center; align-items: center;">
              <button id="buttonTest8" onclick="clickTheButton(8)"></button>
            </div></td> 
            <td>Item 1 - In my little list of stuff</td>
          </tr>
          <tr>
            <td><div style="height: 100%;width: 100%; display:flex; justify-content:center; align-items: center;">
              <button id="buttonTest5" onclick="clickTheButton(5)"></button>
            </div></td> 
            <td>Item 2 - In my little list of stuff</td>
          </tr>
          <tr>
            <td><div style="height: 100%; width: 100%; display:flex; justify-content:center; align-items: center;">
              <button id="buttonTest11" onclick="clickTheButton(11)"></button>
            </div></td> 
            <td>Item 3 - In my little list of stuff</td>
          </tr>
        </table>
      <!-- End of javascript buttons test -->
    </div>
  </div>  
</div>
<script>
var totalClicks = 0;
var clickArr = [];

function on() {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("overContain").style.display = "flex";
    document.getElementById("overWeighBecause").style.display = "block";
}

function off() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("overContain").style.display = "none";
    document.getElementById("overWeighBecause").style.display = "none";
}

function clearData() {
  for (var i = 0; i < clickArr.length; i++) {
    document.getElementById("buttonTest"+clickArr[i][0]).style.backgroundColor = "var(--cddbGrey)"; 
    document.getElementById("buttonTest"+clickArr[i][0]).style.width = "1rem"; 
    document.getElementById("buttonTest"+clickArr[i][0]).style.height = "1rem";   
  }
  clickArr.length = 0;
  totalClicks = 0;
}

function clickTheButton(argID) {
  totalClicks++;
  var found = false;
  var iterator = 0;
  var foundIndex;
  var clickRatio;
  var clickRatioStyle;
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
    document.getElementById("buttonTest"+argID).style.backgroundColor = "var(--cddbBlue)";
  }
  for (var i = 0; i < clickArr.length; i++) {
    clickRatio = .7+(((clickArr[i][1])/totalClicks)*5);
    clickRatioSyle = clickRatio + "rem";
    document.getElementById("buttonTest"+clickArr[i][0]).style.width = clickRatioSyle; 
    document.getElementById("buttonTest"+clickArr[i][0]).style.height = clickRatioSyle;  
  }
}

</script>

<div class="row-1">
  <div class="header">
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
            <button onclick="on()" class="button weighBecause" name="buttonClicked" value="weighBecause">Weigh In</button> 
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
            <form action='functions.php' method="POST">
              <button type="submit" class="button weighRebuttal" name="buttonClicked" value="weighRebuttal">Weigh In</button> 
            </form>
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
            <form action='functions.php' method="POST">
              <button type="submit" class="button weighSo" name="buttonClicked" value="weighSo">Weigh In</button> 
            </form>
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
