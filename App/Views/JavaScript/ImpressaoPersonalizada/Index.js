function abrirModalCartaz() {
    const form = document.getElementById('impressaoPersonalizadaForm');

    if (!form.checkValidity()) {
        form.reportValidity();

        return;
    }

    $('#modalCartaz').modal('show')
}

function impressao(tipoCartaz) {
    const form = document.getElementById('impressaoPersonalizadaForm');

    const formData = new FormData(form);
    const parametros = Object.fromEntries(formData);

    $.get(`${URL}impressaoPersonalizada/getDadosParaImpressao`, parametros).done(function(response) {
        let dados = JSON.parse(response);

        if (tipoCartaz == 'A4') {
            gerarA4(dados);
    
            return;
        }
    
        if (tipoCartaz == 'A3') {
            gerarA3(dados);
    
            return;
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log("Ocorreu um erro na requisição:", textStatus, errorThrown);
    });
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
            jurosComposto: { fontSize: 9, alignment: 'right' },
        }
    };
    
    let id = 1;

    let preco = dadosProdutoPromocao.tipo == 'A Vista' ? dadosProdutoPromocao.preco_partida : dadosProdutoPromocao.preco_a_prazo;

    preco = converterStringEmNumeroFormatoAmericano(preco);

    let precoParcela = (preco / parseInt(dadosProdutoPromocao.prazo_final)).toFixed(2);

    preco = converterStringEmMoeda(preco);
    preco = converterStringEmMoeda(precoParcela);


    precoParcela = (+precoParcela).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    precoParcela = precoParcela.replace('R$', '');
    precoParcela = precoParcela.slice(1);

    let tipo = {
        "A Vista": "À Vista",
        "Cartão": "Cartão de Crédito",
        "Carteira": "Carteira"
    };
    let dataInicial = moment(dadosProdutoPromocao.data_inicial, 'YYYY-MM-DD').format('DD/MM/YYYY');
    let dataFinal = moment(dadosProdutoPromocao.data_final, 'YYYY-MM-DD').format('DD/MM/YYYY');

    let idProduto = `${dadosProdutoPromocao.id_produto}.${dadosProdutoPromocao.id_grade_x}.${dadosProdutoPromocao.id_grade_y}`;
    let descricao = dadosProdutoPromocao.produto;
    let variacao = `${dadosProdutoPromocao.cor} - ${dadosProdutoPromocao.voltagem}`;
    let de = `De R$${dadosProdutoPromocao.de}`;
    let prazo = `${dadosProdutoPromocao.prazo_inicial} + ${dadosProdutoPromocao.prazo_final}X`;
    let totalAPrazo = 'Total a prazo R$';
    tipo = tipo[dadosProdutoPromocao.tipo];
    let validade = `De ${dataInicial} até ${dataFinal}`;
    let jurosComposto = `No CDC (GazinCred) taxa de ${dadosProdutoPromocao.juro_composto}% a.m.`;

    let dadosProdutoPromocaoContent = [
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
        { id: `jurosComposto${id}`, text: jurosComposto, style: 'jurosComposto' },  
    ];  

    if (typeof dadosProdutoPromocao.de === 'undefined' || !dadosProdutoPromocao.de) {
        let indiceDe = dadosProdutoPromocaoContent.findIndex((obj) => obj.id === `de${id}`); 
        dadosProdutoPromocaoContent.splice(indiceDe, 1);
    }   

    if (tipo === 'À Vista') {
        let indicePrazo = dadosProdutoPromocaoContent.findIndex((obj) => obj.id === `prazo${id}`);   
        dadosProdutoPromocaoContent.splice(indicePrazo, 1);  
        let indiceTotalAPrazo = dadosProdutoPromocaoContent.findIndex((obj) => obj.id === `totalAPrazo${id}`);   
        dadosProdutoPromocaoContent.splice(indiceTotalAPrazo, 1);
    }   
    
    if (dadosProdutoPromocao.tipoFormato !== 'CDC') {
        let indiceJurosComposto = dadosProdutoPromocaoContent.findIndex((obj) => obj.id === `jurosComposto{id}`);    
        dadosProdutoPromocaoContent.splice(indiceJurosComposto, 1);
    }

    docDefinition.content.push(dadosProdutoPromocaoContent, { text: '', pageBreak: 'after' });


    docDefinition.content.pop();

    let pdfDocGenerator = pdfMake.createPdf(docDefinition);

    pdfDocGenerator.download('cartazin.pdf');

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

function gerarA3(produtoPromocao) {
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
            jurosComposto: { fontSize: 12, alignment: 'right' },
        }
    };

    let id = 1;

    let preco = produtoPromocao.tipo == 'A Vista' ? produtoPromocao.preco_partida : produtoPromocao.preco_a_prazo;
    
    preco = converterStringEmNumeroFormatoAmericano(preco);

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
    let jurosComposto = `No CDC (GazinCred) taxa de ${produtoPromocao.juro_composto}% a.m.`;
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
        { id: `jurosComposto${id}`, text: jurosComposto, style: 'jurosComposto' },  

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

    if (produtoPromocao.tipoFormato !== 'CDC') {
        let indiceJurosComposto = produtoPromocaoContentSegundaPagina.findIndex((obj) => obj.id === `jurosComposto{id}`);    
        produtoPromocaoContentSegundaPagina.splice(indiceJurosComposto, 1);
    }

    docDefinition.content.push(produtoPromocaoContentSegundaPagina, { text: '', pageBreak: 'after' });

    id++;

    docDefinition.content.pop();

    let pdfDocGenerator = pdfMake.createPdf(docDefinition);

    pdfDocGenerator.download('cartazin.pdf');

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

function converterStringEmMoeda(valor) {
    valor = parseFloat(valor).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
    valor = valor.replace('R$', '');

    return valor;
}

function converterStringEmNumeroFormatoAmericano(valor) {
    valor = valor.replace(".", "");
    valor = valor.replace(",", ".");

    return parseFloat(valor);
}