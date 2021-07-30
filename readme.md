Esta solución se basa en las imagenes elaboradas por Bitnami, las cuales son actualizadas con las nuevas versiones de Moodle.

https://github.com/bitnami/bitnami-docker-moodle

Esta solución fue probada en Ubuntu 04

Para ahorro de datos en Cuba se utilizó para las imagenes el mirror docker.uclv.cu el cual está abierto y gratis en la red nacional.

Requerimientos:
- Debe tener instalado docker
- debe tener instalado docker-compose
- Fue necesario instalar el plugin local-persist para lograr persistencia de los volumenes, (si no se siente cómodo usando plugins de terceros puede probar con el driver "local" incluido en docker para definir los volumenes locales). 

instalar el plugin local-persist con el comando:
curl -fsSL https://raw.githubusercontent.com/MatchbookLab/local-persist/master/scripts/install.sh | sudo bash


Una vez cumplidos los requerimientos modificar la ubicacion de los 3 volumenes en el archivo docker-compose a la ubicación deseada en su sistema.
	Ej.
	...
	   mountpoint: /home/cpalacios/Documents/dockering/moodle4/moodle_data
	...
Si lo desea puede modificar los puertos mapeados, actualmente el servicio http sale por el 80 y el https por el 443,
	Ej
	...
	  moodle:
	    image: docker.uclv.cu/bitnami/moodle:3
	    ports:
	      - '80:8080'
	      - '443:8443'
	...

correr con el comando

docker-compose up -d

detener con:

docker-compose down

Usuario: admin
Contraseña: Elinfdev.2021


Este contenedor incluye un campo de perfil ORCID para el trabajo en la integracion

Este Contenedor tiene incluido el plugin vivo en desarrollo, puede comprobar las consultas con eltoken de seguridad
92ad5e2af991d23cc1f9225a20b35ca8

ejemplo

localhost/webservice/rest/server.php?wsfunction=report_get_user_by_custom_field&customfield_name=orcid&customfield_value=0001-0001-0001-0001&moodlewsrestformat=json&wstoken=1eccee0dfe72f9f190c038a00e8ca68f

localhost/webservice/rest/server.php?wsfunction=report_get_courses_by_teacher_id&teacher_id=5&moodlewsrestformat=json&wstoken=1eccee0dfe72f9f190c038a00e8ca68f






