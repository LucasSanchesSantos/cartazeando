<h3 class="text-center mb-4"><i class="bi bi-person-add"></i> Empresa</h3>

<form action="<?= URL ?>empresa/cadastrar" method="post">
    
    <div class="mb-3">
        <label for="id" class="form-label">Id empresa</label>
        <input type="text" class="form-control" id="id" name="id" placeholder="Digite o ID da nova empresa." required>
    </div>
    <div class="mb-3">
        <label for="empresa" class="form-label">Empresa</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite o nome da empresa" required>
    </div>
    <div class="mb-3">
        <label for="cnpj" class="form-label">CNPJ</label>
        <input type="text" class="form-control" id="cnpj" name="cnpj" minlength="14" maxlength="14" plasceholder="Digite o cnpj da empresa (Apenas números)" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>