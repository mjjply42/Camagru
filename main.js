var new_usr = document.querySelector(".new");
var login = document.querySelector(".login");
var home = document.querySelector(".home");

home.addEventListener('click', Home);
login.addEventListener('click', Login);
new_usr.addEventListener('click', newUsr);

function    Home()    { document.location.href = "index.php"; }
function    newUsr()    { document.location.href = "sign_up.php"; }
function    Login()     { document.location.href = "login.php"; }