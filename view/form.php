<?php
if (isset($_GET['id'])) {
    require_once("../controller/ControllerEditar.php");
    $controller = new ControllerEditar();
    $pessoa     = $controller->getPessoa($_GET['id']);
}
?>

<div class="form-row">

    <div class="col-md-4 mb-3">
        <label for="nome">
            Nome
            <i class="text-danger">*</i>
        </label>
        <input type="text" class="form-control" id="nome" value="<?= !empty($pessoa) ? $pessoa['nome'] : "" ?>" name="nome" placeholder="Nome" required autofocus>
        <div class="invalid-feedback">
            O campo não pode ficar vazio.
        </div>
    </div>

    <div class="col-md-2 mb-3">
        <label for="cpf">
            CPF
            <i class="text-danger">*</i>
        </label>
        <input type="text" onblur="validarCPF(this)" class="form-control cpf" minlength="14" maxlength="14" id="cpf" value="<?= !empty($pessoa) ? $pessoa['cpf'] : "" ?>" name="cpf" placeholder="CPF" required>
        <div class="invalid-feedback errorCpf">
            O campo não pode ficar vazio.
        </div>
    </div>

    <div class="col-md-2 mb-3">
        <label for="telefone">
            Telefone
            <i class="text-danger">*</i>
        </label>
        <input type="text" class="form-control telefone" id="telefone" value="<?= !empty($pessoa) ? $pessoa['telefone'] : "" ?>" name="telefone" placeholder="Telefone" required>
        <div class="invalid-feedback">
            O campo não pode ficar vazio.
        </div>
    </div>

    <div class="col-md-2 mb-3">
        <label for="rg">
            RG
            <i class="text-danger">*</i>
        </label>
        <input type="text" class="form-control" id="rg" value="<?= !empty($pessoa) ? $pessoa['rg'] : "" ?>" name="rg" placeholder="RG" required>
        <div class="invalid-feedback">
            O campo não pode ficar vazio.
        </div>
    </div>

    <div class="col-md-2 mb-3">
        <label for="data_nascimento">
            Data nascimento
            <i class="text-danger">*</i>
        </label>
        <input type="date" class="form-control" max="<?= date("Y-m-d") ?>" id="data_nascimento" value="<?= !empty($pessoa) ? $pessoa['data_nascimento'] : "" ?>" name="data_nascimento" placeholder="Data nascimento" required>
        <div class="invalid-feedback">
            O campo não pode ficar vazio.
        </div>
    </div>
</div>

<?php if (!isset($pessoa)) { ?>

    <div class="form-row">

        <div class="col-md-5 mb-3">
            <label for="email">
                E-mail
                <i class="text-danger">*</i>
            </label>
            <input type="email" class="form-control" id="email" value="<?= !empty($pessoa) ? $pessoa['email'] : "" ?>" name="email" placeholder="E-mail" required>
            <div class="invalid-feedback">
                O campo não pode ficar vazio.
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <label for="senha">
                Senha
                <i class="text-danger">*</i>
            </label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
            <div class="invalid-feedback">
                O campo não pode ficar vazio.
            </div>
        </div>

    </div>

<?php } else { ?>
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
<?php } ?>

<div class="form-row">

    <div class="col-md-2 mb-3">
        <label for="cep">
            CEP
            <i class="text-danger">*</i>
        </label>
        <input type="text" class="form-control cep" minlength="8" maxlength="8" id="cep" value="<?= !empty($pessoa) ? $pessoa['cep'] : "" ?>" name="cep" placeholder="CEP" required>
        <div class="invalid-feedback">
            O campo não pode ficar vazio.
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="endereco">
            Endereço
            <i class="text-danger">*</i>
        </label>
        <input type="text" class="form-control" id="endereco" value="<?= !empty($pessoa) ? $pessoa['endereco'] : "" ?>" name="endereco" placeholder="Endereço" required>
        <div class="invalid-feedback">
            O campo não pode ficar vazio.
        </div>
    </div>

    <div class="col-md-2 mb-3">
        <label for="numero">
            Número
            <i class="text-danger">*</i>
        </label>
        <input type="text" class="form-control" id="numero" value="<?= !empty($pessoa) ? $pessoa['numero'] : "" ?>" name="numero" placeholder="Número" required>
        <div class="invalid-feedback">
            O campo não pode ficar vazio.
        </div>
    </div>

    <div class="col-md-2 mb-3">
        <label for="estado_id">
            Estado
            <i class="text-danger">*</i>
        </label>
        <select class="custom-select" name="estado_id" id="estado_id" required>
            <option value="">Selecione</option>
            <?php require_once("../controller/EstadoController.php");
            foreach (EstadoController::listaEstados() as $key => $value) { ?>
                <option class="sigla_<?= $value['uf'] ?>" <?= !empty($pessoa) && $pessoa["estado_id"] == $value['id'] ? "selected" : "" ?> value="<?= $value['id'] ?>">
                    <?= $value['nome'] ?>
                </option>
            <?php } ?>
        </select>
        <div class="invalid-feedback">
            O campo não pode ficar vazio.
        </div>
    </div>

</div>