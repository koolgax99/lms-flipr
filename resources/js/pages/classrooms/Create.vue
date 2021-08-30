<template>
	<v-card class="mx-auto p-4" width="700" raised>
		<v-form ref="form" v-model="valid" lazy-validation>
			<v-text-field
				v-model="classroom.title"
				:counter="20"
				:rules="titleRules"
				label="Title"
				required
			></v-text-field>
      <v-spacer></v-spacer>
			<v-text-field
				v-model="classroom.description"
				:rules="descriptionRules"
				:counter="200"
				label="Description"
				required
			></v-text-field>
      <v-spacer></v-spacer>
			<v-select
				v-model="classroom.department_id"
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
				v-model="classroom.class_teacher_id"
				:items="teachers"
				item-text="name"
				item-value="id"
				menu-props="auto"
				label="Select Class Teacher"
				hide-details
				single-line
			></v-select>
      <v-spacer></v-spacer>
      <v-dialog
        ref="dialog"
        v-model="modal"
        :return-value.sync="classroom.start_date"
        persistent
        width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="classroom.start_date"
            label="Academic Start Date"
            prepend-icon="event"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker v-model="classroom.start_date" scrollable>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="modal = false">Cancel</v-btn>
          <v-btn text color="primary" @click="$refs.dialog.save(classroom.start_date)">OK</v-btn>
        </v-date-picker>
      </v-dialog>

      <v-spacer></v-spacer>
      <v-menu
        v-model="menu2"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="classroom.end_date"
            label="Picker without buttons"
            prepend-icon="event"
            readonly
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker v-model="classroom.end_date" @input="menu2 = false"></v-date-picker>
      </v-menu>
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

		descriptionRules: [
			v => !!v || "Description is required",
			v => (v && v.length <= 200) || "Description must be less than 200 characters"
		],
		classroom: {
			title: '',
			description: '',
			department_id: '',
			class_teacher_id: '',
      start_date:'',
      end_date:'',
		},
		departments: [],
    teachers: [],
    modal:false,
    menu2:false,
	}),

	mounted() {
		this.getDepartments();
    this.getTeachers();
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
    getTeachers() {
			axios.get("getTeachers").then(
				res => {
					console.log(res.data);
					this.teachers = res.data;
				},
				() => {
					console.log("error");
				}
			);
		},
		submit() {
			this.errors = {};
			//console.log(this.classroom);
			axios.post('/classrooms/store', this.classroom).then(response => {
          console.log('Message sent!');
          this.$router.push('/classrooms');
          }).catch(error => {
            if (error.response.status === 422) {
              console.log("error");
            }
          });
		}
	}
};
</script>
