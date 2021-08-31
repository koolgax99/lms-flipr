<template>
  <v-card class="mx-auto" min-width="300" width="700" outlined>
    <v-card-title>
      View Assignment
      <v-spacer></v-spacer>
      <v-btn :to="{ name: 'assignment_submissions.index', params:{assignment_id: submission.assignments_get_submissions.id}}" class="mx-2" fab dark small color="black" right>
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
            <tr>
              <th class="text-left">Evaluation Done</th>
              <td v-if="submission.obtained_marks != ''">Yes</td>
              <td v-else>No</td>
            </tr>
            <tr v-if="submission.obtained_marks != ''">
              <th>Obtained Marks</th>
              <td>{{ submission.obtained_marks }}</td>
            </tr>
            <tr v-if="submission.comments != ''">
              <th>Comments</th>
              <td>{{ submission.comments }}</td>
            </tr>
            <v-card-actions>
              <v-btn v-if="role =='7'" :to="{ name: 'assignment_submissions.edit', params: { assignment_id: submission.assignments_get_submissions.id ,id: submission.id }}" dark color="blue">Edit Answer</v-btn>
              <v-btn v-if="role =='6'" :to="{ name: 'assignment_submissions.add_or_edit_marks', params: { assignment_id: submission.assignments_get_submissions.id ,id: submission.id }}" dark color="blue">Add/Edit Marks</v-btn>
            </v-card-actions>
          </tbody>
        </template>
    </v-simple-table>

  </v-card>
</template>

<script>
  export default {
    data() {
      return {
        submission: {
          title: '',
          answer: '',
          assignments_get_submissions:{},
          obtained_marks:'',
          comments:'',
        },
        role:'',
      }
    },
    mounted() {
      this.getSubmission();
      this.getUserRole();
    },

    methods: {
      getUserRole(){
          this.axios.get(`getUserRole`)
          .then(response =>{
            this.role = response.data;
          })
          .catch(error =>{
            console.log(error);
          })
      },
      getSubmission() {
        this.axios
          .get(`assignments/${this.$route.params.assignment_id}/submissions/${this.$route.params.id}/view`)
          .then(response => {
            this.submission = response.data;
            if(response.data == '')
            {
              this.$router.push(`/assignments/${this.$route.params.assignment_id}/submissions`)
            }
          })
          .catch(error => {
            console.log(error)
          })
      },
    }
  }
</script>
