# Laravel Boolfolio - Base

Creiamo con Laravel il nostro sistema di gestione del nostro Portfolio di progetti.

## Todo 15/06

Iniziamo un nuovo progetto usando laravel breeze ed il pacchetto Laravel 9 Preset con autenticazione.

Breeze
```
composer require laravel/breeze --dev

php artisan breeze:install
```

Preset Laravel + Scss + Bootstrap
```
composer require pacificdev/laravel_9_preset

php artisan preset:ui bootstrap --auth
```
Separamo gli ambienti Guest da quelli Admin per quanto riguarda stili, js, controller, viste e layout.


## Install

Download zip or clone repository (if you clone it remember to delete the git file from the folder before start)

- install all dependencies

```
npm i 

composer i 

npm i vue@next

npm i @vitejs/plugin-vue --force

```

- Duplicate the file  ".env.example" and rename it to ".env", then compile it with your db datas and generate key

```
php artisan key:generate
```

- Create a symbolic link to receve uploaded images

```
php artisan storage:link
```



## ToDo laravel Boolfolio api
<br>

### **Milestone 1**
nome repo 1: laravel-api
Aggiungiamo al nostro progetto Laravel una nuovo **Api/ProjectController**. Questo controller risponderà a delle richieste via API e si occuperà di restituire la lista dei progetti presenti nel database in formato json.
### **Milestone 2**
Testiamo la chiamata API tramite Postman o Tunder Client e assicuriamoci di ricevere i dati correttamente.
### **Milestone 3**
nome repo 2: vite-boolfolio
Iniziamo ad occuparci della parte front-office della nostra applicazione: creiamo un nuovo progetto Vue 3 con Vite e installiamo axios.
Colleghiamo questo progetto ad una repo separata.
### **Milestone 4**
Nel componente principale della nostra Vue App facciamo una chiamata API all’endpoint costruito nel progetto Laravel (milestone 1) e recuperiamo tutti i progetti dal nostro back-end.
Stampiamo in console i risultati e verifichiamo di ricevere i dati correttamente.
### **Milestone 5**
Creiamo un nuovo componente ProjectCard, che corrisponde ad una card per visualizzare un progetto. Utilizziamo questo componente per visualizzare tutti i progetti ricevuti tramite API.
