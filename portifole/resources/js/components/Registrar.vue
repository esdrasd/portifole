<template>
<div class="regisBase">
    <h1>Registrar</h1>
    <div class="regiscenter">
        <div class="regisCol1 card">
            <input class="border border-dark" type="text" name='nome' placeholder="nome" value="">
            <br>
            <input class="border border-dark" type="text" name='senha' placeholder="senha" value="">
            <br>
            <input class="border border-dark" type="text" name='cpf' placeholder="cpf" value="">
            <br>
            <input class="border border-dark" type="text" name='ddd' placeholder="ddd" value="">
            <br>
            <input class="border border-dark" type="text" name='telefone' placeholder="telefone" value="">
            <br>
            <input class="border border-dark" type="text" name='email' placeholder="email" value="">
            <br>
            <input class="border border-dark" type="text" name='enderecoNome' placeholder="endereço nome" value="">
            <br>
            <input class="border border-dark" type="text" name='enderecoNumero' placeholder="endereco numero" value="">
        </div>
        <div class="regisCol2 card">
            <input class="border border-dark" type="text" name='complemento' placeholder="complemento" value="">
            <br>
            <input class="border border-dark" type="text" name='bairro' placeholder="bairro" value="">
            <br>
            <input class="border border-dark" type="text" name='cep' placeholder="cep" value="">
            <br>
            <input class="border border-dark" type="text" name='cidade' placeholder="cidade" value="">
            <br>
            <input class="border border-dark" type="text" name='estado' placeholder="estado" value="">
            <br>
            <input class="border border-dark" type="text" name='pais' placeholder="pais" value="">
            <br>
            <input class="border border-dark" type="date" name='dataNascimento' placeholder="dataNascimento" value="">
            <br>
            <input class="border border-dark" type="text" name='areaCode' placeholder="areaCode" value="">
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
