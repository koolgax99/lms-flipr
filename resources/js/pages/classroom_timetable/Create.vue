<template>
	<v-card class="mx-auto p-4" width="700" raised>
		<v-form ref="form" v-model="valid" lazy-validation>
			<v-text-field
				v-model="classroom_timetable.title"
				:counter="20"
				:rules="titleRules"
				label="Title"
				required
			></v-text-field>
      <v-spacer></v-spacer>
			<v-select
				v-model="classroom_timetable.department_id"
				:items="departments"
				item-text="title"
				item-value="id"
				menu-props="auto"
				label="Select Department"
				hide-details
				single-line
			></v-select>
      <v-spacer></v-spacer>
			<v-select
				v-model="classroom_timetable.classroom_id"
				:items="classrooms"
				item-text="title"
				item-value="id"
				menu-props="auto"
				label="Select Classroom"
				hide-details
				single-line
				v-on:change="onChangeClassroomSubject"
			></v-select>
      <v-spacer></v-spacer>
	 		<v-select
				v-model="classroom_timetable.batch_id"
				:items="batches"
				item-text="title"
				item-value="id"
				menu-props="auto"
				label="Select Batches"
				hide-details	
				single-line
			></v-select>
      <v-spacer></v-spacer>
      		<v-select v-model="classroom_timetable.subject_id"
				:items="subjects"
				item-text="title"
				item-value="id"
				menu-props="auto"
				label="Select Classroom Subject"
				hide-details
				single-line
			></v-select>
      <v-spacer></v-spacer>
			<v-date-picker 
				v-model="classroom_timetable.semester_start_date"
				label="Select Semester Start Date"
				dateFormat="dd-MM-yyyy"
				name="date"
				hide-calendar
			></v-date-picker>
      <v-spacer></v-spacer>
	  		<v-date-picker 
				v-model="classroom_timetable.semester_end_date"
				label="Select Semester End Date"
				dateFormat="dd-MM-yyyy"
				name="date"
				hide-calendar
			></v-date-picker>
      <v-spacer></v-spacer>
	  		<v-select
				:items="day_of_the_week"
				label="Day of the Week"
				v-model="classroom_timetable.day_of_the_week"
			></v-select>
      <v-spacer></v-spacer>
      		<v-time-picker 
				v-model="classroom_timetable.lecture_start_time"
				format="24hr"
				label="Lecture Start Time"
			></v-time-picker>
	  <v-spacer></v-spacer>
	  		<v-time-picker 
				v-model="classroom_timetable.lecture_end_time"
				format="24hr"
				label="Lecture End Time"
			></v-time-picker>
	  <v-spacer></v-spacer>
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
			v => !!v || "Title is required",
			v => (v && v.length <= 20) || "Title must be less than 20 characters"
		],

		classroom_timetable: {
			title: '',
			description: '',
			department_id: '',
			classroom_id: '',
			batch_id: '',
			semester_start_date: '',
			semester_end_date:'',
			lecture_start_time: '',
        	subject_id: '',
			lecture_end_time:'',
			day_of_the_week:'',
			subjects:'',
		},
		departments: [],
		classrooms: [],
		batches: [],
		subjects: [],
		day_of_the_week: ['Monday', 'Tuesday', 'Wednesday','Thursday','Friday','Saturday','Sunday'],

	}),

	mounted() {
		this.getDepartments();
		this.getClassrooms();
		this.getBatches();
		this.onChangeClassroomSubject();
	},

	methods: {
		getDepartments() {
			axios.get("departments").then(
				res => {
					console.log(res.data);
					this.departments = res.data;
				},
				() => {
					console.log("error");
				}
			);
		},

		getClassrooms() {
			axios.get("classrooms").then(
				res => {
					console.log(res.data);
					this.classrooms = res.data;
				},
				() => {
					console.log("error");
				}
			);
		},
		getBatches() {
			axios.get("batches").then(
				res => {
					console.log(res.data);
					this.batches = res.data;
				},
				() => {
					console.log("error");
				}
			);
		},
		onChangeClassroomSubject() {
        this.classroom_timetable.classroom_id = ''
        axios
          .get(`/classrooms/${this.classroom_timetable.classroom_id}/subjects`)
          .then(response => {
            this.classroom_subjects = response.data
          })
          .catch(error => {
            console.log(error)
          })
     	},
		submit() {
			this.errors = {};
			//console.log(this.classroom);
			axios.post('/classroom_timetable/store', this.classroom_timetable).then(response => {
          console.log('Message sent!');
          this.$router.push('/classroom_timetable');
          }).catch(error => {
            if (error.response.status === 422) {
              console.log("error");
            }
          });
		}
	}
};
</script>
