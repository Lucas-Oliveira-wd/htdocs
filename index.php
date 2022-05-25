<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar ou Atualizar dados</title>
    <link type="text/css" rel="stylesheet" href="css/geral.css"/>
</head>
<body onload="writeCod (document.querySelector('#setor'))">
    
<?php
$servername = "localhost";
$username = "root";
$password = "No";

// Create connection
$conn = new mysqli($servername, $username, FALSE);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "<script>/*alert(Conexão com o banco de dados foi bem sucedida!)*/</script>";
?>

<section id = "secForm">
<div class="container">
    <h1 class = "stTitle">Upload de dados</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method='post'>
    <?php
        //define variables and set to empty values
        $setor = $cod = $empName = $ultBal = $cotAtual = $roic = $cresres = $divYield = $numAcoes = $divBruta = $disp = $ativCirc = $ativos = $patLiq = $recLiq12 = $ebit12 = $lucLiq12 = $recLiq3 = '';

        # setting to empty the error variables
        $setorErr = $codErr = $empNameErr = $ultBalErr = $cotAtualErr = $roicErr = $cresresErr = $divYieldErr = $numAcoesErr = $divBrutaErr = $dispErr = $ativCircErr = $ativosErr = $patLiqErr = $recLiq12Err = $ebit12Err = $lucLiq12Err = $recLiq3Err = '';

        # Colleting data to the variables
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            # testing if is empty and colleting data
            if (empty($_POST['setor'])) {
                $setorErr = "Selecione um Setor";
            } else {
                $setor = filterData($_POST['setor']);
            };

            if (empty($_POST['cod'])) {
                $codErr = "Selecione um Código";
            } else {
                $cod = filterData($_POST['cod']);
            };

            if (empty($_POST['empName'])) {
                $empNameErr = "Informe o nome da empresa";
            } else {
                $empName = filterData($_POST['empName']);
            };

            if (empty($_POST['ultBal'])) {
                $ultBalErr = "Informe a data do último balanco processado";
            } else {
                $ultBal = filterData($_POST['ultBal']);
            };

            if (empty($_POST['cot'])) {
                $cotAtualErr = "Informe o preco da acao atual";
            } else {
                $cotAtual = filterData($_POST['cot']);
            };

            if (empty($_POST['roic'])) {
                $roicErr = "Informe o ROIC da empresa!";
            } else {
                $roic = filterData($_POST['roic']);
            };

            if (empty($_POST['cresres'])) {
                $cresresErr = "Informe o crescimento da Receita da empres nos últimos 5 anos";
            } else {
                $cresres = filterData($_POST['cresres']);
            };

            if (empty($_POST['dYield'])) {
                $divYieldErr = "Informe o dividend yield";
            } else {
                $divYield = filterData($_POST['dYield']);
            };

            if (empty($_POST['nAcoes'])) {
                $numAcoesErr = "Informe o número de Acoes atual da empresa";
            } else {
                $numAcoes = filterData($_POST['nAcoes']);
            };

            if (empty($_POST['divB'])) {
                $divBrutaErr = "Informe o valor da dívida bruta da empresa!";
            } else {
                $divBruta = filterData($_POST['divB']);
            };

            if (empty($_POST['disp'])) {
                $dispErr = "Informe o valor da disponibilidade";
            } else {
                $disp = filterData($_POST['disp']);
            };

            if (empty($_POST['ativC'])) {
                $ativCirc = "Informe o valor dos ativos circulantes";
            } else {
                $ativCirc = filterData($_POST['ativC']);
            };

            if (empty($_POST['ativ'])) {
                $ativosErr = "Informe o valor dos ativos!";
            } else {
                $ativos = filterData($_POST['ativ']);
            };

            if (empty($_POST['patLiq'])) {
                $patLiqErr = "Informe o valor do patrimônio líquido!";
            } else {
                $patLiq = filterData($_POST['patLiq']);
            };

            if (empty($_POST['recL12'])) {
                $recLiq12 = "Informe a receita líquida nos últimos 12 meses";
            } else {
                $recLiq12 = filterData($_POST['recL12']);
            };

            if (empty($_POST['ebit12'])) {
                $ebit12Err = "Informe o valor do ebit nos últimos 12 meses";
            } else {
                $ebit12 = filterData($_POST['ebit12']);
            };

            if (empty($_POST['lucLiq12'])) {
                $lucLiq12Err = "Informe o valor do lucro líquido nos últimos 12 meses!";
            } else {
                $lucLiq12 = filterData($_POST['lucLiq12']);
            };

            if (empty($_POST['recL3'])) {
                $recLiq3Err = "Informe o valor da receita líquida nos últimos 3 meses!";
            } else {
                $recLiq3 =filterData($_POST['recL3']);
            };
            
            
        }

        #Function to filter date (segurity)
        function filterData($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
        <div class="formItem">
        <?php
        /* Reoder options in alphabetical */
        //criando o array com as opcoes
        $opt = array("Serviços Financeiros Diversos","Diversos","Bancos","Construção Civil","Energia Elétrica","Petróleo, Gás e Biocombustíveis","Tecidos, Vestuário e Calçados","Máquinas e Equipamentos","Químicos","Siderurgia e Metalurgia","Exploração de Imóveis","Madeira e Papel","Outros","Construção e Engenharia");
        //criando um array ordenado
        sort($opt);
        ?>
            <label for="setor">Setor</label><br>
            <select onchange="writeCod(this)" name = "setor" id="setor">
                <option name = ""><?php echo $opt[0]?></option>
                <option name = ""><?php echo $opt[1]?></option>
                <option name = ""><?php echo $opt[2]?></option>
                <option name = ""><?php echo $opt[3]?></option>
                <option name = ""><?php echo $opt[4]?></option>
                <option name = ""><?php echo $opt[5]?></option>
                <option name = ""><?php echo $opt[6]?></option>
                <option name = ""><?php echo $opt[7]?></option>
                <option name = ""><?php echo $opt[8]?></option>
                <option name = ""><?php echo $opt[9]?></option>
                <option name = ""><?php echo $opt[10]?></option>
                <option name = ""><?php echo $opt[11]?></option>
                <option name = ""><?php echo $opt[12]?></option>
                <option name = ""><?php echo $opt[13]?></option>
            </select>
        </div>
        <div class="formItem">
            <label for="cod">Código da Acão</label><br>
            <select id="cod" name='cod' onchage>

            </select>
        </div>

        <div class="formItem">
            <label for="empName">Nome da Empresa</label><br>
            <input name="empName" id="empName" type="text">
        </div>
        <div class="formItem">
            <label for="ultBal">Data do Último Balanco Processado</label><br>
            <input name="ultBal" id="ultBal" type="date">
        </div>
        <div class="formItem">
            <label for="cot">Cotacão Atual</label><br>
            <input name="cot" id="cot" type="text">
        </div>
        <div class="formItem">
            <label for="roic">Roic</label><br>
            <input name='roic' id='roic' type="text">
        </div>
        <div class="formItem">
            <label for="cresres">Crescimento da Receita (5 anos)</label><br>
            <input name='cresres' id='cresres' type="text">
        </div>
        <div class="formItem">
            <label for="dYield">Dividend Yield</label><br>
            <input name='dYield' id='dYield' type="text">
        </div>
        <div class="formItem">
            <label for="nAcoes">Número de Acões</label><br>
            <input name="nAcoes" id="nAcoes" type="text">
        </div>
        <div class="formItem">
            <label for="divB">Dívida Bruta</label><br>
            <input name="divB" id="divB" type="text">
        </div>
        <div class="formItem">
            <label for="disp">Disponibilidades</label><br>
            <input name="disp" id="disp" type="text">
        </div>
        <div class="formItem">
            <label for="ativC">Ativos Circulantes</label><br>
            <input name="ativC" id="ativC" type="text">
        </div>
        <div class="formItem">
            <label for="ativ">Ativos</label><br>
            <input name="ativ" id="ativ" type="text">
        </div>
        <div class="formItem">
            <label for="patLiq">Patrimonio Líquido</label><br>
            <input name="patLiq" id="patLiq" type="text">
        </div>
        <div class="formItem">
            <label for="recL12">Receita Líquida (12 meses)</label><br>
            <input name="recL12" id="recL12" type="text">
        </div>
        <div class="formItem">
            <label for="ebit12">Ebit (12 meses)</label><br>
            <input name="ebit12" id="ebit12" type="text">
        </div>
        <div class="formItem">
            <label for="lucLiq12">Lucro Líquido (12 meses)</label><br>
            <input name="lucLiq12" id="lucLiq12" type="text">
        </div>
        <div class="formItem">
            <label for="recL3">Receita Líquida (3 meses)</label><br>
            <input name="recL3" id="recL3" type="text">
        </div>
        <input type='submit' value="Enviar">
    </form>
</div>
</section>
<script src = "js/formValidate.js"></script>
</body>
</html>