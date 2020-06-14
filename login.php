<?php
    session_start();
    include "connection.php";
?>
    
<div class="row centered" id="frm">
    <div class="col-sm-6 col-sm-offset-3 form-box">
        <div class="form-top">
            <div class="form-top-left">
                <h3>Login</h3>
                <p>Insira o seu email e palavra-chave:</p>
            </div>
            <div class="form-top-right">
                <i class="fa fa-lock"></i>
            </div>
        </div>
        <div class="form-bottom">
            <form role="form" action="process.php" method="post" class="login-form">
                <div class="form-group">
                    <label class="sr-only" for="form-email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Email..." class="form-email form-control" id="form-email">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="form-password">Password</label>
                    <input type="password" id="pass" name="pass" placeholder="Password..." class="form-password form-control" id="form-password">                  
                </div>
                <button type="submit" class="btnin" id="btnin" value="login">Entrar</button>
            </form>
        </div>
    </div>
</div>
