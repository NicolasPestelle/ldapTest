<meta charset="UTF-8">
<?php
 
 /***
  * 
  * https://www.theurbanpenguin.com/managing-openldap-users-with-php/
  * 
  * user : add, rm, modifier
  * group : add, remove,modifier
  * connexion : admin -> all
  * user -> seulement modifier
  * 
  * */
 
// Eléments d'authentification LDAP
$ldaprdn  = 'cn=admin,dc=bla,dc=com';     // DN ou RDN LDAP
$ldappass = 'bla';  // Mot de passe associé
 
// Connexion au serveur LDAP
$ldapconn = ldap_connect("localhost")
    or die("Impossible de se connecter au serveur LDAP.");
 
ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {
 
     echo 'Liaison ...'; 
    $r=ldap_bind($ldapconn,"cn=admin,dc=bla,dc=com","bla");     // connexion anonyme, typique
                                     // pour un accès en lecture seule.
    echo 'Le résultat de connexion est ' . $r . '<br />';
    
    
    
	$info["cn"] = "John Jones";
    $info["sn"] = "Jones";
    $info["objectclass"] = "person";
	$ldapconn = getLdapConnect();
    // Ajoute les données au dossier
    $r = ldap_add($ldapconn, $ldaprdn, $info);
    

  /*  echo 'Recherchons (sn=R*) ...';
    // Recherche par nom de famille
    $sr=ldap_search($ldapconn, "dc=bla, dc=com", "sn=R*"); 
    echo 'Le résultat de la recherche est ' . $sr . '<br />';

    echo 'Le nombre d\'entrées retournées est ' . ldap_count_entries($ldapconn,$sr) 
         . '<br />';

    echo 'Lecture des entrées ...<br />';
    $info = ldap_get_entries($ldapconn, $sr);
    echo 'Données pour ' . $info["count"] . ' entrées:<br />';

    for ($i=0; $i<$info["count"]; $i++) {
        echo 'dn est : ' . $info[$i]["dn"] . '<br />';
        echo 'premiere entree cn : ' . $info[$i]["cn"][0] . '<br />';
        echo 'name : ' . $info[$i]["givenname"][0] . '<br />';
    }*/

    //echo 'Fermeture de la connexion';
    ldap_close($ldapconn);
    } else {
        echo "Connexion LDAP échouée...";
}

/*function connect($ldapconn,$ldaprdn,$ldappass){
	echo 'Liaison ...'; 
    $r=ldap_bind($ldapconn,$ldaprdn,$ldappass);     // connexion anonyme, typique
                                     // pour un accès en lecture seule.
    echo 'Le résultat de connexion est ' . $r . '<br />';
}

function disconnect($ldapconn){
	echo 'Fermeture de la connexion';
    ldap_close($ldapconn);
}
*/
function getLdapConnect(){
	return ldap_connect("localhost");
}

 //connect($ldapconn);
 //disconnect($ldapconn);
 
?>

