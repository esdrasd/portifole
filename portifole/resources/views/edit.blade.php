<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
    <title>Editar Perfil</title>
</head>

<body>
    <form id='form' action="#" method="post">
        @csrf
        @method('POST')
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('index')}}">Home</a>
            </div>
        </nav>
        <hr>
        <div id="Edit"></div>
    </form>
    <script src="{{asset('./js/app.js')}}"></script>
</body>

</html>