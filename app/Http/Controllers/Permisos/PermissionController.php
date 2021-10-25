<?php
namespace App\Http\Controllers\Permisos;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{   
    public function Permission()
    {

		$editUsers = new Permission();
		$editUsers->nombre = 'Subir archivo de memoria de estadia';
		$editUsers->permiso = 'student-file';
		$editUsers->save();

		$createTasks = new Permission();
		$createTasks->nombre = 'Revision de memoria tipo TUTOR';
		$createTasks->permiso = 'review-b';
		$createTasks->save();
		
		$editUsers = new Permission();
		$editUsers->nombre = 'Revision de memoria tipo DIRECTIVO';
		$editUsers->permiso = 'review-c';
		$editUsers->save();

		$editUsers = new Permission();
		$editUsers->nombre = 'Revision de memoria tipo BIBLIOTECA';
		$editUsers->permiso = 'review-d';
		$editUsers->save();

		$editUsers = new Permission();
		$editUsers->nombre = 'Acceso al catalogo de memorias de estadia';
		$editUsers->permiso = 'view-all-memories';
		$editUsers->save();

		$editUsers = new Permission();
		$editUsers->nombre = 'Asignacion de grupos';
		$editUsers->permiso = 'make-groups';
		$editUsers->save();

    	$review_permission = Permission::where('permiso','review-b')->first();
		$student_permission = Permission::where('permiso', 'student-file')->first();
		$review_c = Permission::where('permiso','review-c')->first();
		$review_d = Permission::where('permiso','review-d')->first();
		$review_catalog = Permission::where('permiso','view-all-memories')->first();
			
		//RoleTableSeeder.php
		
		//$dev_role->permissions()->attach($review_permission);
		//$dev_role->permissions()->attach($student_permission);
		//$dev_role->permissions()->attach($review_c);
		//$dev_role->permissions()->attach($review_d);
		//$dev_role->permissions()->attach($review_catalog);
		$dev_role = new Role();
		$dev_role->perfil = 'Alumno';
		$dev_role->nombre = 'Estudiante';
		$dev_role->save();
		$dev_role = new Role();
		$dev_role->perfil = 'director';
		$dev_role->nombre = 'Director de Carrera';
		$dev_role->save();
		//$dev_role->permissions()->attach($review_permission);

		$dev_role = new Role();
		$dev_role->perfil = 'biblioteca';
		$dev_role->nombre = 'Biblioteca';
		$dev_role->save();
		//$dev_role->permissions()->attach($review_permission);

		$dev_role = new Role();
		$dev_role->perfil = 'administrativo';
		$dev_role->nombre = 'Secretario(a)';
		$dev_role->save();

		$dev_role = new Role();
		$dev_role->perfil = 'PTC';
		$dev_role->nombre = 'Profesor de Tiempo Completo';
		$dev_role->save();
		//$dev_role->permissions()->attach($review_permission);

		$dev_role = new Role();
		$dev_role->perfil = 'PA';
		$dev_role->nombre = 'Profesor de Asignatura';
		$dev_role->save();

		$manager_role = new Role();
		$manager_role->perfil = 'tecnico';
		$manager_role->nombre = 'Técnico académico A';
		$manager_role->save();

		

		$dev_role = new Role();
		$dev_role->perfil = 'tutor';
		$dev_role->nombre = 'Tutor de grupo';
		$dev_role->save();
		//$dev_role->permissions()->attach($student_permission);
 
		$admin_rol = Role::where('perfil', 'Administrador')->first();
		$student_rol = Role::where('perfil','Alumno')->first();
		$teacher_role = Role::where('perfil', 'Profesor')->first();
		$principal_role = Role::where('perfil','Directivo')->first();
		$secre_role = Role::where('perfil', 'Administrativo')->first();
		
		
		$Admin = new User();
		$Admin->name = 'Admin';
		$Admin->email = 'admin@gm.com';
		$Admin->password = bcrypt('q1w2e3r4');
		$Admin->save();
		$Admin->roles()->attach($admin_rol);
 
		$student = new User();
		$student->name = 'Student';
		$student->email = 'student@gm.com';
		$student->password = bcrypt('q1w2e3r4');
		$student->save();
		$student->roles()->attach($student_rol);

		$direc = new User();
		$direc->name = 'Director';
		$direc->email = 'direc@gm.com';
		$direc->password = bcrypt('q1w2e3r4');
		$direc->save();
		$direc->roles()->attach($principal_role);

		$tutor = new User();
		$tutor->name = 'Tutor';
		$tutor->email = 'tutor@gm.com';
		$tutor->password = bcrypt('q1w2e3r4');
		$tutor->save();
		$tutor->roles()->attach($teacher_role);

		$secre = new User();
		$secre->name = 'Sectretari@';
		$secre->email = 'secre@gm.com';
		$secre->password = bcrypt('q1w2e3r4');
		$secre->save();
		$secre->roles()->attach($secre_role);


    }
}