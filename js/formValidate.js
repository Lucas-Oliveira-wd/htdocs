function checkEmpty(e){
    if (e.value == ''){
        $body.classList.add('showSpan'+e.id);
    } else {
        $body.classList.remove('showSpan'+e.id)
    }
};

function sc (e){
    for (i = 0; i<e.length; i++){
       console.log(e.charCodeAt(i)) 
    }
};
// funcao para permitir Apenas Letras
// !IMPORTANTE: usar o evento keypressup para chamar essa funcao
function justLetters (e){
    let val = e.value;
    let arr = ['']; //array para conter os caracteres
    for (i=0;i<val.length;i++) {
        let codI = val.charCodeAt(i);
        if(codI >= 65 && codI <= 122 || codI === 32/*(charCode do espaco)*/){
        arr[i] = val[i];  
        }
    };
    let nval = ''; //nova variavel com so com letras
    for(i=0;i<arr.length;i++){
        if(arr[i] != undefined){  // retirando os undifineds
            nval = nval.concat('',arr[i]);
        }
    }
    e.value = nval; // substituindo o valor do input
};


//Funcao para permitir apenas numeros
// !IMPORTANTE: usar o evento keypressup para chamar essa funcao
function justNumbers (e){
    let val = e.value;
    let arr = ['']; //array para conter os caracteres
    for (i=0;i<val.length;i++) {
        let codI = val.charCodeAt(i);
        if(codI>=48&&codI<=57||(codI==45 && i==0)){
        arr[i] = val[i];  
        }
    };
    let nval = ''; //nova variavel com so com números
    for(i=0;i<arr.length;i++){
        if(arr[i] != undefined){  // retirando os undifineds
           nval = nval.concat('',arr[i]); 
        }
    }
    e.value = nval; // substituindo o valor do input
};

//Funcao para permitir apenas numeros com formato em real
// !IMPORTANTE: usar o evento keypressup para chamar essa funcao
function justNumbersReal (e){
    let val = e.value;
    let arr = ['']; //array para conter os caracteres
    for (i=0;i<val.length;i++) {
        let codI = val.charCodeAt(i);
        if(codI>=48&&codI<=57||codI==44||codI==82||codI==36/*charCode de (',','R','$')*/){
        arr[i] = val[i];  
        }
    };
    let nval = ''; //nova variavel com so com letras
    for(i=0;i<arr.length;i++){
        nval = nval.concat('',arr[i]);
    }
    e.value = nval; // substituindo o valor do input
};

//Funcao para tranformar numeros para o formato da moeda real
function toReal(e){
    let val = '';
    let dec = '';
    let real = '';
    for(i=0;i<e.value.length;i++){
        let char = e.value.charAt(i);
        if(char!==','&&char!=='R'&&char!=='$'){
            val = val.concat('',e.value[i]);
        }
    }
    dec = val.slice(val.length-2);
    real = val.slice(0,val.length-2);
    e.value = 'R$'+real+','+dec;
    if(val!==''&&dec!==''&&real!==''){
    }
    
};

//Funcao para tranformar numeros para o formato de porcentagem
function toPercent(e){
    let val = '';
    let dec = '';
    let befVirg = '';
    console.log('toPercent rodou!')
    for(i=0;i<e.value.length;i++){
        let char = e.value.charAt(i);
        if(char!==','&&char!=='%'){
            console.log("char: "+char)
            val = val.concat('',e.value[i]);
        }
    }
    dec = val.slice(val.length-1);
    befVirg = val.slice(0,val.length-1);
    e.value = befVirg+','+dec+'%';
}
//Funcao para permitir apenas numeros com formato de porcentagem
// !IMPORTANTE: usar o evento keypressup para chamar essa funcao
function justNumbersPerc (e){
    console.log("justNumbersPerc rodou!")
    let val = e.value;
    let arr = ['']; //array para conter os caracteres
    for (i=0;i<val.length;i++) {
        let codI = val.charCodeAt(i);
        console.log('codI: '+codI)
        if(codI>=48&&codI<=57||codI==44||codI==37||codI==45/*charCode de (',','%','-')*/){
        arr[i] = val[i];  
        }
    };
    let nval = ''; //nova variavel com so com os valores filtrados
    for(i=0;i<arr.length;i++){
        nval = nval.concat('',arr[i]);
        console.log("arr[i]: "+arr[i])
    }
    e.value = nval; // substituindo o valor do input
};