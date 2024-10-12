# Proyecto Perfil Lipídico

Este proyecto fue desarrollado para BioSoft y tiene como objetivo mostrar el perfil lipídico de los pacientes mediante una interfaz web interactiva construida con Vue y Vuetify.

# Descripción del proyecto

Este sistema permite visualizar el perfil lipídico de los pacientes de Biosoft, brindando acceso a información crítica para la evaluación del estado de salud, como niveles de colesterol total, triglicéridos, HDL, LDL, y otros indicadores importantes. Los datos son presentados de manera clara y estructurada para facilitar su interpretación tanto por parte del paciente como del especialista.

Además, el sistema cuenta con una vista específica para los especialistas en la que pueden gestionar y revisar continuamente los perfiles de sus pacientes, monitoreando el estado de cada uno de ellos. Los especialistas pueden acceder de forma rápida a los resultados más recientes, permitiendo así un seguimiento detallado de la evolución del perfil lipídico de cada paciente.

El objetivo principal de este sistema es mejorar la toma de decisiones clínicas, facilitando el acceso a información clave y ofreciendo una plataforma intuitiva y responsiva para la gestión de datos de salud. Todo esto está integrado en una interfaz moderna y funcional, construida utilizando Vue y Vuetify, que aseguran una experiencia de usuario fluida y eficiente en cualquier dispositivo.

---

## **Características principales**
- Visualización detallada del perfil lipídico de cada paciente.
- Interfaz gráfica basada en **Material Design** con **Vuetify**.
- Gestión de pacientes e integración con la base de datos.
- Acceso seguro a la modificacion de los datos mediante autenticación.

---

## **Tecnologías utilizadas**
- **Vue** - Framework de JavaScript para la construcción de la interfaz de usuario.
- **Vuetify** - Librería de componentes basada en Material Design.
- **Axios** - Para la comunicación con la API que proporciona los datos del perfil lipídico.
- **Vue Router** - Para la gestión de rutas en la aplicación.
- **MySQL** - Para almacenar los perfiles de los pacientes.

---

## **Instalación**
Para configurar el proyecto localmente, sigue estos pasos:

1. Clona el repositorio:
   ```bash
   git clone https://github.com/LuEnciso21/Perfil_Lipidico_P.git
2. Instalación de dependencias del proyecto:
   ```bash
   npm install
3. Instalación de Vuetify:
    ```bash
   npm install vuetify

4. Iniciar el servidor de desarrollo:
    ```bash
   npm run dev


---

## **Ingreso al módulo especialista**
Usuario: angelower.santana
Contraseña: 123

---

## **Base de datos**
Para configurar la base de datos, sigue estos pasos:

1. Descarga el archivo `perfillipidico.sql`.
2. Abre **phpMyAdmin** en tu servidor local.
3. Crea una nueva base de datos (por ejemplo, `perfillipidico`).
4. Selecciona la base de datos recién creada.
5. Haz clic en la pestaña **Importar**.
6. Selecciona el archivo `perfillipidico.sql` desde tu computadora y haz clic en **Continuar** para importar la estructura y datos de la base de datos.

---

## **API**
Para configurar la API, realiza lo siguiente:

1. Navega a la carpeta de instalación de **XAMPP** en tu disco C (generalmente `C:\xampp`).
2. Localiza la carpeta `htdocs`.
3. Crea una nueva carpeta dentro de `htdocs` llamada `api`.
4. Copia el archivo `index.php` y pégalo dentro de la carpeta `api`.
5. Asegúrate de que el servidor de Apache esté en funcionamiento desde el panel de control de XAMPP.




