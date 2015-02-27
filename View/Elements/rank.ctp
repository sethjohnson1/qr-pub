<?
/*
begin zany ranking as proof of concept

DMNH  "Naturalist" 
PIM "Culturally sensitive"
HMRL "Scholarly"
CFM "Gun-Toting"
WG "Well-Cultured"



*/

$prefix='';
$rank='Nothing';
$suffix='';

debug($score/$total);
if ($score >= 2 ) $rank='Dabbler';
if ($score >= 4 ) $rank='Dabbler II';


if ($score/$total >=.33 ) $rank='Explorer';
if ($score/$total >=.66 ) $rank='Scout';
if ($score/$total >= .85 ) $rank='Master Scout';
if ($score/$total >=.99) $rank='Reverend';



debug($totals);
debug($total*.7);
debug($score);


if ($score >= $total*.33)

?>
<h1>Your Rank (eventually this is a button): <?=$prefix.' '.$rank.' '.$suffix?></h1>