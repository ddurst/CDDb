//Deprecated 9.25.2019 - var totalClicks = 0;
//Deprecated 9.25.2019 - var clickArr = [];
var becauseTotalClicks = 0;
var becauseClickArr = [];
var thereforeTotalClicks = 0;
var thereforeClickArr = [];
var rebuttalTotalClicks = 0;
var rebuttalClickArr = [];
var maxFontNum = 2.9; //font gets too huge past 50% so cap it there
var diameter;
var diameterIncludeRem;
var diameterShift = .4; //This should match vars in dynamic-styling_CDDb.php minimum size and amount added to all diamters
var diameterFactor = 5; //This should match vars in dynamic-styling_CDDb.php diamter will be this many times bigger than a single rem.
var rateAsString;
var leftOfDec;
var decOnRight;
//var testArr = [25,30,45];

/*Deprecated 9.25.2019
function updateWeighInValue() {
  var arrayAsString = "";
  for (var i = 0; i < clickArr.length; i++) {
      arrayAsString = arrayAsString + clickArr[i][0] + ","; 
      arrayAsString = arrayAsString + ((clickArr[i][1]/totalClicks)*100).toFixed(5) + ",";
  }
  document.getElementById("weighInWith").value = arrayAsString;
}
*/

//Verified after 9.25 Audit
function updateBecauseWeighInValue() {
  var arrayAsString = "";
  for (var i = 0; i < becauseClickArr.length; i++) {
      arrayAsString = arrayAsString + becauseClickArr[i][0] + ","; 
      arrayAsString = arrayAsString + ((becauseClickArr[i][1]/becauseTotalClicks)*100).toFixed(5) + ",";
  }
  document.getElementById("becauseWeighInWith").value = arrayAsString;
}

//Verified after 9.25 Audit
function updateThereforeWeighInValue() {
  var arrayAsString = "";
  for (var i = 0; i < thereforeClickArr.length; i++) {
      arrayAsString = arrayAsString + thereforeClickArr[i][0] + ","; 
      arrayAsString = arrayAsString + ((thereforeClickArr[i][1]/thereforeTotalClicks)*100).toFixed(5) + ",";
  }
  document.getElementById("thereforeWeighInWith").value = arrayAsString;
}

//Verified assuming 9.25 Audit was accurate
function updateRebuttalWeighInValue() {
  var arrayAsString = "";
  for (var i = 0; i < rebuttalClickArr.length; i++) {
      arrayAsString = arrayAsString + rebuttalClickArr[i][0] + ","; 
      arrayAsString = arrayAsString + ((rebuttalClickArr[i][1]/rebuttalTotalClicks)*100).toFixed(5) + ",";
  }
  document.getElementById("rebuttalWeighInWith").value = arrayAsString;
}

//Reset because back to neutral - the weigh in roll back to zero in preparation for another round of weighting
//Verified after 9.25 Audit
function becauseClearData() {
  for(i = 0, l = jsBecause.length; i < l; i++) { //TODO it is better to cache the length of an array like this than to look it up each time. http://bonsaiden.github.io/JavaScript-Garden/#array.general Have all js for loops do this. 
    goNeutral('Because',jsBecause[i][0]);
    //document.getElementById("displayBtnBecause"+jsBecause[i][0]).setAttribute("onclick","firstClickBecause("+jsBecause[i][0]+")"); 
  }
  becauseClickArr.length = 0;
  becauseTotalClicks = 0;
}

//Reset therefore back to neutral - the weigh in roll back to zero in preparation for another round of weighting
//Verified after 9.25 Audit
function thereforeClearData() {
  for(i = 0, l = jsTherefore.length; i < l; i++) { //TODO it is better to cache the length of an array like this than to look it up each time. http://bonsaiden.github.io/JavaScript-Garden/#array.general Have all js for loops do this. 
    goNeutral('Therefore',jsTherefore[i][0]);
    //document.getElementById("displayBtnBecause"+jsBecause[i][0]).setAttribute("onclick","firstClickBecause("+jsBecause[i][0]+")"); 
  }
  thereforeClickArr.length = 0;
  thereforeTotalClicks = 0;
}

