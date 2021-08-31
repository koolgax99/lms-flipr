<template>
  <v-data-table
    :headers="headers"
    :items="submissions"
    class="elevation-1"
  >
  <template v-slot:item.obtained_marks="prop">
    <td v-if="prop.item.obtained_marks != ''"> {{ prop.item.obtained_marks}}</td>
    <td v-else>Not Evaluated</td>
  </template>
  <template v-slot:item.options="props">
    <v-btn v-if="role == '7' " :to="{ name: 'assignment_submissions.edit', params: { assignment_id: props.item.assignment_id,id: props.item.id }}" class="mx-2" fab dark small color="pink">
      <v-icon dark>mdi-pencil</v-icon>
    </v-btn>
    <v-btn v-if="role == '7' || role == '6' " :to="{ name: 'assignment_submissions.view', params: { assignment_id: props.item.assignment_id,id: props.item.id }}" class="mx-2" fab dark small color="pink">
      <v-icon dark>mdi-eye</v-icon>
    </v-btn>
    <v-btn v-if="role =='6'" :to="{ name: 'assignment_submissions.add_or_edit_marks', params: { assignment_id: props.item.assignment_id ,id: props.item.id }}" dark color="blue">Add/Edit Marks</v-btn>
  </v-card-actions>
  </template>
</v-data-table>
</template>

<script>
  export default {
    data () {
      return {
        headers: [
          {
            text: 'ID',
            align: 'start',
            sortable: true,
            value: 'id',
          },
          { text: 'Title', value: 'title' },
          { text: 'Answers', value: 'answers' },
          { text: 'Student', value: 'assignment_submissions_students.name' },
          { text:'Marks',value:'obtained_marks'},
          { text:'Options', value:'options'}

        ],
        submissions: [],
        role:'',
      }
    },
    created(){
      axios.get(`assignments/${this.$route.params.assignment_id}/submissions`)
      .then(response =>{
        console.log(response.data);
        this.submissions = response.data;
        if(response.data == '')
        {
          this.$router.push(`/assignments`)
        }
      })
      .catch(error =>{
        console.log('here is the error');
      })
    },

     mounted() {
      this.getUserRole();
    },

    methods: {
      getUserRole(){
        axios.get('getUserRole')
        .then(response =>{
          this.role = response.data;
          console.log(this.role);
        })
        .catch(error =>{
          console.log(error);
        })
      },

    }
  }
</script>
