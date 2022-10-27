<!DOCTYPE HTML>
<html>
<?php include("head.php") ?>

<body>

    <div class="container">

        <?php include("menu.php") ?>

        <form method="post" action="../controller/ControllerEditar.php" id="form" name="form" class="needs-validation" novalidate>

            <?php include("form.php") ?>

            <div class="form-group">
                <button type="submit" class="btn btn-success" id="cadastrar">Finalizar Edição</button>
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
    </script>
</body>

</html>