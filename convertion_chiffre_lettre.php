<?php 
/*------------------------*/
function int2str($a)
{
    $convert = explode('.',$a);
    if (isset($convert[1]) && $convert[1]!=''){
    return int2str($convert[0]).'FCFA'.' et '.int2str($convert[1]).'Centimes' ;
    }
    if ($a<0) return 'moins '.int2str(-$a);
    if ($a<17){
    switch ($a){
    case 0: return 'zero';
    case 1: return 'un';
    case 2: return 'deux';
    case 3: return 'trois';
    case 4: return 'quatre';
    case 5: return 'cinq';
    case 6: return 'six';
    case 7: return 'sept';
    case 8: return 'huit';
    case 9: return 'neuf';
    case 10: return 'dix';
    case 11: return 'onze';
    case 12: return 'douze';
    case 13: return 'treize';
    case 14: return 'quatorze';
    case 15: return 'quinze';
    case 16: return 'seize';
    }
    } else if ($a<20){
    return 'dix-'.int2str($a-10);
    } else if ($a<100){
    if ($a%10==0){
    switch ($a){
    case 20: return 'vingt';
    case 30: return 'trente';
    case 40: return 'quarante';
    case 50: return 'cinquante';
    case 60: return 'soixante';
    case 70: return 'soixante-dix';
    case 80: return 'quatre-vingt';
    case 90: return 'quatre-vingt-dix';
    }
    } elseif (substr($a, -1)==1){
    if( ((int)($a/10)*10)<70 ){
    return int2str((int)($a/10)*10).'-et-un';
    } elseif ($a==71) {
    return 'soixante-et-onze';
    } elseif ($a==81) {
    return 'quatre-vingt-un';
    } elseif ($a==91) {
    return 'quatre-vingt-onze';
    }
    } elseif ($a<70){
    return int2str($a-$a%10).'-'.int2str($a%10);
    } elseif ($a<80){
    return int2str(60).'-'.int2str($a%20);
    } else{
    return int2str(80).'-'.int2str($a%20);
    }
    } else if ($a==100){
    return 'cent';
    } else if ($a<200){
    return int2str(100).' '.int2str($a%100);
    } else if ($a<1000){
    //return int2str((int)($a/100)).' '.int2str(100).' '.int2str($a%100);
        if(int2str($a%100)=='zero'){
                   return int2str((int)($a/100)).' '.int2str(100); 
            }else{
                    return int2str((int)($a/100)).' '.int2str(100).' '.int2str($a%100);
            }
    } else if ($a==1000){
    return 'mille';
    } else if ($a<2000){
    return int2str(1000).' '.int2str($a%1000).' ';
    } else if ($a<1000000){
        if(int2str($a%1000)=='zero'){
            return int2str((int)($a/1000)).' '.int2str(1000); 
        }else{
                return int2str((int)($a/1000)).' '.int2str(1000).' '.int2str($a%1000);
            }
    ;
    }
    else if ($a==1000000){
    return 'millions';
    }
    // else if ($a<2000000){
    // return int2str(1000000).' '.int2str($a%1000000).' ';
    // }
    // else if ($a<1000000000){
    // return int2str((int)($a/1000000)).' '.int2str(1000000).' '.int2str($a%1000000);
    // }
    else if ($a < 2000000) {
	return 'un million ' . int2str($a % 1000000) . ' ';
    }  
    else if ($a < 1000000000) {
    	return int2str((int)($a / 1000000)) . ' millions ' . int2str($a % 1000000);
    }
}
/*------------------------*/

?>