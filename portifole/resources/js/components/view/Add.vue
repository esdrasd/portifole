<template>
  <div class="add_base">
    <div class="add_center">
      <div class="add_item card">
        <h5>Add SEUS PRODUTOS</h5>
        <div class="card btn btn-outline-dark">
          Nome do produto:
          <select name="nome" id="nome">
            <option value="avatar">avatar</option>
            <option value="check">check</option>
            <option value="Xiaomi">Xiaomi</option>
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
