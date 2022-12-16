<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="book-form">
    <h1>modifier les détails du livre</h1>
    <form action="update" method="post">
    <input type="hidden" name="livre_id" value="{{ livres[0].livre_id }}">
            <label>Titre : <br>
                <input type="text" name="titre" value="{{ livres[0].titre}}"><br>
            </label>
            <label>Description :<br>
                <textarea name="description" cols="30" rows="10">{{ livres[0].description}}</textarea><br>
            </label>
            <label>Nombre de pages : <br>
                <input type="text" name="nombre_pages" value="{{ livres[0].nombre_pages}}"><br>
            </label>
            <label>Prix :<br>
                <input type="number" step="0.01" name="prix" value="{{ livres[0].prix}}"><br>
            </label>
            <label>Auteur(e) :</label>
                <select name="auteur_id">
                    {% for auteur in auteurs %}
                        <option value="{{ auteur.auteur_id }}"
                        {% if livres[0].auteur_id == auteur.auteur_id %}
                            selected
                        {% endif %}
                        >{{ auteur.nom_auteur }}</option>
                    {% endfor %}
                </select><br>
            <label>Éditeur :</label>
                <select name="editeur_id">
                    {% for editeur in editeurs%}
                        <option value="{{ editeur.editeur_id }}"
                        {% if livres[0].editeur_id == editeur.editeur_id %}
                            selected
                        {% endif %}>{{ editeur.nom_editeur }}</option>
                    {% endfor %}
                </select><br>
            <label>Catégorie :</label>
                <select name="categorie_id">
                    {% for categorie in categories %}
                        <option value="{{ categorie.categorie_id }}"
                        {% if livres[0].categorie_id == categorie.categorie_id %}
                            selected
                        {% endif %}>{{ categorie.nom_categorie }}</option>
                    {% endfor %}
                </select><br>
            <input type="submit" value="Modifier">
    </form>
    </div>
</body>
</html>