<?php
$dureDInscription = 2; // lowercamelcase
$VilleLaPlusProche = "perpignan"; // upperCamelcase
$est_ce_une_ville = false; // snakecase
$nom = 'toto';
$prenom = 'titi';
echo $nom . " " . $prenom;
echo "<P>AFFICHE $nom</P>";
echo '<p>AFFICHE ' . $prenom . '</p>';
//    $output = `ls -la`;
//    echo $output;

/*javascript*/

//    let unTableau = ['pierre','roger','adolf']
//unTableau[1]
//   let mesNotes = [
//           [12,18,09],
//    [6,12,14]
//]
//
//mesNotes[1][1]
//
//let monCarnet = { français : [12,14,15], math: [6,8,12]}
//monCarnet.francais[1]

$unTab = ["pierre","bruno","jose"];
$unTab[] = "franck";

array_push($unTab, "rene","seb", "edith");

//echo print_r($unTab, true) . '<br/>';

//var_dump($unTab);
echo $unTab['3'];
echo '<br/>';
echo '<ul>';
$html = "";
//for($i = 0; $i <= count($unTab) -1; $i++){
//    echo '<li>' . $unTab[$i] . '</li>';
//}
foreach ($unTab as $k => $vt){
//    echo '<li>index: ' . $k .' valeur: ' . $vt . '</li>';
    $html .= "<li>$vt</li>";
}
//var_dump($html);

echo '</ul>';
?>
<p>Un nouveau paragraphe pour lister mon tableau :
<ol>
    <?php echo $html;  ?>
</ol>
</p>
