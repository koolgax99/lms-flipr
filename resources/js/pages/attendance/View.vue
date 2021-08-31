<template>
  <v-container>
    <v-card class="mx-auto" min-width="300" width="700" outlined>
      <v-card-title>
        View Attendance
        <v-spacer></v-spacer>
        <v-btn :to="{ name: 'attendance.index'}" class="mx-2" fab dark small color="black" right>
          <v-icon dark>mdi-keyboard-backspace</v-icon>
        </v-btn>
      </v-card-title>
      <v-simple-table>
        <template v-slot:default>
            <thead>
              <tr>
              </tr>
            </thead>
            <tbody>
              <tr v-if=" attendance.attendance_get_batches == null">
                <th class="text-left">Classroom</th>
                <td>{{ attendance.attendance_get_classrooms.title }}</td>
              </tr>
              <tr v-else>
                <th class="text-left">Batch</th>
                  <td>{{ attendance.attendance_get_batches.title }}</td>
              </tr>
              <tr>
                <th class="text-left">Subject</th>
                <td>{{ attendance.attendance_get_subjects.title }}</td>
              </tr>
              <tr>
                <th class="text-left">Teacher</th>
                <td>{{ attendance.attendance_get_teachers.name }}</td>
              </tr>
              <tr>
                <th class="text-left">Date</th>
                <td>{{ attendance.date }}</td>
              </tr>
              <v-card-actions>
                <v-btn v-on:click ="getAttendanceStatus">View Attendance Data</v-btn>
              </v-card-actions>
            </tbody>
          </template>
      </v-simple-table>
    </v-card>
    <br><br>
    <v-card class="mx-auto" min-width="300" width="700" outlined v-if=" this.attendance_status !=''">
      <v-card-title>
        Attendance Data
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="attendance_status"
        class="elevation-1"
      >
      <template v-slot:item.status="props">
        <td v-if="props.item.status == '1'">Present</td>
        <td v-else-if="props.item.status == '2'">Absent</td>
        <td v-else>Late</td>
      </template>
      <template v-slot:item.options="props">
        <v-btn class="mx-2" fab dark small color="pink">
          <v-icon dark>mdi-pencil</v-icon>
        </v-btn>
      </template>
    </v-data-table>
    </v-card>
  </v-container>
</template>

<script>
  export default {
    data() {
      return {
        attendance: {
          classroom_id: '',
          batch_id: '',
          subject_id: '',
          date: '',
          attendance_get_classrooms: {},
          attendance_get_batches: {},
          attendance_get_teachers: {},
          attendance_get_subjects: {}
        },
        submissions: [],
        headers:[
          { text:'Student',value:'attendance_status_get_student.name'},
          { text:'Status', value:'status'},
        ],
        attendance_status:[],
      }
    },
    mounted() {
      this.getAttendance()
    },

    methods: {
      getAttendance() {
        this.axios
          .get(`attendance/${this.$route.params.attendance_id}/view`)
          .then(response => {
            if(response.data == '' || response.data == null)
            {
              this.$router.push(`/attendance`);
            }
            this.attendance = response.data[0];
            console.log(response.data);
          })
          .catch(error => {
            console.log(error)
          })
      },
      getAttendanceStatus(){
        this.axios.get(`attendance/${this.$route.params.attendance_id}/status`)
        .then(response =>{
          this.attendance_status = response.data;
        })
        .catch(error =>{
          console.log(error)
        })
      },
    }
  }
</script>
