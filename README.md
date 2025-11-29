# How to initially run

```
cd POC
composer install
npm install
cd ..
php artisan key:generate
type nul > database\database.sqlite
php artisan key:generate
php artisan migrate:fresh
php artisan serve
```

With the use of Herd just add the project to Herd instead of `php artisan serve`

## Sequence diagramm
```mermaid
sequenceDiagram
    actor A as user
    participant R as Router
    participant M as Middleware (Auth)
    participant V as View
    participant C as Controller
    participant D as Database

    A ->> R: GET /
    R ->> M: Request

    alt not Authenticated & Authorized
        M ->> A: Redirect /login
        A ->> R: GET /login 
        R ->> C: serveLogin()
        C ->> V: view()
        V ->> R: RenderedView
        R ->> A: Response 
    else Authenticated & Authorized
        M ->> C: getHome
        C ->> D: Request Data
        C ->> V: view(data)
        V ->> R: RenderedView
        R ->> A: Response 
    end
```