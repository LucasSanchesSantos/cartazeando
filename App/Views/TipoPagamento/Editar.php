<h3 class="text-center mb-4"><i class="bi bi-person-gear"></i> Usuário</h3>

<form action="<?= URL ?>tipoPagamento/editar" method="post">
    <input type="hidden" id="id" name="id" value=<?= !empty($_GET['id']) ? intval($_GET['id']) : intval($tipoPagamento['id']) ?>>

        <div class="mb-3">
            <label for="idFilial" class="form-label">ID</label>
            <input type="number" class="form-control" id="idFilial" name="idFilial" value="<?= $this->viewVar['tipoPagamento']['id'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="numeroFilial" class="form-label">Tipo de pagamento</label>
            <input type="number" class="form-control" id="numeroFilial" name="numeroFilial" value="<?= $this->viewVar['tipoPagamento']['tipoPagamento'] ?>" required>
        </div>
    
        <div class="text-end">
            <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
        </div>
</form>