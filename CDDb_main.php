<?php 
  session_start(); 
  $_SESSION['currentArg'] = intval($_GET["arg"]); 
  require_once('argument_at_hand.php');
  $baseURL = "http://localhost/CDDB_main.php";
  //print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Vestigette</title>
  <meta charset="utf-8"/>
  <meta name="keywords" content="argument, dialectic, reasoning, anti-troll, discussion, debate, assertion network, 
    dialogue, public forum, town square, consensus building, diliberation chamber, diliberative body, dynamic 
    polling, self-guided polling, opposition research, best reason why, best reason not"/>
  <meta name="copyright" content="Copyright 2015 Craig Danz Seattle, WA USA">  
  <meta name="robots" content="follow"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" href="CDDb_styles.css">
  <script type="text/javascript"> //Figure out if I can do this anywhere better. Don't know how to do it directly in script file and is clunky echoing it out in php. 
    var jsBecause = <?php echo json_encode($because); ?>;
  </script>
  <script type="text/javascript" src="script_CDDb.js"></script>
  <style>
    <?php
      include('dynamic-styling_CDDb.php');
    ?>
  </style>
</head>
                      <!-- End Header -->
<body>
  <div class="main_grid">
    <div class="because_cell">
      <div class="box_header becauseColor">
        <div>
          Because...
        </div>



          <?php if($_SESSION['opinion'] > 0){ ?> 
            <div style="width: 70%;"></div>

            <button onclick="becauseClearData()" class="button weighBecause" name="buttonClicked" value="weighBecause">&#x27F2;</button> 

            <!-- TESTER Bring back the form below in all its glory when you are ready to run with the big dogs -->
            <button onclick="testFunction()" class="button weighBecause" name="buttonClicked" value="weighBecause">Weigh In</button> 
            <!--<form action="functions.php" method="POST">
              <button onclick="testFunction()" class="button weighBecause" name="buttonClicked" value="weighBecause">Weigh In</button> 
              <button type="submit" class="button weighBecause" name="buttonClicked" value="weighBecause">Weigh In</button>-->
              <!-- This hidden field has its value updated with an array as a string serving as the "weigh in" input -->
              <input type="hidden" name="becauseWeighInWith" id="becauseWeighInWith" value="" /> 
            <!--</form>-->
          <?php } ?>



      </div>
      <div class="box_content becauseContent">

        <?php
          $endorseType = 'Because';
          include('associated_arguments.php');
        ?>  

          <!-- Create a new argument to use when the one you need is not yet available -->
          <?php if($_SESSION['opinion'] > 0){ ?> 
            <form action="functions.php" method="POST">
              <button type="submit" class="button weighBecause" name="buttonClicked" value="becauseAddAssertion">Add</button>
              <input type="text" size="120" name="becauseAddAssertion" id="becauseAddAssertion" value="" /> 
            </form>
          <?php } ?>
      </div>
      <div class="box_nofoot becauseInvert"></div>
    </div>
    <div class="head_cell">
      <div class="box_logo primaryColor">
        <!-- A standin for a logo-->
        <section style="
          color: white;
          font-size: 12vh;
        ">
          <span style="text-shadow: 5px 5px 15px var(--cddbRed);">Vestigette</span>
        </section>
      </div>
      <div class="box_footer primaryColor">
        <div>About</div>
        <div>Explore</div>
        <div>Profile</div>
        <div><a href="login.php?arg=<?php echo $_SESSION['currentArg'];?>">Login</a></div> 
      </div>
    </div>
    <div class="argument_cell">
      <div class="box_header primaryColor">
        <div>
          Argument: <?php echo $_SESSION['currentArg'];?>
          <!--Green check if logged in user accepts aurgement at hand, red X if they reject -->
          <?php if($_SESSION['opinion'] > 0){ ?>
            <affirm>&#x2714;</affirm>
          <?php } ?>
          <?php if($_SESSION['opinion'] < 0){ ?>
            <negate>&#x2718;</negate>
          <?php } ?>
        </div>

        <!--ACCEPT OR REJECT BUTTON
          4 possible states
            1) No user logged in - both options available, both link to login
            2) User logged in but no opinion selected yet - Both options available and will set opinion accordingly.
            3) User logged in has opinion affirming argument - Accept w/ color to indicate selected, Reject greyed and colored on hover to show available to set opinion to the opposite.
            4) User logged in has opinion negating argument - Reject w/ color to indicate selected, Accept greyed and colored on hover to show available to set opinion to the opposite.
        -->
        <div class="choiceHold"><div class="choice">

          <!--1-->
          <?php if(!isset($_SESSION['profile'])){ ?>
              <form action="login.php?arg=<?php echo $currentArgID; ?>" method="POST">
                <button type="submit" class="button acceptOpen" name="buttonClicked" value="accept">Accept</button> 
              </form>
              <form action="login.php?arg=<?php echo $currentArgID; ?>" method="POST">
                <button type="submit" class="button rejectOpen" name="buttonClicked" value="reject">Reject</button> 
              </form>
          <?php } ?>

          <!--2-->
          <?php if(isset($_SESSION['profile']) and ($_SESSION['opinion'] == 0)){ ?>
              <form action='functions.php' method="POST">
                <button type="submit" class="button acceptOpen" name="buttonClicked" value="accept">Accept</button> 
              </form>
              <form action='functions.php' method="POST">
                <button type="submit" class="button rejectOpen" name="buttonClicked" value="reject">Reject</button> 
              </form>
          <?php } ?>

          <!--3-->
          <?php if(isset($_SESSION['profile']) and ($_SESSION['opinion'] > 0)){ ?>

              <button type="submit" class="button acceptSet" name="buttonClicked" value="accept">Accepted</button> 
              <form action='functions.php' method="POST">
                <button type="submit" class="button rejectOpen" name="buttonClicked" value="reject">Reject</button> 
              </form>
          <?php } ?>

          <!--4-->
          <?php if(isset($_SESSION['profile']) and ($_SESSION['opinion'] < 0)){ ?>
              <form action='functions.php' method="POST">
                <button type="submit" class="button acceptOpen" name="buttonClicked" value="accept">Accept</button> 
              </form>
          <button type="submit" class="button rejectSet" name="buttonClicked" value="reject">Rejected</button> 
          <?php } ?>
        </div></div>
      </div>



      <div class="box_content primaryInvert">
        <div class="genContain">Rate: <?php echo "$rate\n";?><br>
          Based on this many users: <?php echo "$assertions\n";?><br>
          Phrased: <?php echo "$phrasing\n";?></div>
        <div class="genContain">
          Title: <?php echo $links[0][4];?><br>
          Link: <?php echo $links[0][0];?><br>
          Publisher: <?php echo $links[0][1];?><br>
          By first name: <?php echo $links[0][2];?><br>
          By last name: <?php echo $links[0][3];?><br>
        </div>
      </div>
      <div class="box_nofoot primaryInvert"></div>
    </div>
    <div class="rebuttal_cell">
      <div class="box_header rebuttalColor">
        Rebuttal
      </div>
      <div class="box_content rebuttalContent">
        <div class='lineItem'>
          <div class='acceptRate'>".$line[1]."</div>
          <div class='assertLink'><a href=" . $baseURL . "?arg=" . $line[0] . ">" . $line[2] . "</a></div>
          <div class='bumpButton'><button class='bump' onclick='becauseBump(5)'>XYZ</button></div>
          <div class='pendingWeight'>{calc}</div>
        </div>
      </div>
      <div class="box_nofoot rebuttalInvert"></div>
    </div>
    <div class="therefore_cell">
      <div class="box_header thereforeColor">
        Therefore...
      </div>
      <div class="box_content thereforeContent">
        Here is where we list the therefore stuff
      </div>
      <div class="box_nofoot thereforeInvert"></div>
    </div>
    <div class="filter_cell">
      <div class="box_header primaryColor">
        Filter
      </div>
      <div class="box_content primaryInvert">
        Here is where we deal with filters
      </div>
      <div class="box_nofoot primaryInvert"></div>
    </div>
  </div>
</body>
</html>