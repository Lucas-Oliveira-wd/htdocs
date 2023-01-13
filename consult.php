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
    <link type="text/css" rel="stylesheet" href="css/consult.css"/>
    <link type="text/css" rel="stylesheet" href="css/pie_chart.css"/>
</head>
<body onload = "showData(document.querySelector('#ult_bal_sel').value)">
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

echo //criando a página
'<header>
    <div class="container" >
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
</header>

<!-- secão de consulta -->
<section id="sec-consult">
    <div class="container">';


$sql = "SELECT DISTINCT ultBal FROM acoesb3 ORDER BY ultBal DESC";
$ultBal = $conn->query($sql);

$ultBalValues =  array();

if ($ultBal->num_rows > 0) {
    echo
'<form name="select_ult_cot" action="'.'<?php echo htmlspecialchars($_SERVER[PHP_SELF]) ?>'.'" method="get">
    <div class="form-item">
        <select onchange="showData(this.value);" name="ult_bal" id="ult_bal_sel">';
    // output data of each row
    while($row = $ultBal->fetch_assoc()) {
      array_push($ultBalValues, $row['ultBal']);// utimos balanços
      ;
      
    }
    

echo '$ShowData: '.$showData;
for($i=0;$i<count($ultBalValues);$i++){
    if ($i == 0){
        echo
        '<option selected name = "'.$ultBalValues[$i].'">'.$ultBalValues[$i].'</option>';
    }
    else{
       echo 
    '<option name = "'.$ultBalValues[$i].'">'.$ultBalValues[$i].'</option>'; 
    }
    
}

echo '  </select>   
    </div>
</form>';
  } else {
    echo "Sem datas de Balanço para mostrar";
  }

echo
    '<div class="table" id="table_fund">';

echo
"<table>
<thead>
    <tr>
        <th>Código</th>
        <th>P/L</th>
        <th>P/VPA</th>
        <th>ROE</th>
        <th>ROIC</th>
        <th>Preco/Caixa</th>
        <th>Dívida/Patrimônio</th>
        <th>Preco/Ativo Circulante</th>
        <th>Preco/Ativo</th>
        <th>Dívida/Caixa</th>
        <th>Márg. Ebit</th>
        <th>Márg. Líquida</th>
        <th>Crescimento da Receita (5a)</th>
        <th>Dividendyield</th>
        <th>Lynch</th>
        <th>Período de Resistência</th>
        <th>Divida/Lucro Mensal</th>
        <th>Desv.Pad. das Receitas</th>
    </tr>
</thead>
<tbody>";
echo
'</tbody>
</table>';

echo
    '</div>';


echo
  '</div>
</section>';

echo
'<Section id="sec-rank">
    <div class="container">';

echo
    '</div>
</section>';

?>
<script src = "js/show_rank.js"></script>
<script src = "js/ajax.js"></script>
</body>
</html>