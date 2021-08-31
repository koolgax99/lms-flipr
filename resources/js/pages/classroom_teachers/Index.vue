<template>
  <v-data-table
    :headers="headers"
    :items="teachers"
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
          { text: 'Teacher', value: 'classroom_teachers_get_teachers.name' },
          { text: 'Subject', value: 'classroom_teachers_get_subjects.title' },

        ],
        teachers: []

      }
    },

     mounted() {
      this.getClassroomTeachers()
    },

    methods: {
      getClassroomTeachers() {
        axios.get(`classroom/${this.$route.params.id}/teachers`)
        .then(response =>{
          this.teachers = response.data;
        })
        .catch(error => {
          console.log('error')
        })
      }
    }
  }
</script>
