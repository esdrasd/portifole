<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
    <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <title>Document</title>
</head>

<body>
    <form id='form' action="" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div id="app"></div>
        <script src="{{asset('./js/app.js')}}"></script>
    </form>
</body>

</html>