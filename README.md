
# Acerca

MercaTodo es un e-commerce hecho en el framework [Laravel](https://laravel.com/) como proyecto de estudio de la Escuela de desarrolladores junior PHP impartido por [Evertec](https://www.evertecinc.com/). Incluye las siguientes funcionalidades:

- Gestión de productos y categorias.
- Administración de usuarios con sus roles y permisos.
- Carrito de compras.
- Gestión de ordenes para los clientes.

## Requerimientos
- PHP 8.0+ `required`
- MYSQL 5.7+ `required`


## Instalación

- Clone el repositorio:
```bash
$ git clone https://github.com/jomgarciaro/mercatodo.git
```
- Ingrese a la carpeta del repositorio:
```bash
$ cd mercatodo
```
- Si quiere acceder a todo el historial del desarrollo use el comando:
```bash
$ git fetch --all
```
- Instale las dependencias de PHP por medio del gestor [composer](https://getcomposer.org/download/):
```bash
$ composer install
```
- Instale las dependencias de NodeJS por medio del gestor [npm](https://nodejs.org/es/):
```bash
$ npm install
```
## Configuración

- Copié el archivo .env.example en .env y env.testing y luego agregue cada variables de entorno:
`DB_USERNAME` Usuario base de datos.  
`DB_PASSWORD` Password base de datos.  
`MAIL_USERNAME` Usuario Mailtrap para pruebas.  
`MAIL_PASSWORD` Password Mailtrap para pruebas.  
`MAIL_FROM_ADDRESS` Correo del sistema.  
`LOGIN_PLACETOPAY` Login de [PlaceToPay](https://docs-gateway.placetopay.com/docs/webcheckout-docs/ZG9jOjQxMjU1Njc-autenticacion).  
`TRANKEY_PLACETOPAY` Secret Key de PlaceToPay.  
`BASEURL_PLACETOPAY` Base URL DE PlaceToPay.

- Genere la llave de la aplicación:
```bash
$ php artisan key:generate
```
- Migre y siembre la base de datos:
```bash
$ php artisan migrate --seed
```
- Cree la conexión entre public y storage:
```bash
$ php artisan storage:link
```
- Cree las llaves para autentificación de la API:
```bash
$ php artisan passport:keys
```
- Corra los test de la aplicación y compruebe si la instalación y la configuración se hicieron correctamente.
```bash
$ php artisan test
```
## Contribuciones

Puedes hacer tus contribuciones mediantes pull request. Para cambios importantes primero crear un ISSUE.  

Asegurate de actualizar los test apropiadamente.

## License

**MercaTodo** es un proyecto bajo la licencia [MIT license](https://opensource.org/licenses/MIT).