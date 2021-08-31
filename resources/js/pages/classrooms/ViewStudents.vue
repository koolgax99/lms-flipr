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
          { text: 'Batch', value:'batches_get_students.title'},
        ],
        students: []

      }
    },

     mounted() {
      this.getStudents()
    },

    methods: {
      getStudents(){
        this.axios.get(`classrooms/${this.$route.params.classroom_id}/students`)
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
