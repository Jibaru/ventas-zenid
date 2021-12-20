# Ventas Zenid

Proyecto final del curso de ADS 2021-2

## Configuración de la base de datos

Establecer las siguientes variables de entorno en el sistema:

`
ZENID_ADS_HOST
ZENID_ADS_BD_NAME
ZENID_SCRUM_BD_USER
ZENID_SCRUM_BD_PASSWORD
`

- Windows:

Ir a las variables de entorno del sistema y establecer las variables de acuerdo a la ruta: `Equipo -> Propiedades -> Configuración Avanzada del Sistema -> Variables de Entorno -> Nueva`. 
Probar el funcionamiento del sistema. Si no funciona, intentar cerrar sesión e iniciar nuevamente.

- Linux:

Abrir el archivo `~/.bash_profile` (dependiendo del shell a usar), y establecer las variables de entorno:

```
vim ~/.bash_profile
export ZENID_ADS_HOST=valor
...
```

Guardar el archivo y cerrar (`ctrl + wq`) y luego cerrar sesión e iniciar nuevamente.