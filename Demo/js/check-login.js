
document.getElementById("loginButton").addEventListener("click", function () {

    let username = $("#username");
    let password = $("#password");

    if (username.val().length === 0) {

        document.getElementById("username").style.border = "1px solid red";

        if (password.val().length === 0) {

            document.getElementById("password").style.border = "1px solid red";
        }

    } else if (password.val().length === 0) {

        document.getElementById("password").style.border = "1px solid red";

    } else {

        let data = {
            "username": document.getElementById("username").value,
            "password": document.getElementById("password").value
        };

        $.ajax({
            method: "POST",
            url: 'check-login.php',
            data: data
        })
            .done(function (msg) {
                if (msg === "Granted") {
                    document.getElementById("username").value="";
                    window.location.replace("dashboard.php");
                } else {
                    alert(msg);
                    location.reload();
                }
            });
    }

});
