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
        <h1>log des connexions</h1>
        <ul>
            {{ session.user }}
            {% for user in session %}
                <li>username : {{ user.username }}, adresse ip : {{ user.ip_address }}, temps de visite : {{ user.login_time }} à {{ user.logout_time }}</li>
            {% endfor %}
        </ul>
        <a href="index">retour</a>
    </main>
</body>
</html>