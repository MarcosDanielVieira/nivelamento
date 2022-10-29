$(document).ready(function() {
    $(".cpf").mask("000.000.000-00", { reverse: true });
    $(".telefone").mask("(00) 00000-0000");
    $(".cep").mask("00000-000");

    (function() {
        "use strict";
        window.addEventListener(
            "load",
            function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName("needs-validation");
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener(
                        "submit",
                        function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add("was-validated");
                        },
                        false
                    );
                });
            },
            false
        );
    })();

    $(".cpf").on("blur", function() {
        if (!validarCPF($(this).val())) {
            alert("CPF inválido!");
            $(this).val("");
            $(this).addClass("is-invalid");
            $(".errorCpf").html("Cpf é inválido.");
        } else {
            $(this).removeClass("is-invalid");
            $(this).addClass("is-valid");
        }
    });

    function validarCPF(cpf) {
        var cpf = cpf.replace(/[^\d]+/g, "");
        if (cpf == "") return false;
        // Elimina CPFs invalidos conhecidos
        if (
            cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999"
        )
            return false;
        // Valida 1o digito
        add = 0;
        for (i = 0; i < 9; i++) add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11) rev = 0;
        if (rev != parseInt(cpf.charAt(9))) return false;
        // Valida 2o digito
        add = 0;
        for (i = 0; i < 10; i++) add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11) rev = 0;
        if (rev != parseInt(cpf.charAt(10))) return false;
        return true;
    }

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#endereco").val("");
        $("#estado_id").val("");
    }

    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {
        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, "");

        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {
                //Preenche os campos com "Carregando..." enquanto consulta webservice.
                $("#endereco").val("Carregando...");
                $("#estado_id").val("Carregando...");

                //Consulta o webservice viacep.com.br/
                $.getJSON(
                    "https://viacep.com.br/ws/" + cep + "/json/?callback=?",
                    function(dados) {
                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#endereco").val(dados.logradouro);
                            $('.sigla_' + dados.uf).attr('selected', 'selected');

                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    }
                );
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});