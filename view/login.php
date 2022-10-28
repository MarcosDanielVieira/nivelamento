<!DOCTYPE HTML>
<html>
<?php include("head.php");

session_start();
if (isset($_SESSION['login']) && isset($_SESSION['senha'])) {
    header('location:index.php');
}
?>

<body>

    <div class="Login ">
        <div class="section section-login">
            <div class="login bg-white">

                <div class="text-center mb-4">
                    <img width="80%" src="../img/webdec-home.png">
                </div>

                <form method="post" action="../controller/LoginController.php" id="form" name="form" class="needs-validation" novalidate>

                    <div class="form-group">
                        <label class="form-label" type="email">
                            E-mail
                            <i class="text-danger">*</i>
                        </label>
                        <input class="form-control" placeholder="E-mail" type="email" name="email" required />
                        <div class="invalid-feedback">
                            O campo não pode ficar vazio.
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" type="senha">
                            Senha
                            <i class="text-danger">*</i>
                        </label>
                        <input class="form-control" type="password" placeholder="Senha" name="senha" required />
                        <div class="invalid-feedback">
                            O campo não pode ficar vazio.
                        </div>
                    </div>

                    <input class="btn btn-primary w-100" type="submit" value="Entrar" />
                </form>
            </div>
        </div>
    </div>

</body>