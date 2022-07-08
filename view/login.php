<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif; 
        background-image: url('https://t3.ftcdn.net/jpg/04/99/37/56/360_F_499375635_uDldPC5EXfaM1aYzF7dzgB8l5I2EMjdm.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;  
        background-size: cover;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 20px 20px;
  margin: 5px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #F5CBA7;
  color: white;
  padding: 10px 20px;
  margin: 5px 0;
  border: 1px solid #ccc;
  cursor: pointer;
  width: 50%;
}

button:hover {
  opacity: 0.5;
}

.cancel-button {
  color: white;
  padding: 10px 20px;
  margin: 5px 0;
  border: 1px solid #ccc;
  cursor: pointer;
  width: 48%;
  background-color: #ff0000;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

.modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgba(0,0,0,0.7); 
  padding-top: 60px;
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto 5% auto; 
  border: 1px solid #888;
  width: 30%; 
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

.animate {
  -webkit-animation: animatezoom 0.5s;
  animation: animatezoom 0.5s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

.buttons-center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

</style>
</head>
<body>

<div class = "buttons-center">
<button onclick="document.getElementById('login').style.display='block'" style="width:auto;">Login</button>
<button onclick="document.getElementById('register').style.display='block'" style="width:auto;">Register</button>
</div>

<div id="login" class="modal">
  <form class="modal-content animate" action="recipes.php?rt=users/handleLogin" method="post">
    <div class="container">
        <h2>Login</h2>
        <input type="text" placeholder="Enter Username" name="username">
        <br>
        <input type="password" placeholder="Enter Password" name="password">
        <br>
        <button type="submit" name="button">Login</button>
        <button type="button" onclick="document.getElementById('login').style.display='none'" class="cancel-button">Cancel</button>
    </div>
  </form>
</div>

<div id="register" class="modal">
  <form class="modal-content animate" action="recipes.php?rt=users/handleRegistration" method="post">
    <div class="container">
      <h2>Registriraj se!</h2>
      <input type="text" placeholder="Enter Username" name="username">
      <br>
      <input type="password" placeholder="Enter Password" name="password">
      <br>
      <input type="password" placeholder="Re-enter Password" name="re-password">
      <br>
      <input type="password" placeholder="Enter email" name="email">
      <br>
      <button type="submit" name="button">Register</button>
      <button type="button" onclick="document.getElementById('register').style.display='none'" class="cancel-button">Cancel</button>
    </div>
  </form>
</div>

<script>
var login = document.getElementById('login');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
var register = document.getElementById('register');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>
