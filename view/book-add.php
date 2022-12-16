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
<h1>Ajouter un livre</h1>
<form action="insert" method="post">
            <label>Titre :<br>
                <input type="text" name="titre"><br>
            </label>
            <label>Description :<br>
                <textarea name="description" cols="30" rows="10"></textarea><br>
            </label>
            <label>Nombre de pages :<br>
                <input type="text" name="nombre_pages"><br>
            </label>
            <label>Prix :<br>
                <input type="number" step="0.01" name="prix"><br>
            </label>
            <label>Auteur(e) :</label>
                <select name="auteur_id">
                    {% for auteur in auteurs %}
                        <option value="{{ auteur.id }}">{{ auteur.nom_auteur }}</option>
                    {% endfor %}
                </select><br>
            <label>Éditeur :</label>
                <select name="editeur_id">
                    {% for editeur in editeurs%}
                        <option value="{{ editeur.id }}">{{ editeur.nom_editeur }}</option>
                    {% endfor %}
                </select><br>
            <label>Catégorie :</label>
                <select name="categorie_id">
                    {% for categorie in categories %}
                        <option value="{{ categorie.id }}">{{ categorie.nom_categorie }}</option>
                    {% endfor %}
                </select><br>
            <input type="submit" value="Ajouter">
    </form>
</div>
</body>
</html>