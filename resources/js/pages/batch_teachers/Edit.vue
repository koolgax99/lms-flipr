<template>
  <v-card
    class="mx-auto p-4"
    width="700"
    raised
  >
  <v-form ref="form" v-model="valid" lazy-validation>
      <v-spacer></v-spacer>
          <v-select
        v-model="batch_teachers.teacher_id"
        :items="teachers"
        item-text="name"
        item-value="id"
        menu-props="auto"
        label="Select Teachers"
        hide-details
        single-line
      ></v-select>
      <v-spacer></v-spacer>
          <v-select
        v-model="batch_teachers.subject_id"
        :items="subjects"
        item-text="title"
        item-value="id"
        menu-props="auto"
        label="Select Subjects"
        hide-details
        single-line
      ></v-select>
    <v-btn :disabled="!valid" color="success" class="mr-4" @click="submit">
      Submit
    </v-btn>
  </v-form>
  </v-card>
</template>

<script>
  export default {
  data() {
    return {
      valid: true,

      batch_teachers: {
        department_id: '',
        teacher_id: '',
        subject_id: '',
        classroom_id: '',
      },
      teachers: [],
      subjects: [],
    }
  },

  created() {
    let url = process.env.MIX_APP_URL + `/api/batches/${this.$route.params.batch_id}/teachers/${this.$route.params.id}/edit`;
    this.axios.get(url)
    .then(response => {
      this.batch_teachers = response.data;
    })
    .catch(error =>{
      console.log('error');
    })
  },

  mounted() {
    this.getTeachers();
    this.getSubjects();
  },

  methods: {
    getTeachers(){
			axios.get('getTeachers')
			.then(response => {
				console.log(response.data);
				this.teachers = response.data;
			})
			.catch(error =>{
				console.log('error');
			})
		},
		getSubjects(){
			axios.get('subjects')
			.then(response =>{
				this.subjects = response.data;
			})
			.catch(error => {
				console.log('error');
			})
		},
    submit() {
      this.errors = {};
      axios.put(`/batches/${this.$route.params.batch_id}/teachers/${this.$route.params.id}/update/`, this.batch_teachers)
      .then(response => {
        console.log('Message sent!');
        this.$router.push(`/batches/${this.$route.params.batch_id}/teachers`);
      })
      .catch(error => {
        console.log("error");
      });
    },
  },
}
</script>
