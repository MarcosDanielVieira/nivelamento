<!DOCTYPE HTML>
<html>
<?php include("head.php") ?>

<body class="section">

    <div class="container">

        <?php include("menu.php") ?>

        <div class="card border-primary mb-3">

            <div class="card-header">
                Cadastro de uma pessoa
            </div>

            <div class="card-body ">

                <form method="post" action="../controller/ControllerCadastro.php" id="form" name="form" class="needs-validation" novalidate>

                    <?php include("form.php") ?>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success" id="cadastrar">Finalizar Cadastro</button>
                    </div>
                </form>

            </div>

        </div>

    </div>

</body>

</html>