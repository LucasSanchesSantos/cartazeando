<h3 class="text-center mb-4"><i class="bi bi-person-add"></i> Usuário</h3>

<form action="<?= URL ?>usuario/cadastrar" method="post">
    <div class="mb-3">
        <label for="idFilial" class="form-label">ID Filial</label>
        <input type="number" class="form-control" id="idFilial" name="idFilial" required>
    </div>
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Número da Filial</label>
        <input type="number" class="form-control" id="numeroFilial" name="numeroFilial" required>
    </div>
    <div class="mb-3">
        <div class="mb-3">
            <label for="idEmpresa" class="form-label">Empresa</label>
            <input type="text" class="form-control" id="idEmpresa" name="idEmpresa" required>
        </div>
        <div class="mb-3">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" required>
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
            <label for="idTipoFormato" class="form-label">Formato</label>
            <select class="form-select" id="idTipoFormato" name="idTipoFormato" required>
                <?php
                    foreach ($this->viewVar['tiposFormato'] as $tipoFormato) {
                ?>
                    <option value=<?= $tipoFormato['id'] ?>>
                        <?= $tipoFormato['descricao'] ?>
                    </option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="idTipoPermissao" class="form-label">Permissão</label>
            <select class="form-select" id="idTipoPermissao" name="idTipoPermissao" required>
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