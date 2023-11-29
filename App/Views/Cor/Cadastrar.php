<h3 class="text-center mb-4"><i class="bi bi-palette me-2"></i> Cor</h3>

<form action="<?= URL ?>cor/cadastrar" method="post">
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Novo cor</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite o nome da nova cor" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>