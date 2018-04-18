<?php
/**
 * Created by PhpStorm.
 * User: HP470
 * Date: 17/01/2018
 * Time: 15:44
 */

class ModelIndex
{

    /**
     * @param $username
     */
    public function addSlider($nomVille, $nomPhoto, $description) {
        $slide = array(
            'nom' => $nomVille,
            'photo' => $nomPhoto,
            'description' => $description
        );

        $dom = new DomDocument();

        $dom->load(__DIR__.'\..\..\medias\infoSlider.xml');
        $racine = $dom->documentElement;

        $destination = $dom->createElement("destination");

        $nom = $dom->createElement( "nom" );
        $nom->appendChild($dom->createTextNode( $slide['nom'] ));
        $destination->appendChild($nom);

        $photo = $dom->createElement( "photo" );
        $photo->appendChild($dom->createTextNode( $slide['photo'] ));
        $destination->appendChild($photo);

        $description = $dom->createElement( "description" );
        $description->appendChild($dom->createTextNode( $slide['description'] ));
        $destination->appendChild($description);

        $racine->appendChild($destination);
        // foreach ($racine->childNodes AS $item) {
        //   print $item->nodeName . " = " . $item->nodeValue . "<br>";
        // }
        $dom->save(__DIR__.'\..\..\medias\infoSlider.xml');
        //$europe = $dom->getElementsByTagName("europe")->item(0);
        //$europe->appendChild($nouveauPays);
    }
    /**
     * @param $username
     * @param $pwd
     * @return mixed
     */
    public function getDestination() {
      $slides = array();

      $dom = new DomDocument();

      $dom->load(__DIR__.'\..\..\medias\infoSlider.xml');
      $racine = $dom->getElementsByTagName('nom');
      foreach ($racine as $item) {
          $nom = $item->nodeValue;
          array_push($slides, $nom);
      }

      return $slides;
    }

    /**
     * @param $username
     * @param $pwd
     * @return mixed
     */
    public function deleteSlider($nom) {
      $dom = new DomDocument();

      $dom->load(__DIR__.'\..\..\medias\infoSlider.xml');

      $thedocument = $dom->documentElement;

      $racine = $dom->getElementsByTagName('destination');
      $nodeASupprimer = null;
      foreach ($racine as $item) {
          if($nom == $item->first_child) {
            $nodeASupprimer = $item;
          }
      }

      if ($nodeASupprimer != null)
      $thedocument->removeChild($nodeASupprimer);

      $dom->save(__DIR__.'\..\..\medias\infoSlider.xml');
    }
}
