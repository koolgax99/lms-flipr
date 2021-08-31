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

      <v-radio-group v-model="radio.notices" row label="Select the notice recipient" required>
        <v-radio label="College_Wide" value="1"></v-radio>
        <v-radio label="Department" value="2"></v-radio>
        <v-radio label="Classroom" value="3"></v-radio>
        <v-radio label="Batch" value="4"></v-radio>
      </v-radio-group>
      <br>
        <v-select v-model="notices.department_id"
                  :items="departments"
                  item-text="title"
                  item-value="id"
                  menu-props="auto"
                  label="Select Department"
                  hide-details
                  v-if="radio == '2'"
                  single-line>
                </v-select>
                <v-select v-if="radio == '3' || radio=='4'"
                          v-model="notices.classroom_id"
                          :items="classrooms"
                          item-text="title"
                          item-value="id"
                          menu-props="auto"
                          label="Select Classroom"
                          hide-details
                          v-on:change="onChangeGetClassroomBatches"
                          single-line>
                        </v-select>
                        <v-select v-if="radio == '4'"
                                  v-model="notices.batch_id"
                                  :items="batches"
                                  item-text="title"
                                  item-value="id"
                                  menu-props="auto"
                                  label="Select Batch"
                                  hide-details
                                  single-line>
                                </v-select>
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
      radio: '1'
    }),

    mounted() {
      this.getDepartments()
      this.getClassrooms()
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
        axios.get('teachers/classrooms')
        .then(response => {
          this.classrooms = response.data
        })
        .catch(error => {
          console.log('error')
        })
      },
      onChangeGetClassroomBatches() {
        axios.get(`classrooms/${this.notices.classroom_id}/batches`)
          .then(response => {
            //console.log(response.data);
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
