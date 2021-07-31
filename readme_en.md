This solution is based on the images produced by Bitnami, which are updated with the new versions of Moodle.

https://github.com/bitnami/bitnami-docker-moodle

This solution was tested on Ubuntu 04

To save data in Cuba, the mirror docker.uclv.cu was used for the images, which is open and free on the national network.

Requirements:
- You must have docker installed
- you must have docker-compose installed
- It was necessary to install the local-persist plugin to achieve volume persistence, (if you don't feel comfortable using third-party plugins, you can try the "local" driver included in docker to define local volumes).

install the local-persist plugin with the command:
curl -fsSL https://raw.githubusercontent.com/MatchbookLab/local-persist/master/scripts/install.sh | sudo bash


Once the requirements are met, modify the location of the 3 volumes in the docker-compose file to the desired location on your system.
	Ex.
	...
	   mountpoint: /home/cpalacios/Documents/dockering/moodle4/moodle_data
	...

If you wish, you can modify the mapped ports, currently the http service goes out on 80 and https on 443,
	Ex.
	...
	  moodle:
	    image: docker.uclv.cu/bitnami/moodle:3
	    ports:
	      - '80:8080'
	      - '443:8443'
	...

run with command

docker-compose up -d

stop with:

docker-compose down

User: admin
Password: Elinfdev.2021


This container includes an ORCID profile field for work on integration

This Container includes the live plugin in development, you can check the queries with the security token
92ad5e2af991d23cc1f9225a20b35ca8

example

localhost/webservice/rest/server.php?wsfunction=report_get_user_by_custom_field&customfield_name=orcid&customfield_value=0001-0001-0001-0001&moodlewsrestformat=json&wstoken=1eccee0dfe72f9f190c038a00e8ca68f

localhost/webservice/rest/server.php?wsfunction=report_get_courses_by_teacher_id&teacher_id=5&moodlewsrestformat=json&wstoken=1eccee0dfe72f9f190c038a00e8ca68f
