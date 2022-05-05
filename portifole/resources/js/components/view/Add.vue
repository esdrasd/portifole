<template>
<div class="add_base">
    <div class="add_center">
        <div class="add_item card">
            <h5>Add SEUS PRODUTOS</h5>
            <br>
            <div class="card">
                <input class="border border-dark" type="text" name="desc" placeholder="nome do produto" />
            </div>
            <br>
            <div class="card btn btn-outline-dark">
                Categoria:
                <select name="nome" id="nome">
                    <option>Escolha a Categoria</option>
                    <option value="celular">celular</option>
                    <option value="game">game</option>
                </select>
            </div>
            <br />
            <div class="card">
                <input class="border border-dark" type="text" name="price" placeholder="Price" />
            </div>
            <br />
            <div class="card">
                <input class="btn btn-outline-dark" type="file" id="file" name="img[]" multiple />
            </div>
            <br />
            <div class="card">
                <input class="btn btn-outline-dark" type="submit" @click="add()" value="enviar" />
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "Add",
    methods: {
        add() {
            document.getElementById("form").action = "add";
        },
    },
};
</script>
