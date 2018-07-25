var totalClicks = 0;
var clickArr = [];
var testArr = [25,30,45];

function updateWeighInValue() {
  var arrayAsString = "";
  for (var i = 0; i < clickArr.length; i++) {
      arrayAsString = arrayAsString + clickArr[i][0] + ","; 
      arrayAsString = arrayAsString + ((clickArr[i][1]/totalClicks)*100).toFixed(5) + ",";
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
//New assertion functions
function assertOn() {
  document.getElementById("overlay").style.display = "block";
  document.getElementById("overContain").style.display = "flex";
  document.getElementById("overAssertion").style.display = "flex";
}
function assertOff() {
  document.getElementById("overAssertion").style.display = "none";
}