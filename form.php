<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar ou Atualizar dados</title>
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link type="text/css" rel="stylesheet" href="css/geral.css"/>
    <link type="text/css" rel="stylesheet" href="css/formUp.css"/>
    <link type="text/css" rel="stylesheet" href="css/header.css"/>
    <link type="text/css" rel="stylesheet" href="css/form-inf.css"/>
</head>
<body>

<?php
echo 
'  <header>
        <div class="container">
            <nav>
                <ul class="main-menu">
                    <li class="menu-item">
                        <a href="index.html">Cadastrar Empresa</a>
                    </li>
                    <li class="menu-item">
                        <a href="refresh.html">Atualizar Empresa</a>
                    </li>
                    <li class="menu-item">
                        <a href="consult.php">Consultar</a>
                    </li>
                    <li class="menu-item">
                        <a href="">Lorem, ipsum.</a>
                    </li>
                    <li class="menu-item">
                        <a href="">Lorem, ipsum.</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>'
?>
<?php
        
        //define variables and set to empty values
        $setor = $cod = $empName = $ultBal = $cotAtual = $roic = $cresres = $divYield = $numAcoes = $divBruta = $disp =
        $ativCirc = $ativos = $patLiq = $recLiq12 = $ebit12 = $lucLiq12 = $recLiq3 = '';

        # setting to empty the error variables
        $setorErr = $codErr = $empNameErr = $ultBalErr = $cotAtualErr = $roicErr = $cresresErr = $divYieldErr =
        $numAcoesErr = $divBrutaErr = $dispErr = $ativCircErr = $ativosErr = $patLiqErr = $recLiq12Err = $ebit12Err =
        $lucLiq12Err = $recLiq3Err = '';

        # Colleting data to the variables
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            # testing if is empty and colleting data
            if (empty($_POST['setor'])) {
                $setorErr = "Selecione um Setor";
            } else {
                $setor = $_POST['setor'];
                $setor = filterData($setor);
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
                $cotAtual = tofloat(filterData($_POST['cot']));
                $cotAtual = (double)filter_var($cotAtual, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            };

            if (empty($_POST['roic'])) {
                $roicErr = "Informe o ROIC da empresa!";
            } else {
                $roic = tofloat(filterData($_POST['roic']));
            };

            if (empty($_POST['cresres'])) {
                $cresresErr = "Informe o crescimento da Receita da empres nos últimos 5 anos";
            } else {
                $cresres = tofloat(filterData($_POST['cresres']));
            };

            if (empty($_POST['dYield'])) {
                $divYieldErr = "Informe o dividend yield";
            } else {
                $divYield = tofloat(filterData($_POST['dYield']));
                $divYield = (double)filter_var($divYield, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
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
                $recLiq3 = filterData($_POST['recL3']);
            };
            
            
        }

        #Function to filter date (segurity)
        function filterData($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        #function to transforme decimal to float (substitute "," to ".")
        function tofloat($num) {
            $dotPos = strrpos($num, '.');
            $commaPos = strrpos($num, ',');
            $percPos = strrpos($num, '%');
            $realSingPos = strrpos($num, 'R$');
            $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
                ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
          
            if (!$sep) {
                return floatval(preg_replace("/[^0-9]/", "", $num));
            }
        
            return floatval(
                preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
                preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
            );
        }

    ?>
  
<?php
$username = "root";
$servername = "localhost";
$password = NULL;
$dbname = "invest";

/// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
};

$sql = "INSERT INTO acoesB3 (
    setor,codigo,empName,ultBal,cotAtual,roic,cresRec5a,divYield,nAcoes,divBruta,disponib,ativCirc,ativos,patLiq,recLiq12m,
    ebit12m,LucLiq12m,recLiq3m
    )
VALUES (
    '$setor','$cod','$empName','$ultBal',$cotAtual,$roic,$cresres,$divYield,$numAcoes,$divBruta,$disp,$ativCirc,$ativos,$patLiq,$recLiq12,
    $ebit12,$lucLiq12,$recLiq3
    );";
echo 'os inputs são:'.trim($setor).' '.$cod.' '.trim($empName).' '.$ultBal.' '.$cotAtual.' '.$roic.' '.$cresres.' '.$divYield.' '.$numAcoes.' '.$divBruta.' '.$disp.' '.$ativCirc.' '.$ativos.' 
'.$patLiq.' '.$recLiq12.' '.$ebit12.' '.$lucLiq12.' '.$recLiq3;


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();
?>

</body>
</html>