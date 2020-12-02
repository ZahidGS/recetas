<template>
  <div>
    <span class="like-btn" @click="likeReceta" :class="{ 'like-active' : isActive }"></span>
    <p>{{ cantidadLikes }} Les gustó esta receta ...</p>
  </div>
</template>

<script>
export default {
  props: ["recetaId", "like","likes"],
  data: function(){ //con data es dinamico la consulta
    return {
      isActive: this.like,
      totalLikes: this.likes
    }
  },
  mounted() {
    console.log(this.like);
  },
  methods: {
    likeReceta() {
      axios
        .post("/recetas/" + this.recetaId)
        .then(respuesta => {

          //actualiza la respuesta del data
          if (respuesta.data.attached.length > 0) {
            this.$data.totalLikes++;
          } else {
            this.$data.totalLikes--;
          }

          this.isActive = !this.isActive
        })
        .catch(error => {
          if (error.response.status === 401) {
            window.location = '/register';
          }
        });
    }
  },
  computed: { //con computed es estatita la consulta, se debe recargar o usar data
    cantidadLikes: function(){
      return this.totalLikes
    }
  },
};
</script>