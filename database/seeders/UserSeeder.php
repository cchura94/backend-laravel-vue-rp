<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // usuarios

        $u1 = new User();
        $u1->name = "admin";
        $u1->email = "admin@mail.com";
        $u1->password = bcrypt("admin54321");
        $u1->save();

        $u2 = new User();
        $u2->name = "gerente";
        $u2->email = "gerente@mail.com";
        $u2->password = bcrypt("gerente54321");
        $u2->save();

        $u3 = new User();
        $u3->name = "user";
        $u3->email = "user@mail.com";
        $u3->password = bcrypt("user54321");
        $u3->save();

        // Roles
        $r0 = new Role();
        $r0->name = "SUPER-ADMIN";
        $r0->save();

        $r1 = new Role();
        $r1->name = "ADMIN";
        $r1->save();

        $r2 = new Role();
        $r2->name = "GERENTE";
        $r2->save();

        $r3 = new Role();
        $r3->name = "CAJERO";
        $r3->save();

        // asignando roles a los usuarios
        $u1->roles()->attach($r1->id);
        $u2->roles()->attach([$r2->id, $r3->id]);
        $u3->roles()->attach($r3->id);

        // permisos

        $p0 = new Permiso();
        $p0->name = "Administrar Todo";
        $p0->action = "manage"; // index, create, show, edit, delete
        $p0->subject = "all";
        $p0->permiso = "manage_all";
        $p0->descripcion = "Permiso total";
        $p0->save();


        $p1 = new Permiso();
        $p1->name = "Listar Usuarios";
        $p1->action = "index"; // index, create, show, edit, delete
        $p1->subject = "user";
        $p1->permiso = "index_user";
        $p1->descripcion = "Listado de usuarios";
        $p1->save();

        $p2 = new Permiso();
        $p2->name = "Nuevo Usuario";
        $p2->action = "create"; // index, create, show, edit, delete
        $p2->subject = "user";
        $p2->permiso = "create_user";
        $p2->descripcion = "Creación de nuevos usuarios";
        $p2->save();

        $p3 = new Permiso();
        $p3->name = "Mostrar Usuario";
        $p3->action = "show"; // index, create, show, edit, delete
        $p3->subject = "user";
        $p3->permiso = "show_user";
        $p3->descripcion = "Mostrar usuario";
        $p3->save();

        $p4 = new Permiso();
        $p4->name = "Editar Usuario";
        $p4->action = "edit"; // index, create, show, edit, delete
        $p4->subject = "user";
        $p4->permiso = "edit_user";
        $p4->descripcion = "Editar usuario";
        $p4->save();

        $p5 = new Permiso();
        $p5->name = "Eliminar Usuario";
        $p5->action = "delete"; // index, create, show, edit, delete
        $p5->subject = "user";
        $p5->permiso = "delete_user";
        $p5->descripcion = "Eliminar usuario";
        $p5->save();

        // asignando permisos a roles;
        $r0->permisos()->attach($p0->id); // super admin

        $r1->permisos()->attach([$p1->id, $p2->id, $p3->id, $p4->id, $p5->id]);

        $r2->permisos()->attach([$p1->id, $p2->id, $p3->id, $p4->id]);

        $r3->permisos()->attach([$p1->id, $p3->id]);

    }
}
