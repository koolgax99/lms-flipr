<template>
  <v-container>
    <v-card class="mx-auto p-4" width="700" raised>
      <v-card-title>
        Get Marks for Particular Assignment
      </v-card-title>
      <v-form ref="form" lazy-validation enctype="multipart/form-data">
        <v-select v-model="assignment.id"
                  :items="assignments"
                  item-text="title"
                  item-value="id"
                  menu-props="auto"
                  label="Select Assignment"
                  hide-details
                  single-line></v-select>
        <br>
        <v-btn color="success" class="mr-4" @click="submit">
          Submit
        </v-btn>
      </v-form>
    </v-card>
    <br>
    <h1 class="title" v-if="loaded">{{ assignment.title }}</h1>
    <div class="Chart__container" v-if="loaded">
      <div class="Chart__title">
        All Student's Marks for this assignment
        <hr>
      </div>
      <div class="Chart__content">
        <line-chart v-if="loaded" :chart-data="downloads" :chart-labels="labels"></line-chart>
      </div>
    </div>
    <br>
    <br>
    <v-card class="mx-auto p-4" width="700" raised>
      <v-card-title>
        Get Particular Student's Marks for All Assignments
      </v-card-title>
      <v-form ref="form" lazy-validation enctype="multipart/form-data">
        <v-select v-model="classroom.id"
                  :items="classrooms"
                  item-text="title"
                  item-value="id"
                  menu-props="auto"
                  label="Select Classroom"
                  hide-details
                  single-line
                  v-on:change="getClassroomStudents"></v-select>
        <br>
        <v-select v-model="student.id"
                  :items="students"
                  item-text="name"
                  item-value="id"
                  menu-props="auto"
                  label="Select Classroom"
                  hide-details
                  single-line
                  v-if="classroom.id != ''"></v-select>
                  <br>
        <v-btn color="success" class="mr-4" @click="submit_1">
          Submit
        </v-btn>
      </v-form>
    </v-card>
    <br>
    <h1 class="title" v-if="loaded_1">{{ student.name }}'s Marks for All Assignments</h1>
    <div class="Chart__container" v-if="loaded_1">
      <div class="Chart__title">
        <hr>
      </div>
      <div class="Chart__content">
        <one-student-all-assignments v-if="loaded_1" :chart-data="data" :chart-labels="labels_1"></one-student-all-assignments>
      </div>
    </div>
  </v-container>
</template>
<script>
  import LineChart from './charts/LineChart'
  import OneStudentAllAssignments from './charts/OneStudentAllAssignments'
  export default {
    components: {
      LineChart,
      OneStudentAllAssignments,
    },
    props: {},
    data() {
      return {
        assignment: {
          id: '',
          title: ''
        },
        assignments: [],
        loaded: false,
        loaded_1:false,
        downloads: [],
        labels: [],
        classroom:{
          id:'',
        },
        student:{
          id:'',
          name:'',
        },
        classrooms:[],
        students:[],
        data:[],
        labels_1:[],
      }
    },
    mounted() {
      this.getAssignments()
      this.getClassrooms()

    },
    methods: {
      getAssignments(){
        this.axios
          .get(`assignments`)
          .then(response => {
            this.assignments = response.data
          })
          .catch(error => {
            console.log(error)
          })
      },
      getClassrooms(){
        this.axios.get(`teachers/classrooms`)
        .then(response =>{
          this.classrooms = response.data;
        })
        .catch(error =>{
          console.log(error)
        })
      },
      getClassroomStudents(){
        this.axios.get(`classrooms/${this.classroom.id}/students`)
        .then(response =>{
          this.students = response.data;
        })
        .catch(error => {
          console.log(error)
        })
      },
      submit() {
        axios
          .get(`assignments/${this.assignment.id}/all-students-one-assignment`)
          .then(response => {
            console.log(response.data)
            this.downloads = response.data.map(data => data.obtained_marks)
            this.labels = response.data.map(data => data.student)
            console.log(this.downloads)
            console.log(this.labels)
            this.loaded = true
          })
          .catch(err => {
            this.errorMessage = err.response.data.error
            this.showError = true
          })
      },
      submit_1(){
        this.axios.get(`assignments/${this.student.id}/one-student-all-assignments`)
        .then(response => {
          console.log(response.data)
          this.data = response.data.map(data => data.obtained_marks)
          this.labels_1 = response.data.map(data => data.assignments)
          console.log(this.downloads)
          console.log(this.labels_1)
          this.loaded_1 = true
        })
        .catch(err => {
          this.errorMessage = err.response.data.error
          this.showError = true
        })
        this.axios.get(`getUser/${this.student.id}`)
        .then(response =>{
          this.student = response.data;
        })
        .catch(error =>{
          console.log(error);
        })
      }
    }
  }
</script>
