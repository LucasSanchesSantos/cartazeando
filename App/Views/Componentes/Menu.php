<body class="bg-light">
    <nav class="navbar bg-white sticky-top shadow">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <button class="navbar-toggler bg-white me-2 shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand fw-bold fs-4 m-0 d-flex align-middle" href="<?= URL ?>inicio"><img src="<?= PATH_IMG ?>cartazeando.png" width="150px"></a>
            </div>
            <div class="d-flex align-items-center">
                <div class="btn-group">
                    <button type="button" class="d-flex align-items-center btn border-0 p-0 text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-4 me-1 text-dark-blue"></i><?= $usuario['usuario'] ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="<?= URL ?>usuario/edicao" class="dropdown-item text-end" type="button">
                                Usuário<i class="bi bi-person-gear ms-1"></i>
                            </a>
                            <a href="<?= URL ?>login/logout" class="dropdown-item text-end" type="button">
                                Sair<i class="bi bi-box-arrow-right ms-1"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header shadow">
                    <h5 class="offcanvas-title text-dark-blue" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div>
                    <ul class="navbar-nav justify-content-end flex-grow-1">
                    <li class="nav-item">
                        <a class="nav-link px-3 border-bottom" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#submenuImpressoes" aria-expanded="false">
                            <i class="text-dark-blue bi bi-printer me-2"></i>Impressões
                        </a>
                        <ul class="collapse list-unstyled ms-4" id="submenuImpressoes">
                            <li class="nav-item">
                                <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>impressao/index"><i class="text-dark-blue bi bi-printer me-2"></i>Impressão</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>impressaoPersonalizada/index"><i class="text-dark-blue bi bi-printer me-2"></i>Impressão personalizada</a>
                            </li>
                            <!-- Adicione outros itens de submenu aqui, se necessário -->
                        </ul>
                    </li>

                        <?php
                            if ($isAdministrativo) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link px-3 border-bottom" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#submenuManutencoes" aria-expanded="false">
                                    <i class="text-dark-blue bi bi-tools me-2"></i>Manutenções
                                </a>
                                <ul class="collapse list-unstyled ms-4" id="submenuManutencoes">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>usuario/index"><i class="text-dark-blue bi bi-person-gear me-2"></i>Usuários</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>tipoPagamento/index"><i class="text-dark-blue bi bi-gear-fill me-2"></i>Tipos de pagamentos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>filial/index"><i class="text-dark-blue bi bi-shop me-2"></i>Filiais</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link px-3 border-bottom" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#submenuProdutos" aria-expanded="false">
                                    <i class="text-dark-blue bi bi-box-arrow-in-down me-2"></i>Produtos
                                </a>
                                <ul class="collapse list-unstyled ms-4" id="submenuProdutos">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>ProdutoCadastro/index"><i class="text-dark-blue bi bi-tv me-2"></i>Produto</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>Cor/index"><i class="text-dark-blue bi bi-palette me-2"></i>Cor</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>Voltagem/index"><i class="text-dark-blue bi bi-lightning me-2"></i>Voltagem</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>Promocao/index"><i class="text-dark-blue bi bi-tags-fill me-2"></i>Promoções</a>
                                    </li>
                                </ul>
                            </li>

                            
                            <li class="nav-item">
                                <a class="nav-link px-3 border-bottom" aria-current="page" href="#" data-bs-toggle="collapse" data-bs-target="#submenuRelatorios" aria-expanded="false">
                                    <i class="text-dark-blue bi bi-file-earmark-bar-graph me-2"></i>Relatórios
                                </a>
                                <ul class="collapse list-unstyled ms-4" id="submenuRelatorios">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>Impressoes/index"><i class="text-dark-blue bi bi-file-earmark-spreadsheet me-2"></i>Impressões geral</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>Impressoes/RealorioQuantidade"><i class="text-dark-blue bi bi-file-earmark-spreadsheet me-2"></i>Impressões por promoção</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>Impressoes/RealorioProduto"><i class="text-dark-blue bi bi-file-earmark-spreadsheet me-2"></i>Impressões por produto</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3 border-bottom" aria-current="page" href="<?= URL ?>Impressoes/ImpressoesPorFilial"><i class="text-dark-blue bi bi-file-earmark-spreadsheet me-2"></i>Impressões por filial</a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-white div-content rounded shadow-lg">