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
patLiq, recLiq12m, LucLiq12m, ebit12m, recLiq3m FROM acoesb3 WHERE ultBal = '2022-03-31'";
$ub0322 = $conn->query($sql);

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

$pl = $pv = $cod = $roe = $roic = $p_cxa = $divb_patl = $p_ativc = $p_ativ = $divb_cx = $marg_ebit = $marg_liq
= $cres_rec = $divY = $lynch = $perRes = $divbLuc = $desv_pad_rec = $mean = $variance =  array();

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
      array_push($desv_pad_rec, round(((((($row['recLiq12m']/4-((($row['recLiq12m']/4)+$row['recLiq3m'])/2))**2+($row['recLiq3m']-((($row['recLiq12m']/4)+$row['recLiq3m'])/2))**2)/2)**(1/2)/((($row['recLiq12m']/4)+$row['recLiq3m'])/2))*100), 3)); //Desvio Padrão Relativos das Receitas trimestrais e anuais
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
        <td>'.$desv_pad_rec[$i].'</td>
        
    </tr>';
}

echo '</table>';
  } else {
    echo "0 results";
  }



echo
    '</div>
</section>';

echo
'<Section id="sec-rank">
    <div class="container">';
//Normalizando os dados(fórmula=>X_new = (X - X_min)/(X_max - X_min))

for ($i=0;$i<count($cod);$i++){
$plN[$i] = round(($pl[$i] - min($pl))/(max($pl) - min($pl)), 3);
$pvN[$i] = round(($pv[$i] - min($pv))/(max($pv) - min($pv)), 3);
$roeN[$i] = round(($roe[$i] - min($roe))/(max($roe) - min($roe)), 3);
$roicN[$i] = round(($roic[$i] - min($roic))/(max($roic) - min($roic)), 3);
$p_cxaN[$i] = round(($p_cxa[$i] - min($p_cxa))/(max($p_cxa) - min($p_cxa)), 3);
$divb_patlN[$i] = round(($divb_patl[$i] - min($divb_patl))/(max($divb_patl) - min($divb_patl)), 3);
$p_ativcN[$i] = round(($p_ativc[$i] - min($p_ativc))/(max($p_ativc) - min($p_ativc)), 3);
$p_ativN[$i] = round(($p_ativ[$i] - min($p_ativ))/(max($p_ativ) - min($p_ativ)), 3);
$divb_cxN[$i] = round(($divb_cx[$i] - min($divb_cx))/(max($divb_cx) - min($divb_cx)), 3);
$marg_ebitN[$i] = round(($marg_ebit[$i] - min($marg_ebit))/(max($marg_ebit) - min($marg_ebit)), 3);
$marg_liqN[$i] = round(($marg_liq[$i] - min($marg_liq))/(max($marg_liq) - min($marg_liq)), 3);
$cres_recN[$i] = round(($cres_rec[$i] - min($cres_rec))/(max($cres_rec) - min($cres_rec)), 3);
$divYN[$i] = round(($divY[$i] - min($divY))/(max($divY) - min($divY)), 3);
$lynchN[$i] = round(($lynch[$i] - min($lynch))/(max($lynch) - min($lynch)), 3);
$perResN[$i] = round(($perRes[$i] - min($perRes))/(max($perRes) - min($perRes)), 3);
$divbLucN[$i] = round(($divbLuc[$i] - min($divbLuc))/(max($divbLuc) - min($divbLuc)), 3);
$desv_pad_recN[$i] = round(($desv_pad_rec[$i] - min($desv_pad_rec))/);
}

for($i=0;$i<count($cod);$i++){//mudando os valores com o bjetivo de minimizacão (quanto menor melhor)
$plNMin[$i] = 1 - $plN[$i];
$pvNMin[$i] = 1 - $plN[$i];
$p_cxaNMin[$i] = 1 - $p_cxaN[$i];
$divb_patlNMin[$i] = 1 - $divb_patlN[$i];
$p_ativcNMin[$i] = 1 - $p_ativcN[$i];
$p_ativNMin[$i] = 1 - $p_ativN[$i];
$divb_cxNMin[$i] = 1 - $divb_cxN[$i];
$divbLucNMin[$i] = 1 - $divbLucN[$i];
}

for ($i=0;$i<count($cod);$i++){
    $best[$i] = 
        $bestc[$i] = $cod[$i]; $bestv[$i] =
        $roeN[$i] + $roicN[$i] + $marg_ebitN[$i] + $divYN[$i] + $lynchN[$i] + $perResN[$i] + $plNMin[$i] +
        $pvNMin[$i] + $p_cxaNMin[$i] + $divb_patlNMin[$i] + $p_ativcNMin[$i] + $p_ativNMin[$i] + $divb_cxNMin[$i] +
        $divbLucNMin[$i];
};

array_multisort ($bestv, SORT_NUMERIC, SORT_DESC, $bestc);
echo '<ol>';
for($i=0;$i<count($cod);$i++){
    echo '<ul>'.$bestc[$i].': '.$bestv[$i].'</ul>';
}
echo '</ol>';

echo
    '</div>
</section>';

?>
</body>
</html>