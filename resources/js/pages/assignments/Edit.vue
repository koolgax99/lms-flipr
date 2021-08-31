<template>
  <v-card class="mx-auto p-4" width="700" raised>
    <v-form ref="form" v-model="valid" lazy-validation enctype="multipart/form-data">
      <v-text-field v-model="assignments.title"
                    :counter="20"
                    :rules="titleRules"
                    label="Title"
                    required></v-text-field>
      <br>
      <v-text-field v-model="assignments.description"
                    :rules="descriptionRules"
                    :counter="200"
                    label="Description"
                    required>
      </v-text-field>
      <br>
      <v-radio-group v-model="radio" row label="Select whether to assign the assignment to a classroom or a batch" required>
        <v-radio label="Classroom" value="Classroom"></v-radio>
        <v-radio label="Batch" value="Batch"></v-radio>
      </v-radio-group>
      <br>
      <div v-if="radio == 'Classroom'">
        <v-select v-model="assignments.classroom_id"
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
        <v-select v-model="assignments.batch_id"
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
      <div v-if="assignments.classroom_id != null && radio =='Classroom'">
        <v-select v-model="assignments.subject_id"
                  :items="classroom_subjects"
                  item-text="title"
                  item-value="id"
                  menu-props="auto"
                  label="Select Classroom Subject"
                  hide-details
                  single-line></v-select>
      </div>
      <div v-if="assignments.batch_id != null && radio == 'Batch'">
        <v-select v-model="assignments.subject_id"
                  :items="batch_subjects"
                  item-text="title"
                  item-value="id"
                  menu-props="auto"
                  label="Select Batch Subject"
                  hide-details
                  single-line></v-select>
      </div>
      <br>
      <v-datetime-picker label="Select Submission Start Time" v-model="assignments.start_date_and_time" dateFormat="dd-MM-yyyy" timeFormat="HH:mm"></v-datetime-picker>
      <br>
      <v-datetime-picker label="Select Submission Deadline" v-model="assignments.end_date_and_time" dateFormat="dd-MM-yyyy" timeFormat="HH:mm"></v-datetime-picker>
      <br>
      <v-text-field v-model="assignments.maximum_marks"
                    label="Maximum Marks for this Assignment"
                    required></v-text-field>
      <br>
      <v-text-field v-model="assignments.more_details"
                    :counter="200"
                    label="More Details Regarding the Assignment"
                    required></v-text-field>
      <br>
      <br>
      <v-checkbox v-model="assignments.allow_deadline_submission" label="Allow Submission after Deadline"></v-checkbox>

      <v-btn :disabled="!valid" color="success" class="mr-4" @click="submit">
        Submit
      </v-btn>
    </v-form>
  </v-card>
</template>

<script>
  export default {
    data: () => ({
      valid: true,

      titleRules: [
        v => !!v || 'Title is required',
        v => (v && v.length <= 20) || 'Title must be less than 20 characters'
      ],

      descriptionRules: [
        v => !!v || 'Description is required',
        v => (v && v.length <= 200) || 'Description must be less than 200 characters'
      ],

      assignments: {
        title: '',
        description: '',
        attachments: [],
        start_date_and_time: '',
        end_date_and_time: '',
        maximum_marks: '',
        more_details: '',
        teacher_id: '',
        subject_id: '',
        classroom_id: '',
        batch_id: '',
        allow_deadline_submission: ''
      },

      teachers: [],

      classroom_subjects: [],
      batch_subjects: [],

      classrooms: [],

      batches: [],
      radio: '',
    }),

    created(){
      let url = process.env.MIX_APP_URL + `/api/assignments/${this.$route.params.id}/edit`;
      this.axios.get(url)
      .then(response =>{
        console.log(response.data);
        this.assignments = response.data;
        if((this.assignments.classroom_id == null || this.assignments.classroom_id == '') && (this.assignments.batch_id != null || this.assignments.batch_id != '') )
        {
          this.radio = 'Batch';

          console.log(this.radio)
          axios.get(`batches/${this.assignments.batch_id}/subjects`)
          .then(response =>{
            this.batch_subjects = response.data;
          })
          .catch(error =>{
            console.log(error)
          })
        }
        else
        {
          this.radio = 'Classroom';
          axios.get(`classrooms/${this.assignments.classroom_id}/subjects`)
          .then(response =>{
            this.classroom_subjects = response.data;
          })
          .catch(error =>{
            console.log(error)
          })
        }
      })
      .catch(error => {
        console.log(error)
      });
    },

    mounted() {
      this.getClassrooms()
      this.getBatches()
    },

    methods: {
      onChangeClassroomSubject() {
        this.assignments.batch_id = ''
        axios
          .get(`/classrooms/${this.assignments.classroom_id}/subjects`)
          .then(response => {
            this.classroom_subjects = response.data
          })
          .catch(error => {
            console.log(error)
          })
      },
      onChangeBatchSubject() {
        this.assignments.classroom_id = ''
        axios
          .get(`/batches/${this.assignments.batch_id}/subjects`)
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
      submit() {
        this.errors = {}
        axios
          .post('/assignments/store', this.assignments)
          .then(response => {
            console.log('Message sent!')
            this.$router.push('/assignments')
          })
          .catch(error => {
            console.log('error')
          })
      }
    }
  }
</script>
