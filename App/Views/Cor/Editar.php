<h3 class="text-center mb-4"><i class="bi bi-person-gear"></i> Usuário</h3>

<form action="<?= URL ?>cor/editar" method="post">
    <input type="hidden" id="id" name="id" value=<?= !empty($_GET['id']) ? intval($_GET['id']) : intval($cor['id']) ?>>

        <div class="mb-3">
            <label class="form-label">ID</label>
            <input type="number" class="form-control" id="id" name="id" value="<?= $this->viewVar['cor']['id'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Cor</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $this->viewVar['cor']['descricao'] ?>" required>
        </div>
    
        <div class="text-end">
            <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
        </div>
</form>