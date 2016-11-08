# Sass

[sass-lang.com]

# Ficheros

El fichero principal de SCSS definido en el proyecto es:

```
app/style/main.scss
```

Para modularizar el proyecto podemos usar partials, es decir, modulos que luego importaremos en el fichero main.scss. Un ejemplo es el propio bootstrap.


# Variables bootstrap

Todas las variables de bootstrap se encuentran en el fichero:

```
app/bower_components/bootstrap-sass-official/vendor/assets/stylesheets/bootstrap/_variables.scss
```

Deberemos definir las variables antes de importar bootstrap en el fichero app/styles/main.scss

```
$icon-font-path: "/bower_components/bootstrap-sass-official/vendor/assets/fonts/bootstrap/";


$gray-darker:            lighten(#000, 13.5%);
$gray-dark:              lighten(#000, 20%);
$gray:                   lighten(#000, 33.5%);
$gray-light:             lighten(#000, 60%);
$gray-lighter:           lighten(#000, 93.5%);

// bower:scss
@import 'bootstrap-sass-official/vendor/assets/stylesheets/bootstrap.scss';
// endbower

// El resto de código...
```

Los Mixins de bootstrap son muy interesantes:

```
app/bower_components/bootstrap-sass-official/vendor/assets/stylesheets/bootstrap/_mixins.scss
```




# Configurar SASS en el navegador

### Abrir el inspector de Chrome (botón de la derecha inspeccionar elemento)

![alt text](images/inspector.png "Logo Title Text 1")


### Añadir el directorio de trabajo a la carpeta workspaces

![alt text](images/workspace.png "Logo Title Text 1")


### Mapear el fichero proyecto/app/styles/main.scss a styles/main.css

En la pestaña sources del inspector buscar el fichero proyecto/app/styles/main.scss, pulsar botón derecho sobre el fichero y seleccionar la opción "Map to Network Resource"

![alt text](images/map.png "Logo Title Text 1")

Buscar el recurso localhost:9000/styles/main.css

![alt text](images/map2.png "Logo Title Text 1")

### En cada regla aplicada a cada elemento tendremos un enlace al fichero.

![alt text](images/inspector.png "Logo Title Text 1")
