$(document).ready(() => {
    $('#modalFiltro').modal('show')
})

let condicaoSelecionarTudo = true;

function atualizarFilialSelecionada(idFilial) {
    let idFilialSelecionada = document.getElementById('idFilial').value;

    if (idFilial != idFilialSelecionada && idFilialSelecionada) {
        ativarLoading();

        window.location.href = `${URL}impressao/index?idFilialSelecionada=${idFilialSelecionada}`;
    }
}

function atualizarPromocoes(idFilialSessao) {
    const elementoIdFilial = document.getElementById('idFilial');

    let idFilial = elementoIdFilial ? elementoIdFilial.value : idFilialSessao;

    let parametro = {
        idFilial: idFilial
    };

    $.get(`${URL}rotina/produtos`, parametro)
        .done(function(data) {
            console.log(data);
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log("Ocorreu um erro na requisição:", textStatus, errorThrown);
        });
}

function atualizarCards(idFilialSessao) {
    const elementoIdFilial = document.getElementById('idFilial');

    let idFilial = elementoIdFilial ? elementoIdFilial.value : idFilialSessao;

    let filtroPromocao = document.getElementById('filtroPromocao').value;
    let filtroCategoria = document.getElementById('filtroCategoria').value;
    let filtroSubcategoria = document.getElementById('filtroSubcategoria').value;
    let filtroIdProduto = document.getElementById('filtroIdProduto').value;

    $('#modalFiltro').modal('hide');

    let parametros = {
        "idFilial": idFilial,
        "promocao": filtroPromocao,
        "idDepartamento": filtroCategoria,
        "idSubdepartamento": filtroSubcategoria,
        "idProduto": filtroIdProduto
    };

    let divInformativoFiltro = document.getElementById('divInformativoFiltro');
    let informativoFiltro = document.getElementById('informativoFiltro');

    divInformativoFiltro.setAttribute('class', 'd-none');

    $.get(`${URL}impressao/produtosPorFiltro`, parametros)
        .done(function(response) {
            let dados = JSON.parse(response);

            if (dados == null) {
                divInformativoFiltro.setAttribute('class', 'mt-4 w-100');

                informativoFiltro.innerHTML = 'Nenhum produto encontrado!';

                return;
            }

            let divCards = document.getElementById('divCards');

            divCards.innerHTML = '';

            let idElemento = 1;
            
            Object.values(dados).forEach((produto) => {
                let valor = produto['tipo'] === 'A Vista' ? 
                    converterStringEmMoeda(produto['preco_partida'])
                    : converterStringEmMoeda(produto['preco_a_prazo']);

                let divInformacoes = getDivInformacoes(produto, valor, idElemento);
                let divImgInformacoes = getDivImgInformacoes();
                let divImg = getDivImg(produto['imagem']);
                let divCheckbox = getDivCheckbox(idElemento);
                let divImgInformacoesCheckbox = getDivImgInformacoesCheckbox();

                divImgInformacoes.appendChild(divImg);
                divImgInformacoes.appendChild(divInformacoes);

                divImgInformacoesCheckbox.appendChild(divImgInformacoes);
                divImgInformacoesCheckbox.appendChild(divCheckbox);

                let divDe = getDivDe(idElemento);
                let divPromocao = getDivPromocao(produto, idElemento);
                let divPromocaoDe = getDivPromocaoDe();

                divPromocaoDe.appendChild(divPromocao);
                divPromocaoDe.appendChild(divDe);

                let divConteudoCard = getDivConteudoCard();

                divConteudoCard.appendChild(divImgInformacoesCheckbox);
                divConteudoCard.appendChild(divPromocaoDe);

                let divCard = getDivCard(idElemento, produto);

                divCard.appendChild(divConteudoCard);

                divCards.appendChild(divCard);

                aplicarMascaras();

                idElemento++;
            });
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log("Ocorreu um erro na requisição:", textStatus, errorThrown);

            divInformativoFiltro.setAttribute('class', 'mt-4 w-100');

            informativoFiltro.innerHTML = 'Produto(s) não encontrado(s).';

            divCards.innerHTML = '';
        });
}

