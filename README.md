# Manual de Instalación y Configuración del Entorno de Desarrollo

Este documento muestra al detalle los pasos a seguir necesarios para replicar el entorno de desarrollo del proyecto en una máquina virtual.

---

## 1. Requisitos de Software

El entorno fue configurado y probado utilizando las siguientes versiones específicas:

* Sistema Operativo: Fedora Server 44
* Servidor Web: Apache 2.4.65
* Base de Datos: PostgreSQL 16
* Lenguaje Programación: PHP 8.5

## 2. Instalación y configuración del servidor

A continuación sigue estos pasos en la terminal de Fedora Server para poder instalar y activar los servicios necesarios.

Paso 1: Actualizar el Sistema

Antes de comenzar asegurate de que todos los paquetes del sistema estén actualizados:

sudo dnf update -y

----------------------------------------------------------

Paso 2: Instalación de Apache

Primero instale el servidor web Apache:

sudo dnf install httpd -y 

Luego inicie el servicio y configurelo para que este se ejecute de manera automática al arrancar el sistema:

sudo systemctl start httpd
sudo systemctl enable httpd

----------------------------------------------------------

Paso 3: Instalación de PHP 8.5 y Extensiones

Primero asegúrese de que tenga habilitado el repositorio Remi que este es necesario para las últimas verssiones de PHP en Fedora:

sudo dnf install https://rpms.remirepo.net/fedora/remi-release-44.rpm -y
sudo dnf module reset php
sudo dnf module enable php:remi-8.5 -y

Siguiendo, luego de eso instale PHP junto con las extensiones requeridas para conectar con PostgreSQL y el manejo del proyecto:

sudo dnf install php php-cli php-common php-pdo php-pgsql php-mbstring php-xml php-json -y

Ahora, reinicie Apache para cargar PHP

sudo systemctl restart httpd

----------------------------------------------------------

Paso 4: Instalación y Configuración de PostgreSQL 16

Primero, instale el servidor y el cliente de PostgreSQL:

sudo dnf install postgresql-server postgresql-contrib -y

Segundo, inicialice la base de datos:

sudo postgresql-setup --initdb

Por último inicie el servicio y habilítelo para que arranque:

sudo systemctl start postgresql
sudo systemctl enable postgresql

Paso 5: Configuración del Firewall

Para que Fedora permita el acceso web y las conexiones desde el exterior, ejecute los siguientes comandos:

sudo firewall-cmd --permanent --add-service=http
sudo firewall-cmd --permanent --add-service=https
sudo firewall-cmd --permanent --add-service=ssh
sudo firewall-cmd --reload

----------------------------------------------------------

## 3. Configuración del Entorno de Trabajo Local

Ahora, para desarrollar de manera cómoda, se recomienda conectar el entorno local con la Máquina Virtual.

3.1 Requisitos Previos de Red

Para que el host y la máquina virtual puedan comunicarse, la MV debe estar configurada en la plataforma de virtualización con un adaptador de red en modo Puente o Anfitrión.

Primero en la terminal de Fedora, ejecute el siguiente comando para identificar la dirección IP asignada:

ip a

Ahora, busque la interfaz de red activa y anote la dirección IP de tipo local.

3.2. Conexión Remota mediante Visual Studio Code

El desarrollo se realizará de forma remota utilizando el protocolo SSH. A continuación siga estos pasos en la máquina local:

Primero, la instalación de la extensión. Abra Visual Studio Code en el sistema local, acceda al apartado donde dice Extensiones e instale la extensión oficial, Remote - SSH, desarrollada por Microsoft.

Segundo, toca establecer la conexión. Presione la tecla "F1" para desplegar la paleta de comandos, luego seleccione la opción "Remote-SSH: Connect to Host". Continuando, introduzca la cadena de conexión con el siguiente formato: "usuario_fedora@IP_DE_LA_MV". Seleccione "Continuar" ante la alerta de huella digital del servidor e introduzca la contraseña del usuario cuando el sistema se lo solicite. Ya por último, el acceso al Directorio del Proyecto, una vez establecida la conexión vaya a Archivo > Abrir carpeta y especifíque la ruta raíz del servidor web Apache.

----------------------------------------------------------

## 4. Extensiones recomendadas en el Entorno Remoto

Una vez ya conectado al servidor mediante SSH, se sugiere para una mayor comodidad instalar las sigueinnte extensiones:

PHP intelephense: 
Este proporciona un autocompletado inteligente, ánalisis de código en tiepo real y formateo para PHP 8.5

PostgreSQL (Chris Kolkman): Este permite explorar bases de datos, tablas y ejecutar consultas SQL directamente desde un panel lateral en VS Code.

EditorConfig for VS Code: Este garantiza que los saltos de línea y las indentaciones se mantengan uniformes independientemente del sistema operativo del desarrollador.

----------------------------------------------------------

## 5. Verificación del Entorno

Por último, para commprobar que todo está operando correctamente, realize las siguiente pruebas finales:

Verificación de Apache y PHP

En la terminal de la MV, cree un archivo de prueba en el directorio raíz:

echo "<?php phpinfo(); ?>" | sudo tee /var/www/html/info.php

Luego, desde el navegador de su máquina local, acceda a: http://IP_DE_LA_MV/info.php

El resultado esperado, es que se despliegue una pantalla de información de PHP con la versión 8.5

Verificación de PostgreSQL

Primero, acceda a la consola interactiva de a base de datos con el siguiente comando:

sudo -i -u postgres psql

El resultado esperado es que el prompt cambiará a postgres=#, indicando que el motor responde correctamente. Escriba \q y presione Enter para salir.
