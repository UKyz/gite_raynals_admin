<?php
/**
 * Created by PhpStorm.
 * User: victorfauquembergue
 * Date: 23/07/2018
 * Time: 09:41
 */

class Services
{

    public static function showServices() {
        $script_services = "";

        global $bdd;
        $req = $bdd->query('SELECT * FROM services ORDER BY price');
        $donnees = $req->fetch();

        if ($donnees == null) {
            $script_services .= "<p>Aucun services n'a été ajouté aux reservations.</p>";
        } else {
            $script_services .= "        <table class=\"w3-table w3-striped w3-bordered\">
                        <thead>
                        <tr class=\"w3-theme\">
                            <th>Type</th>
                            <th>Prix</th>
                            <th>Détail</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>";

            $req = $bdd->query('SELECT * FROM services ORDER BY price');
            $donnees = $req->fetch();

            if ($donnees != null) {
                $req = $bdd->query('SELECT * FROM services ORDER BY price');
                while ($donnees = $req->fetch()) {
                    $script_services .= "<tr class=\"w3-white\">";

                    if ($donnees['can_select'] == 'no') {
                        $script_services .= "<td>Obligatoire</td>";
                    } else {
                        $script_services .= "<td>Au choix</td>";
                    }
                    $script_services .= "<td>" . $donnees['price'] . "€</td>
                           <td>" . $donnees['details'] . "</td>
                           <td><form action=\"./index.php?action=delete_service\" method=\"post\">
                                    <input type=\"hidden\" name=\"id\" value=\"" . $donnees['id'] . "\">
                                    <input type=\"submit\" value=\"Supprimer\" class=\"w3-button w3-theme2\">
                            </form></td>
                        </tr>";
                }
            }

            $script_services .= "            </tbody>
                    </table>";
        }

        return $script_services;
    }

    public static function addService($tab) {

        global $bdd;
        $req = $bdd->prepare("INSERT INTO services(can_select, price, details)
            VALUES(:can_select, :price, :details)");
        $req->execute(array(
            'can_select' => (isset($tab['can_select']) && $tab['can_select'] == 'no') ? 'no' : 'yes',
            'price' => $tab['price'],
            'details' => $tab['details']));
    }

    public static function deleteService($id) {
        global $bdd;
        $req = $bdd->prepare('DELETE FROM services WHERE id = :id');
        $req->execute(array(
            'id' => $id));
    }


}