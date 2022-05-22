<template>
<div class="editBase">
    <h1>Editar</h1>
<div class="regiscenter">
<div class="editCol1 card">
    Email:
    <input class="border border-dark" type="text" name="email" placeholder="email" />
    <br />
    Senha Antiga:
    <input class="border border-dark" type="text" name="antigaSenha" placeholder="antiga senha" />
    <br />
    Senha Nova:
    <input class="border border-dark" type="text" name="noveSenha" placeholder="nova senha" />
    <br />
    Nome completo:
    <input class="border border-dark" type="text" name="nome" placeholder="nome" />
    <br />
    CPF:
    <input class="border border-dark" type="text" name="cpf" placeholder="cpf" />
    <br />
    DDD:
    <input class="border border-dark" type="text" name="ddd" placeholder="ddd" />
    <br />
    TELEFONE:
    <input class="border border-dark" type="text" name="telefone" placeholder="telefone" />
    <br />
    ENDEREÇO:
    <input class="border border-dark" type="text" name="enderecoNome" placeholder="enderecoNome" />
    <br />
    NUMERO:
    <input class="border border-dark" type="text" name="enderecoNumero" placeholder="enderecoNumero" />
</div>
<div class="editCol2 card">
    Complemento:
    <input class="border border-dark" type="text" name="complemento" placeholder="complemento" />
    <br />
    Bairro:
    <input class="border border-dark" type="text" name="bairro" placeholder="bairro" />
    <br />
    CEP:
    <input class="border border-dark" type="text" name="cep" placeholder="cep" />
    <br />
    CIDADE:
    <input class="border border-dark" type="text" name="cidade" placeholder="cidade" />
    <br />
    ESTADO
    <input class="border border-dark" type="text" name="estado" placeholder="estado" />
    <br />
    PAIS:
    <input class="border border-dark" type="text" name="pais" placeholder="pais" />
    <br />
    DATA NASCIMENTO
    <input class="border border-dark" type="date" name="dataNascimento" placeholder="dataNascimento" />
</div>
</div>
<div class="editColbutton card">
    <input class="btn btn-outline-dark" type="submit" value="save" @click="save()" />
</div>
</div>
</template>

<script>
import axios from "axios";
export default {
    name: "Edit",
    data() {
        return {
            dados: "",
        };
    },
    mounted() {
        axios.get("edit_perfil").then((Response) => (this.dados = Response.data));
    },
    methods: {
        save() {
            document.getElementById("form").action = "edit_save";
        },
    },
};
</script>