//Reset therefore back to neutral - the weigh in roll back to zero in preparation for another round of weighting
//Verified assuming 9.25 Audit was accurate
function rebuttalClearData() {
  for(i = 0, l = jsRebuttal.length; i < l; i++) { //TODO it is better to cache the length of an array like this than to look it up each time. http://bonsaiden.github.io/JavaScript-Garden/#array.general Have all js for loops do this. 
    goNeutral('Rebuttal',jsRebuttal[i][0]);
    //document.getElementById("displayBtnBecause"+jsBecause[i][0]).setAttribute("onclick","firstClickBecause("+jsBecause[i][0]+")"); 
  }
  rebuttalClickArr.length = 0;
  rebuttalTotalClicks = 0;
}

//Return the because to a state as though untouched
//Verified after 9.25 Audit
function becauseRevert() {
  var actionButtonClassArray = document.getElementsByClassName("button weighBecause");
  var i;
  var l;
  for (i = 0, l = actionButtonClassArray.length; i < l; i++) {
    actionButtonClassArray[i].style.display = "none";
  }
  document.getElementById("becauseAddAssertion").style.display = "none";
  for(i = 0, l = jsBecause.length; i < l; i++) {  
    document.getElementById("displayBtnBecause"+jsBecause[i][0]).setAttribute("onclick","firstClickBecause("+jsBecause[i][0]+")"); 
    var btn = document.getElementById("displayBtnBecause"+jsBecause[i][0]);
    btn.className = "";
    diameter = diameterShift + ((jsBecause[i][1] / 100) * diameterFactor);
    if (diameter > maxFontNum) diFontSize = maxFontNum;
    else diFontSize = diameter;
    rateAsString = jsBecause[i][1]; 
      if (jsBecause[i][1] < 10) {
        leftOfDec = rateAsString.substring(0,1); 
        decOnRight = rateAsString.substring(1,3);
      }
      else if(jsBecause[i][1] < 100) {
        leftOfDec = rateAsString.substring(0,2);
        decOnRight = rateAsString.substring(2,4);
      }
      else { //100 is the only 3 digit number left of decimal
        leftOfDec = rateAsString.substring(0,3);
        decOnRight = rateAsString.substring(3,5);
      }
    decOnRight += "%";
    document.getElementById("btnContainerBecause"+jsBecause[i][0]).style.width = diameter + "rem"; 
    document.getElementById("btnContainerBecause"+jsBecause[i][0]).style.height = diameter + "rem"; 
    document.getElementById("displayBtnBecause"+jsBecause[i][0]).innerHTML = leftOfDec;
    document.getElementById("displayBtnBecause"+jsBecause[i][0]).style.fontSize = diFontSize + "rem"; 
    var setSmall = document.createElement("SPAN");
    setSmall.setAttribute("style", "font-size:.6em");
    var smallLetters = document.createTextNode(decOnRight);
    setSmall.appendChild(smallLetters);
    document.getElementById("displayBtnBecause"+jsBecause[i][0]).appendChild(setSmall);
  }
  becauseClickArr.length = 0;
  becauseTotalClicks = 0;
}

