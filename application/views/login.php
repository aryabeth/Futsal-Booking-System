<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include "head.php"; ?>
    
<title>Paragon Futsal</title>
<style>
    body {
        /*background: grey;*/
        background: url('assets/img/background.jpg') no-repeat fixed center center;
        background-size: cover;
    }

    .logo {
        margin: 40px auto;
        text-align: center;
    }

    .logo img{
        width: 30%;
        height: auto;
    }

    .login-block {
        width: 320px;
        padding: 20px;
        background: #e0e0e0;
        border-radius: 5px;
        border: 5px solid #5cb85c;
        /*border: 5px solid #ed1c24;*/
        margin: 0 auto;
    }

    .login-block h1 {
        text-align: center;
        color: #000;
        font-size: 18px;
        text-transform: uppercase;
        margin-top: 0;
        margin-bottom: 20px;
    }

    span button {
        width: 50px;
        margin: 15px auto;
    }

    input {
        margin: 15px auto;
    }

    .btn-login{
        width: 100%;
        height: 40px;
        margin-top: 15px;
    }</style>

</head>

<body>

<div class="logo"><img src="assets/img/header.png"></div>
<div class="login-block">
    <h1>Login</h1>
    <form action="login/login_process" method="post">
        <div class="input-group">
            <span class="form-group input-group-btn">
                <button class="btn btn-default" disabled type="button"><i class="fa fa-user"></i></button>
            </span>
            <input type="text" placeholder="username" id="username" name="username" class="form-control" required>
        </div>

        <div class="input-group">
            <span class="form-group input-group-btn">
                <button class="btn btn-default" disabled type="button"><i class="fa fa-lock"></i></button>
            </span>
            <input type="password" placeholder="Password" id="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success btn-login"><i class="fa fa-sign-in">&nbsp;</i>LOGIN</button>
    </form>

</div>
</body>

</html>