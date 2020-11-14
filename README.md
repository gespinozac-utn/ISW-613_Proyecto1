# Universidad Técnica Nacional.
Carrera: Ingeniería del software.  
Curso:   Programación en ambiente web I.    
Alumno : Gustavo Espinoza Corrales.  
Profesor: Bladimir Arroyo.      
III Cuatrimestre 2020.

## Objetivos
Desarrollar habilidades en programación de aplicaciones web para el reforzamiento de los conocimientos adquiridos en clase.

## Requerimientos
La empresa de ventas en línea E-shop lo ha contratado a usted para que diseñe y entregue una aplicación web en la cual se podrán vender productos en línea.

### Funcionalidades
La aplicación debe cumplir con los siguientes requerimietos funcionales:
- [X] Existen dos tipos de usuarios: Administradores y Clientes.
- [X] Es necesario un usuario y una contraseña para poder ingresar al sistema ya sea como administrador o como cliente.
- [X] Existirá de manera predeterminada un usuario Administrador.
- [X] **Perspectiva de Administrador** 
    - [X] *Solo el usuario con rol de administrador tendrá acceso a esta sección si un usuario con otro rol intenta acceder deberá ser redireccionado ~~a una página que indique que no posee acceso a dicha funcionalidad~~ al dashboard.* 
    - [X] *La primera página de inicio mostrará las siguientes estadísticas (Dashboard)*:
        - [X] Cantidad de Clientes Registrados
        - [X] Cantidad de productos vendidos.
        - [X] Monto total de ventas.
    - [X] *El Administrador será capaz de Administrar Categorías, esto permitirá*
        - [X] Listar todas las categorías existentes.
        - [X] Crear una nueva categoría. Las categorías estarán compuestas por Nombre y Categoría Padre (opcional)
        - [x] Editar una categoria.
        - [X] Eliminar categorías, esto es posible solo si la categoría no tiene productos asociados.
    - [X] *El Administrador será capaz de Administrar Productos, esto permitirá*
        - [X] Listar todos los productos existentes.
        - [X] Crear un nuevo producto. Los productos estarán compuestos por:
            - [X] SKU, Nombre, Descripción, Imagen, Categoria (lista de categorías existentes), Stock, Precio.
            - [X] Editar un producto.
            - [X] Eliminar productos.
    - [X] *Cerrar sessión*
- [X] **Perspectiva de Cliente**
    - [X] Un usuario deberá registrarse para poder realizar compras. Un registro de cliente
    consiste en los siguientes datos:
        - [X] Nombre, Apellidos, Número de Teléfono, Correo Electrónico, Dirección, contraseña
    - [X] El usuario podrá ingresar al catálogo de productos. El catálogo listará todas las categorías y al darle click a la categoría mostrará las sub-categorías y los productos asociados a la categoría.
    - [X] Al darle click a un producto la aplicación mostrará el detalle del producto. Nombre, descripción, sku,imagen y un botón para agregar al carrito de compras.
    - [X] Los clientes pueden agregar artículos a su carrito de compras.
    - [X] Es posible ver el contenido del carrito de compras en cualquier momento para lo cual se mostrará un botón con el carrito en algún lugar para que esté siempre visible.
    - [X] Al darle click al carrito de compras se mostrará el detalle del carrito de manera que el usuario podrá eliminar elementos del carrito o proceder a la compra.
    - [X] Como pantalla de inicio después de autenticarse el usuario podrá ver una pantalla inicial de estadísticas:
        - [X] Total de productos adquiridos por el cliente
        - [X] Monto total de compras realizadas por el cliente
    - [X] Cuando el usuario hace “checkout”, el sistema debe generar una orden con los artículos del carrito de compras. A cada artículo comprado deberá disminuir la disponibilidad en stock.
    - [x] El cliente tendrá acceso a una sección donde puede ver todas las compras realizadas. En un listado se mostrará la fecha, y el monto total de cada compra, al darle click en Ver Orden se mostrará el detalle de la orden esto incluye los siguientes datos:
        - [x] Fecha de Compra
        - [X] Total de la Orden
        - [x] Items
            - [x] Cantidad
            - [X] Descripción
            - [X] Precio
- [X] ***Cronjob (php script)***
    - [X] Desarrollar un script que busque los productos con cierto nivel de stock y que el mismo envíe un correo electrónico al administrador con el asunto “Productos con bajo stock”, en el contenido del correo indicar el SKU de los productos con bajo stock. El script recibirá como parámetro el stock mínimo a consultar, de manera que si al ejecutar el script se envía como parámetro el número 3, entonces el script identificara y reportará aquellos productos cuyo stock es menor o igual a 3. 