//Verified after 9.25 Audit
function thereforeRevert() {
  var actionButtonClassArray = document.getElementsByClassName("button weighTherefore");
  var i;
  var l;
  for (i = 0, l = actionButtonClassArray.length; i < l; i++) {
    actionButtonClassArray[i].style.display = "none";
  }
  document.getElementById("thereforeAddAssertion").style.display = "none";
  for(i = 0, l = jsTherefore.length; i < l; i++) {  
    document.getElementById("displayBtnTherefore"+jsTherefore[i][0]).setAttribute("onclick","firstClickTherefore("+jsTherefore[i][0]+")"); 
    var btn = document.getElementById("displayBtnTherefore"+jsTherefore[i][0]);
    btn.className = "";
    diameter = diameterShift + ((jsTherefore[i][1] / 100) * diameterFactor);
    if (diameter > maxFontNum) diFontSize = maxFontNum;
    else diFontSize = diameter;
    rateAsString = jsTherefore[i][1]; 
      if (jsTherefore[i][1] < 10) {
        leftOfDec = rateAsString.substring(0,1); 
        decOnRight = rateAsString.substring(1,3);
      }
      else if(jsTherefore[i][1] < 100) {
        leftOfDec = rateAsString.substring(0,2);
        decOnRight = rateAsString.substring(2,4);
      }
      else { //100 is the only 3 digit number left of decimal
        leftOfDec = rateAsString.substring(0,3);
        decOnRight = rateAsString.substring(3,5);
      }
    decOnRight += "%";
    document.getElementById("btnContainerTherefore"+jsTherefore[i][0]).style.width = diameter + "rem"; 
    document.getElementById("btnContainerTherefore"+jsTherefore[i][0]).style.height = diameter + "rem"; 
    document.getElementById("displayBtnTherefore"+jsTherefore[i][0]).innerHTML = leftOfDec;
    document.getElementById("displayBtnTherefore"+jsTherefore[i][0]).style.fontSize = diFontSize + "rem"; 
    var setSmall = document.createElement("SPAN");
    setSmall.setAttribute("style", "font-size:.6em");
    var smallLetters = document.createTextNode(decOnRight);
    setSmall.appendChild(smallLetters);
    document.getElementById("displayBtnTherefore"+jsTherefore[i][0]).appendChild(setSmall);
  }
  thereforeClickArr.length = 0;
  thereforeTotalClicks = 0;
}

// The very first click of any section has some extra work to do then all subsequent bumps. First click needs to switch the section from a display mode to an edit mode. It needs to accept the first edit in input mode while also surfacing features needed to input new weight. It is special for this reason. 
//Verified after 9.25 Audit
function firstClickBecause(argID) {
  thereforeRevert();
  //Getting elements by class returns an array that must be looped through to edit. 
  var actionButtonClassArray = document.getElementsByClassName("button weighBecause");
  var i;
  var l;
  for (i = 0, l = actionButtonClassArray.length; i < l; i++) {
    actionButtonClassArray[i].style.display = "block";
  }
  document.getElementById("becauseAddAssertion").style.display = "block";
  //Clear unentered Therefore and Rebuttals 
  for(i = 0, l = jsBecause.length; i < l; i++) { //TODO it is better to cache the length of an array like this than to look it up each time. http://bonsaiden.github.io/JavaScript-Garden/#array.general Have all js for loops do this. 
    goNeutral('Because',jsBecause[i][0]);
    document.getElementById("displayBtnBecause"+jsBecause[i][0]).setAttribute("onclick","bump('Because',"+jsBecause[i][0]+")"); 
  }
  bump('Because',argID);
}
//Verified after 9.25 Audit
function firstClickTherefore(argID) {
  becauseRevert();
  //Getting elements by class returns an array that must be looped through to edit. 
  var actionButtonClassArray = document.getElementsByClassName("button weighTherefore");
  var i;
  var l;
  for (i = 0, l = actionButtonClassArray.length; i < l; i++) {
    actionButtonClassArray[i].style.display = "block";
  }
  document.getElementById("thereforeAddAssertion").style.display = "block";
  //Clear unentered Therefore and Rebuttals 
  for(i = 0, l = jsTherefore.length; i < l; i++) { //TODO it is better to cache the length of an array like this than to look it up each time. http://bonsaiden.github.io/JavaScript-Garden/#array.general Have all js for loops do this. 
    goNeutral('Therefore',jsTherefore[i][0]);
    document.getElementById("displayBtnTherefore"+jsTherefore[i][0]).setAttribute("onclick","bump('Therefore',"+jsTherefore[i][0]+")"); 
  }
  bump('Therefore',argID);
}
//Verified assuming 9.25 Audit is accurate
function firstClickRebuttal(argID) {
  //Getting elements by class returns an array that must be looped through to edit. 
  var actionButtonClassArray = document.getElementsByClassName("button weighRebuttal");
  var i;
  var l;
  for (i = 0, l = actionButtonClassArray.length; i < l; i++) {
    actionButtonClassArray[i].style.display = "block";
  }
  document.getElementById("rebuttalAddAssertion").style.display = "block";
  //Clear unentered Rebuttal and Rebuttals 
  for(i = 0, l = jsRebuttal.length; i < l; i++) { //TODO it is better to cache the length of an array like this than to look it up each time. http://bonsaiden.github.io/JavaScript-Garden/#array.general Have all js for loops do this. 
    goNeutral('Rebuttal',jsRebuttal[i][0]);
    document.getElementById("displayBtnRebuttal"+jsRebuttal[i][0]).setAttribute("onclick","bump('Rebuttal',"+jsRebuttal[i][0]+")"); 
  }
  bump('Rebuttal',argID);
}

