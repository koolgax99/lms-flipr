<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Admin Dashboard</div>

            <div class="card-body">
                Welcome
            </div>

        </div>
        <div class="card card-default">
            <div class="card-header">Liste des utilisateurs</div>

            
        </div>
    </div>
</template>

<script>
    export default {
    created(){
      this.$store.commit('SET_LAYOUT', 'basic-app-layout');
    },
    
    mounted() {
      //
    },

  }
</script>
