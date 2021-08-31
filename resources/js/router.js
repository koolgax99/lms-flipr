import VueRouter from 'vue-router'

// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import Dashboard from './pages/user/Dashboard'
import AdminDashboard from './pages/admin/Dashboard'
import RolesIndex from './pages/roles/Index'
import RolesCreate from './pages/roles/Create'
import RolesEdit from './pages/roles/Edit'
import DepartmentsIndex from './pages/departments/Index'
import DepartmentsCreate from './pages/departments/Create'
import DepartmentsEdit from './pages/departments/Edit'
import ClassroomsIndex from './pages/classrooms/Index'
import ClassroomsCreate from './pages/classrooms/Create'
import ClassroomsEdit from './pages/classrooms/Edit'
import BatchesIndex from './pages/batches/Index'
import BatchesCreate from './pages/batches/Create'
import BatchesEdit from './pages/batches/Edit'
import SubjectsIndex from './pages/subjects/Index'
import SubjectsCreate from './pages/subjects/Create'
import SubjectsEdit from './pages/subjects/Edit'
import Department_TeachersIndex from './pages/department_teachers/Index'
import Department_TeachersCreate from './pages/department_teachers/Create'
import Department_TeachersEdit from './pages/department_teachers/Edit'
import Classroom_TeachersIndex from './pages/classroom_teachers/Index'
import Classroom_TeachersCreate from './pages/classroom_teachers/Create'
import Classroom_TeachersEdit from './pages/classroom_teachers/Edit'
import Batch_TeachersIndex from './pages/batch_teachers/Index'
import Batch_TeachersCreate from './pages/batch_teachers/Create'
import Batch_TeachersEdit from './pages/batch_teachers/Edit'
import AssignmentsIndex from './pages/assignments/Index'
import AssignmentsCreate from './pages/assignments/Create'
import AssignmentsEdit from './pages/assignments/Edit'
import AssignmentsView from './pages/assignments/View'
import AssignmentsAnalysis from './pages/assignments/Analysis'
import Assignment_SubmissionsIndex from './pages/assignment_submissions/Index'
import Assignment_SubmissionsCreate from './pages/assignment_submissions/Create'
import Assignment_SubmissionsEdit from './pages/assignment_submissions/Edit'
import Assignment_SubmissionsView from './pages/assignment_submissions/View'
import Assignment_SubmissionsAddOrEditMarks from './pages/assignment_submissions/AddOrEditMarks'
import UsersIndex from './pages/user/Index'
import UsersCreate from './pages/user/Create'
import UsersEdit from './pages/user/Edit'
import ViewBatchStudents from './pages/batches/ViewStudents'
import ViewClassroomStudents from './pages/classrooms/ViewStudents'
import AttendanceCreate from './pages/attendance/Create'
import AttendanceIndex from './pages/attendance/Index'
import AttendanceView from './pages/attendance/View'
import MaterialsIndex from './pages/materials/Index'
import MaterialsCreate from './pages/materials/Create'
import MaterialsEdit from './pages/materials/Edit'
import NoticesIndex from './pages/notices/Index'
import NoticesCreate from './pages/notices/Create'
import NoticesEdit from './pages/notices/Edit'
import HolidaysIndex from './pages/holidays/Index'
import HolidaysCreate from './pages/holidays/Create'
import HolidaysEdit from './pages/holidays/Edit'
import Classroom_TimetableIndex from './pages/classroom_timetable/Index'
import Classroom_TimetableCreate from './pages/classroom_timetable/Create'
import Classroom_TimetableEdit from './pages/classroom_timetable/Edit'


// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: true
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },
  // USER ROUTES
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      auth: true
    }
  },
  // ADMIN ROUTES
  {
    path: '/admin',
    name: 'admin.dashboard',
    component: AdminDashboard,
    meta: {
      auth: {roles: 2, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },

  {
    path: '/roles',
    name: 'roles.index',
    component: RolesIndex,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/roles/create',
    name: 'roles.create',
    component: RolesCreate,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/roles/:id/edit',
    name: 'roles.edit',
    component: RolesEdit,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/departments',
    name: 'departments.index',
    component: DepartmentsIndex,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/departments/create',
    name: 'departments.create',
    component: DepartmentsCreate,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/departments/:id/edit',
    name: 'departments.edit',
    component: DepartmentsEdit,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/classrooms',
    name: 'classrooms.index',
    component: ClassroomsIndex,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/classrooms/create',
    name: 'classrooms.create',
    component: ClassroomsCreate,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/classrooms/:id/edit',
    name: 'classrooms.edit',
    component: ClassroomsEdit,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/classrooms/:classroom_id/students',
    name: 'classrooms.students',
    component: ViewClassroomStudents,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/batches',
    name: 'batches.index',
    component: BatchesIndex,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/batches/create',
    name: 'batches.create',
    component: BatchesCreate,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/batches/:id/edit',
    name: 'batches.edit',
    component: BatchesEdit,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/batches/:batch_id/students',
    name: 'batches.students',
    component: ViewBatchStudents,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/subjects',
    name: 'subjects.index',
    component: SubjectsIndex,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/subjects/create',
    name: 'subjects.create',
    component: SubjectsCreate,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/subjects/:id/edit',
    name: 'subjects.edit',
    component: SubjectsEdit,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/department_teachers',
    name: 'department_teachers.index',
    component: Department_TeachersIndex,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/department_teachers/create',
    name: 'department_teachers.create',
    component: Department_TeachersCreate,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/department_teachers/:id/edit',
    name: 'department_teachers.edit',
    component: Department_TeachersEdit,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/classroom/:id/teachers',
    name: 'classroom_teachers.index',
    component: Classroom_TeachersIndex,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/classroom/:id/teachers/add',
    name: 'classroom_teachers.create',
    component: Classroom_TeachersCreate,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/classroom/:classroom_id/teachers/:id/edit',
    name: 'classroom_teachers.edit',
    component: Classroom_TeachersEdit,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/batches/:batch_id/teachers',
    name: 'batch_teachers.index',
    component: Batch_TeachersIndex,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/batches/:batch_id/teachers/create',
    name: 'batch_teachers.create',
    component: Batch_TeachersCreate,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/batches/:batch_id/teachers/:id/edit',
    name: 'batch_teachers.edit',
    component: Batch_TeachersEdit,
    meta: {
      auth: { roles: 1 , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/assignments',
    name: 'assignments.index',
    component: AssignmentsIndex,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/assignments/create',
    name: 'assignments.create',
    component: AssignmentsCreate,
    meta: {
      auth: { roles: [1,6] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/assignments/:id/edit',
    name: 'assignments.edit',
    component: AssignmentsEdit,
    meta: {
      auth: { roles: [1,6] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/assignments/:id/view',
    name: 'assignments.view',
    component: AssignmentsView,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/assignments/analysis',
    name: 'assignments.analysis',
    component: AssignmentsAnalysis,
    meta: {
      auth: { roles: [1,6] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/assignments/:assignment_id/submissions',
    name: 'assignment_submissions.index',
    component: Assignment_SubmissionsIndex,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/assignments/:assignment_id/submissions/create',
    name: 'assignment_submissions.create',
    component: Assignment_SubmissionsCreate,
    meta: {
      auth: { roles: [1,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/assignments/:assignment_id/submissions/:id/edit',
    name: 'assignment_submissions.edit',
    component: Assignment_SubmissionsEdit,
    meta: {
      auth: { roles: [1,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/assignments/:assignment_id/submissions/:id/view',
    name: 'assignment_submissions.view',
    component: Assignment_SubmissionsView,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/assignments/:assignment_id/submissions/:id/add-marks',
    name: 'assignment_submissions.add_or_edit_marks',
    component: Assignment_SubmissionsAddOrEditMarks,
    meta: {
      auth: { roles: [1,6] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/attendance/create',
    name: 'attendance.create',
    component: AttendanceCreate,
    meta: {
      auth: { roles: [1,6] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/attendance',
    name: 'attendance.index',
    component: AttendanceIndex,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/attendance/:attendance_id/view',
    name: 'attendance.view',
    component: AttendanceView,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/study-materials',
    name: 'materials.index',
    component: MaterialsIndex,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/study-materials/create',
    name: 'materials.create',
    component: MaterialsCreate,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/study-materials/:id/edit',
    name: 'materials.edit',
    component: MaterialsEdit,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/notices',
    name: 'notices.index',
    component: NoticesIndex,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/notices/create',
    name: 'notices.create',
    component: NoticesCreate,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/notices/:id/edit',
    name: 'notices.edit',
    component: NoticesEdit,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/users',
    name: 'users.index',
    component: UsersIndex,
    meta: {
      auth: { roles: [1,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/users/create',
    name: 'users.create',
    component: UsersCreate,
    meta: {
      auth: { roles: [1,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/users/:id/edit',
    name: 'users.edit',
    component: UsersEdit,
    meta: {
      auth: { roles: [1,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/holidays',
    name: 'holidays.index',
    component: HolidaysIndex,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/holidays/create',
    name: 'holidays.create',
    component: HolidaysCreate,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/holidays/:id/edit',
    name: 'holidays.edit',
    component: HolidaysEdit,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/classroom_timetable',
    name: 'classroom_timetable.index',
    component: Classroom_TimetableIndex,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/classroom_timetable/create',
    name: 'classroom_timetable.create',
    component: Classroom_TimetableCreate,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
  {
    path: '/classroom_timetable/:id/edit',
    name: 'classroom_timetable.edit',
    component: Classroom_TimetableEdit,
    meta: {
      auth: { roles: [1,6,7] , redirect: {name: 'login'}, forbiddenRedirect: '/403' }
    }
  },
]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})

export default router