//This is the business
function bump(type,argID) {
  var found = false;
  var iterator = 0;
  var foundIndex;
  switch(type) {
    //Verified after 9.25 Audit
    case 'Because':
      becauseTotalClicks++;
      while (found == false && iterator < becauseClickArr.length) {
        if(becauseClickArr[iterator][0] == argID){
          found = true;
          becauseClickArr[iterator][1]++;
          foundIndex = iterator;
        }
        iterator++;
      }
      if (found == false) {
        foundIndex = becauseClickArr.length;
        becauseClickArr.push([argID,1]);
        //document.getElementById("displayBtn"+type+argID).style.backgroundColor = "var(--cddbBlue)"; 
        var btn = document.getElementById("displayBtn"+type+argID);
        btn.className = "";
      }
      for (var i = 0, l = becauseClickArr.length; i < l; i++) {
        //clickRatio = .7+(((clickArr[i][1])/totalClicks)*5); fixing the poorly named variable while I'm here
        //clickRatioStyle = clickRatio + "rem"; just hard code the rem part
        diameter = diameterShift + (((becauseClickArr[i][1])/becauseTotalClicks) * diameterFactor);
        //font gets too huge past 50% so cap it there
        if (diameter > maxFontNum) diFontSize = maxFontNum;
        else diFontSize = diameter;
        //diameterIncludeRem = diameter +
        rateAsString = ((becauseClickArr[i][1]/becauseTotalClicks)*100).toFixed(1); 
          if (((becauseClickArr[i][1]/becauseTotalClicks)*100) < 10) {
            leftOfDec = rateAsString.substring(0,1); 
            decOnRight = rateAsString.substring(1,3);
          }
          else if(((becauseClickArr[i][1]/becauseTotalClicks)*100) < 100) {
            leftOfDec = rateAsString.substring(0,2);
            decOnRight = rateAsString.substring(2,4);
          }
          else {
            leftOfDec = rateAsString.substring(0,3);
            decOnRight = rateAsString.substring(3,5);
          }
        decOnRight += "%";

        document.getElementById("btnContainer"+type+becauseClickArr[i][0]).style.width = diameter + "rem"; 
        document.getElementById("btnContainer"+type+becauseClickArr[i][0]).style.height = diameter + "rem"; 

        document.getElementById("displayBtn"+type+becauseClickArr[i][0]).innerHTML = leftOfDec;
        document.getElementById("displayBtn"+type+becauseClickArr[i][0]).style.fontSize = diFontSize + "rem"; 
        var setSmall = document.createElement("SPAN");
        setSmall.setAttribute("style", "font-size:.6em");
        var smallLetters = document.createTextNode(decOnRight);
        setSmall.appendChild(smallLetters);
        document.getElementById("displayBtn"+type+becauseClickArr[i][0]).appendChild(setSmall);
      }
      updateBecauseWeighInValue();
    break;
    //Verified after 9.25 Audit
    case 'Therefore':
      thereforeTotalClicks++;
        while (found == false && iterator < thereforeClickArr.length) {
          if(thereforeClickArr[iterator][0] == argID){
            found = true;
            thereforeClickArr[iterator][1]++;
            foundIndex = iterator;
          }
          iterator++;
        }
        if (found == false) {
          foundIndex = thereforeClickArr.length;
          thereforeClickArr.push([argID,1]);
          //document.getElementById("displayBtn"+type+argID).style.backgroundColor = "var(--cddbBlue)"; 
          var btn = document.getElementById("displayBtn"+type+argID);
          btn.className = "";
        }
        for (var i = 0, l = thereforeClickArr.length; i < l; i++) {
          //clickRatio = .7+(((clickArr[i][1])/totalClicks)*5); fixing the poorly named variable while I'm here
          //clickRatioStyle = clickRatio + "rem"; just hard code the rem part
          diameter = diameterShift + (((thereforeClickArr[i][1])/thereforeTotalClicks) * diameterFactor);
          //font gets too huge past 50% so cap it there
          if (diameter > maxFontNum) diFontSize = maxFontNum;
          else diFontSize = diameter;
          //diameterIncludeRem = diameter +
          rateAsString = ((thereforeClickArr[i][1]/thereforeTotalClicks)*100).toFixed(1); 
            if (((thereforeClickArr[i][1]/thereforeTotalClicks)*100) < 10) {
              leftOfDec = rateAsString.substring(0,1); 
              decOnRight = rateAsString.substring(1,3);
            }
            else if(((thereforeClickArr[i][1]/thereforeTotalClicks)*100) < 100) {
              leftOfDec = rateAsString.substring(0,2);
              decOnRight = rateAsString.substring(2,4);
            }
            else {
              leftOfDec = rateAsString.substring(0,3);
              decOnRight = rateAsString.substring(3,5);
            }
          decOnRight += "%";

          document.getElementById("btnContainer"+type+thereforeClickArr[i][0]).style.width = diameter + "rem"; 
          document.getElementById("btnContainer"+type+thereforeClickArr[i][0]).style.height = diameter + "rem"; 

          document.getElementById("displayBtn"+type+thereforeClickArr[i][0]).innerHTML = leftOfDec;
          document.getElementById("displayBtn"+type+thereforeClickArr[i][0]).style.fontSize = diFontSize + "rem"; 
          var setSmall = document.createElement("SPAN");
          setSmall.setAttribute("style", "font-size:.6em");
          var smallLetters = document.createTextNode(decOnRight);
          setSmall.appendChild(smallLetters);
          document.getElementById("displayBtn"+type+thereforeClickArr[i][0]).appendChild(setSmall);
        }
        updateThereforeWeighInValue();
    break;
  case 'Rebuttal':
    rebuttalTotalClicks++;
        while (found == false && iterator < rebuttalClickArr.length) {
          if(rebuttalClickArr[iterator][0] == argID){
            found = true;
            rebuttalClickArr[iterator][1]++;
            foundIndex = iterator;
          }
          iterator++;
        }
        if (found == false) {
          foundIndex = rebuttalClickArr.length;
          rebuttalClickArr.push([argID,1]);
          //document.getElementById("displayBtn"+type+argID).style.backgroundColor = "var(--cddbBlue)"; 
          var btn = document.getElementById("displayBtn"+type+argID);
          btn.className = "";
        }
        for (var i = 0, l = rebuttalClickArr.length; i < l; i++) {
          //clickRatio = .7+(((clickArr[i][1])/totalClicks)*5); fixing the poorly named variable while I'm here
          //clickRatioStyle = clickRatio + "rem"; just hard code the rem part
          diameter = diameterShift + (((rebuttalClickArr[i][1])/rebuttalTotalClicks) * diameterFactor);
          //font gets too huge past 50% so cap it there
          if (diameter > maxFontNum) diFontSize = maxFontNum;
          else diFontSize = diameter;
          //diameterIncludeRem = diameter +
          rateAsString = ((rebuttalClickArr[i][1]/rebuttalTotalClicks)*100).toFixed(1); 
            if (((rebuttalClickArr[i][1]/rebuttalTotalClicks)*100) < 10) {
              leftOfDec = rateAsString.substring(0,1); 
              decOnRight = rateAsString.substring(1,3);
            }
            else if(((rebuttalClickArr[i][1]/rebuttalTotalClicks)*100) < 100) {
              leftOfDec = rateAsString.substring(0,2);
              decOnRight = rateAsString.substring(2,4);
            }
            else {
              leftOfDec = rateAsString.substring(0,3);
              decOnRight = rateAsString.substring(3,5);
            }
          decOnRight += "%";

          document.getElementById("btnContainer"+type+rebuttalClickArr[i][0]).style.width = diameter + "rem"; 
          document.getElementById("btnContainer"+type+rebuttalClickArr[i][0]).style.height = diameter + "rem"; 

          document.getElementById("displayBtn"+type+rebuttalClickArr[i][0]).innerHTML = leftOfDec;
          document.getElementById("displayBtn"+type+rebuttalClickArr[i][0]).style.fontSize = diFontSize + "rem"; 
          var setSmall = document.createElement("SPAN");
          setSmall.setAttribute("style", "font-size:.6em");
          var smallLetters = document.createTextNode(decOnRight);
          setSmall.appendChild(smallLetters);
          document.getElementById("displayBtn"+type+rebuttalClickArr[i][0]).appendChild(setSmall);
        }
        updateRebuttalWeighInValue();
    break;
  default:
    // TODO we gonna use this for anything? How about some sort of error? Seems appropriate
  }
}


