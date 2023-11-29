<div>
    <nav class="navbar bg-body-tertiary">
      <div class="container-fluid d-flex justify-content-between">
        <div class="d-flex">
            <button type="button" class="btn btn-dark-blue me-1" data-bs-toggle="modal" data-bs-target="#modalFiltro">
                Filtros
            </button>
            <button type="button" class="btn btn-dark-blue ms-1" onclick="selecionarTudo()">
                Selecionar tudo
            </button>
        </div>
            <?php
                if ($isAdministrativo) {
            ?>
                <div class="d-flex align-items-center">
                    <select class="form-select" id="idFilial" name="idFilial" onchange="atualizarFilialSelecionada(<?= $usuario['id_filial_selecionada']?>)" required>
                            <?php
                                foreach ($this->viewVar['filiais'] as $filial) {
                            ?>
                                <option value=<?= $filial['id_filial'] ?> <?= $filial['id_filial'] == $usuario['id_filial_selecionada'] ? 'selected' : '' ?>>
                                    FL <?= $filial['numero_filial'] ?> - <?= $filial['cidade'] ?>
                                </option>
                            <?php
                                }
                            ?>
                    </select>
                </div>
            <?php
                }
            ?>
      </div>
    </nav>

    <div id="divInformativoFiltro" class="mt-4 w-100">
        <div id="informativoFiltro" class="alert alert-warning text-center" role="alert">
          Utilize o filtro para exibir registros.
        </div>
    </div>

     <div class="mt-4 row" id="divCards"> <!--Cartaz gera aqui dentro dessa div -->
     
    </div>
</div>

<div class="d-flex justify-content-end sticky-bottom">
    <button type="button" class="btn btn-dark-blue btn-floating mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#modalCartaz"><i class="bi bi-card-heading"></i> Gerar Cartaz(es)</button>
</div>

<div class="modal fade" id="modalFiltro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark-blue text-white">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Filtros</h1>
        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form action="">
                <div class="mb-4">
                    <label class="form-label" for="filtroIdPromocao">Promoção</label>
                    <select class="form-control selectpicker" id="filtroIdPromocao" title="Selecione" name="filtroIdPromocao" data-live-search="true">
                        <option value="">Selecione</option>
                        <?php foreach ($this->viewVar['promocoes'] as $promocao) { ?>
                            <option value="<?= "{$promocao['id_promocao']}" ?>"><?= "{$promocao['descricao']} ({$promocao['tipo']})" ?></option>
                        <?php } ?>
                    </select>
                </div>
                   
                <div class="mb-4">
                    <label class="form-label" for="filtroIdProduto">Código produto</label>
                    <select class="form-control selectpicker" id="filtroIdProduto" title="Selecione" name="filtroIdProduto" data-live-search="true">
                        <option value="">Selecione</option>
                        <?php foreach ($this->viewVar['idProdutos'] as $idProduto) { ?>
                            <option value="<?= $idProduto['id_produto'] ?>"><?= $idProduto['id_produto'].' - '.$idProduto['produto']?></option>
                        <?php } ?>
                    </select>
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-dark-blue" onclick="atualizarCards(<?= $usuario['id_filial']?>)">Filtrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalCartaz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark-blue text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Selecione o formato de cartaz</h1>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <?php foreach ($this->viewVar['tiposCartazes'] as $tiposCartazes) { ?>
                        <div class="col-md-6">
                            <div class="card text-center mx-3 p-3" onclick="impressao('<?= $tiposCartazes['tipo_cartaz'] ?>')">
                                <div class="d-flex justify-content-center">
                                    <img src="<?= PATH_IMG ?>sticky.svg" class="imagem-centralizada" style="width: 50%;">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= "{$tiposCartazes['tipo_cartaz']}"?></h5>
                                    <p class="card-text"><?= "{$tiposCartazes['dimensao_inicial']}cm x {$tiposCartazes['dimensao_final']}cm"?></p>
                                    <p class="card-text"><?= "{$tiposCartazes['qtd_folhas']}"?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
</div>