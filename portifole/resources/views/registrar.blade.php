<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
    <title>Document</title>
</head>

<body>
    <form action="{{route('registrar_cadastrar')}}" method="post">
        @csrf
        @method('POST')
        <input type="text" name='nome' placeholder="nome" value="Jose Comprador">
        <input type="text" name='cpf' placeholder="cpf" value="72962940005">
        <input type="text" name='ddd' placeholder="ddd" value="11">
        <input type="text" name='telefone' placeholder="telefone" value="56273440">
        <input type="text" name='email' placeholder="email" value="comprador@uol.com.br">
        <input type="text" name='enderecoNome' placeholder="endereço nome" value="Av. Brig. Faria Lima">
        <input type="text" name='enderecoNumero' placeholder="endereco numero" value="1384">
        <input type="text" name='complemento' placeholder="complemento" value="5o andar">
        <input type="text" name='bairro' placeholder="bairro" value="Jardim Paulistano">
        <input type="text" name='cep' placeholder="cep" value="01452002">
        <input type="text" name='cidade' placeholder="cidade" value="Sao Paulo">
        <input type="text" name='estado' placeholder="estado" value="SP">
        <input type="text" name='pais' placeholder="pais" value="BRA">
        <input type="date" name='dataNascimento' placeholder="dataNascimento" value="">
        <input type="text" name='areaCode' placeholder="areaCode" value="11">
        <input type="submit" value="save">
    </form>
    <script src="{{asset('./js/app.js')}}"></script>
</body>

</html>