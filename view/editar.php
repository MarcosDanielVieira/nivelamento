<!DOCTYPE HTML>
<html>
<?php include("head.php") ?>

<body class="section">

    <div class="container">

        <?php include("menu.php") ?>

        <div class="card border-primary mb-3">

            <div class="card-header">
                Edição dos dados de uma pessoa
            </div>

            <div class="card-body ">

                <form method="post" action="../controller/ControllerEditar.php" id="form" name="form" class="needs-validation" novalidate>

                    <?php include("form.php") ?>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success" id="cadastrar">Finalizar Edição</button>
                    </div>
                </form>

            </div>

        </div>

    </div>

    <script src="../js/main.js"></script>

</body>

</html>