function goNeutral(type,argID){
    var btn = document.getElementById("displayBtn"+type+argID);
        btn.className = "neutral";
    //document.getElementById("displayBtn"+type+argID).style.backgroundColor = "var(--cddbGrey)"; 
    document.getElementById("btnContainer"+type+argID).style.height = "1rem"; 
    document.getElementById("btnContainer"+type+argID).style.width = "1rem"; 
    document.getElementById("displayBtn"+type+argID).style.fontSize = "1rem"; 
    document.getElementById("displayBtn"+type+argID).innerHTML = "Add"; 
}

function revealPhrasing(){
  document.getElementById("overlay").style.display = "block";
  document.getElementById("overContain").style.display = "block";
  document.getElementById("overPhrasing").style.display = "block";
 document.getElementById("newPutForth").style.display = "block";
}

function concealPhrasing(){
  document.getElementById("overlay").style.display = "none";
  document.getElementById("overContain").style.display = "none";
  document.getElementById("overPhrasing").style.display = "none";
  document.getElementById("newPutForth").style.display = "none";
}

/*Next two are tests - these are sorta shit*/
function revealQuibble(){
  document.getElementById("overPhrasing").style.display = "none";
  document.getElementById("overQuibble").style.display = "block";
}

function concealQuibble(){
  document.getElementById("overlay").style.display = "none";
  document.getElementById("overContain").style.display = "none";
  document.getElementById("overQuibble").style.display = "none";
}

