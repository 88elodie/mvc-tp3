<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="book-list">
    <h1>Librairie Peridot</h1>
    <p>contactez-nous pour faire une demande d'ajout</p>
    <a href="../home/pdf">download un pdf !</a>
    {% if session == 1 or session == 2 %}
<a href="list">modifier l'inventaire</a>
<a href="/user/index">Panneau de contrôle</a>
<a href="../login/logout">se déconnecter</a>
{% endif %}

{% if session == 0 %}
<a href="../login/index">se connecter</a>
{% endif %}
    
    {% for livre in livres %}
        <div class="carte">
        <div>
        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fdfb503wu29eo2.cloudfront.net%2Fslir%2Fh1200%2Fpng24-front%2Fbookcover0010363.jpg&f=1&nofb=1&ipt=7f2eec953e8f6353cd395eb34e1a276f5abbc1266e90fbf4e5a564fc01ee61d4&ipo=images">
        </div>
        <div>
        <h3>{{ livre.titre }}</h3>
        <h5>par : {{ livre.nom_auteur }}</h5>
        <p>{{ livre.description }}</p><br>
        <span><b>categorie : </b>{{ livre.nom_categorie }}</span>
        </div>
        <div>
        <span>prix : {{ livre.prix }} $</span><br>
        <span>pages : {{ livre.nombre_pages }}</span><br>
        <span>editeur : {{ livre.nom_editeur }}</span>
        </div>
        </div>
    {% endfor %}

</div>
</body>
</html>