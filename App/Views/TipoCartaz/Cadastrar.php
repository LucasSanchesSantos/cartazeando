<h3 class="text-center mb-4"><i class="bi bi-person-add"></i> Usuário</h3>

<form action="<?= URL ?>tipoCartaz/cadastrar" method="post">
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Novo tipo de cartaz</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite o nome do novo tipo de cartaz" required>
    </div>
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Dimensão inicial</label>
        <input type="numeric" class="form-control" id="dimensaoInicial" name="dimensaoInicial" placeholder="Digite o tamanho inicial do novo tipo de cartaz" required>
    </div>
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Dimensao final</label>
        <input type="numeric" class="form-control" id="dimensaoFinal" name="dimensaoFinal" placeholder="Digite o tamanho final do novo tipo de cartaz" required>
    </div>
    <div class="mb-3">
        <label for="numeroFilial" class="form-label">Quantidade de folhas</label>
        <input type="numeric" class="form-control" id="qtdFolhas" name="qtdFolhas" placeholder="Digite a quantidade de folhas" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary bg-dark-blue">Salvar</button>
    </div>
</form>