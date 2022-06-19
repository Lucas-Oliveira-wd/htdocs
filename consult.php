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
</head>
<body>
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

$sql = "SELECT codigo, cotAtual, roic, cresRec5a, divYield, nAcoes, divBruta, disponib, ativCirc, ativos,
patLiq, recLiq12m, LucLiq12m, ebit12m FROM acoesb3 WHERE ultBal = '2022-03-31'";
$ub0322 = $conn->query($sql);

echo //criando a página
'<header>
    <div class="container" >
        <nav>
            <ul class="main-menu">
                <li class="menu-item">
                    <a href="index.html">CadastrarEmpresa</a>
                </li>
                <li class="menu-item">
                    <a href="">Lorem, ipsum.</a>
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

$pl = $pv = $cod = $roe = $roic = $p_cxa = $divb_patl = $p_ativc = $p_ativ = $divb_cx = $marg_ebit = $marg_liq
= $cres_rec = $divY = $lynch = $perRes = $divbLuc = array();

if ($ub0322->num_rows > 0) {
    echo
"<table>
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
    </tr>";
    // output data of each row
    while($row = $ub0322->fetch_assoc()) {
        array_push($cod,$row['codigo']); //Código
      array_push($pl, round(($row['cotAtual']/($row['LucLiq12m']/$row['nAcoes'])), 2));// P/L
      array_push($pv, round(($row['cotAtual']/($row['patLiq']/$row['nAcoes'])), 2)); //P/VPA
      array_push($roe, round(($row['LucLiq12m']/$row['patLiq'])*100, 2)); //ROE
      array_push($roic, round($row['roic'], 2)); //ROIC
      array_push($p_cxa, round($row['cotAtual']/($row['disponib']/$row['nAcoes']), 2)); //Preco/Caixa por Acão
      array_push($divb_patl, round($row['divBruta']/$row['patLiq'], 3)); //Dívida Bruta/Patrimônio Líquido
      array_push($p_ativc, round($row['cotAtual']/($row['ativCirc']/$row['nAcoes']), 3)); //Preco/Ativos Circulantes por acao
      array_push($p_ativ, round($row['cotAtual']/($row['ativos']/$row['nAcoes']), 3)); //Preco/Ativos por acao
      array_push($divb_cx, round($row['divBruta']/$row['disponib'], 2)); //Dívida Bruta/Caixa
      array_push($marg_ebit, round(($row['ebit12m']/$row['recLiq12m'])*100, 2)); //Margem Ebítida
      array_push($marg_liq, round(($row['LucLiq12m']/$row['recLiq12m'])*100, 2)); //Margem Líquida
      array_push($cres_rec, round($row['cresRec5a'], 2)); //Crescimento da Receita (5 anos)
      array_push($divY, round($row['divYield'], 2)); //Dividen Yield
      array_push($lynch, round((($row['divYield']+($row['cresRec5a']/5))/($row['cotAtual']/($row['LucLiq12m']/$row['nAcoes']))), 2)); //Lynch
      array_push($perRes, round(($row['disponib']/(($row['recLiq12m']-$row['LucLiq12m'])/12)), 2)); //Período de Resistência
      array_push($divbLuc, round(($row['divBruta']/($row['LucLiq12m']/12)), 2)); //Dívida Bruta/Lucro Líquido Mensal
      
      
      ;
      
    }
    
for($i=0;$i<count($pl);$i++){
    echo 
    '<tr>
        <td>'.$cod[$i].'</td>
        <td>'.$pl[$i].'</td>
        <td>'.$pv[$i].'</td>
        <td>'.$roe[$i].'</td>
        <td>'.$roic[$i].'</td>
        <td>'.$p_cxa[$i].'</td>
        <td>'.$divb_patl[$i].'</td>
        <td>'.$p_ativc[$i].'</td>
        <td>'.$p_ativ[$i].'</td>
        <td>'.$divb_cx[$i].'</td>
        <td>'.$marg_ebit[$i].'</td>
        <td>'.$marg_liq[$i].'</td>
        <td>'.$cres_rec[$i].'</td>
        <td>'.$divY[$i].'</td>
        <td>'.$lynch[$i].'</td>
        <td>'.$perRes[$i].'</td>
        <td>'.$divbLuc[$i].'</td>
        
    </tr>';
}

echo '</table>';
  } else {
    echo "0 results";
  }



echo
    '</div>
</section>';

?>
</body>
</html>