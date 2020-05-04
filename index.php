<!-- 
  **FILE DESCRIPTION**
    The front page - html, php, and javascript. All dynamic content is called from this file and this is the file the web will reference. 
  **NEEDS**
    If CSS inline it is because I'm not sure how to better handle.
  **WRITTEN BY**
    Craig Danz - Seattle, WA - Copyright January 18, 2018

  **SYSTEM DESCRIPTION**
    A structure for expression measuring while shaping a map of "the dialogue". Reduces noise and contextualizes to enable productive collective decision making.      
      ** Novel reference material to join dictionaries, encyclopedias and atlases
      ** Manages competing priorities
      ** Enable governing bodies
      ** Public/Private knowledgebase
      ** Next gen-polling
      ** Content discovery
    The Dialogue - defined here as the collective expression of online/media/community chatter as individually percieved AKA "The Discourse", "conventional wisdom", what "Society Tells You to Think" .
    An organizing principle with an emphasis on context. 
-->



<?php 
  if(session_status()!=PHP_SESSION_ACTIVE) session_start();
  $_SESSION['currentArg'] = intval($_GET["arg"]); 
  require_once('argument_at_hand.php');
  $baseURL = "http://localhost/CDDB_main.php";
  $_SESSION['currentBecause'] = $because; 
  $_SESSION['currentTherefore'] = $therefore; 
  $_SESSION['currentRebuttal'] = $rebuttal; 
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

  <script type="text/javascript" src="script_CDDb.js"></script>
  <script type="text/javascript"> //Figure out if I can do this anywhere better. Don't know how to do it directly in script file and is clunky echoing it out in php. 
    var jsBecause = <?php echo json_encode($because); ?>;
    var jsTherefore = <?php echo json_encode($therefore); ?>;
    var jsRebuttal = <?php echo json_encode($rebuttal); ?>;
  </script>
  <style>
    <?php
      include('dynamic-styling_CDDb.php');
    ?>
  </style>
</head>
                      <!-- End Header -->
<body>

