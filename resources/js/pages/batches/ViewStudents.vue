<template>
  <v-data-table
    :headers="headers"
    :items="students"
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
          { text: 'Name', value: 'name' },
          { text: 'Roll No.', value: 'roll_no' },

        ],
        students: []

      }
    },

     mounted() {
      this.getStudents()
    },

    methods: {
      getStudents(){
        this.axios.get(`batches/${this.$route.params.batch_id}/students`)
        .then(response =>{
          this.students = response.data;
        })
        .catch(error => {
          console.log(error)
        })
      }
  }
}
</script>