function revealExplication(){
  document.getElementById("overlay").style.display = "block";
  document.getElementById("overContain").style.display = "block";
  document.getElementById("overExplication").style.display = "block";
}

function concealExplication(){
  document.getElementById("overlay").style.display = "none";
  document.getElementById("overContain").style.display = "none";
  document.getElementById("overExplication").style.display = "none";
}


/*Deprcated 9.30.2019
function testFunction() {
  var arrayAsString = "";
  for (var i = 0; i < becauseClickArr.length; i++) {
      arrayAsString = arrayAsString + becauseClickArr[i][0] + ","; 
      arrayAsString = arrayAsString + ((becauseClickArr[i][1]/becauseTotalClicks)*100).toFixed(5) + ",";
  }
  document.getElementById("becauseWeighInWith").value = arrayAsString;
  alert(arrayAsString);
}
*/

/*Deprecated 9.30.2019
function becauseBump(argID) {
  becauseTotalClicks++;
  var found = false;
  var iterator = 0;
  var foundIndex;
  var clickRatio;
  var clickRatioStyle;
  while (found == false && iterator < becauseClickArr.length) {
    if(becauseClickArr[iterator][0] == argID){
      found = true;
      becauseClickArr[iterator][1]++;
      foundIndex = iterator;
    }
    iterator++;
  }
  if (found == false) {
    foundIndex = becauseClickArr.length;
    becauseClickArr.push([argID,1]);  
    //document.getElementById("buttonBecause"+argID).style.backgroundColor = "var(--cddbBlue)";
  }
  for (var i = 0; i < becauseClickArr.length; i++) {
    clickRatio = .7+(((clickArr[i][1])/totalClicks)*5);
    clickRatioStyle = clickRatio + "rem";
    clickRatioType = 2.5*(clickArr[i][1]/totalClicks);
    clickRatioStyleType = clickRatioType + "rem";
    percentCode = "<span style='font-size:"+clickArr[i][1]/totalClicks+"rem'>%</span>";
    document.getElementById("buttonBecause"+clickArr[i][0]).style.width = clickRatioStyle; 
    document.getElementById("buttonBecause"+clickArr[i][0]).style.height = clickRatioStyle; 
    document.getElementById("buttonBecause"+clickArr[i][0]).style.fontSize = clickRatioStyleType; 
    document.getElementById("calcBecause"+becauseClickArr[i][0]).innerHTML = Math.floor((becauseClickArr[i][1]/becauseTotalClicks)*100); 
    /*if(((clickArr[i][1]/totalClicks)*100)>=20){
      document.getElementById("buttonBecause"+clickArr[i][0]).innerHTML = Math.floor((clickArr[i][1]/totalClicks)*100) + percentCode;
      document.getElementById("calcBecause"+clickArr[i][0]).innerHTML = Math.floor((clickArr[i][1]/totalClicks)*100); 
    }
    else{
      document.getElementById("buttonBecause"+clickArr[i][0]).innerHTML = "";
      document.getElementById("calcBecause"+clickArr[i][0]).innerHTML = Math.floor((clickArr[i][1]/totalClicks)*100); 
    }
  }
  updateBecauseWeighInValue();
}
*/

