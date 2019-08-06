var totalClicks = 0;
var clickArr = [];
var becauseTotalClicks = 0;
var becauseClickArr = [];
var maxFontNum = 2.9; //font gets too huge past 50% so cap it there
var diameter;
var diameterIncludeRem;
var diameterShift = .4; //This should match vars in dynamic-styling_CDDb.php minimum size and amount added to all diamters
var diameterFactor = 5; //This should match vars in dynamic-styling_CDDb.php diamter will be this many times bigger than a single rem.
var rateAsString;
var leftOfDec;
  var decOnRight;
//var testArr = [25,30,45];

function updateWeighInValue() {
  var arrayAsString = "";
  for (var i = 0; i < clickArr.length; i++) {
      arrayAsString = arrayAsString + clickArr[i][0] + ","; 
      arrayAsString = arrayAsString + ((clickArr[i][1]/totalClicks)*100).toFixed(5) + ",";
  }
  document.getElementById("weighInWith").value = arrayAsString;
}

function updateBecauseWeighInValue() {
  var arrayAsString = "";
  for (var i = 0; i < becauseClickArr.length; i++) {
      arrayAsString = arrayAsString + becauseClickArr[i][0] + ","; 
      arrayAsString = arrayAsString + ((becauseClickArr[i][1]/becauseTotalClicks)*100).toFixed(5) + ",";
  }
  document.getElementById("becauseWeighInWith").value = arrayAsString;
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

//Reset because back to neutral - the weigh in roll back to zero in preparation for another round of weighting
function becauseClearData() {
  for(i = 0, l = jsBecause.length; i < l; i++) { //TODO it is better to cache the length of an array like this than to look it up each time. http://bonsaiden.github.io/JavaScript-Garden/#array.general Have all js for loops do this. 
    goNeutral('Because',jsBecause[i][0]);
    //document.getElementById("displayBtnBecause"+jsBecause[i][0]).setAttribute("onclick","firstClickBecause("+jsBecause[i][0]+")"); 
  }
  becauseClickArr.length = 0;
  becauseTotalClicks = 0;
}

//Return the because to a state as though untouched
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

//This is under construction. It needs to do more than a standard bumps.
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

function thereforeRevert(){
  
}

//This is the business
function bump(type,argID) {
  var found = false;
  var iterator = 0;
  var foundIndex;
  switch(type) {
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
        // I assume this was for the percentaage strings that needed smaller fonts so Ignoring for now. 
        //clickRatioType = 2.5*(clickArr[i][1]/totalClicks);
        //clickRatioStyleType = clickRatioType + "rem";
        //percentCode = "<span style='font-size:"+clickArr[i][1]/totalClicks+"rem'>%</span>";

        //document.getElementById("buttonBecause"+clickArr[i][0]).style.width = clickRatioStyle; 
        //document.getElementById("buttonBecause"+clickArr[i][0]).style.height = clickRatioStyle; 
        //document.getElementById("buttonBecause"+clickArr[i][0]).style.fontSize = clickRatioStyleType; 
        document.getElementById("btnContainer"+type+becauseClickArr[i][0]).style.width = diameter + "rem"; 
        document.getElementById("btnContainer"+type+becauseClickArr[i][0]).style.height = diameter + "rem"; 

        //document.getElementById("calcBecause"+becauseClickArr[i][0]).innerHTML = Math.floor((becauseClickArr[i][1]/becauseTotalClicks)*100); 
        //Give the buttons a value again but with different sizes we make things complex

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
  case 'Therefore':
    // Copied from Because when ready
    break;
  case 'Rebuttal':
    // Copied from Because when ready
    break;
  default:
    // we gonna use this for anything?
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

function testFunction() {
  var arrayAsString = "";
  for (var i = 0; i < becauseClickArr.length; i++) {
      arrayAsString = arrayAsString + becauseClickArr[i][0] + ","; 
      arrayAsString = arrayAsString + ((becauseClickArr[i][1]/becauseTotalClicks)*100).toFixed(5) + ",";
  }
  document.getElementById("becauseWeighInWith").value = arrayAsString;
  alert(arrayAsString);
}

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
    /*clickRatio = .7+(((clickArr[i][1])/totalClicks)*5);
    clickRatioStyle = clickRatio + "rem";
    clickRatioType = 2.5*(clickArr[i][1]/totalClicks);
    clickRatioStyleType = clickRatioType + "rem";
    percentCode = "<span style='font-size:"+clickArr[i][1]/totalClicks+"rem'>%</span>";
    document.getElementById("buttonBecause"+clickArr[i][0]).style.width = clickRatioStyle; 
    document.getElementById("buttonBecause"+clickArr[i][0]).style.height = clickRatioStyle; 
    document.getElementById("buttonBecause"+clickArr[i][0]).style.fontSize = clickRatioStyleType; */
    document.getElementById("calcBecause"+becauseClickArr[i][0]).innerHTML = Math.floor((becauseClickArr[i][1]/becauseTotalClicks)*100); 
    /*if(((clickArr[i][1]/totalClicks)*100)>=20){
      document.getElementById("buttonBecause"+clickArr[i][0]).innerHTML = Math.floor((clickArr[i][1]/totalClicks)*100) + percentCode;
      document.getElementById("calcBecause"+clickArr[i][0]).innerHTML = Math.floor((clickArr[i][1]/totalClicks)*100); 
    }
    else{
      document.getElementById("buttonBecause"+clickArr[i][0]).innerHTML = "";
      document.getElementById("calcBecause"+clickArr[i][0]).innerHTML = Math.floor((clickArr[i][1]/totalClicks)*100); 
    }*/
  }
  updateBecauseWeighInValue();
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
//New assertion functions
function assertOn() {
  document.getElementById("overlay").style.display = "block";
  document.getElementById("overContain").style.display = "flex";
  document.getElementById("overAssertion").style.display = "flex";
}
function assertOff() {
  document.getElementById("overAssertion").style.display = "none";
}