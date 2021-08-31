<template>
  <v-container>
  <v-card class="mx-auto" min-width="300" width="700" outlined>
    <v-card-title>
      Assignment Details
      <v-spacer></v-spacer>
      <v-btn :to="{ name: 'assignment_submissions.index', params:{assignment_id: evaluation.assignment_id}}" class="mx-2" fab dark small color="black" right>
        <v-icon dark>mdi-keyboard-backspace</v-icon>
      </v-btn>
    </v-card-title>
    <v-simple-table>
      <template v-slot:default>
          <thead>
          </thead>
          <tbody>
            <tr>
              <th class="text-left">Assignment</th>
              <td>{{ submission.assignments_get_submissions.title }}</td>
            </tr>
            <tr>
              <th class="text-left">Title</th>
              <td>{{ submission.title }}</td>
            </tr>
            <tr>
              <th class="text-left">Answer</th>
              <td>{{ submission.answers }}</td>
            </tr>
          </tbody>
        </template>
    </v-simple-table>


  </v-card>
  <br><br>
  <v-card class="mx-auto p-4"
  raised>
  <v-card-title>
    Add Marks for this Assignment
  </v-card-title>
    <v-form ref="form" v-model="valid" lazy-validation>
			<v-text-field
				v-model="evaluation.obtained_marks"
				label="Marks to be given"
				required
			></v-text-field>
      <v-spacer></v-spacer>
			<v-text-field
				v-model="evaluation.comments"
				label="Comments for Students"
				required
			></v-text-field>
      <v-spacer></v-spacer>
			<v-btn :disabled="!valid" color="success" class="mr-4" @click="submit">
				Submit
			</v-btn>
		</v-form>
  </v-card>
</v-container>

</template>

<script>
  export default {
    data() {
      return {
        valid:true,
        submission: {
          title: '',
          answer: '',
          assignments_get_submissions:{},
        },
        role:'',
        evaluation:{
          obtained_marks:'',
          comments:'',
        }
      }
    },
    mounted() {
      this.getSubmission();
    },

    methods: {
      getSubmission() {
        this.axios
          .get(`assignments/${this.$route.params.assignment_id}/submissions/${this.$route.params.id}/view`)
          .then(response => {
            this.submission = response.data;
            this.evaluation = response.data;
            if(response.data == '')
            {
              this.$router.push(`/assignments`)
            }
          })
          .catch(error => {
            console.log(error)
          })
      },
      submit() {
        this.errors = {};
        axios.put(`/assignments/${this.$route.params.assignment_id}/submissions/${this.$route.params.id}/storeOrUpdateMarks/`, this.evaluation)
        .then(response => {
          console.log('Message sent!');
          this.$router.push(`/assignments/${this.$route.params.assignment_id}/submissions`);
        })
        .catch(error => {
          console.log("error");
        });
      },
    }
  }
</script>
