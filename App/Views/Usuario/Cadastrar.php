<h3 class="text-center mb-4"><i class="bi bi-person-add"></i> Usuário</h3>

<form action="<?= URL ?>usuario/cadastrar" method="post">
    <div class="mb-3">
        <label for="idFilial" class="form-label">ID Filial</label>
        <select class="form-select" id="idFilial" name="idFilial" required>
            <option value=0>Selecione</option>
            <?php
                foreach ($this->viewVar['filiais'] as $filial) {
            ?>
                <option value=<?= $filial['id_filial'] ?>>
                    <?= $filial['filial'] ?>
                </option>
            <?php
                }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" class="form-control" id="usuario" name="usuario" required>
    </div>
    <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" required>
    </div>
    <div class="mb-3">
        <label for="idTipoPermissao" class="form-label">Permissão</label>
        <select class="form-select" id="idTipoPermissao" name="idTipoPermissao" required>
            <option value=0>Selecione</option>

            <?php
                foreach ($this->viewVar['tiposPermissao'] as $tipoPermissao) {
            ?>
                <option value=<?= $tipoPermissao['id'] ?>>
                    <?= $tipoPermissao['descricao'] ?>
                </option>
            <?php
                }
            ?>
        </select>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>