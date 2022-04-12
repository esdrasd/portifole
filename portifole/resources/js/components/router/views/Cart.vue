<template>
  <div class="menu">
    <!-- PRODUTOS -->
    <div class="item">
      <div v-for="(i, id_vetor) in vetor" :key="i">
        <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0">
            <div class="col-md-4">
              <div v-for="img in JSON.parse(i.img)" :key="img">
                <img :src="'storage/' + img" alt="" width="200" height="200" />
              </div>
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ i.nome }}</h5>
                <p class="card-text">DESCRIÇAO</p>
                <p class="card-text">
                  <small class="text-muted">{{ i.price }}</small>
                </p>
              </div>
            </div>
          </div>
          <input
            type="button"
            class="btn btn-outline-dark"
            value="remover"
            @click="del(id_vetor)"
          />
        </div>
      </div>
    </div>
    <div class="pagamento">
      <div class="card" style="width: 80%; height: 80%">
        <div class="card-body">
          <h5 class="card-title">Pagameto</h5>
          <p class="card-text">R$ {{ price }}</p>

          <label for="boleto">boleto</label>
          <input
            name="pagar"
            type="radio"
            id="boleto"
            value="boleto"
            v-model="modo"
          />
          <br />
          <label for="credito">cartao de credito</label>
          <input
            name="pagar"
            type="radio"
            id="credito"
            value="credito"
            v-model="modo"
          />
        </div>
        <input
          type="submit"
          class="btn btn-outline-dark"
          @click="pagar()"
          value="Pagamento"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Cart",
  data() {
    return {
      vetor: "",
      price: 0,
      modo: "",
      json: "",
    };
  },
  mounted() {
    console.clear();
    const session = sessionStorage.getItem("cart");
    this.vetor = JSON.parse(session);
    this.json = session;
    for (let index = 0; index < this.vetor.length; index++) {
      this.price += this.vetor[index].price;
    }
  },
  methods: {
    pagar() {
      if (this.modo == "boleto") {
        console.log("boleto");
        const session = sessionStorage.getItem("cart");
        document.getElementById("form").action = "pagamento";
        this.json = sessionStorage.getItem("cart");
        document.getElementById("boleto").value = this.json;
      } else {
        console.log("credito");
        const session = sessionStorage.getItem("cart");
        document.getElementById("form").action = "pagamento";
        this.json = sessionStorage.getItem("cart");
        document.getElementById("credito").value = this.json;
      }
    },
    del(id) {
      this.price -= this.vetor[id].price;
      const session = sessionStorage;
      const vetor = this.vetor;
      vetor.splice(id, 1);
      session.setItem("cart", JSON.stringify(vetor));
    },
  },
};
</script>

<style>
.menu {
  position: relative;
  width: 100%;
  height: 90vh;
  /* border: solid 5px red; */
}
.item {
  position: absolute;
  right: 50%;
  width: 50%;
  height: 90vh;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  /* border: solid 5px blue; */
}
.pagamento {
  position: absolute;
  left: 50%;
  width: 50%;
  height: 90vh;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  /* border: solid 5px green; */
}
</style>