function alterarPromocao(idElemento) {
    let produtoPromocao = document.getElementById(`produtoPromocao${idElemento}`);
    let textoPromocao = document.getElementById(`textoPromocao${idElemento}`);

    let dadosProdutoPromocao = JSON.parse(produtoPromocao.getAttribute('dados'));
    let dadosPromocao = JSON.parse(document.getElementById(`promocao${idElemento}`).value);

    dadosProdutoPromocao.id_promocao_produto_grade = dadosPromocao['id_promocao_produto_grade'];
    dadosProdutoPromocao.promocao = dadosPromocao['promocao'];
    dadosProdutoPromocao.tipo = dadosPromocao['tipo'];
    dadosProdutoPromocao.valor = parseFloat(dadosPromocao['valor'].replace(",", "."));
    dadosProdutoPromocao.prazo_inicial = dadosPromocao['prazo_inicial'];
    dadosProdutoPromocao.prazo_final = dadosPromocao['prazo_final'];

    if (dadosProdutoPromocao.tipo == 'A Vista') {
        dadosProdutoPromocao.preco_partida = parseFloat(dadosPromocao['valor'].replace(",", "."));
    } else {
        dadosProdutoPromocao.preco_a_prazo = parseFloat(dadosPromocao['valor'].replace(",", "."));
    }

    produtoPromocao.setAttribute('dados', JSON.stringify(dadosProdutoPromocao));

    textoPromocao.innerHTML = `${dadosPromocao['tipo']}: <small>R$</small> ${dadosPromocao['valor']}`;
}

function alterarDe(idElemento) {
    let de = document.getElementById(`de${idElemento}`).value;

    let produtoPromocao = document.getElementById(`produtoPromocao${idElemento}`);
    let dadosProdutoPromocao = JSON.parse(produtoPromocao.getAttribute('dados'));

    dadosProdutoPromocao.de = de;

    produtoPromocao.setAttribute('dados', JSON.stringify(dadosProdutoPromocao));
}

function selecionarTudo() {
    let checkboxes = document.querySelectorAll('input[type="checkbox"]');

    for (let i = 0; i < checkboxes.length; i++) {
        let checkbox = checkboxes[i];

        checkbox.checked = condicaoSelecionarTudo;
    }

    condicaoSelecionarTudo = !condicaoSelecionarTudo;
}

function impressao(tipoCartaz) {
    let checkboxesMarcados = document.querySelectorAll('input[type="checkbox"]:checked');

    let dados = [];

    for (let i = 0; i < checkboxesMarcados.length; i++) {
      let checkbox = checkboxesMarcados[i];

      divProdutoPromocao = document.getElementById(checkbox.value);

      dadosProdutoPromocao = JSON.parse(divProdutoPromocao.getAttribute('dados'));

      dados.push(dadosProdutoPromocao);
    }

    if (tipoCartaz == 'A4') {
        gerarA4(dados);

        return;
    }

    if (tipoCartaz == 'A3') {
        gerarA3(dados);

        return;
    }
}

