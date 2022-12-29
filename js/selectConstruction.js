// Global variables
const $body = document.querySelector('body');

//criando o array com as opcoes
const $opt = ["Serviços Financeiros Diversos","Diversos","Bancos","Construção Civil",
"Energia Elétrica","Petróleo, Gás e Biocombustíveis","Tecidos, Vestuário e Calçados",
"Máquinas e Equipamentos","Químicos","Siderurgia e Metalurgia",
"Exploração de Imóveis","Madeira e Papel","Outros","Construção e Engenharia", "Comércio"];

/* Reoder options in alphabetical */

// array para conter os options de setor 
var $ordOpt = [];
for (i=0;i<$opt.length;i++){
    $ordOpt[i] = '<option name="setor'+i+'">'+$opt.sort()[i]+'</option>'
};
// escrevendo os options no select setor
document.querySelector('#setor').innerHTML = $ordOpt;

// forming the select to codigo da acao
//creating the arrays
$servFinDir = ['GPIV33']; 
$dir = ['RENT3'];
$banc = ['ITSA4'];
$constCivil = ['CYRE3'];
$eneElet = ['TRPL4','CLSC4'];
$petGasBioc = ['ENAT3','PETR4'];
$tecVestCalc = ['CTSA4'];
$maqEq = ['MTSA4','KEPL3','WEGE3', 'TASA4'];
$quim = ['CRPG6','BRKM6'];
$sidMet = ['CSNA3','TKNO4','PATI4','GOAU4','USIM5', 'GGBR4'];
$expPet = ['HBTS5','BRML3']
$madPap = ['EUCA4'];
$outros = ['ATOM3'];
$consEng = ['SOND5', 'ETER3'];
$comerc = ['EPAR3'];

/*!ATENCAO esses são todos os setores possiveis para empresas ja registradas.
Caso seja nescessario cadastrar uma empresa que não tenha o setor nesse script, será nescessário criar um novo array.
Para cada empresa que tiver o setor, basta acrescentar o codigo da empresa no array do setor correspondente! */

$cod = [$servFinDir,$dir,$banc,$constCivil,$eneElet,$petGasBioc,$tecVestCalc,$maqEq,$quim,$sidMet,
    $expPet,$madPap,$outros,$consEng, $comerc]

const $selCod = document.querySelector('#cod');

function writeCod (e){
var $selArr = []; //Array que vai conter as opcoes para o select
    switch (e.value){
        case "Serviços Financeiros Diversos":
            for (i=0;i<$servFinDir.length;i++){
                $selArr[i] = "<option name ='"+$servFinDir[i]+"'>"+$servFinDir[i]+"</option>";
                $selCod.innerHTML = $selArr;
            };
            break;
        case "Diversos":
            for (i=0;i<$dir.length;i++){
                $selArr[i] = "<option name ='"+$dir[i]+"'>"+$dir[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break;
        case "Bancos":
            for (i=0;i<$banc.length;i++){
                $selArr[i] = "<option name ='"+$banc[i]+"'>"+$banc[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break;
        case "Construção Civil":
            for (i=0;i<$constCivil.length;i++){
                $selArr[i] = "<option name ='"+$constCivil[i]+"'>"+$constCivil[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break;
        case "Energia Elétrica":
            for (i=0;i<$eneElet.length;i++){
                $selArr[i] = "<option name ='"+$eneElet[i]+"'>"+$eneElet[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break;
        case "Petróleo, Gás e Biocombustíveis":
            for (i=0;i<$petGasBioc.length;i++){
                $selArr[i] = "<option name ='"+$petGasBioc[i]+"'>"+$petGasBioc[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break;
        case "Tecidos, Vestuário e Calçados":
            for (i=0;i<$tecVestCalc.length;i++){
                $selArr[i] = "<option name ='"+$tecVestCalc[i]+"'>"+$tecVestCalc[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break;
        case "Máquinas e Equipamentos":
            for (i=0;i<$maqEq.length;i++){
                $selArr[i] = "<option name ='"+$maqEq[i]+"'>"+$maqEq[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break;
        case "Químicos":
            for (i=0;i<$quim.length;i++){
                $selArr[i] = "<option name ='"+$quim[i]+"'>"+$quim[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break;
        case "Siderurgia e Metalurgia":
            for (i=0;i<$sidMet.length;i++){
                $selArr[i] = "<option name ='"+$sidMet[i]+"'>"+$sidMet[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break; 
        case "Exploração de Imóveis":
            for (i=0;i<$expPet.length;i++){
                $selArr[i] = "<option name ='"+$expPet[i]+"'>"+$expPet[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break; 
        case "Madeira e Papel":
            for (i=0;i<$madPap.length;i++){
                $selArr[i] = "<option name ='"+$madPap[i]+"'>"+$madPap[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break;
        
        case "Outros":
            for (i=0;i<$outros.length;i++){
                $selArr[i] = "<option name ='"+$outros[i]+"'>"+$outros[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break;
            
        case "Construção e Engenharia":
            for (i=0;i<$consEng.length;i++){
                $selArr[i] = "<option name ='"+$consEng[i]+"'>"+$consEng[i]+"</option>"
                $selCod.innerHTML = $selArr;
            };
            break;
            
            case "Comércio":
                for (i=0;i<$comerc.length;i++){
                    $selArr[i] = "<option name ='"+$comerc[i]+"'>"+$comerc[i]+"</option>"
                    $selCod.innerHTML = $selArr;
                };
                break;
        default:
            $selCod.innerHTML = '<option name="default">Selecione um Setor para ver os códigos disponíveis</option>'
        };
};
