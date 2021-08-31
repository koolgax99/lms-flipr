<template>
  <v-container>
    <v-card class="mx-auto p-4" width="700" raised>
      <v-form ref="form" v-model="valid" lazy-validation enctype="multipart/form-data">
        <v-radio-group v-model="radio" row label="Select whether to take the attendance for a classroom or a batch" required>
          <v-radio label="Classroom" value="Classroom"></v-radio>
          <v-radio label="Batch" value="Batch"></v-radio>
        </v-radio-group>
        <br>
        <div v-if="radio == 'Classroom'">
          <v-select v-model="attendance.classroom_id"
                    :items="classrooms"
                    item-text="title"
                    item-value="id"
                    menu-props="auto"
                    label="Select Classrooms"
                    hide-details
                    single-line
                    v-on:change="onChangeClassroomSubject"></v-select>
        </div>
        <div v-if="radio == 'Batch'">
          <v-select v-model="attendance.batch_id"
                    :items="batches"
                    item-text="title"
                    item-value="id"
                    menu-props="auto"
                    label="Select Batch"
                    hide-details
                    v-on:change="onChangeBatchSubject"
                    single-line></v-select>
        </div>
        <br>
        <div v-if="attendance.classroom_id != '' && radio =='Classroom'">
          <v-select v-model="attendance.subject_id"
                    :items="classroom_subjects"
                    item-text="title"
                    item-value="id"
                    menu-props="auto"
                    label="Select Classroom Subject"
                    hide-details
                    v-on:click="getClassroomStudents"
                    single-line></v-select>
        </div>
        <div v-if="attendance.batch_id != '' && radio == 'Batch'">
          <v-select v-model="attendance.subject_id"
                    :items="batch_subjects"
                    item-text="title"
                    item-value="id"
                    menu-props="auto"
                    label="Select Batch Subject"
                    hide-details
                    v-on:click="getBatchStudents"
                    single-line></v-select>
        </div>
        <br>
        <v-dialog ref="dialog"
                  v-model="modal"
                  :return-value.sync="attendance.date"
                  persistent
                  width="290px">
          <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-model="attendance.date"
                label="Picker in dialog"
                prepend-icon="event"
                readonly
                v-bind="attrs"
                v-on="on"
              ></v-text-field>
            </template>
          <v-date-picker v-model="attendance.date" scrollable>
            <v-spacer></v-spacer>
            <v-btn text color="primary" @click="modal = false">Cancel</v-btn>
            <v-btn text color="primary" @click="$refs.dialog.save(attendance.date)">OK</v-btn>
          </v-date-picker>
        </v-dialog>
        <br>

        <v-btn :disabled="!valid" color="success" class="mr-4" @click="submit">
          Submit
        </v-btn>
      </v-form>
    </v-card>
    <br>
    <v-card class="mx-auto p-4" width="700" raised v-if="part1 == '1'">
    <v-container class="grey lighten-5">
    <v-row no-gutters>
      <v-col
        cols="12"
        sm="6"
      >
        <v-card
          class="pa-2"
          outlined
          tile
        >
          <v-simple-table>
            <tbody>
              <tr v-for="student in students">
                <th>{{ student.name }}</th>
              </tr>
            </tbody>
          </v-simple-table>
        </v-card>
      </v-col>
      <v-col
        cols="12"
        sm="6"
      >
      <v-card
        class="pa-2"
        outlined
        tile
      >
        <v-simple-table>
          <tbody>
            <tr v-for="n in students.length">
              <v-select
              :items="status"
              label="Standard"
              dense
              :key = "n"
              v-model="attendance_status.status[n]"
              ></v-select>
            </tr>
          </tbody>
        </v-simple-table>
      </v-card>
      </v-col>
      <v-btn :disabled="!valid" color="success" class="mr-4" @click="statusSubmit">
        Submit
      </v-btn>
    </v-row>
  </v-container>
</v-card>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      valid: true,
      nvalid: true,
      attendance: {
        subject_id: '',
        classroom_id: '',
        date: '',
        batch_id: '',
      },
      attendance_status: {
        student_id: [],
        status:[],
      },
      attendance_id: '',
      classroom_subjects: [],
      batch_subjects: [],

      classrooms: [],

      batches: [],
      radio: 'Classroom',
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'name', value: 'name' },
        { text: 'options', value: 'options' }
      ],
      status: [
        { text: 'Present', value: '1' },
        { text: 'Absent', value: '2' },
        { text: 'Late', value: '3' }
      ],
      part1: '',
      students: [],
      modal: false
    }),

    mounted() {
      this.getClassrooms()
      this.getBatches()
    },

    methods: {
      onChangeClassroomSubject() {
        this.attendance.batch_id = ''
        axios
          .get(`/classrooms/${this.attendance.classroom_id}/subjects`)
          .then(response => {
            this.classroom_subjects = response.data
          })
          .catch(error => {
            console.log(error)
          })
      },
      onChangeBatchSubject() {
        this.attendance.classroom_id = ''
        axios
          .get(`/batches/${this.attendance.batch_id}/subjects`)
          .then(response => {
            this.batch_subjects = response.data
          })
          .catch(error => {
            console.log(error)
          })
      },
      getClassrooms() {
        axios
          .get('teachers/classrooms')
          .then(response => {
            this.classrooms = response.data
          })
          .catch(error => {
            console.log('error')
          })
      },
      getBatches() {
        axios
          .get('teachers/batches')
          .then(response => {
            this.batches = response.data
          })
          .catch(error => {
            console.log('error')
          })
      },
      getClassroomStudents(){
        this.axios
          .get(`classrooms/${this.attendance.classroom_id}/students`)
          .then(response => {
            //console.log(response.data);
            this.students = response.data
            //this.part1 = '1'
          })
          .catch(error => {
            console.log(error)
          })
      },

      getBatchStudents(){
        this.axios
          .get(`batches/${this.attendance.batch_id}/students`)
          .then(response => {
            console.log(response.data);
            this.students = response.data
            //this.part1 = '1'
          })
          .catch(error => {
            console.log('test error')
          })
      },

      submit() {
        this.errors = {}
//        let batch_id = this.attendance.batch_id;
        axios
          .post('/attendance/store', this.attendance)
          .then(response => {
            this.attendance = response.data;
            this.attendance_id = this.attendance.id;
            this.part1 = '1';
          })
          .catch(error => {
            console.log('error')
          })
      },
      statusSubmit() {
        this.errors = {}
        console.log(this.attendance_status)
        axios
            .post(`/attendance/${this.attendance_id}/status/store`, this.attendance_status)
            .then(response => {
              this.$router.push(`/attendance`);
              console.log('Message sent!')
            })
            .catch(error => {
              console.log('error')
            })
      }
    }
  }
</script>
