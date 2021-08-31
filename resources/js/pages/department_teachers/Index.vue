<template>
  <v-data-table
    :headers="headers"
    :items="department_teachers"
    class="elevation-1"
  ></v-data-table>
</template>

<script>
  export default {
    data () {
      return {
        department_teachers: [],
        headers: [
          {
            text: 'ID',
            align: 'start',
            sortable: true,
            value: 'id',
          },
          {
            text:'Department', value:'department_teachers_get_departments.title'
          },
          {
            text:'Teacher', value: 'department_teachers_get_teachers.name'
          }
        ],

      }
    },

    mounted() {
      this.getDepartmentTeachers()
    },

    methods: {
      getDepartmentTeachers(){
        axios.get('department_teachers')
        .then(response =>{
          this.department_teachers = response.data;
        })
        .catch(error => {
          console.log('error');
        })
      }

    }
  }
</script>
