<template>
  <v-card class="mx-auto p-4" width="700" raised>
    <v-form ref="form" v-model="valid" lazy-validation enctype="multipart/form-data">
      <v-text-field v-model="notices.title"
                    :counter="20"
                    :rules="titleRules"
                    label="Title"
                    required></v-text-field>
      <br>
      <v-text-field v-model="notices.notice_text"
                    :rules="notice_textRules"
                    :counter="200"
                    label="Notice Text"
                    required>
      </v-text-field>
      <br>

      <v-radio-group v-model="radio" row label="Select the notice recipient" required>
        <v-radio label="Colloege Wide" value="College_Wide"></v-radio>
        <v-radio label="Department" value="Department"></v-radio>
        <v-radio label="Classroom" value="Classroom"></v-radio>
        <v-radio label="Batch" value="Batch"></v-radio>
      </v-radio-group>
      <br>
      <div v-if="radio == 'Department'">
        <v-select v-model="notices.department_id"
                  :items="departments"
                  item-text="title"
                  item-value="id"
                  menu-props="auto"
                  label="Select Department"
                  hide-details
                  single-line>
                  </v-select>
      </div>
      <div v-if="radio == 'Classroom'">
        <v-select v-model="notices.classroom_id"
                  :items="classrooms"
                  item-text="title"
                  item-value="id"
                  menu-props="auto"
                  label="Select Classroom"
                  hide-details
                  single-line>
                  </v-select>
      </div>
      <div v-if="radio == 'Batch'">
        <v-select v-model="notices.batch_id"
                  :items="batches"
                  item-text="title"
                  item-value="id"
                  menu-props="auto"
                  label="Select Batch"
                  hide-details>
                  </v-select>
      </div>
      <br>
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

      notice_textRules: [
        v => !!v || 'Notice Text is required',
        v => (v && v.length <= 200) || 'Text must be less than 200 characters'
      ],

      notices: {
        title: '',
        notice_text: '',
        teacher_id: '',
        department_id: '',
        classroom_id: '',
        batch_id: '',
      },

      teachers: [],

      departments: [],

      classrooms: [],

      batches: [],
      radio: 'Institute'
    }),

    created(){
      let url = process.env.MIX_APP_URL + `/api/notices/${this.$route.params.id}/edit`;
      this.axios.get(url)
      .then(response =>{
        console.log(response.data);
        this.notices = response.data;
        })

      .catch(error => {
        console.log(error)
      });
    },

    mounted() {
      this.getDepartments()
      this.getClassrooms()
      this.getBatches()
    },

    methods: {
      getDepartments() {
        axios
          .get('departments')
          .then(response => {
            this.departments = response.data
          })
          .catch(error => {
            console.log('error')
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
          .post('/notices/store', this.notices)
          .then(response => {
            console.log('Message sent!')
            this.$router.push('/notices')
          })
          .catch(error => {
            console.log('error')
          })
      }
    }
  }
</script>
