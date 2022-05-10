<template>
<div class="regisBase">
    <h1>Registrar</h1>
    <div class="regiscenter">
        <div class="regisCol1 card">
            <input class="border border-dark" type="text" name='nome' placeholder="nome" value="Jose Comprador">
            <br>
            <input class="border border-dark" type="text" name='senha' placeholder="senha" value="12345-senha">
            <br>
            <input class="border border-dark" type="text" name='cpf' placeholder="cpf" value="72962940005">
            <br>
            <input class="border border-dark" type="text" name='ddd' placeholder="ddd" value="11">
            <br>
            <input class="border border-dark" type="text" name='telefone' placeholder="telefone" value="56273440">
            <br>
            <input class="border border-dark" type="text" name='email' placeholder="email" value="esd@esd">
            <br>
            <input class="border border-dark" type="text" name='enderecoNome' placeholder="endereço nome" value="Av. Brig. Faria Lima">
            <br>
            <input class="border border-dark" type="text" name='enderecoNumero' placeholder="endereco numero" value="1384">
        </div>
        <div class="regisCol2 card">
            <input class="border border-dark" type="text" name='complemento' placeholder="complemento" value="5o andar">
            <br>
            <input class="border border-dark" type="text" name='bairro' placeholder="bairro" value="Jardim Paulistano">
            <br>
            <input class="border border-dark" type="text" name='cep' placeholder="cep" value="01452002">
            <br>
            <input class="border border-dark" type="text" name='cidade' placeholder="cidade" value="Sao Paulo">
            <br>
            <input class="border border-dark" type="text" name='estado' placeholder="estado" value="SP">
            <br>
            <input class="border border-dark" type="text" name='pais' placeholder="pais" value="BRA">
            <br>
            <input class="border border-dark" type="date" name='dataNascimento' placeholder="dataNascimento" value="">
            <br>
            <input class="border border-dark" type="text" name='areaCode' placeholder="areaCode" value="11">
        </div>
    </div>
    <div class="card">
        <input class="btn btn-outline-dark" type="submit" value="save" @click='save()'>
    </div>
</div>
</template>

<script>
export default {
    name: "Registrar",
    methods: {
        save() {
            document.getElementById("form").action = "registrar_cadastrar";
        },
    },
};
</script>
