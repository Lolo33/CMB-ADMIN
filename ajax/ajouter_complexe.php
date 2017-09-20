<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 14/09/2017
 * Time: 04:29
 */

include "../includes/init.php";
$db = getConnexion();


if (!empty($_POST)){
    $nom = htmlspecialchars(trim($_POST["nom"]));
    $adresseL1 = htmlspecialchars(trim($_POST["adresseL1"]));
    $adresseL2 = htmlspecialchars(trim($_POST["adresseL2"]));
    $cp = htmlspecialchars(trim($_POST["cp"]));
    $ville = htmlspecialchars(trim($_POST["ville"]));
    $mail = htmlspecialchars(trim($_POST["mail"]));
    $tel = htmlspecialchars(trim($_POST["tel"]));
    $is_client = htmlspecialchars(trim($_POST["is_client"]));
    $systeme = htmlspecialchars(trim($_POST["systeme"]));
    $url = htmlspecialchars(trim($_POST["url"]));

    if (!empty($nom) && !empty($adresseL1) && !empty($cp) && !empty($ville) && !empty($mail) && !empty($tel)){
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)){

            $req_id_complexe = $db->query("SELECT MAX(id) FROM complexe");
            $req_id_complexe->execute();
            $id_last_complexe  = $req_id_complexe->fetchColumn() + 1;
            $req_id_coord = $db->query("SELECT MAX(id) FROM coordonnee");
            $req_id_coord->execute();
            $id_last_coord  = $req_id_coord->fetchColumn() + 1;

            if ($is_client == "true" || $is_client === true){
                $is_client = 1;
            }else{
                $is_client = 0;
            }

            if ($systeme == "null" || $systeme == null)
                $systeme = null;

            $req_ajout_coord = $db->prepare("INSERT INTO coordonnee (id, adresse_ligne1, adresse_ligne2, ville, code_postal, mail, telephone) 
            VALUES (:id, :adresseL1, :adresseL2, :ville, :cp, :mail, :tel)");
            $req_ajout_coord->bindValue(":id", $id_last_coord, PDO::PARAM_INT);
            $req_ajout_coord->bindValue(":adresseL1", $adresseL1, PDO::PARAM_STR);
            $req_ajout_coord->bindValue(":adresseL2", $adresseL2, PDO::PARAM_STR);
            $req_ajout_coord->bindValue(":ville", $ville, PDO::PARAM_STR);
            $req_ajout_coord->bindValue(":cp", $cp, PDO::PARAM_STR);
            $req_ajout_coord->bindValue(":mail", $mail, PDO::PARAM_STR);
            $req_ajout_coord->bindValue(":tel", $tel, PDO::PARAM_STR);

            if ($req_ajout_coord->execute()){
                $req_ajout_complexe = $db->prepare("INSERT INTO complexe (id, coordonnees_id, lieu_nom, is_client_cmb, systeme_resa_id, site) VALUES (:id, :coord, :nom, :is_client, :systeme, :url)");
                $req_ajout_complexe->bindValue(":id", $id_last_complexe, PDO::PARAM_INT);
                $req_ajout_complexe->bindValue(":coord", $id_last_coord, PDO::PARAM_INT);
                $req_ajout_complexe->bindValue(":nom", $nom, PDO::PARAM_STR);
                $req_ajout_complexe->bindValue(":is_client", $is_client, PDO::PARAM_BOOL);
                $req_ajout_complexe->bindValue(":systeme", $systeme, PDO::PARAM_INT);
                $req_ajout_complexe->bindValue(":url", $url, PDO::PARAM_STR);
                if ($req_ajout_complexe->execute())
                    echo "ok-" . $id_last_complexe;
                else
                    echo "Une erreur innatendue s'est produite";
            }else
                echo "Une erreur innatendue s'est produite";

        }else{
            echo "L'adresse mail saisie n'est pas valide";
        }
    }else{
        echo "Vous devez remplir les champs obligatoires marqués d'un *";
    }
}