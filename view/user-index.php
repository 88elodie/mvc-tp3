<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <main>
        <h1>User</h1>
        <ul>
            <li><a href='{{path}}/book/index'>Liste des livres</a></li>
            {% if session == 1 %}
            <li><a href='{{path}}/user/create'>Ajouter un utilisateur</a></li>
            <li><a href='{{path}}/user/list'>Utilisateurs</a></li>
            <li><a href='{{path}}/user/log'>Journal de bord</a></li>
            {% endif %}
            <li><a href="{{path}}/login/logout">se déconnecter</a></li>
        </ul>
    </main>
</body>
</html>
