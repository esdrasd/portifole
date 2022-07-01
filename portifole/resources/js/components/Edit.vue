<template>
<div class="editBase">
    <h1>Editar</h1>
    <div class="regiscenter">
        <div class="editCol1 card">
            Email:
            <input class="border border-dark" type="text" name="email" :placeholder="dados.email" />
            <br />
            Senha Antiga:
            <input class="border border-dark" type="text" name="antigaSenha" placeholder="antiga senha" />
            <br />
            Senha Nova:
            <input class="border border-dark" type="text" name="novaSenha" placeholder="nova senha" />
            <br />
            Nome completo:
            <input class="border border-dark" type="text" name="nome" :placeholder="dados.nome" />
            <br />
            CPF:
            <input class="border border-dark" type="text" name="cpf" :placeholder="dados.cpf" />
            <br />
            DDD:
            <input class="border border-dark" type="text" name="ddd" :placeholder="dados.ddd" />
            <br />
            TELEFONE:
            <input class="border border-dark" type="text" name="telefone" :placeholder="dados.telefone" />
            <br />
            ENDEREÇO:
            <input class="border border-dark" type="text" name="enderecoNome" :placeholder="dados.enderecoNome" />
            <br />
            NUMERO:
            <input class="border border-dark" type="text" name="enderecoNumero" :placeholder="dados.enderecoNumero" />
        </div>
        <div class="editCol2 card">
            Complemento:
            <input class="border border-dark" type="text" name="complemento" :placeholder="dados.complemento" />
            <br />
            Bairro:
            <input class="border border-dark" type="text" name="bairro" :placeholder="dados.bairro" />
            <br />
            CEP:
            <input class="border border-dark" type="text" name="cep" :placeholder="dados.cep" />
            <br />
            CIDADE:
            <input class="border border-dark" type="text" name="cidade" :placeholder="dados.cidade" />
            <br />
            ESTADO
            <input class="border border-dark" type="text" name="estado" :placeholder="dados.estado" />
            <br />
            PAIS:
            <input class="border border-dark" type="text" name="pais" :placeholder="dados.pais" />
            <br />
            DATA NASCIMENTO
            <input class="border border-dark" type="date" name="dataNascimento" :placeholder="dados.dataNascimento" />
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
