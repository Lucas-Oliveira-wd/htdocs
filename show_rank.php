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

$cod = $roic = $cres_rec = $nAc = $divBruta = $disp = $ativC = $ativ = $patLiq = $recLiq12 = $lucLiq12 =
$ebit12 = $recLiq3 =  array();

// get the q parameter from URL
$q = $_REQUEST["q"];

$sql = "SELECT codigo, roic, cresRec5a, nAcoes, divBruta, disponib, ativCirc, ativos,
patLiq, recLiq12m, LucLiq12m, ebit12m, recLiq3m FROM acoesb3 WHERE ultBal = '".$q."'";

$ub = $conn->query($sql);

if ($ub->num_rows > 0) {

    // output data of each row
    while($row = $ub->fetch_assoc()) {
        array_push($cod,$row['codigo']);//codigo
        array_push($roic,$row['roic']);//ROIC
        array_push($cres_rec,$row['cresRec5a']);//Crescimento da Receita
        array_push($nAc,$row['nAcoes']);//Número de acoes
        array_push($divBruta,$row['divBruta']);//Divida Bruta
        array_push($disp,$row['disponib']);// Disponibilidades
        array_push($ativC,$row['ativCirc']);//Ativos Circulantes
        array_push($ativ,$row['ativos']);//Ativos
        array_push($patLiq,$row['patLiq']);//Patrimonio liquido
        array_push($recLiq12,$row['recLiq12m']);//Receita Liquida 12 meses
        array_push($lucLiq12,$row['LucLiq12m']);//Lucro Liquido 12 meses
        array_push($ebit12,$row['ebit12m']);// Ebitida 12 meses
        array_push($recLiq3,$row['recLiq3m']);// Receita Liquida 3 meses
                
    }

} else {
    echo "sem dados para essa data";
}

$cot = array(); // Array para conter as cotações
$divY = array(); // Array para o dividendyield

foreach ($cod as $v){
    $sql = "SELECT cotAtual, divYield FROM acoesb3cot WHERE ultBal = '".$v."' AND ultCot = MAX(ultCot)";
    $uc = $conn->query($sql);
    if ($uc->num_rows > 0) {
        while($row = $uc->fetch_assoc()) {
            array_push($cot,$row['cotAtual']);
            array_push($divY,$row['divYield']);
        }
    } else {
        array_push($cot,0);
        array_push($divY,0);
    }
}


    // output data of each row
    while($row = $ub->fetch_assoc()) {
        /*  Código   */
array_push($cod,$row['codigo']);
        /*  P/L  */
if ($row['LucLiq12m']!=0&&$row['nAcoes']!=0){
    array_push($pl, round(($row['cotAtual']/($row['LucLiq12m']/$row['nAcoes'])), 2));
} else{
    array_push($pl, INF);
};
        /* P/VPA     */
if ($row['patLiq']!=0&&$row['nAcoes']!=0){
    array_push($pv, round(($row['cotAtual']/($row['patLiq']/$row['nAcoes'])), 2));
} else {
    array_push($pv, INF);
}
        /*  ROE    */
if ($row['patLiq']!=0){
    array_push($roe, round(($row['LucLiq12m']/$row['patLiq'])*100, 2));
} else {
    array_push($roe, INF);
}
        /**    ROIC   */
array_push($roic, round($row['roic'], 2));
        /*     Preco/Caixa por Acão      */
if ($row['disponib']!=0&&$row['nAcoes']!=0){
    array_push($p_cxa, round($row['cotAtual']/($row['disponib']/$row['nAcoes']), 2));
} else {
    array_push($p_cxa, INF);
}
        /*   Dívida Bruta/Patrimônio Líquido   */
if ($row['patLiq']!=0){
    array_push($divb_patl, round($row['divBruta']/$row['patLiq'], 3));
} else {
    array_push($divb_patl, INF);
}
        /*   Preco/Ativos Circulantes por acao  */
if($row['ativCirc']!=0&&$row['nAcoes']!=0){
    array_push($p_ativc, round($row['cotAtual']/($row['ativCirc']/$row['nAcoes']), 3));
} else {
    array_push($p_ativc, INF);
}
        /*  Preco/Ativos por acao       */
if ($row['ativos']!=0&&$row['nAcoes']!=0){
    array_push($p_ativ, round($row['cotAtual']/($row['ativos']/$row['nAcoes']), 3));
} else {
    array_push($p_ativ, INF);
}
        /*  Dívida Bruta/Caixa */
if ($row['disponib']!=0){
    array_push($divb_cx, round($row['divBruta']/$row['disponib'], 2));
} else {
    array_push($divb_cx, INF);
}
        /*  Margem Ebítida  */
        /*  Margem Líquida  */
if ($row['recLiq12m']!=0){
    array_push($marg_ebit, round(($row['ebit12m']/$row['recLiq12m'])*100, 2));
    array_push($marg_liq, round(($row['LucLiq12m']/$row['recLiq12m'])*100, 2));
} else {
    array_push($marg_ebit, INF);
    array_push($marg_liq, INF);
}

        /*  Crescimento da Receita (5 anos) */
array_push($cres_rec, round($row['cresRec5a'], 2));
        /*  Dividen Yield       */
array_push($divY, round($row['divYield'], 2));
        /*  Lynch               */
if ($row['cotAtual']!=0&&$row['LucLiq12m']!=0&&$row['nAcoes']!=0){
    array_push($lynch, round((($row['divYield']+($row['cresRec5a']/5))/($row['cotAtual']/($row['LucLiq12m']/$row['nAcoes']))), 2));
}else {
    array_push($lynch, INF);
}
        /*  Período de Resistência  */
if ((($row['recLiq12m']-$row['LucLiq12m'])/12)!=0){
    array_push($perRes, round(($row['disponib']/(($row['recLiq12m']-$row['LucLiq12m'])/12)), 2));
} else {
    array_push($perRes, INF);
}
        /*  Dívida Bruta/Lucro Líquido Mensal   */
if (($row['LucLiq12m']/12)!=0){
    array_push($divbLuc, round(($row['divBruta']/($row['LucLiq12m']/12)), 2));
} else {
    array_push($divbLuc, INF);
}
// calculando o desvio padrão
$med = ($row['recLiq12m']/4+$row['recLiq3m'])/2;
$sumDif1 = ($row['recLiq12m']/4 - $med)**2;
$sumDif2 = ($row['recLiq3m'] - $med)**2;
$dp = ($sumDif1 + $sumDif2)**(1/2);
if($med!=0){
    $dpperc = $dp/abs($med);
} else {
$dpperc = INF;
}

array_push($desv_pad_rec, round($dpperc, 3)); //Desvio Padrão Relativos das Receitas trimestrais e anuais
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