function gerarA4(dadosProdutoPromocao) {
    let docDefinition = {
        content: [],
        pageSize: 'A4',
        pageMargins: [80, 240, 80, 0],
        styles: {
            idProduto: { fontSize: 12, alignment: 'center', margin: [0, 0, 0, 10] }, //[start, top, end, bot]
            descricao: { fontSize: 20, bold: true, alignment: 'center', margin: [0, 0, 0, 10] },
            variacao: { fontSize: 16, alignment: 'center', margin: [0, 0, 0, 50] },
            de: { fontSize: 20, alignment: 'center', decoration: 'lineThrough', margin: [0, 0, 0, 0] },
            prazo: { fontSize: 20, bold: true, margin: [100, 0, 0, 0] },
            rs: { fontSize: 50, bold: true, alignment: 'center' },
            precoParcela: { fontSize: 90, bold: true, alignment: 'center' },
            totalAPrazo: { fontSize: 16, alignment: 'right' },
            preco: { fontSize: 16, bold: true, alignment: 'right' },
            tipo: { fontSize: 16, alignment: 'right', margin: [0, 15, 0, 6] },
            validade: { fontSize: 9, alignment: 'right' },
        }
    };

    let id = 1;

    dadosProdutoPromocao.forEach((produtoPromocao) => {
        let preco = produtoPromocao.tipo == 'A Vista' ? produtoPromocao.preco_partida : produtoPromocao.preco_a_prazo;
        let precoParcela = (preco / produtoPromocao.prazo_final).toFixed(2);

        preco = (+preco).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        preco = preco.replace('R$', '');

        precoParcela = (+precoParcela).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        precoParcela = precoParcela.replace('R$', '');
        precoParcela = precoParcela.slice(1);

        let tipo = {
            "A Vista": "À Vista",
            "Cartão": "Cartão de Crédito",
            "Carteira": "Carteira"
        };
        let dataInicial = moment(produtoPromocao.data_inicial, 'YYYY-MM-DD').format('DD/MM/YYYY');
        let dataFinal = moment(produtoPromocao.data_final, 'YYYY-MM-DD').format('DD/MM/YYYY');

        let idProduto = `${produtoPromocao.id_produto}.${produtoPromocao.id_grade_x}.${produtoPromocao.id_grade_y}`;
        let descricao = produtoPromocao.produto;
        let variacao = `${produtoPromocao.cor} - ${produtoPromocao.voltagem}`;
        let de = `De R$${produtoPromocao.de}`;
        let prazo = `${produtoPromocao.prazo_inicial} + ${produtoPromocao.prazo_final}X`;
        let totalAPrazo = 'Total a prazo R$';
        tipo = tipo[produtoPromocao.tipo];
        let validade = `De ${dataInicial} até ${dataFinal}`;


        let produtoPromocaoContent = [
            { id: `idProduto${id}`, text: idProduto, style: 'idProduto' },
            { id: `descricao${id}`, text: descricao, style: 'descricao' },
            { id: `variacao${id}`, text: variacao, style: 'variacao' },
            { id: `de${id}`, text: de, style: 'de' },
            { id: `prazo${id}`, text: prazo, style: 'prazo' },
            {
                id: `precoParcela${id}`,
                text: [
                    { text: 'R$', style: 'rs' },
                    { text: precoParcela, style: 'precoParcela' }
                ]
            },
            {
                id: `totalAPrazo${id}`,
                text: [
                    { text: totalAPrazo, style: 'totalAPrazo' },
                    { text: preco, style: 'preco' }
                ]
            },
            { id: `tipo${id}`, text: tipo, style: 'tipo' },
            { id: `validade${id}`, text: validade, style: 'validade' },

        ];

        if (typeof produtoPromocao.de === 'undefined' || !produtoPromocao.de) {
            let indiceDe = produtoPromocaoContent.findIndex((obj) => obj.id === `de${id}`);

            produtoPromocaoContent.splice(indiceDe, 1);
        }

        if (tipo === 'À Vista') {
            let indicePrazo = produtoPromocaoContent.findIndex((obj) => obj.id === `prazo${id}`);

            produtoPromocaoContent.splice(indicePrazo, 1);

            let indiceTotalAPrazo = produtoPromocaoContent.findIndex((obj) => obj.id === `totalAPrazo${id}`);

            produtoPromocaoContent.splice(indiceTotalAPrazo, 1);
        }

        docDefinition.content.push(produtoPromocaoContent, { text: '', pageBreak: 'after' });

        id++;
    });

    docDefinition.content.pop();

    let pdfDocGenerator = pdfMake.createPdf(docDefinition);

    pdfDocGenerator.download('cartazeando.pdf');

    pdfMake.createPdf(docDefinition).getBase64(function (base64) {
        let pdfData = 'data:application/pdf;base64,' + base64;

        let htmlContent = '<html><body style="margin: 0; padding: 0;">' +
          '<embed width="100%" height="100%" src="' + pdfData + '" type="application/pdf" />' +
          '</body></html>';

        let newWindow = window.open();
        newWindow.document.write(htmlContent);
        newWindow.document.close();
    });
}

