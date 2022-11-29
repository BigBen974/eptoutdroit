<?php
// Déclaration des variables
$ident=$idp=$ids=$idd=$codes=$code1=$code2=$code3=$code4=$code5=$datas='';
$idp = 258157;
// $ids n'est plus utilisé, mais il faut conserver la variable pour une question de compatibilité
$idd = 443635;
$ident=$idp.";".$ids.";".$idd;
// On récupère le(s) code(s) sous la forme 'xxxxxxxx;xxxxxxxx'
if(isset($_POST['code1'])) $code1 = $_POST['code1'];
if(isset($_POST['code2'])) $code2 = ";".$_POST['code2'];
if(isset($_POST['code3'])) $code3 = ";".$_POST['code3'];
if(isset($_POST['code4'])) $code4 = ";".$_POST['code4'];
if(isset($_POST['code5'])) $code5 = ";".$_POST['code5'];
$codes=$code1.$code2.$code3.$code4.$code5;
// On récupère le champ DATAS
if(isset($_POST['DATAS'])) $datas = $_POST['DATAS'];
// On encode les trois chaines en URL
$ident=urlencode($ident);
$codes=urlencode($codes);
$datas=urlencode($datas);

/* Envoi de la requête vers le serveur StarPass
Dans la variable tab[0] on récupère la réponse du serveur
Dans la variable tab[1] on récupère l'URL d'accès ou d'erreur suivant la réponse du serveur */
$get_f=@file( "https://script.starpass.fr/check_php.php?ident=$ident&codes=$codes&DATAS=$datas" );
if(!$get_f)
{
exit( "Votre serveur n'a pas accès au serveur de StarPass, merci de contacter votre hébergeur. " );
}
$tab = explode("|",$get_f[0]);

if(!$tab[1]) $url = "https://script.starpass.fr/error.php";
else $url = $tab[1];

// dans $pays on a le pays de l'offre. exemple "fr"
$pays = $tab[2];
// dans $palier on a le palier de l'offre. exemple "Plus A"
$palier = urldecode($tab[3]);
// dans $id_palier on a l'identifiant de l'offre
$id_palier = urldecode($tab[4]);
// dans $type on a le type de l'offre. exemple "sms", "audiotel, "cb", etc.
$type = urldecode($tab[5]);
// vous pouvez à tout moment consulter la liste des paliers à l'adresse : https://script.starpass.fr/palier.php

// Si $tab[0] ne répond pas "OUI" l'accès est refusé
// On redirige sur l'URL d'erreur
if( substr($tab[0],0,3) != "OUI" )
{
       header( "Location: $url" );
       exit;
}
else
{
       /* Le serveur a répondu "OUI"

       On place un cookie appelé CODE_BON et qui vaut la valeur 1
       Ce cookie est valide jusqu'à ce que l'internaute ferme son navigateur
       Dans les pages suivantes, nous testerons l'existence du cookie
       S'il existe, c'est que l'internaute est autorisé,
       sinon on le renverra sur une page d'erreur */
       setCookie( "CODE_BON", "1", 0 );
       // Si vous avez plusieurs documents, nommer le cookie plutôt 'code'+iDocumentId

       // vous pouvez afficher les variables de cette façon :
       // echo "idd : $idd / codes : $codes / datas : $datas / pays : $pays / palier : $palier / id_palier : $id_palier / type : $type";
}
?>
Dans les pages suivantes de la zone payante de votre site, vous pouvez alors vérifier l'existence de ce cookie :

<?php
// On vérifie si le cookie existe
if(isset( $HTTP_COOKIE_VARS['CODE_BON'] ))
{
// Si le cookie existe mais que le contenu n'est pas bon on le redirige sur la page d'erreur
if( $HTTP_COOKIE_VARS['CODE_BON'] != '1'){

header( "Location: https://script.starpass.fr/error.php" );
exit(1);
}
}
else{

// Si le cookie n'existe pas on redirige l'internaute sur la page d'erreur
header( "Location: https://script.starpass.fr/error.php" );
exit(1);
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <noscript><meta http-equiv="refresh" content="0;url=https://script.starpass.fr/error_code2.php?idd=443635&idp=258157"></noscript><script type="text/javascript" src="https://script.starpass.fr/error_code.php?idd=443635&idp=258157"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1">
    
    <link rel="icon" href="favicon.ico">
    <title>TYBEN - Tout Droit (EP)</title>
  </head>
  <body style="margin:0;">

    <div class="app" > 
        <div class="texte" >TYBEN - Tout Droit</div> 
     
        <div class="bloc-btn" >
          <div class="titre" >01 - Pas jolie</div>
          <a class="btn" href="" >télécharger</a><br />
          <div class="titre" >02 - Fort</div>
          <a class="btn" href="">télécharger</a><br />
          <div class="titre" >03 - Tout Droit</div>
          <a class="btn" href="">télécharger</a><br />
          <div class="titre" >04 - Fraise</div>
          <a class="btn" href="">télécharger</a><br />

         
         
        </div>
            
  
    </div>

</html>

<style>
.app{
       display: inline-block;
      -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;
    
    
        text-align: center;
        background-color: #ffffff;
      
    color:#000!important;
    margin: auto;
    padding-top: 40px;
    width: 100%;
   
    }
    .img{
       width:50% ;
   margin-top: 20px;
    
    }

    .texte{
        font-weight: 900;
        font-size: 24px;
        padding-bottom: 40px;
    }

    
    .bloc-btn {

    
display:inline-block;

width: 100%;

} 

    
.titre {

    
display:inline-block;
font-weight: 900;
        font-size: 18px;
       

margin-top: 10px;
margin-right: 20px;
} 
  

.btn{
    font-weight: 600;
        font-size: 18px;
    
display: inline-block;
 text-align: center;
 background-color:#2490be!important;

 width: 100px;
 min-width: 100px;
 padding:4px;
 min-height: 26px;
 border-radius: 5px;
 border: none;
 color:#fff!important;
text-decoration:none;

margin-top: 10px;

}


    
    </style>
