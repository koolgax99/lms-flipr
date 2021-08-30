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

// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
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
]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})

export default router