function gerarA3(dadosProdutoPromocao) {
    let docDefinition = {
        content: [],
        pageSize: 'A4',
        pageOrientation: 'landscape',
        pageMargins: [80, 0, 80, 0],
        styles: {
            idProduto: { fontSize: 26, alignment: 'center', margin: [0, 0, 0, 10] }, //[start, top, end, bot]
            descricao: { fontSize: 40, bold: true, alignment: 'center', margin: [0, 0, 0, 10] },
            variacao: { fontSize: 28, alignment: 'center', margin: [0, 0, 0, 50] },
            de: { fontSize: 40, alignment: 'center', decoration: 'lineThrough', margin: [0, 0, 0, 0] },
            prazo: { fontSize: 40, bold: true, margin: [100, 0, 0, 0] },
            rs: { fontSize: 80, bold: true, characterSpacing: -30, alignment: 'center' },
            precoParcela: { fontSize: 180, bold: true, alignment: 'center' },
            precoParcelaComEspacamentoDiminuido: { fontSize: 180, bold: true, characterSpacing: -17, alignment: 'center' },
            totalAPrazo: { fontSize: 35, alignment: 'right' },
            preco: { fontSize: 35, bold: true, alignment: 'right' },
            tipo: { fontSize: 35, alignment: 'right', margin: [0, 15, 0, 6] },
            validade: { fontSize: 12, alignment: 'right' },
        }
    };

    let id = 1;

    dadosProdutoPromocao.forEach((produtoPromocao) => {
        let preco = produtoPromocao.tipo == 'A Vista' ? produtoPromocao.preco_partida : produtoPromocao.preco_a_prazo;
        let precoParcela = (preco / produtoPromocao.prazo_final).toFixed(2);

        preco = (+preco).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        preco = preco.replace('R$', '');

        precoParcela = (+precoParcela).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        precoParcela = precoParcela.replace('R$', '');
        precoParcela = precoParcela.slice(1);

        let tipo = {
            "A Vista": "À Vista",
            "Cartão": "Cartão de Crédito",
            "Carteira": "Carteira"
        };
        let dataInicial = moment(produtoPromocao.data_inicial, 'YYYY-MM-DD').format('DD/MM/YYYY');
        let dataFinal = moment(produtoPromocao.data_final, 'YYYY-MM-DD').format('DD/MM/YYYY');

        let idProduto = `${produtoPromocao.id_produto}.${produtoPromocao.id_grade_x}.${produtoPromocao.id_grade_y}`;
        let descricao = produtoPromocao.produto;
        let variacao = `${produtoPromocao.cor} - ${produtoPromocao.voltagem}`;
        let de = `De R$${produtoPromocao.de}`;
        let prazo = `${produtoPromocao.prazo_inicial} + ${produtoPromocao.prazo_final}X`;
        let totalAPrazo = 'Total a prazo R$';
        tipo = tipo[produtoPromocao.tipo];
        let validade = `De ${dataInicial} até ${dataFinal}`;
        let produtoPromocaoContentPrimeiraPagina = [
            { text: '', margin: [0, 360, 0, 0]},
            { id: `idProduto${id}`, text: idProduto, style: 'idProduto' },
            { id: `descricao${id}`, text: descricao, style: 'descricao' },
            { id: `variacao${id}`, text: variacao, style: 'variacao' }
        ];
        
        docDefinition.content.push(produtoPromocaoContentPrimeiraPagina, { text: '', pageBreak: 'after' });

        let stylePrecoParcela = 'precoParcela';

        if (precoParcela.length >= 7) {
            stylePrecoParcela = 'precoParcelaComEspacamentoDiminuido';
        }

        let produtoPromocaoContentSegundaPagina = [
            { text: '', margin: [0, 10, 0, 0]},
            { id: `de${id}`, text: de, style: 'de' },
            { id: `prazo${id}`, text: prazo, style: 'prazo' },
            {
                id: `precoParcela${id}`,
                text: [
                    { text: 'R$', style: 'rs' },
                    { text: precoParcela, style: stylePrecoParcela }
                ]
            },
            {
                id: `totalAPrazo${id}`,
                text: [
                    { text: totalAPrazo, style: 'totalAPrazo' },
                    { text: preco, style: 'preco' }
                ]
            },
            { id: `tipo${id}`, text: tipo, style: 'tipo' },
            { id: `validade${id}`, text: validade, style: 'validade' },
        ];

        if (typeof produtoPromocao.de === 'undefined' || !produtoPromocao.de) {
            let indiceDe = produtoPromocaoContentSegundaPagina.findIndex((obj) => obj.id === `de${id}`);

            produtoPromocaoContentSegundaPagina.splice(indiceDe, 1);
        }

        if (tipo === 'À Vista') {
            let indicePrazo = produtoPromocaoContentSegundaPagina.findIndex((obj) => obj.id === `prazo${id}`);

            produtoPromocaoContentSegundaPagina.splice(indicePrazo, 1);

            let indiceTotalAPrazo = produtoPromocaoContentSegundaPagina.findIndex((obj) => obj.id === `totalAPrazo${id}`);

            produtoPromocaoContentSegundaPagina.splice(indiceTotalAPrazo, 1);
        }

        docDefinition.content.push(produtoPromocaoContentSegundaPagina, { text: '', pageBreak: 'after' });

        id++;
    });

    docDefinition.content.pop();

    let pdfDocGenerator = pdfMake.createPdf(docDefinition);

    pdfDocGenerator.download('cartazeando.pdf');

    pdfMake.createPdf(docDefinition).getBase64(function (base64) {
        let pdfData = 'data:application/pdf;base64,' + base64;

        let htmlContent = '<html><body style="margin: 0; padding: 0;">' +
          '<embed width="100%" height="100%" src="' + pdfData + '" type="application/pdf" />' +
          '</body></html>';

        let newWindow = window.open();
        newWindow.document.write(htmlContent);
        newWindow.document.close();
    });
}

function getDivDe(idElemento) {
    let div = document.createElement('div');
    let input = document.createElement('input');

    div.setAttribute('class', 'col-md-12');

    input.setAttribute('type', 'text');
    input.setAttribute('class', 'form-control moeda');
    input.setAttribute('id', `de${idElemento}`);
    input.setAttribute('name', `de${idElemento}`);
    input.setAttribute('placeholder', 'De R$');
    input.setAttribute('onblur', `alterarDe(${idElemento})`);

    div.appendChild(input);

    return div;
}

