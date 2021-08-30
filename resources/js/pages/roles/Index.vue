<template>
  <v-data-table
    :headers="headers"
    :items="roles"
    class="elevation-1"
  ></v-data-table>
</template>

<script>
  export default {
    data () {
      return {
        headers: [
          {
            text: 'ID',
            align: 'start',
            sortable: true,
            value: 'id',
          },
          { text: 'Title', value: 'title' },
          { text: 'Description', value: 'description' },

        ],
        roles: []

      }
    },

     mounted() {
      this.getRoles()
    },

    methods: {
      getRoles() {
        axios.get('roles')
          .then((res) => {
            this.roles = res.data
          }, () => {
            console.log("error")
          })
      }
    }
  }
</script>