<!-- Overlay used to refine phrasing or explication -->
<div id="overlay">
  <!-- TODO I clearly can't figure out how to properly adjust the height of this overlay window -->
  <div id="overContain">
    <!-- New Assertion overlay -->
    <div id="overPhrasing">
      <div class="box_header neutralColor">
        <div>Otherwise Put</div>
        <button onclick="concealPhrasing()" class="button shame" name="buttonClicked" value="altPhrasing">X</button> 
      </div>
      <?php
        if (count($altPhrasings) > 0) { 
          $lineColorIterator = 0;
          foreach($altPhrasings as $row) {
            if ($lineColorIterator % 2  == 0) { 
              echo "<div class='lineItem'>";
            }
            else{
              echo "<div class='lineItem2'>";
            }
            $lineColorIterator++;

            echo "<div>" . $row[0] . "</div>\n";
            if(isset($_SESSION['profile']) and ($_SESSION['opinion'] > 0)){
            

              echo "<div class=\"choiceHold\"><div class=\"choice\"><div>
                <form action=\"checkMotJuste.php\" method=\"POST\">
                  <button type=\"submit\" class=\"button phraseQuibble\" name=\"buttonClicked\" value=\"phraseQuibble\">eh...<span class=\"tooltiptext\">Almost but not quite</span></button> 
                  <input type=\"hidden\" name=\"phraseQuibble\" id=\"phraseQuibble\" value=" . $row[1] . " /> 
                </form>
                <form action=\"functions.php\" method=\"POST\">
                  <button type=\"submit\" class=\"button phrasePrefer\" name=\"buttonClicked\" value=\"promotePutForth\">Preferred</button>
                  <input type=\"hidden\" name=\"promotePutForth\" id=\"promotePutForth\" value=" . $row[1] . " /> 
                </form>


              </div></div></div>";
            }
            echo "</div>";
          }
        }
        else {
          echo "0 results";
        }
      ?>

        <!-- Create a new put forth to use when the one you need is not yet available -->

          <?php if($_SESSION['opinion'] > 0){ ?> 
            <form action="functions.php" method="POST">
              <button type="submit" class="button shame" name="buttonClicked" value="newPutForth">Add</button>
              <input type="text" size="120" name="newPutForth" id="newPutForth" value="" /> 
            </form>
          <?php } ?>

    </div>
    <div id="overExplication">
      <div class="box_header neutralColor">
        <div>The argument may be better developed or revealed by the following</div>
        <button onclick="concealExplication()" class="button shame" name="buttonClicked" value="altExplication">X</button> 
      </div>
      <?php
        if (count($links[0][0]) != null) { 
          foreach($links as $row) {
            if(strlen($row[5])<1){
              $row[5] = $row[1]; //If there is no value for the title just set the url as the title
            }
            echo "<div class='lineItemLabel'><div>Users promoting</div><div>Explication links</div></div>";
            echo "<div class='lineItem'>";
            echo "<div>" . $row[0] . "</div>\n";
            echo "<div><a href=\"" . $row[1] . "\"target=\"_blank\">" . $row[5] . "</a></div>\n";
            if(isset($_SESSION['profile']) and ($_SESSION['opinion'] > 0)){
              echo "<div>
              <form action=\"functions.php\" method=\"POST\">
                        <button type=\"submit\" class=\"button shame\" name=\"buttonClicked\" value=\"promoteExplication\">My Pick</button>
                        <input type=\"hidden\" name=\"promoteExplication\" id=\"promoteExplication\" value=\"" . $row[1] . "\" /> 
                    </form>
              </div>";
            }
            echo "</div>\n<hr />";
          }
        }

        else {
        echo "No one has offered a link to any content as any sort of explication for this argument yet. Add your own!";
        }
      ?>

      <!-- Add a new link that isn't available yet -->

          <?php if($_SESSION['opinion'] > 0){ ?> 
            <form action="functions.php" method="POST">
              <button type="submit" class="button shame" name="buttonClicked" value="promoteExplication">Add</button>
              <input type="text" size="120" name="promoteExplication" id="promoteExplication" value="" style="display: block; height: 2rem;"/> 
            </form>
          <?php } ?>

    </div>
  </div>  