function getDivPromocao(produto, idElemento) {
    let div = document.createElement('div');
    let select = document.createElement('select');

    div.setAttribute('class', 'col-md-12 mb-2');

    select.setAttribute('class', 'form-select');
    select.setAttribute('id', `promocao${idElemento}`);
    select.setAttribute('name', `promocao${idElemento}`);
    select.setAttribute('onchange', `alterarPromocao(${idElemento})`);

    produto.promocoes.forEach((promocao) => {
        let option = document.createElement('option');

        option.setAttribute('value', JSON.stringify({
            "id_promocao_produto_grade": promocao['id_promocao_produto_grade'],
            "promocao": promocao['promocao'],
            "tipo": promocao['tipo'],
            "valor": promocao['valor'],
            "prazo_inicial": promocao['prazo_inicial'],
            "prazo_final": promocao['prazo_final']
        }));

        if (promocao['id_promocao_produto_grade'] == produto['id_promocao_produto_grade']) {
            option.selected = true;
        }

        let valor = converterStringEmMoeda(promocao['valor']);

        option.innerHTML = `${promocao['promocao']} (${promocao['tipo']}) - R$ ${valor}`;
    
        select.appendChild(option);
    });

    div.appendChild(select);

    return div;
}

function getDivPromocaoDe() {
    let div = document.createElement('div');

    div.setAttribute('class', 'row mt-2');

    return div;
}

function getDivInformacoes(produto, valor, idElemento) {
    let div = document.createElement('div');
    let h5 = document.createElement('h5');
    let primeiroH6 = document.createElement('h6');
    let segundoH6 = document.createElement('h6');

    segundoH6.setAttribute('id', `textoPromocao${idElemento}`)

    let textoDescricao = document.createTextNode(produto['produto']);
    let textoCodigoSaldo = document.createTextNode(
        `${produto['id_produto']}.${produto['id_grade_x']}.${produto['id_grade_y']} | Saldo: ${produto['estoque']}`
    );

    let textoTipoValor = `${produto['tipo']}: <small>R$</small>${valor}`;

    h5.appendChild(textoDescricao);
    primeiroH6.appendChild(textoCodigoSaldo);

    segundoH6.innerHTML = textoTipoValor;

    div.appendChild(h5);
    div.appendChild(primeiroH6);
    div.appendChild(segundoH6);

    return div;
}

function getDivImgInformacoes() {
    let div = document.createElement('div');

    div.setAttribute('class', 'd-flex');

    return div;
}

function getDivImg(url) {
    let div = document.createElement('div');
    let img = document.createElement('img');

    img.setAttribute('src', url);
    img.setAttribute('width', '150px');

    div.appendChild(img);

    return div;
}

function getDivCheckbox(idElemento) {
    let div = document.createElement('div');
    let checkbox = document.createElement('input');

    div.setAttribute('class', 'form-check d-flex justify-content-end');
    checkbox.setAttribute('class', 'form-check-input');
    checkbox.setAttribute('type', 'checkbox');
    checkbox.setAttribute('value', `produtoPromocao${idElemento}`);

    checkbox.checked = false;

    div.appendChild(checkbox);

    return div;
}

function getDivImgInformacoesCheckbox() {
    let div = document.createElement('div');

    div.setAttribute('class', 'd-flex justify-content-between');

    return div;
}

function getDivConteudoCard() {
    let div = document.createElement('div');

    div.setAttribute('class', 'h-100 border p-3');

    return div;
}

function getDivCard(idElemento, produto) {
    let div = document.createElement('div');

    div.setAttribute('class', 'col-md-3 p-3');
    div.setAttribute('id', `produtoPromocao${idElemento}`);

    let json = JSON.stringify(produto);

    div.setAttribute('dados', json);

    return div;
}

function converterStringEmMoeda(valor) {
    valor = (+valor).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
    valor = valor.replace('R$', '');

    return valor;
}

function getAlturaPrimeiroConteudo(conteudo) {
    let tamanhoEmBytes = new Blob([JSON.stringify(conteudo)]).size;
    let tamanhoEmKiloBytes = tamanhoEmBytes / 1024;
    let pixelsPorKiloByte = 10; // Exemplo: 10 pixels por kilobyte
    let tamanhoEmPixels = tamanhoEmKiloBytes * pixelsPorKiloByte;
    let marginsExtras = 0;

    return tamanhoEmPixels + marginsExtras;
}