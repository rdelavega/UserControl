# UserControl

Control sobre usuarios (tipo y departamento al que son asignados).

## Ejercicio

Para este ejercicio debes generar un CMS, el cual debe contener:

  1. Inicio de sesión
  2. CRUD de Usuarios
  3. CRUD de Roles: (Roles disponibles: admin, usuario)
  4. CRUD de Departamento

## Consideraciones

  - El admin. debe ser capaz de crear más usuarios y asignarles un departamento.
  - Los usuarios nuevos deben ser capaces de iniciar sesión con username/email y
  contraseña.
  - Hay libertad creativa.
  - Puedes usar algún Template para el Frontend pero para el Backend será importante
  que uses PHP.
  - Se añadirán puntos si usas algún Framework como Laravel o Symfony.
  - Es importante compartir tu razonamiento y justificar tus decisiones.

## MVC (Modelo Vista Controlador)

### Controladores

  - **UserController:** Operaciones relacionadas a usuarios.
  - **DepartmentController:** Operaciones relacionadas a departamentos.
  - **SecurityController:** Autenticación.

### Entidades:

  - **User:** Información del usuario y datos de autenticación.

  | Encabezado | Descripción |
  | ------------- | ------------- |
  | id  | AUTOICREMENT  |
  | username  | string (180)  |
  | name  | string (180)  |
  | lname  | string (180)  |
  | email  | string (180)  |
  | image  | string (180)  |
  | roles  | array ['ROLE_ADMIN'] o ['ROLE_USER']  |
  | department  | inversed by user.id   |
  | password  | hashed password  |  

  - **Department:** Nombre del departamento al que puede ser asignado un usuario.

  | Encabezado | Descripción |
  | ------------- | ------------- |
  | id  | AUTOICREMENT  |
  | name  | string (255)  |

### Vistas

  - **User:**
    - index: Lista de usuarios registrados en el sistema.
    - profile: Pagina de inicio para usuarios de tipo no administrador.
    - add: Agregar nuevos usuarios al sistema.
    - edit: Editar información de usuarios ya registrados.
  - **Department:**
    - index: Lista de departamentos registrados en el sistema.
    - add: Agregar nuevos departamentos al sistema.
    - edit: Editar información de departamentos ya registrados.
  - **Security:** Página login del sistema.

### Formas

  - **UserType:** Reutilizable para agregar y editar.
  - **DepartmenType:** Reutilizable para agregar y editar.

## Instalación

  1. Posicionarse en directorio:
  ```bash
  cd UserControl
  ```
  2. Instalar dependencias:
  ```bash
  composer install
  ```
  3. Crear base de datos (reemplazar **$(user)** con usuario mysql):
  ```bash
  cat createDatabase.sql | mysql -u $(user) -p
  ```
  4. Configurar archivo `.env` Linea 32 (reemplazar **$(user)** y **$(pass)** con usuario y contraseña de mysql):
  ```
  DATABASE_URL=mysql://$(user):$(pass)@127.0.0.1:3306/usercontrol?serverVersion=5.7
  ```
  5. Crear tablas:
  ```bash
  php bin/console doctrine:schema:update --dump-sql
  php bin/console doctrine:schema:update --force
  ```
  6. Agregar usuarios de prueba (reemplazar **$(user)** con usuario mysql):
  ```bash
  cat addData.sql | mysql -u $(user) -p
  ```

## Ejecución

  Ejecutar en **localhost**:
  ```bash
  symfony server:start
  ```

## Usuarios de Prueba

  - Administrador
    - **Username:** admin
    - **Password:** password

  - Usuario
    - **Username:** user
    - **Password:** password

###### Made with :heart: in **CDMX**