</div> 
<!-- End of overlays -->



  <div class="main_grid">
    <div class="because_cell">
      <div class="box_header becauseColor">
        <div>
          Because...
        </div>



          <?php if($_SESSION['opinion'] > 0){ ?> 
            <div style="width: 70%;"></div>

            <button onclick="becauseClearData()" class="button weighBecause" name="buttonClicked" value="weighBecause">&#x27F2;</button> 

            <form action="functions.php" method="POST"> 
              <button type="submit" class="button weighBecause" name="buttonClicked" value="weighBecause">Weigh In</button>
              <!-- This hidden field has its value updated with an array as a string serving as the "weigh in" input -->
              <input type="hidden" name="becauseWeighInWith" id="becauseWeighInWith" value="" /> 
            </form>
          <?php } ?>
      </div>
      <div class="box_content becauseContent">
        <?php
          $endorseType = 'Because';
          include('associated_arguments.php');
        ?>  

          <!-- Create a new argument to use when the one you need is not yet available -->
          <?php if($_SESSION['opinion'] > 0){ ?> 
            <form action="checkNewAssertion.php" method="POST">
              <button type="submit" class="button weighBecause" name="buttonClicked" value="becauseAddAssertion">Add</button>
              <input type="text" size="120" name="becauseAddAssertion" id="becauseAddAssertion" value="" /> 
            </form>
          <?php } ?>
      </div>


        <!-- TODO Total Hack Job Here - Needs to be rethought and better solution
            If zero results then there is no means to add any. That won't do. If the JS array for this type had no results then it is null. Check for null and display the attributes for adding an endorsement. We only need one of the three button weighBecause elements (as of 10.6.2019) so I hard code call the third element in the array of all to change the display to block. Why? cause it is easier for now. But needs a fix. I also display the input field. The whole thing is wrapped in a ph conditional so this only shows up when the appropriate accept/reject condition is chosen along with a logged in user. 

            This "solution" breaks normal flow with how I want to interact with each window individually and if a user switch I want it to revert. I expect bugs with this. 
         -->
        <?php if(isset($_SESSION['profile']) and ($_SESSION['opinion'] > 0) and (count($because)==0)){ ?>
          <script type="text/javascript"> 
              var actionButtonClassArray = document.getElementsByClassName("button weighBecause");
              actionButtonClassArray[2].style.display = "block";
              document.getElementById("becauseAddAssertion").style.display = "block";
          </script>
        <?php } ?>
        <!--End of Hack that I want to fix-->


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
        <div class="argBox_grid">
          <div class="stat_subCell">
            <div class="statBig">
              <?php 
                if(strlen($rate)==5){
                  echo substr($rate,0,3);
                }
                else if(strlen($rate)==4){
                  echo substr($rate,0,2);
                }
                else if(strlen($rate)==3){
                  echo substr($rate,0,1);
                }
              ?>
            </div>
            <div class="statSmall">
              <?php 
                if(strlen($rate)==5){
                  echo substr($rate,3,2)."%\n";
                }
                else if(strlen($rate)==4){
                  echo substr($rate,2,2)."%\n";
                }
                else if(strlen($rate)==3){
                  echo substr($rate,1,1)."%\n";
                }
                else if(strlen($rate)==2){
                  echo substr($rate,0,1)."%\n";
                }
              ?>
            </div>
            <div class="statDetail">
              Based on <?php echo $assertions; if($assertions == 1) echo " user\n"; else echo " users\n";?>
            </div>
          </div>
          <div class="phrased_subCell">
            <?php echo "$phrasing\n";?>
          </div>
          <div class="phraseAltBtn_subCell">
            <button onclick="revealPhrasing()" class="button phraseAltBtn" name="buttonClicked" value="altPhrasing">&#x270e;</button> 
          </div>
          <div class="explication_subCell">
            <?php 
              if(strlen($links[0][5])<1){
                $links[0][5] = $links[0][1]; //If there is no value for the title just set the url as the title
              }
            ?>
            <a href="<?php echo $links[0][1];?>" target="_blank"><?php echo $links[0][5];?></a><br>
            Publisher: <?php echo $links[0][2];?><br>
            Author: <?php echo $links[0][3]." ".$links[0][4];?><br>
          </div>
          <div class="explicationAltBtn_subCell">
            <button onclick="revealExplication()" class="button explicationAltBtn" name="buttonClicked" value="altExplication">&#x2318;</button> 
          </div>
        </div>
      </div>
      <div class="box_nofoot primaryInvert"></div>
    </div>
    <div class="rebuttal_cell">
      <div class="box_header rebuttalColor">
        <div>
          Rebuttal
        </div>

          <!--TODO Ripped from because section, customization for rebuttal in progress-->
          <?php if($_SESSION['opinion'] < 0){ ?> 
            <div style="width: 70%;"></div>

            <button onclick="rebuttalClearData()" class="button weighRebuttal" name="buttonClicked" value="weighRebuttal">&#x27F2;</button> 

            <form action="functions.php" method="POST"> 
              <button type="submit" class="button weighRebuttal" name="buttonClicked" value="weighRebuttal">Weigh In</button>
              <!-- This hidden field has its value updated with an array as a string serving as the "weigh in" input -->
              <input type="hidden" name="rebuttalWeighInWith" id="rebuttalWeighInWith" value="" /> 
            </form>
          <?php } ?>
        </div>
      <div class="box_content rebuttalContent">
        <!--TODO Ripped from because section, customization for rebuttal in progress-->
        <?php
          $endorseType = 'Rebuttal';
          include('associated_arguments.php');
        ?>  

          <!-- Create a new argument to use when the one you need is not yet available -->
          <?php if($_SESSION['opinion'] < 0){ ?> 
            <form action="checkNewAssertion.php" method="POST">
              <button type="submit" class="button weighRebuttal" name="buttonClicked" value="rebuttalAddAssertion">Add</button>
              <input type="text" size="120" name="rebuttalAddAssertion" id="rebuttalAddAssertion" value="" /> 
            </form>
          <?php } ?>
      </div>

        <!-- TODO Total Hack Job Here - Needs to be rethought and better solution
            If zero results then there is no means to add any because the form only appears after a selection is made in yte window. That won't do. If the JS array for this type had no results then it is null. Check for null and display the attributes for adding an endorsement. We only need one of the three button weighBecause elements (as of 10.6.2019) so I hard code call the third element in the array of all to change the display to block. Why? cause it is easier for now. But needs a fix. I also display the input field. The whole thing is wrapped in a ph conditional so this only shows up when the appropriate accept/reject condition is chosen along with a logged in user. 

            This "solution" breaks normal flow with how I want to interact with each window individually and if a user switch I want it to revert. I expect bugs with this. 
         -->
        <?php if(isset($_SESSION['profile']) and ($_SESSION['opinion'] < 0) and (count($rebuttal)==0)){ ?>
          <script type="text/javascript"> 
              var actionButtonClassArray = document.getElementsByClassName("button weighRebuttal");
              actionButtonClassArray[2].style.display = "block";
              document.getElementById("rebuttalAddAssertion").style.display = "block";
          </script>
        <?php } ?>
        <!--End of Hack that I want to fix-->


      <div class="box_nofoot rebuttalInvert"></div>
    </div>
    <div class="therefore_cell">
      <div class="box_header thereforeColor">
        <div>
          Therefore...
        </div>
          <?php if($_SESSION['opinion'] > 0){ ?> 
            <div style="width: 70%;"></div>

            <button onclick="thereforeClearData()" class="button weighTherefore" name="buttonClicked" value="weighTherefore">&#x27F2;</button> 

            <form action="functions.php" method="POST"> 
              <button type="submit" class="button weighTherefore" name="buttonClicked" value="weighTherefore">Weigh In</button>
              <!-- This hidden field has its value updated with an array as a string serving as the "weigh in" input -->
              <input type="hidden" name="thereforeWeighInWith" id="thereforeWeighInWith" value="" /> 
            </form>
          <?php } ?>
        </div>
      <div class="box_content thereforeContent">
        <?php
          $endorseType = 'Therefore';
          include('associated_arguments.php');
        ?>  
          <!-- Create a new argument to use when the one you need is not yet available -->
          <?php if($_SESSION['opinion'] > 0){ ?> 
            <form action="checkNewAssertion.php" method="POST">
              <button type="submit" class="button weighTherefore" name="buttonClicked" value="thereforeAddAssertion">Add</button>
              <input type="text" size="120" name="thereforeAddAssertion" id="thereforeAddAssertion" value="" /> 
            </form>
          <?php } ?>
      </div>

        <!-- TODO Total Hack Job Here - Needs to be rethought and better solution
            If zero results then there is no means to add any. That won't do. If the JS array for this type had no results then it is null. Check for null and display the attributes for adding an endorsement. We only need one of the three button weighBecause elements (as of 10.6.2019) so I hard code call the third element in the array of all to change the display to block. Why? cause it is easier for now. But needs a fix. I also display the input field. The whole thing is wrapped in a ph conditional so this only shows up when the appropriate accept/reject condition is chosen along with a logged in user. 

            This "solution" breaks normal flow with how I want to interact with each window individually and if a user switch I want it to revert. I expect bugs with this. 
         -->
         <?php if(isset($_SESSION['profile']) and ($_SESSION['opinion'] > 0) and (count($therefore)==0)){ ?>
          <script type="text/javascript"> 
              var actionButtonClassArray = document.getElementsByClassName("button weighTherefore");
              actionButtonClassArray[2].style.display = "block";
              document.getElementById("thereforeAddAssertion").style.display = "block";
          </script>
        <?php } ?>
        <!--End of Hack that I want to fix-->


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