<template>
	<v-card class="mx-auto p-4" width="700" raised>
		<v-form ref="form" v-model="valid" lazy-validation>
			<v-select
				v-model="department_teachers.department_id"
				:items="departments"
				item-text="title"
				item-value="id"
				menu-props="auto"
				label="Select Department"
				hide-details
				single-line
			></v-select>

			<v-select
				v-model="department_teachers.teacher_id"
				:items="teachers"
				item-text="name"
				item-value="id"
				menu-props="auto"
				label="Select Teacher"
				hide-details
				single-line
			></v-select>
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

		department_teachers: {
			department_id: '',
			teacher_id: '',
		},
		departments: [],

		teachers: [],
	}),

	mounted() {
		this.getDepartments();
		this.getTeachers();
	},

	methods: {
		getDepartments() {
			axios.get('departments')
			.then(response =>{
				this.departments = response.data;
			})
			.catch(error => {
				console.log('error')
			})
		},

		getTeachers() {
			axios.get('getTeachers')
			.then(response =>{
				this.teachers = response.data;
			})
			.catch(error => {
				console.log('error')
			})
		},


		submit() {
			this.errors = {};
			//console.log(this.classroom);
			axios.post('/department_teachers/store', this.department_teachers).then(response => {
          console.log('Message sent!');
          this.$router.push('/department_teachers');
          }).catch(error => {
            if (error.response.status === 422) {
              console.log("error");
            }
          });
		}
	}
};
</script>
