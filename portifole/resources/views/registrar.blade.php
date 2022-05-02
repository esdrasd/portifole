<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
    <title>Registrar</title>
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
        <div id="app2"></div>
        <!-- <input class="border border-dark" type="text" name='nome' placeholder="nome" value="Jose Comprador">
        <input class="border border-dark" type="text" name='senha' placeholder="senha" value="12345-senha">
        <input class="border border-dark" type="text" name='cpf' placeholder="cpf" value="72962940005">
        <input class="border border-dark" type="text" name='ddd' placeholder="ddd" value="11">
        <input class="border border-dark" type="text" name='telefone' placeholder="telefone" value="56273440">
        <input class="border border-dark" type="text" name='email' placeholder="email" value="esd@esd">
        <input class="border border-dark" type="text" name='enderecoNome' placeholder="endereço nome" value="Av. Brig. Faria Lima">
        <input class="border border-dark" type="text" name='enderecoNumero' placeholder="endereco numero" value="1384">
        <input class="border border-dark" type="text" name='complemento' placeholder="complemento" value="5o andar">
        <input class="border border-dark" type="text" name='bairro' placeholder="bairro" value="Jardim Paulistano">
        <input class="border border-dark" type="text" name='cep' placeholder="cep" value="01452002">
        <input class="border border-dark" type="text" name='cidade' placeholder="cidade" value="Sao Paulo">
        <input class="border border-dark" type="text" name='estado' placeholder="estado" value="SP">
        <input class="border border-dark" type="text" name='pais' placeholder="pais" value="BRA">
        <input class="border border-dark" type="date" name='dataNascimento' placeholder="dataNascimento" value="">
        <input class="border border-dark" type="text" name='areaCode' placeholder="areaCode" value="11">
        <input class="btn btn-outline-dark" type="submit" value="save"> -->
    </form>
    <script src="{{asset('./js/app.js')}}"></script>
</body>

</html>