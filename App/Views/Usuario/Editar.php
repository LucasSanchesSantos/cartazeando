<h3 class="text-center mb-4"><i class="bi bi-person-gear"></i> Usuário</h3>

<form action="<?= URL ?>usuario/editar" method="post">
    <input type="hidden" id="id" name="id" value=<?= !empty($_GET['id']) ? intval($_GET['id']) : intval($usuario['id']) ?>>

    <?php
        if ($isAdministrativo) {
    ?>
        <div class="mb-3">
            <label for="idFilial" class="form-label">ID Filial</label>
            <input type="number" class="form-control" id="idFilial" name="idFilial" value="<?= $this->viewVar['usuario']['id_filial'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="numeroFilial" class="form-label">Número da Filial</label>
            <input type="number" class="form-control" id="numeroFilial" name="numeroFilial" value="<?= $this->viewVar['usuario']['numero_filial'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="idEmpresa" class="form-label">Empresa</label>
            <input type="number" class="form-control" id="idEmpresa" name="idEmpresa" value="<?= $this->viewVar['usuario']['id_empresa'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" value="<?= $this->viewVar['usuario']['cidade'] ?>" required>
        </div>
    
    <?php
        }
    ?>

        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $this->viewVar['usuario']['usuario'] ?>" required <?= $isAdministrativo ? '' : 'disabled' ?>>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha">
        </div>

    <?php
        if ($isAdministrativo) {
    ?>

        <div class="mb-3">
            <label for="idTipoFormato" class="form-label">Formato</label>
            <select class="form-select" id="idTipoFormato" name="idTipoFormato" required>
                <?php
                    foreach ($this->viewVar['tiposFormato'] as $tipoFormato) {
                ?>
                    <option value=<?= $tipoFormato['id'] ?> <?= $this->viewVar['usuario']['id_tipo_formato'] == $tipoFormato['id'] ? 'selected' : '' ?>>
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
                    <option value=<?= $tipoPermissao['id'] ?> <?= $this->viewVar['usuario']['id_tipo_permissao'] == $tipoPermissao['id'] ? 'selected' : '' ?>>
                        <?= $tipoPermissao['descricao'] ?>
                    </option>
                <?php
                    }
                ?>
            </select>
        </div>

    <?php
        }
    ?>

        <div class="text-end">
            <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
        </div>
</form>