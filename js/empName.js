// object to hold the emp names

const empName = {
    'PETR4': 'PETROBRAS PN',
    'BRKM6': 'BRASKEM PNB N1',
    'CSNA3': 'CSN ON',
    'GOAU4': 'METALÚRGICA GERDAU PN N1',
    'ITSA4': 'ITAÚSA PN N1',
    'USIM5': 'USIMINAS PNA N1',
    'WEGE3': 'WEG SA ON N1',
    'CYRE3': 'CYRELA BRAZIL REALTY PN',
    'RENT3': 'OCALIZA RENT A CAR ON',
    'TRPL4': 'TRANSMISSÃO PAULISTA PN N1',
    'TKNO4': 'TEKNO PN',
    'BRML3': 'BR MALLS PARTICIPAÇÔES S/A ON',
    'CLSC4': 'CELESC PN N2',
    'CRPG6': 'CRISTAL PNB',
    'CTSA4': 'SANTANENSE PN',
    'ENAT3': 'ENAUTA PART ON',
    'EUCA4': 'EUCATEX PN',
    'GPIV33': 'GP INVESTMENTS, LTD DR3',
    'HBTS5': 'CIA HABITASUL PNA',
    'KEPL3': 'KEPLER WEBER SA ON',
    'MTSA4': 'METISA PN',
    'PATI4': 'PANATLANTICA PN',
    'ATOM3': 'ATOMPAR ON',
    'SOND5': 'SONDOTECNICA S/A. PNA'
};

function wrtEmpName(){
    let val = document.forms['up']['cod'].value;
    for (i in empName){
        if(i == val){
            document.querySelector('#empName').value = empName[i];
        }
    }
}