<!DOCTYPE HTML>
<html>
<?php include("head.php") ?>

<body>

    <div class="container">

        <?php include("menu.php") ?>

        <form method="post" action="../controller/ControllerCadastro.php" id="form" name="form" onsubmit="validar(document.form); return false;" class="needs-validation" novalidate>
            <div class="form-row">

                <div class="col-md-5 mb-3">
                    <label for="nome">
                        Nome
                        <i class="text-danger">*</i>
                    </label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required autofocus>
                    <div class="invalid-feedback">
                        O campo não pode ficar vazio.
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="cpf">
                        CPF
                        <i class="text-danger">*</i>
                    </label>
                    <input type="text" onblur="validarCPF(this)" class="form-control cpf" minlength="14" maxlength="14" id="cpf" name="cpf" placeholder="CPF" required>
                    <div class="invalid-feedback errorCpf">
                        O campo não pode ficar vazio.
                    </div>
                </div>

                <div class="col-md-2 mb-3">
                    <label for="rg">
                        RG
                        <i class="text-danger">*</i>
                    </label>
                    <input type="text" class="form-control" id="rg" name="rg" placeholder="RG" required>
                    <div class="invalid-feedback">
                        O campo não pode ficar vazio.
                    </div>
                </div>

                <div class="col-md-2 mb-3">
                    <label for="rg">
                        Data nascimento
                        <i class="text-danger">*</i>
                    </label>
                    <input type="date" class="form-control" max="<?= date("Y-m-d") ?>" id="data_nascimento" name="data_nascimento" placeholder="Data nascimento" required>
                    <div class="invalid-feedback">
                        O campo não pode ficar vazio.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" id="cadastrar">Finalizar Cadastrar</button>
            </div>
        </form>
    </div>

    <script src="../js/main.js"></script>

    <script language="javascript" type="text/javascript">
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        $(".cpf").on("blur", function() {

            if (!validarCPF($(this).val())) {
                alert("CPF inválido!");
                $(this).val("");
                $(this).addClass("is-invalid");
                $(".errorCpf").html("Cpf é inválido.")
            } else {
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
            }

        });

        function validarCPF(cpf) {
            var cpf = cpf.replace(/[^\d]+/g, '');
            if (cpf == '') return false;
            // Elimina CPFs invalidos conhecidos	
            if (cpf.length != 11 ||
                cpf == "00000000000" ||
                cpf == "11111111111" ||
                cpf == "22222222222" ||
                cpf == "33333333333" ||
                cpf == "44444444444" ||
                cpf == "55555555555" ||
                cpf == "66666666666" ||
                cpf == "77777777777" ||
                cpf == "88888888888" ||
                cpf == "99999999999")
                return false;
            // Valida 1o digito	
            add = 0;
            for (i = 0; i < 9; i++)
                add += parseInt(cpf.charAt(i)) * (10 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(9)))
                return false;
            // Valida 2o digito	
            add = 0;
            for (i = 0; i < 10; i++)
                add += parseInt(cpf.charAt(i)) * (11 - i);
            rev = 11 - (add % 11);
            if (rev == 10 || rev == 11)
                rev = 0;
            if (rev != parseInt(cpf.charAt(10)))
                return false;
            return true;
        }

        function formatarMoeda() {
            var elemento = document.getElementById('preco');
            var valor = preco.value;

            valor = valor + '';
            valor = parseInt(valor.replace(/[\D]+/g, ''));
            valor = valor + '';
            valor = valor.replace(/([0-9]{2})$/g, ",$1");

            if (valor.length > 6) {
                valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
            }

            elemento.value = valor;
        }

        function validar(formulario) {
            var quantidade = form.quantidade.value;
            var preco = form.preco.value;
            for (i = 0; i <= formulario.length - 2; i++) {
                if ((formulario[i].value == "")) {
                    formulario[i].focus();
                    return false;
                }
            }

            formulario.submit();
        }
    </script>
</body>

</html>