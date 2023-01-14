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
    $sql = "SELECT cotAtual, divYield FROM acoesb3cot WHERE cod = '".$v."' ORDER BY ultCot DESC LIMIT 1";
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

        /*  Arrays para conter os criterios     */

$pl = $pv = $roe = $p_cxa = $divb_patl = $p_ativc = $p_ativ = $divb_cx = $marg_ebit = $marg_liq = $lynch = $perRes =
 $divbLuc = $med = $sumDif1 = $sumDif2 = $dp = $desv_pad_rec = array();        

 for ($i=0;$i<count($cod);$i++){
                 /*  P/L  */
if ($lucLiq12[$i]!=0&&$nAc[$i]!=0) {
    $pl[$i] = round($cot[$i]/($lucLiq12[$i]/$nAc[$i]) , 2);
 }  else {
    $pl[$i] = INF;  
 };    
        /* P/VPA     */
if ($patLiq[$i]!=0&&$nAc[$i]!=0){
    $pv[$i] = round($cot[$i]/($patLiq[$i]/$nAc[$i]), 2);
} else {
    $pv[$i] = INF;
}
        /*  ROE    */
        /*   Dívida Bruta/Patrimônio Líquido   */
if ($patLiq[$i]!=0){
    $roe[$i] = round(($lucLiq12[$i]/$patLiq[$i])*100, 2);
    $divb_patl[$i] = round($divBruta[$i]/$patLiq[$i], 3);
} else {
    $roe[$i] = INF;
    $divb_patl[$i] = INF;
}
        /*     Preco/Caixa por Acão      */
if ($disp[$i]!=0&&$nAc[$i]!=0){
    $p_cxa[$i] = round($cot[$i]/($disp[$i]/$nAc[$i]), 2);
} else {
    $p_cxa[$i] = INF;
}
        /*   Preco/Ativos Circulantes por acao  */
if($ativC[$i]!=0&&$nAc[$i]!=0){
    $p_ativc[$i] = round($cot[$i]/($ativC[$i]/$nAc[$i]), 3);
} else {
    $p_ativc[$i] = INF;
}
        /*  Preco/Ativos por acao       */
if ($ativ[$i]!=0&&$nAc[$i]!=0){
    $p_ativ[$i] = round($cot[$i]/($ativ[$i]/$nAc[$i]), 3);
} else {
    $p_ativ[$i] = INF;
}
        /*  Dívida Bruta/Caixa */
if ($disp[$i]!=0){
    $divb_cx[$i] = round($divBruta[$i]/$disp[$i], 2);
} else {
    array_push($divb_cx, INF);
}
        /*  Margem Ebítida  */
        /*  Margem Líquida  */
if ($recLiq12[$i]!=0){
    $marg_ebit[$i] = round(($ebit12[$i]/$recLiq12[$i])*100, 2);
    $marg_liq[$i] = round(($lucLiq12[$i]/$recLiq12[$i])*100, 2);
} else {
    $marg_ebit[$i] = INF;
    $marg_liq[$i] = INF;
}
        /*  Lynch               */
if ($pl[$i]!=0){
    $lynch[$i] = round((($divY[$i]+($cres_rec[$i]/5))/$pl[$i]), 2);
}else {
    $lynch[$i] = INF;
}
        /*  Período de Resistência  */
if ($recLiq12[$i]-($lucLiq12[$i]/12)!=0){
    $perRes[$i] = round($disp[$i]/($recLiq12[$i]-($lucLiq12[$i]/12)), 2);
} else {
    $perRes[$i] = INF;
}
        /*  Dívida Bruta/Lucro Líquido Mensal   */
if (($lucLiq12[$i]/12)!=0){
    $divbLuc[$i] = round(($divBruta[$i]/($lucLiq12[$i]/12)), 2);
} else {
    $divbLuc[$i] = INF;
}
// calculando o desvio padrão
$med[$i] = ($recLiq12[$i]/4+$recLiq3[$i])/2;
$sumDif1[$i] = ($recLiq12[$i]/4 - $med[$i])**2;
$sumDif2[$i] = ($recLiq3[$i] - $med[$i])**2;
$dp[$i] = ($sumDif1[$i] + $sumDif2[$i])**(1/2);
if($med[$i]!=0){
    $desv_pad_rec[$i] = round($dp[$i]/abs($med[$i]), 3);
} else {
    $desv_pad_rec[$i] = INF;
}//Desvio Padrão Relativos das Receitas trimestrais e anuais

}
 
for($i=0;$i<count($pl);$i++){// mostrando os valores dos criterios na tabela
    echo 
    '<tr>
        <td><a href="https://fundamentus.com.br/detalhes.php?papel='.$cod[$i].'" target="_blank">'.$cod[$i].'</a></td>
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
};

