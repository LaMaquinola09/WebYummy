<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Header y Footer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Este es el Header</h1>
        </header>

        <main>
            <p>Contenido de la página aquí.</p>
            <p>Agrega más contenido si es necesario.</p>
            <!-- Agrega más contenido aquí -->
        </main>

        <footer>
            <p>Este es el Footer</p>
        </footer>
    </div>
</body>
</html>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    height: 100%; /* Asegura que el body ocupe toda la altura de la ventana */
}

body {
    display: flex;
    flex-direction: column;
}

.container {
    flex: 1; /* Permite que el contenedor ocupe el espacio disponible */
    display: flex;
    flex-direction: column;
}

header {
    background-color: #4CAF50;
    color: white;
    text-align: center;
    padding: 1em 0; /* Espaciado vertical */
}

main {
    flex: 1; /* Permite que el main ocupe el espacio restante */
    padding: 20px; /* Espaciado interno */
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px 0; /* Espaciado vertical */
}

</style>