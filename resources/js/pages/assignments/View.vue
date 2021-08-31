<template>
  <v-card class="mx-auto" min-width="300" width="700" outlined>
    <v-card-title>
      View Assignment
      <v-spacer></v-spacer>
      <v-btn :to="{ name: 'assignments.index'}" class="mx-2" fab dark small color="black" right>
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
            <tr>
              <th class="text-left">Title</th>
              <td>{{ assignment.title }}</td>
            </tr>
            <tr>
              <th class="text-left">Description</th>
              <td>{{ assignment.description }}</td>
            </tr>
            <tr v-if="assignment.classroom_id !=''">
              <th class="text-left">Classroom</th>
              <td>{{ assignment.assignments_get_classrooms.title }}</td>
            </tr>
            <tr v-else>
              <th class="text-left">Batch</th>
                <td>{{ assignment.assignments_get_batches.title }}</td>
              </tr>
            </tr>
            <tr>
              <th class="text-left">Subject</th>
              <td>{{ assignment.assignments_get_subjects.title }}</td>
            </tr>
            <tr>
              <th class="text-left">Teacher</th>
              <td>{{ assignment.assignments_get_teachers.name }}</td>
            </tr>
            <tr>
              <th class="text-left">Submission Start Date</th>
              <td>{{ assignment.start_date_and_time }}</td>
            </tr>
            <tr>
              <th class="text-left">Submission Deadline</th>
              <td>{{ assignment.end_date_and_time }}</td>
            </tr>
            <tr>
              <th class="text-left">Submission Allowed After Deadline</th>
              <td v-if="assignment.allow_deadline_submission == '0'">No</td>
              <td v-else>Yes</td>
            </tr>
            <tr>
              <th class="text-left">More Details</th>
              <td>{{ assignment.more_details }}</td>
            </tr>
            <v-card-actions>
              <v-btn v-if="submissions =='' && role =='7'" :to="{ name: 'assignment_submissions.create', params: { assignment_id: assignment.id }}">Add Answer</v-btn>
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
        assignment: {
          title: '',
          description: '',
          classroom_id: '',
          batch_id: '',
          subject_id: '',
          start_date_and_time: '',
          end_date_and_time: '',
          allow_deadline_submission: '',
          more_details: '',
          assignments_get_classrooms: {},
          assignments_get_batches: {},
          assignments_get_teachers: {},
          assignments_get_subjects: {}
        },
        submissions:[],
        role:'',
      }
    },
    mounted() {
      this.getAssignment();
      this.checkStudentSubmission();
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
      checkStudentSubmission(){
        this.axios.get(`assignments/${this.$route.params.id}/submission`)
        .then(response =>{
          console.log(response.data);
          this.submissions = response.data;
        })
        .catch(error =>{
          console.log(error);
        })

      },
      getAssignment() {
        this.axios
          .get(`assignments/${this.$route.params.id}/view`)
          .then(response => {
            console.log(response.data[0]);
            this.assignment = response.data[0];
          })
          .catch(error => {
            console.log(error)
          })
      },
    }
  }
</script>
