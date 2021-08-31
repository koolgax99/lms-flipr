<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                Bienvenue
            </div>
        </div>
    </div>
</template>

<script>

  export default {
    data() {
      return {
        //
      }
    },
    created(){
      this.$store.commit('SET_LAYOUT', 'basic-app-layout');
    },
    components: {
      //
    }
  }
</script>