<template>
  <v-data-table
    :headers="headers"
    :items="classrooms"
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
        classrooms: []

      }
    },

     mounted() {
      this.getClassrooms()
    },

    methods: {
      getClassrooms() {
        axios.get('classrooms')
          .then((res) => {
            console.log(res.data);
            this.classrooms = res.data
          }, () => {
            console.log("error")
          })
      }
    }
  }
</script>
