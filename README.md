# UserControl

Control sobre usuarios (tipo y departamento al que sson asignados).

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

## Instalación

  1. Posicionarse en directorio:
  ```bash
  cd UserControl
  ```
  2. Instalar dependencias:
  ```bash
  composer install
  ```
  3. Crear base de datos **(reemplazar $(user) con usuario mysql)**:
  ```bash
  cat createDatabase.sql | mysql -u $(user) -p
  ```
  4. Crear tablas:
  ```bash
  php bin/console doctrine:schema:update --dump-sql
  php bin/console doctrine:schema:update --force
  ```
  5. Agregar usuarios de prueba **(reemplazar $(user) con usuario mysql)**:
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
    - **Username:** admin
    - **Password:** password

###### Made with :heart: in **CDMX**
