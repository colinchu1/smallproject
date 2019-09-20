$(document).ready(function() {
    $("#register").click(function() {
    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    if (name == '' || email == '' || password == '' || cpassword == '' || fname == '' || lname == '') {
    alert("Please fill all fields...!!!!!!");
    } else if ((password.length) < 8) {
    alert("Password should atleast 8 character in length...!!!!!!");
    } else if (!(password).match(cpassword)) {
    alert("Your passwords don't match. Try again?");
    } else {
    $.post("register.php", {
    name1: name,
    email1: email,
    fname1: fname,
    lname1: lname,
    password1: password
    }, function(data) {
    if (data == 'You have Successfully Registered.....') {
    $("form")[0].reset();
    }
    alert(data);
    });
    }
    });
    });