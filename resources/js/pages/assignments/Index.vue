<template>
  <v-card class="mx-auto" min-width="300" width="1000" outlined>
    <v-card-title>
      Assignments
      <v-spacer></v-spacer>
      <v-btn v-if="role == '6'" :to="{ name: 'assignments.create'}" class="mx-2" fab dark small color="black" right>
        <v-icon dark>mdi-clipboard-plus</v-icon>
      </v-btn>
    </v-card-title>
    <v-data-table :headers="headers"
                  :items="assignments"
                  class="elevation-1">
      <template v-slot:item.allow_deadline_submission="props">
                    <div v-if=" props.item.allow_deadline_submission == '1' ">
                      Yes
                    </div>
                    <div v-else>
                      No
                    </div>
                  </template>
      <template v-slot:item.options="props">
                    <v-btn :to="{ name: 'assignments.view', params: { id: props.item.id }}" class="mx-2" fab dark small color="pink">
                      <v-icon dark>mdi-eye</v-icon>
                    </v-btn>
                    <v-btn v-if="role == '6'" :to="{ name: 'assignments.edit', params: { id: props.item.id }}" class="mx-2" fab dark small color="pink">
                      <v-icon dark>mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn v-if="role == '6'" :to="{ name: 'assignment_submissions.index', params: { assignment_id: props.item.id }}" class="mx-2" fab dark small color="pink">
                      <v-icon dark>mdi-notebook</v-icon>
                    </v-btn>

                  </template>
    </v-data-table>
  </v-card>
</template>

<script>
  export default {
    data() {
      return {
        headers: [
          {
            text: 'ID',
            align: 'start',
            sortable: true,
            value: 'id'
          },
          { text: 'Title', value: 'title' },
          { text: 'End_Date_And_Time', value: 'end_date_and_time' },
          { text: 'Teacher', value: 'assignments_get_teachers.name' },
          { text: 'Subject', value: 'assignments_get_subjects.title' },
          { text: 'Submission after Deadline', value: 'allow_deadline_submission' },
          { text: 'Options', value: 'options' }
        ],
        assignments: [],
        submissions: [],
        role: ''
      }
    },

    mounted() {
      this.getAssignments()
      this.getUserRole()
    },

    methods: {
      getUserRole() {
        axios.get('getUserRole').then(response => {
          this.role = response.data
        })
      },
      getAssignments() {
        this.axios
          .get('assignments')
          .then(response => {
            this.assignments = response.data
          })
          .catch(error => {
            console.log(error)
          })
      }
    }
  }
</script>
