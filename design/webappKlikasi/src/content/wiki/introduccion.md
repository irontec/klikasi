

# por cada proyecto

npm install

bower install


# empaquetar para distribuir

```
rm -R <proyecto>/node_modules
rm -R <proyecto>/app/bower_components
```

# Cada día

- abrir el terminal, pulsar espacio y comando -> spotlight
  - buscar terminal y enter.

- cd ~/directorio/proyecto

- abrir en el navegador http://localhost:9000/

# Yeoman

Yeoman aims to solve this problem by scaffolding workflows for creating modern webapps, while at the same time mixing in many of the best practices that have evolved within the industry.


### Instalar yeoman

```
  npm install -g yo
```

### Instalar un generador

```
  npm install -g generator-webapp generator-assemble
```


### Crear el esqueleto de un proyecto nuevo

```
  yo webapp

```

### Buscar bibliotecas

```
  bower search fancybox
```

### Instalar una biblioteca

```
  bower install fancybox --save
```

### Trabajar

```
  grunt serve
```


# ¿Qué hace yeoman por nosotros?

- Creación de esqueletos de un proyecto con templates personalizables.

- Compilación automática de Compass. El sistema LiveReload observa los cambios en los ficheros fuente y refresca el navegador automáticamente.

- Optimización de imágenes. Optimización automática de todas las imágenes con OptiPNG y JPEGTrans para minimizar los tiempos de carga.

- Gestión de paquetes. Facilidad de instalación y actualización de bibliotecas y sus dependencias.

- Servidor web de previsualización integrado.
 
- Proceso de construcción/compilación. No solo minimiza y concatena, también optimiza las imágenes, el html, compila Compass y Sass, y si usas AMD, pasará esos módulos a r.js.

- Verificación automática de scripts. Todos los scripts son comprobados con jshint para asegurar que cumplen las mejores prácticas de programación.

- PhantomJS Unit Testing — Easily run your unit tests in headless WebKit via PhantomJS. When you create a new application, I also include some test scaffolding for your app.


# GRUNT

Un gestor de tareas JavaScript.

### Arrancar el servidor web con nuestro proyecto

```
  Grunt serve
```

### Construir/compilar nuestro proyecto

```
  Grunt build
```

* Estas tareas han sido predefinidas gracias a la magia del generador de yeoman.


# Configurando Grunt: Gruntfile.js


## Configuracion de tareas

```
grunt.initConfig({
  concat: {
    // Configuración de la tarea concat
  },
  uglify: {
    // configuración de la tarea uglify
  },
  // información arbitraria
  config: {
    src: 'src',
    dist: 'dist'
  },
});

```

## Objetivos

```
grunt.initConfig({
  concat: {
    foo: {
      // opcions de la tarea concat y el objetivo foo.
    },
    bar: {
      // opcions de la tarea concat y el objetivo bar.
    },
  },
});
```

## Ficheros

```
grunt.initConfig({
  concat: {
    foo: {
      files: [
        {src: ['src/aa.js', 'src/aaa.js'], dest: 'dest/a.js'},
      ],
    },
    bar: {
      files: [
        {
          expand: true,     // Enable dynamic expansion.
          cwd: 'lib/',      // Src matches are relative to this path.
          src: ['**/*.js'], // Actual pattern(s) to match.
          dest: 'build/',   // Destination path prefix.
          ext: '.min.js',   // Dest filepaths will have this extension.
          extDot: 'first'   // Extensions in filenames begin after the first dot
        },
      ],
    },
  },
});
```

## Conclusión

Grunt es la herramienta que aplica tareas sobre nuestros ficheros.



# Bower

## Instalación de una biblioteca

```
bower install <package>#<version> --save
```

## ¿Dónde se instalarán los ficheros?

.bowerrc

```
{
  "directory": "public/bower_components"
}
```

## ¿Dónde se guardan los paquetes instalados?


bower.js

```
{
  "name": "webappassemble",
  "private": true,
  "dependencies": {
    "bootstrap-sass-official": "~3.1.0",
    "modernizr": "~2.6.2",
    "jquery": "~1.11.0"
  },
  "devDependencies": {}
}
```


# Assemble.io

Un generador de páginas estáticas para Node.js, Grunt.js y Yeoman.

- Permite dividir tu HTML en fragmentos reutilizables (a veces llamados partials, includes, sections, snippets...)

- Opcionalmente diseños (layouts) para envolver sus páginas con el contenido y elementos comunes. 

- Las páginas se puede definir como HTML/templates, JSON o YAML.

- Permite definir datos globales para toda la web: títulos, textos,... y redefinibles en cualquier página.




# Propuesta de trabajo

Estructura de directorios:

```
src/
├── content
│   ├── about.md
│   └── index.md
├── data
│   └── site.yml
└── templates
    ├── layouts
    │   ├── minisite.hbs
    │   └── default.hbs
    ├── pages
    │   ├── about.hbs
    │   ├── blog.hbs
    │   ├── showcase.hbs
    │   └── index.hbs
    └── partials
        ├── carousel.hbs
        ├── modal-window.hbs
        └── navbar-fixed-top.hbs
```

## Contenido

Aquí podemos guardar el contenido, en html o md

```
src/
└── content
    │   └── graficas/evolucion.html
    ├── about.html
    └── index.md
```

La intención es separar el contenido de las páginas



## Datos

Variables globales para todo el proyecto.

```
src/
└── data
    └── site.yml
```

Ejemplo de contenido de src/data/site.yml

```
title: Generator_tests
description: Irontec: Internet y Sistemas sobre GNU / LinuX
ogimage: images/Irontec.png
keywords: 
    - irontec
    - linux
    - GNU/Linux
```

Ejemplo de uso de estos datos en el html de una plantilla .hbs

```
<title>{{title}} | {{site.title}}</title>
<meta name="description" content="{{site.description}}">
<meta name="keywords" content="{{site.keywords}}" />
<meta property="og:image" content="{{site.ogimage}}"/>
```

# Layouts

Diseño principal de las páginas

```
src/
└── templates
    └── layouts
        ├── minisite.hbs
        └── default.hbs
```

El contenido de la página concreta se insertará en la etiqueta 
```\{{> body}}```

# Partials

Componentes reutilizables

```
src/
└── templates
    └── partials
        ├── carousel.hbs
        ├── modal-window.hbs
        └── navbar-fixed-top.hbs
```


Para incrustarlo en algún lugar simplemente escribimos 
```\{{> navbar-fixed-top }}```


# Páginas

```
src/
└── templates
    └── pages
        ├── about.hbs
        ├── blog.hbs
        ├── showcase.hbs
        └── index.hbs
```

Las páginas se añaden a una colleción de este modo aparecen mágicamente enlaces en la barra de título.
