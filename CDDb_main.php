<?php 
  session_start(); 
  $_SESSION['currentArg'] = intval($_GET["arg"]); 
  
?>


<!DOCTYPE html>
<html>
<head>
  <title>The Collective Dialectic Database</title>
  <meta charset="utf-8"/>
  <meta name="keywords" content="argument, dialectic, reasoning, anti-troll, discussion, debate, assertion network, 
    dialogue, public forum, town square, consensus building, diliberation chamber, diliberative body, dynamic 
    polling, self-guided polling, opposition research, best reason why, best reason not"/>
  <meta name="copyright" content="Copyright 2015 Craig Danz Seattle, WA USA">  
  <meta name="robots" content="follow"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" href="CDDb_styles.css">
  <script src="CDDb_script.js"></script>
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
        Because...
      </div>
      <div class="box_content becauseContent">
        Here is where we list the because stuff
      </div>
      <div class="box_nofoot becauseInvert"></div>
    </div>
    <div class="head_cell">
      <div class="box_logo primaryColor">
        <!-- A standin for a logo-->
        <section style="
          color: white;
          font-size: 15vh;
        ">
          <span style="text-shadow: 5px 5px 10px var(--cddbBlue);">C</span><span style="text-shadow: 5px 5px 10px var(--cddbGreen);">D</span><span style="text-shadow: 5px 5px 10px var(--cddbRed);">Db</span>
        </section>
      </div>
      <div class="box_footer primaryColor">
        <div>About</div><div>Explore</div><div>Profile</div><div>Login</div>
      </div>
    </div>
    <div class="argument_cell">
      <div class="box_header primaryColor">
        Argument: [number whaterver]
      </div>
      <div class="box_content primaryInvert">
        Here is where all the argument stuff goes
      </div>
      <div class="box_nofoot primaryInvert"></div>
    </div>
    <div class="rebuttal_cell">
      <div class="box_header rebuttalColor">
        Rebuttal
      </div>
      <div class="box_content rebuttalContent">
        Here is where we list the rebuttal stuff
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