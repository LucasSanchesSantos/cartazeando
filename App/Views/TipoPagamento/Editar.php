<h3 class="text-center mb-4"><i class="bi bi-person-gear"></i> Tipo pagamento</h3>

<form action="<?= URL ?>tipoPagamento/editar" method="post">
    <input type="hidden" id="id" name="id" value=<?= !empty($_GET['id']) ? intval($_GET['id']) : intval($tipoPagamento['id']) ?>>

        <div class="mb-3">
            <label class="form-label">ID</label>
            <input type="number" class="form-control" id="id" name="id" value="<?= $this->viewVar['tipoPagamento']['id'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo de pagamento</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $this->viewVar['tipoPagamento']['descricao'] ?>" required>
        </div>
    
        <div class="text-end">
            <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
        </div>
</form>