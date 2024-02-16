$(document).ready(function() {
    $("#signIn").click(function() {
        window.location = '/';
    });

    $("#btnLogin").click(function() {
        var email = $("#email").val();
        var pass = $("#password").val();
        if (email.length == "" && pass.length == "") {
            $('#alertLogin').html('Masukan Email & Password!');
            $('#alertLogin').attr('class', 'alert alert-danger alert-dismissible');
            $('#email').attr('style', 'border: 1px solid red;');
            $('#password').attr('style', 'border: 1px solid red;');
        } else if (email.length == "") {
            $('#alertLogin').html('Masukan Email!');
            $('#alertLogin').attr('class', 'alert alert-danger alert-dismissible');
            $('#email').attr('style', 'border: 1px solid red;');
            $('#password').attr('style', '');
        } else if (pass.length == "") {
            $('#alertLogin').html('Masukan Password!');
            $('#alertLogin').attr('class', 'alert alert-danger alert-dismissible');
            $('#password').attr('style', 'border: 1px solid red;');
            $('#email').attr('style', '');
        } else {
            $('#email').attr('style', '');
            $('#password').attr('style', '');
            $('#alertLogin').html('Login Berhasil!');
            $('#alertLogin').attr('class', 'alert alert-success alert-dismissible');
            setTimeout(function() {
                $('#btnLogin').attr('type', 'submit').click();
            }, 2000);
        }
    });

    $("#signUp").click(function() {
        window.location = '/regis';
    });

    $("#btnRegis").click(function() {
        var name = $("#name").val();
        var email = $("#email").val();
        var pass = $("#password").val();
        if (name.length == "" && email.length == "" && pass.length == "") {
            $('#alertRegis').html('Masukan Nama, Email & Password!');
            $('#alertRegis').attr('class', 'alert alert-danger alert-dismissible');
            $('#name').attr('style', 'border: 1px solid red;');
            $('#email').attr('style', 'border: 1px solid red;');
            $('#password').attr('style', 'border: 1px solid red;');
        } else if (name.length == "") {
            $('#alertRegis').html('Masukan Nama!');
            $('#alertRegis').attr('class', 'alert alert-danger alert-dismissible');
            $('#name').attr('style', 'border: 1px solid red;');
            $('#email').attr('style', '');
            $('#password').attr('style', '');
        } else if (email.length == "") {
            $('#alertRegis').html('Masukan Email!');
            $('#alertRegis').attr('class', 'alert alert-danger alert-dismissible');
            $('#name').attr('style', '');
            $('#email').attr('style', 'border: 1px solid red;');
            $('#password').attr('style', '');
        } else if (pass.length == "") {
            $('#alertRegis').html('Masukan Password!');
            $('#alertRegis').attr('class', 'alert alert-danger alert-dismissible');
            $('#name').attr('style', '');
            $('#email').attr('style', '');
            $('#password').attr('style', 'border: 1px solid red;');
        } else {
            $('#name').attr('style', '');
            $('#email').attr('style', '');
            $('#password').attr('style', '');
            // $('#alertRegis').html('Akun Berhasil Dibuat!');
            $('#alertRegis').attr('class', 'alert alert-success alert-dismissible');
            setTimeout(function() {
                $('#btnRegis').attr('type', 'submit').click();
            }, 2000);
        }
    });
});