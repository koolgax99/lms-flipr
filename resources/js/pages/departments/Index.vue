<template>
  <v-data-table
    :headers="headers"
    :items="departments"
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
        departments: []

      }
    },

     mounted() {
      this.getDepartments()
    },

    methods: {
      getDepartments() {
        axios.get('departments')
          .then((res) => {
            console.log(res.data);
            this.departments = res.data
          }, () => {
            console.log("error")
          })
      }
    }
  }
</script>
