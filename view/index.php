<?php require_once("../controller/ControllerListar.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include("head.php"); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

<style>
    .quebrarTexto {
        word-break: break-word;
    }
</style>

<body>

    <div class="container">

        <?php include("menu.php"); ?>

        <div class="card border-primary mb-3">

            <div class="card-header">Listagem dos dados da(s) pessoa(s)</div>

            <div class="card-body table-responsive">

                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Nascimento</th>
                            <th>CEP</th>
                            <th>Endereço</th>
                            <th>Número</th>
                            <th>UF</th>
                            <th>E-mail</th>
                            <th>Cadastrado</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $lista = new listarController();

                        foreach ($lista->pessoas() as $value) { ?>

                            <tr>
                                <td> <?= $value['nome'] ?> </td>
                                <td> <?= $value['cpf'] ?> </td>
                                <td> <?= date('d/m/Y', strtotime($value['data_nascimento'])) ?> </td>
                                <td> <?= $value['cep'] ?> </td>
                                <td> <?= $value['endereco'] ?> </td>
                                <td class="text-center"> <?= $value['numero'] ?> </td>
                                <td> <?= $value['estado'] ?> </td>
                                <td class="quebrarTexto"> <?= $value['email'] ?> </td>
                                <td> <?= date('d/m/Y H:m', strtotime($value['data_cadastro'])) ?> </td>
                                <td>
                                    <a class='btn btn-warning mr-2 mb-2' href='editar.php?id=<?= $value['id'] ?>'>Editar</a>
                                    <a class='btn btn-danger mr-2 mb-2' href='../controller/ControllerDeletar.php?id=<?= $value['id'] ?>'>Excluir</a>
                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>
                </table>

            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json",
                    searchPlaceholder: "Qualquer informação"
                },
                "paging": true,
                "lengthChange": false,
                "pageLength": 50,
                "searching": true,
                "ordering": true,
                "info": true,
                "processing": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>