//Therefore functions
/*Deprecated 9.25.2019
function thereforeOn() {
  document.getElementById("overlay").style.display = "block";
  document.getElementById("overContain").style.display = "flex";
  document.getElementById("overWeighTherefore").style.display = "flex";
}
//also deprecated
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
//also deprecated
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
//also deprecated
function thereforeClickTheButton(argID) {
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
    document.getElementById("buttonTherefore"+argID).style.backgroundColor = "var(--cddbGreen)";
  }
  for (var i = 0; i < clickArr.length; i++) {
    clickRatio = .7+(((clickArr[i][1])/totalClicks)*5);
    clickRatioStyle = clickRatio + "rem";
    clickRatioType = 2.5*(clickArr[i][1]/totalClicks);
    clickRatioStyleType = clickRatioType + "rem";
    percentCode = "<span style='font-size:"+clickArr[i][1]/totalClicks+"rem'>%</span>";
    document.getElementById("buttonTherefore"+clickArr[i][0]).style.width = clickRatioStyle; 
    document.getElementById("buttonTherefore"+clickArr[i][0]).style.height = clickRatioStyle; 
    document.getElementById("buttonTherefore"+clickArr[i][0]).style.fontSize = clickRatioStyleType; 
    if(((clickArr[i][1]/totalClicks)*100)>=20)
      document.getElementById("buttonTherefore"+clickArr[i][0]).innerHTML = Math.floor((clickArr[i][1]/totalClicks)*100) + percentCode; 
    else
      document.getElementById("buttonTherefore"+clickArr[i][0]).innerHTML = ""; 
  }
  updateWeighInValue();
}
*/

//New assertion functions
function assertOn() {
  document.getElementById("overlay").style.display = "block";
  document.getElementById("overContain").style.display = "flex";
  document.getElementById("overAssertion").style.display = "flex";
}
function assertOff() {
  document.getElementById("overAssertion").style.display = "none";
}