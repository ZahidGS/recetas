<template>
  <input
    type="submit"
    class="btn btn-sm btn-danger d-block w-100 mb-2"
    value="Eliminar ×"
    v-on:click="eliminarReceta"
  />
</template>

<script>
export default {
  props: ["recetaId"],
  methods: {
    eliminarReceta() {
      this.$swal({
        title: "¿Deseas eliminar esta receta?",
        text: "Una vez eliminada, no se puede recuperar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
      }).then(result => {
        if (result.value) {
          //pasarle el parametros
          const params = {
            id: this.recetaId
          };

          //enviar la solicitud al servidor, se ve en la ruta web.php
          axios
            .post(`/recetas/${this.recetaId}`, { params, _method: "delete" })
            .then(respuesta => {
              this.$swal({
                title: "Receta Eliminada",
                text: "Se eliminó la receta",
                icon: "success"
              });

              //eliminar receta del DOM
              // .$el = elemento actual, se usa .parentNode para subir a elemento padre
              this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
            })
            .catch(error => {
                console.log(error)
            });
        }
      });
    }
  }
};
</script>