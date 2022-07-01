<template>
<div class="regisBase">
    <h1>Registrar</h1>
    <div class="regiscenter">
        <div class="regisCol1 card">
            <label for="email">
                Email:
                <br>
                <input id='email' class="border border-dark" type="text" name='email' placeholder="email" value="comprador@uol.com.br">
            </label>
            <br>
            <label for="senha">
                Senha:
                <br>
                <input id='senha' class="border border-dark" type="text" name='senha' placeholder="senha" value="">
            </label>
            <br>
            <label for="nome">
                Nome:
                <br>
                <input id='nome' class="border border-dark" type="text" name='nome' placeholder="nome" value="Jose Comprador">
            </label>
            <br>
            <label for="cpf">
                CPF:
                <br>
                <input id='cpf' class="border border-dark" type="text" name='cpf' placeholder="cpf" value="729629400056">
            </label>
            <br>
            <label for="DDD">
                DDD:
                <br>
                <input id='DDD' class="border border-dark" type="text" name='ddd' placeholder="ddd" value="11">
            </label>
            <br>
            <label for="telefone">
                Telefone:
                <br>
                <input id='telefone' class="border border-dark" type="text" name='telefone' placeholder="telefone" value="56273440">
            </label>
            <br>
            <label for="endEndereco">
                Endereço:
                <br>
                <input id='endEndereco' class="border border-dark" type="text" name='enderecoNome' placeholder="endereço nome" value="Av. Brig. Faria Lima">
            </label>
            <br>
            <label for="endNumero">
                Endereço Numero:
                <br>
                <input id='endNumero' class="border border-dark" type="text" name='enderecoNumero' placeholder="endereco numero" value="1384">
            </label>
        </div>
        <div class="regisCol2 card">
            <label for="complemento">
                Complemento:
                <br>
                <input id='complemento' class="border border-dark" type="text" name='complemento' placeholder="complemento" value="5o andar">
            </label>
            <br>
            <label for="bairro">
                Bairro:
                <br>
                <input id='bairro' class="border border-dark" type="text" name='bairro' placeholder="bairro" value="Jardim Paulistano">
            </label>
            <br>
            <label for="cep">
                CEP:
                <br>
                <input id='cep' class="border border-dark" type="text" name='cep' placeholder="cep" value="01452002">
            </label>
            <br>
            <label for="cidade">
                Cidade:
                <br>
                <input id='cidade' class="border border-dark" type="text" name='cidade' placeholder="cidade" value="Sao Paulo">
            </label>
            <br>
            <label for="estado">
                Estado:
                <br>
                <input id='estado' class="border border-dark" type="text" name='estado' placeholder="estado" value="SP">
            </label>
            <br>
            <label for="país">
                País:
                <br>
                <input id='país' class="border border-dark" type="text" name='pais' placeholder="pais" value="BRA">
            </label>
            <br>
            <label for="dataNascimento">
                Data Nascimento:
                <br>
                <input class="border border-dark" type="date" name='dataNascimento' placeholder="dataNascimento" value="">
            </label>
            <br>
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
