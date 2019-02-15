var new_usr = document.querySelector(".new");
var login = document.querySelector(".login");

login.addEventListener('click', Login);
new_usr.addEventListener('click', newUsr);

function    newUsr()    { document.location.href = "sign_up.php"; }
function    Login()     { document.location.href = "login.php"; }