<?php
        /* Reoder options in alphabetical */
        //criando o array com as opcoes
        $opt = array("Serviços Financeiros Diversos","Diversos","Bancos","Construção Civil","Energia Elétrica","Petróleo, Gás e Biocombustíveis","Tecidos, Vestuário e Calçados","Máquinas e Equipamentos","Químicos","Siderurgia e Metalurgia","Exploração de Imóveis","Madeira e Papel","Outros","Construção e Engenharia");
        //criando um array ordenado
        sort($opt);
        ?>

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
<div class ='none' style = 'display:  none'>    
<?php
$username = "lucas";
$servername = "localhost";
$password = NULL;
$dbname = "fundamentus";

// Create connection
$conn = new mysqli($servername, $username, FALSE, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
echo "<script>alert(Conexão com o banco de dados foi bem sucedida!)</script>";
};

$sql = "INSERT INTO a_03_2022 (setor,codigo,empName,datUltBal,cot,roic,cresRec5a,divYield,numAcoes,divB,disp,ativCirc,arivos,patLiq,recLiq12,ebit12,lucLiq12,recLiq3)
VALUES ($setor,$cod,$empName,$ultBal,$cot,$roic,$cresres,$dYield,$nAcoes,$divB,$disp,$ativC,$ativ,$patLiq,$recL12,$ebit12,$lucLiq12,$recL3)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();
?>