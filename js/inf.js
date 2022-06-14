function showInf(){
    let cotAt = document.forms['up']['cot'].value;
    let arr = ['']; //array para conter os caracteres
    for (i=0;i<cotAt.length;i++) {
        let codI = cotAt.charCodeAt(i);
        if(codI>=48&&codI<=57){
        arr[i] = cotAt[i];  
        }
    };
    let nCotAt = ''; //nova variavel com so com números
    for(i=0;i<arr.length;i++){
        if(arr[i] != undefined){  // retirando os undifineds
            nCotAt = nCotAt.concat('',arr[i]); 
        }
    };
    nCotAt = (1/100)*nCotAt; //dividindo os valores por 100 para driblar a conversão
    let nAc = document.forms['up']['nAcoes'].value;
    let lucLiqA = document.forms['up']['lucLiq12'].value;

    //  Mostrar o P/L
    if(cotAt != '' && nAc != '' && lucLiqA != ''){
        document.querySelector('#inf-pl').innerHTML = 'P/L: '+
        (nCotAt/(lucLiqA/nAc)).toFixed(2);
    };

    let cod = document.forms['up']['cod'].value;

    // Mostrar o link de Fundamentus
    if(cod != ''){
        document.querySelector('#inf-link-fund').innerHTML =
        '<a href = "https://fundamentus.com.br/detalhes.php?papel='+cod+'" target = "_blank">Ir para Fundamentus</a>'
    };

    let patLiq = document.forms['up']['patLiq'].value;

    // Mostrar o P/VP
    if(patLiq != '' && nCotAt != '' && nAc != ''){
        document.querySelector('#inf-pvp').innerHTML = 'P/VP: '+(nCotAt/(patLiq/nAc)).toFixed(2);
    };

    if (lucLiqA != '' && nAc != ''){
        document.querySelector('#inf-lpa').innerHTML = 'LPA: '+(lucLiqA/nAc).toFixed(2);
    };

    if (patLiq != '' && nAc != ''){
        document.querySelector('#inf-vpa'). innerHTML = 'VPA: '+ (patLiq/nAc).toFixed(2);
    };

    // mostrar marg. ebit
    let ebit = document.forms['up']['ebit12'].value;
    let recLiq = document.forms['up']['recL12'].value;
    if(ebit != '' && recLiq != ''){
        document.querySelector('#inf-marg-ebit').innerHTML = (((ebit/recLiq)*100).toFixed(1)+'%');
    };

    //mostrar marg. Líquida
    if(lucLiqA != '' && recLiq != ''){
        document.querySelector('#inf-marg-liq').innerHTML = (((lucLiqA/recLiq)*100).toFixed(1)+'%');
    };
};