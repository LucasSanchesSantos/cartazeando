<h3 class="text-center mb-4"><i class="bi bi-person-gear"></i> Filial</h3>

<form action="<?= URL ?>filial/editar" method="post">
    <input type="hidden" id="id" name="id" value=<?= !empty($_GET['id']) ? intval($_GET['id']) : intval($filial['id']) ?>>

        <div class="mb-3">
            <label class="form-label">ID</label>
            <input type="number" class="form-control" id="id" name="id" value="<?= $this->viewVar['filial']['id'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Filial</label>
            <input type="numeric" class="form-control" id="numero" name="numero" value="<?= $this->viewVar['filial']['numero'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Empresa</label>
            <input type="numeric" class="form-control" id="empresa" name="empresa" value="<?= $this->viewVar['filial']['empresa'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" value="<?= $this->viewVar['filial']['cidade'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">UF</label>
            <input type="text" class="form-control" id="uf" name="uf" value="<?= $this->viewVar['filial']['uf'] ?>" required>
        </div>  
        <div class="text-end">
            <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
        </div>
</form>