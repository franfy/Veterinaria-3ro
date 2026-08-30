#!/bin/bash



#############
# Variables #
#############
op=1



#############
# Funciones #
#############
# NAME: EncenderSerivicios
# INFO: Inicia los servicios de mysql y apache usando xampp
function EncenderServicios {
	sudo /opt/lampp/lampp startmysql
	sudo /opt/lampp/lampp startapache
}



# NAME: EncenderServidor
# INFO: Enciende el demonio del servidor
function EncenderServidor {
	echo "Enciende el servidor..."
}


# NAME: EstadoDeServicios
# INFO: Muestra el estado de los servicios que utiliza el software
function EstadoDeServicios {
	sudo /opt/lampp/lampp status
}


# NAME: ApagarServicios
# INFO: Apaga los servicios de mysql y apache usando xampp
function ApagarServicios {
	sudo /opt/lampp/lampp stopmysql
	sudo /opt/lampp/lampp stopapache
}


# NAME: ApagarServidor
# INFO: Apaga el servidor
function ApagarServidor {
	echo "Apagando el servidor..."
}


# NAME: BackupProyecto
# INFO: Realiza una copia del software dentro del directorio .local/ del usuario
function BackupProyecto {
	echo "Respaldando proyecto en: /home/{$USER}/.local/Veterinaria/Backup/software/"
}


# NAME: BackupBDD
# INFO: Realiza una copia de la base de datos dentro del directorio .local/ del usuario
function BackupBDD {
	echo "Respaldando base de datos en: /home/$USER/.local/Veterinaria/Backup/BDD.json"
}


# NAME: Resultados
# INFO: Funcion meramente estetica para poder direferenciar mas claramente entre el menu y el resultado de un comando
function Resultados {
	echo "----------------------------------------------------"
	echo "|          Resultados de la funcionalidad          |"
	echo "----------------------------------------------------"
}



##################
# Menu Principal #
##################
clear
while (( $op != 0 )); do
	
	echo "----------------------------------------------------"
	echo "|                    Servidor                      |"
	echo "----------------------------------------------------"
	echo "|1- Iniciar servicios                              |"
	echo "|2- Iniciar servidor                               |"
	echo "|3- Comprobar estado de servicios                  |"
	echo "|4- Apagar servicios                               |"
	echo "|5- Apagar servidor                                |"
	echo "----------------------------------------------------"
	echo "|                     Backup                       |"
	echo "----------------------------------------------------"
	echo "|6- Realizar copia de seguridad del proyecto       |"
	echo "|7- Realizar copia de seguridad de la base de datos|"
	echo "----------------------------------------------------"
	echo "|                     Otros                        |"
	echo "----------------------------------------------------"
	echo "|0- Salir del Script                               |"
	echo "----------------------------------------------------"
	echo "Elige una opcion: "
	read op

	if (( $op == 1 )); then
		clear
		Resultados
		EncenderServicios

	elif (( $op == 2 )); then
		clear
		Resultados
		EncenderServidor

	elif (( $op == 3 )); then
		clear
		Resultados
		EstadoDeServicios

	elif (( $op == 4 )); then
		clear
		Resultados
		ApagarServicios

	elif (( $op == 5 )); then
		clear
		Resultados
		ApagarServidor

	elif (( $op == 6 )); then
		clear
		Resultados
		BackupProyecto

	elif (( $op == 7 )); then
		clear
		Resultados
		BackupBDD

	else
		clear
		Resultados
		echo "La opcion $op no es valida..."
	fi

done



clear
echo "Fin del programa..."
