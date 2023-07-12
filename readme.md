Sistema de Gestion de Pedidos
Instituto de Formacion Docente y Tecnica Nº166

Tipo de Documento
Especificacion de Requerimientos del Sistema

A quién está dirigido
“Calabaza” Casa de Comidas

Resumen

En este documento se establecen los objetivos y requisitos para el desarrollo de un sistema de control de pedidos en el cual se den de alta los mismos seleccionando un plato de la carta o menu del dia, tambien se lleve a cabo un control de stock de mercaderia y la administracion con los proveedores. El sistema sera utilizado por la casa de comidas para optimizar sus operaciones y mejorar la experiencia con el cliente
Fecha	        Autor/es	        Versión Documento	Versión Software
Julio/2023	Virginia Cifarelli
            Emanuel Clementi	             2.0	

Sistema de Gestion Para Casa de Comidas
Se requiere un sistema de control de pedidos en el cual se den de alta los mismos seleccionando un plato de la carta o menu del dia. Tambien se requiere que el sistema pueda llevar a cabo un control del stock disponible de mercaderia e ir gestionando el mismo. Los datos de los proveedores de cada producto de la mercaderia tambien se tienen que poder almacenar y gestionar.

Objetivos:
•	Desarrollar un sistema que permita dar de alta y gestionar pedidos, seleccionando platos de la carta o el menu del dia.
•	Desarrollar una funcionalidad de control de stock para hacer un seguimiento de la disponibilidad de la mercaderia utilizada en los platos.
•	Proporcionar una funcionalidad para almacenar y gestionar los datos de los proveedores de cada producto de la mercaderia.

Requerimientos
Gestion de Pedidos:
-	Dar de alta y gestionar pedidos registrando los platos seleccionados.
-	Permitir la personalizacion de los platos, como opciones de ingredientes adicionales.
-	Generar un resumen del pedido con los detalles del cliente y los platos seleccionados.
Control de Stock:
-	Mantener un registro actualizado del stcok de mercaderia disponible.
-	Restar automaticamente las cantidades usadas al registrar los pedidos.
-	Generar alertas cuando el stock llegue a un minimo predefinido.
Gestion de Proveedores:
-	Almacenar y gestionar los datos de los proveedores, como el numero de proveedor, el nombre, datos de contacto y descripcion de los productos suministrados.
-	Asociar cada producto de la mercaderia a su proveedor.

Modelo Entidad-Relacion
A continuacion se muestra el modelo entidad-relacion de los datos que se obtuvieron anteriormente.
Atributos de las Entidades:

Cliente        Pedido            	Menu-Plato  	Ingredientes     Proveedor
ID Cliente     ID Pedido            ID Menu		    Nombre	         ID Proveedor
Nombre         ID Menu-plato        Nombre		    Tipo		     Nombre
Apellido       Fecha                Descripcion		Proveedor	     Descripcion
Direccion      Forma de Pago	    ID Ingredientes                  Tipo_Producto
Telefono	   ID Cliente                                            Telefono
Direccion

Cronograma Estimado:
Desarrollo del Sistema: 6 a 8 semanas.
Pruebas: 1 semana

Recursos Previstos:
Desarrolladores de software (2 personas):
-	Virginia Cifarelli
-	Emanuel Clementi
Recursos tecnicos:
-	Hardware: Computadoras personales (PC y Notebook)
-	Software: Se utilizara el entorno de desarrollo Visual Studio Code, junto con GitHub para el almacenamiento y control de versiones.
