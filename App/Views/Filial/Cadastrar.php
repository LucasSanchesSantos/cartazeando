<h3 class="text-center mb-4"><i class="bi bi-shop me-2"></i> Filial</h3>

<form action="<?= URL ?>filial/cadastrar" method="post">
    
    <div class="mb-3">
        <label for="id" class="form-label">Id filial</label>
        <input type="text" class="form-control" id="id" name="id" placeholder="Digite o ID da nova filial." required>
    </div>
    <div class="mb-3">
        <label for="cidade" class="form-label">Cidade</label>
        <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Digite o nome da cidade da filial" required>
    </div>
    <div class="mb-3">
        <label for="uf" class="form-label">UF</label>
        <input type="text" class="form-control" id="uf" name="uf" plasceholder="Digite a UF da filial." required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>