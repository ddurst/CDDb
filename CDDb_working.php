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
 
        <form action="new_assertion.php" method="POST">
          Not Listed <input style="display: inline-block; width: 80%;" type="text" name="assertion" placeholder="If no similar arguments exist to support position, add your own...">
          <input style="display: inline-block;" type="submit" value="Add">
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
          $baseURL = 'http://localhost:8888/CDDb_working.php';
          include('weigh_associated.php');
        ?>
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
          <strong>Its important to err toward convergence, any of these close enough?</strong>
      </section>
      <section class="weighContent">
        <?php
          $endorseType = 'Because'; //TODO Endorse type needs to change depending on where it was triggered
          //include('new_assertion.php');
        ?>
      </section>
      <section class="weighFooter" style="background-color:var(--cddbGrey);">

        <form action="functions.php" method="POST">
          <button type="submit" class="button weighRebuttal" name="buttonClicked" value="weighRebuttal"><strong>Submit</strong></button>
          <!-- This hidden field handles an input array the user populates in "weigh in" overlays -->
          <input type="hidden" name="weighInWith" id="weighInWith" value="" /> 
        </form>

      </section>
    </div>
    <!-- End of overlays -->
  </div>  
</div>


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
