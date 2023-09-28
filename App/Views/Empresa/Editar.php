<h3 class="text-center mb-4"><i class="bi bi-person-gear"></i> Empresa</h3>

<form action="<?= URL ?>empresa/editar" method="post">
    <input type="hidden" id="id" name="id" value=<?= !empty($_GET['id']) ? intval($_GET['id']) : intval($empresa['id']) ?>>

        <div class="mb-3">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" id="id" name="id" value="<?= $this->viewVar['empresa']['id'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Empresa</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $this->viewVar['empresa']['descricao'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj" minlength="14" maxlength="14" value="<?= $this->viewVar['empresa']['cnpj'] ?>" required>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
        </div>
</form>