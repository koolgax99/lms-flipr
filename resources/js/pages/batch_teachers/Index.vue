<template>
  <v-data-table
    :headers="headers"
    :items="batch_teachers"
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
          { text: 'Teacher', value: 'batch_teachers_get_teachers.name' },
          { text: 'Subject', value: 'batch_teachers_get_subjects.title' },
        ],
        batch_teachers: []

      }
    },

     mounted() {
      this.getBatchTeachers()
    },

    methods: {
      getBatchTeachers() {
        this.axios.get(`batches/${this.$route.params.batch_id}/teachers`)
        .then(response =>{
          this.batch_teachers = response.data;
        })
        .catch(error =>{
          console.log('error');
        })
      }
    }
  }
</script>
