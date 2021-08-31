<template>
  <v-card class="mx-auto" min-width="300" width="1000" outlined>
    <v-card-title>
      Attendance
      <v-spacer></v-spacer>
      <v-btn v-if="role == '6'" :to="{ name: 'attendance.create'}" class="mx-2" fab dark small color="black" right>
        <v-icon dark>mdi-clipboard-plus</v-icon>
      </v-btn>
    </v-card-title>
  <v-data-table
    :headers="headers"
    :items="attendance"
    class="elevation-1"
  >
  <template v-slot:item.options="props">
    <v-btn :to="{ name: 'attendance.view', params: { attendance_id: props.item.id }}" class="mx-2" fab dark small color="pink">
      <v-icon dark>mdi-eye</v-icon>
    </v-btn>
  </template>
</v-data-table>
</v-card>
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
          { text: 'Classroom', value: 'attendance_get_classrooms.title' },
          { text: 'Batch', value: 'attendance_get_batches.title' },
          { text: 'Subject', value: 'attendance_get_subjects.title' },
          { text: 'Teacher', value: 'attendance_get_teachers.name' },
          { text: 'Options', value: 'options'},
        ],
        attendance: [],
        role:'',
      }
    },

     mounted() {
      this.getAttendance()
      this.getUserRole()
    },

    methods: {
      getUserRole() {
        axios.get('getUserRole').then(response => {
          this.role = response.data
        })
      },
      getAttendance() {
        axios.get(`attendance`)
        .then(response =>{
          this.attendance = response.data;
        })
        .catch(error => {
          console.log('error')
        })
      }
    }
  }
</script>
