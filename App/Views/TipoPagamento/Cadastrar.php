<h3 class="text-center mb-4"><i class="bi bi-person-add"></i> Usuário</h3>

<form action="<?= URL ?>usuario/cadastrar" method="post">
    <div class="mb-3">
        <label for="idFilial" class="form-label">ID Filial</label>
        <input type="number" class="form-control" id="idFilial" name="idFilial" required>
    </div>
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Novo tipo de pagamento</label>
        <input type="number" class="form-control" id="numeroFilial" name="numeroFilial" required>
    </div>
    
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>