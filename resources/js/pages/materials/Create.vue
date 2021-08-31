<template>
  <v-card class="mx-auto p-4" width="700" raised>
    <v-form ref="form" v-model="valid" lazy-validation enctype="multipart/form-data">
      <v-text-field v-model="materials.title"
                    :counter="20"
                    :rules="titleRules"
                    label="Title"
                    required></v-text-field>
      <br>
      <v-text-field v-model="materials.description"
                    :rules="descriptionRules"
                    :counter="200"
                    label="Description"
                    required>
      </v-text-field>
      <br>
      <v-radio-group v-model="radio" row label="Select whether to upload the material for a classroom or a batch" required>
        <v-radio label="Classroom" value="Classroom"></v-radio>
        <v-radio label="Batch" value="Batch"></v-radio>
      </v-radio-group>
      <br>
      <div v-if="radio == 'Classroom'">
        <v-select v-model="materials.classroom_id"
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
        <v-select v-model="materials.batch_id"
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
      <div v-if="materials.classroom_id != '' && radio =='Classroom'">
        <v-select v-model="materials.subject_id"
                  :items="classroom_subjects"
                  item-text="title"
                  item-value="id"
                  menu-props="auto"
                  label="Select Classroom Subject"
                  hide-details
                  single-line></v-select>
      </div>
      <div v-if="materials.batch_id != '' && radio == 'Batch'">
        <v-select v-model="materials.subject_id"
                  :items="batch_subjects"
                  item-text="title"
                  item-value="id"
                  menu-props="auto"
                  label="Select Batch Subject"
                  hide-details
                  single-line></v-select>
      </div>
      <br>
      <v-text-field v-model="materials.online_url"
                    label="Online URL for the material"
                    required></v-text-field>
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

      materials: {
        title: '',
        description: '',
        classroom_id: '',
        batch_id: '',
        subject_id: '',
        online_url: ''
      },

      teachers: [],

      classroom_subjects: [],
      batch_subjects: [],

      classrooms: [],

      batches: [],
      radio: 'Classroom'
    }),

    mounted() {
      this.getClassrooms()
      this.getBatches()
    },

    methods: {
      onChangeClassroomSubject() {
        this.materials.batch_id = ''
        axios
          .get(`/classrooms/${this.materials.classroom_id}/subjects`)
          .then(response => {
            this.classroom_subjects = response.data
          })
          .catch(error => {
            console.log(error)
          })
      },
      onChangeBatchSubject() {
        this.materials.classroom_id = ''
        axios
          .get(`/batches/${this.materials.batch_id}/subjects`)
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
          .post('/study-materials/store', this.materials)
          .then(response => {
            console.log('Message sent!')
            this.$router.push('/study-materials')
          })
          .catch(error => {
            console.log('error')
          })
      }
    }
  }
</script>
