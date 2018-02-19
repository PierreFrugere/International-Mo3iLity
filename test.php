<?php

//La page qu'on veut utiliser
$wikipediaURL = 'https://fr.wikipedia.org/wiki/Universit%C3%A9_du_Qu%C3%A9bec_en_Outaouais';

//On initialise cURL
$ch = curl_init();
//On lui transmet la variable qui contient l'URL
curl_setopt($ch, CURLOPT_URL, $wikipediaURL);
//On lui demdande de nous retourner la page
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//On envoie un user-agent pour ne pas être considéré comme un bot malicieux
curl_setopt($ch, CURLOPT_USERAGENT, 'Google');
//On exécute notre requête et met le résultat dans une variable
$resultat = curl_exec($ch);
//On ferme la connexion cURL
curl_close($ch);

//On crée un nouveau document DOMDocument
$wikipediaPage = new DOMDocument();
//On y charge le contenu qu'on a récupéré avec cURL
$wikipediaPage->loadHTML($resultat);

//On parcourt les balises <div>
foreach($wikipediaPage->getElementsByTagName('div') as $div){
    //Si l'id de la page est bodyContent
    if($div->getAttribute('id') == "bodyContent"){

        //On met le contenu du premier <p> dans une variable
        $premierP = trim($div->getElementsByTagName('p')->item(0)->nodeValue);
        //Si le premier <p> est vide ou ne contient pas du texte
        while($premierP == '<br>' || $premierP == '<br />' || $premierP == ''){
            //On le supprime
            $div->removeChild($div->getElementsByTagName('p')->item(1));
            //Et on passe au <p> suivant
            $premierP = trim($div->getElementsByTagName('p')->item(1)->nodeValue);
        };

        //On met le contenu du premier <p> dans une variable
        $premierP = trim($div->getElementsByTagName('p')->item(2)->nodeValue);
        //Si le premier <p> est vide ou ne contient pas du texte
        while($premierP == '<br>' || $premierP == '<br />' || $premierP == ''){
            //On le supprime
            $div->removeChild($div->getElementsByTagName('p')->item(2));
            //Et on passe au <p> suivant
            $premierP = trim($div->getElementsByTagName('p')->item(2)->nodeValue);
        };


        //Un joli try pour éviter les messages d'erreur
        try{
            //On parcourt toutes les tables
            foreach( $div->getElementsByTagName('table') as $table ){
                //Et on les supprime
                $div->removeChild($table);
            }
        } catch(Exception $e){
            //On censure :P
        }

        //On récupère le contenu de la fameuse balise <p> dans une variable
        $description = '<p>' . $div->getElementsByTagName('p')->item(0)->nodeValue. '</p>';
        $description .= '<p>' . $div->getElementsByTagName('p')->item(2)->nodeValue. '</p>';
    }
}

//On enlève la syntaxe propre à Wikipedia
$description = preg_replace('/\[[0-9]*\][,]|\[[0-9]*\]/', '', $description);

//On affiche de résultat
echo $description;

?>