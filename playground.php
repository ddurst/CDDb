<?php
  session_start();
  ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

.switch {
  position: relative;
  display: inline-block;
  width: 200px; /*default is 60px*/
  height: 44px; /*default is 34px*/
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #af1a17;
  -webkit-transition: .3s;
  transition: .3s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 36px;/*default is 26px*/
  width: 96px;/*default is 26px*/
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .3s;
  transition: .3s;
}

input:checked + .slider {
  background-color: #10a020;
}

input:focus + .slider {
  box-shadow: 0 0 1px #10a020;
}

input:checked + .slider:before {
  -webkit-transform: translateX(96px);/*default is 26px*/
  -ms-transform: translateX(96px);/*default is 26px*/
  transform: translateX(96px);/*default is 26px*/
}

.buttonCircle {
  border-radius:50%;
  background-color:#af1a17;
}

.btn {
    border-radius:50%;
    background-color:#af1a17;
    padding: 14px 24px;
    border: 0 none;
    letter-spacing: 1px;
    text-transform: uppercase;
}
 
.btn:focus, .btn:active:focus, .btn.active:focus {
    outline: 0 none;
}
 
.btn-primary {
    background: #0099cc;
    color: #ffffff;
}
 
.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open > .dropdown-toggle.btn-primary {
    background: #33a6cc;
}
 
.btn-primary:active, .btn-primary.active {
    background: #007299;
    box-shadow: none;
}

.btn-primary.raised {
  box-shadow: 0 3px 0 0 #007299;
}

.btn-primary.raised:active, .btn-primary.raised.active {
  background: #33a6cc;
  box-shadow: none;
  margin-bottom: -3px;
  margin-top: 3px;
}

</style>
</head>
<body>

<h2>Toggle Switch</h2>

<label class="switch">
  <input type="checkbox" label="accept">
  <span class="slider"></span>
</label>

<h2>Homemade</h2>
  <button type="submit" class="btn-primary.raised" name="buttonClicked" value="accept">Accept</button> 
  <button type="submit" class="btn-primary.raised" name="buttonClicked" value="accept">Reject</button> 
  <button type="submit" class="btn-primary.raised" name="buttonClicked" value="accept">Accept</button> 
  <button type="submit" class="btn-primary.raised" name="buttonClicked" value="accept">Reject</button> 
<div>
  <table>
    <tr>
      <td><button class="buttonCircle" height='10px'></button></td><td>Some writing</td></tr>
    <tr>
      <td><button class="buttonCircle" width='3rem'></td><td>More writing</td></tr>
    <tr>
      <td><button class="buttonCircle" width='2rem'></td><td>Even more, its gonna keep coming.</td></tr>
    <tr>
      <td><button class="buttonCircle" width='1rem'></td><td>Actually it ends here.</td></tr>                  
</div>
<?php
    print_r($_SESSION);
?>

</body>
</html> 
