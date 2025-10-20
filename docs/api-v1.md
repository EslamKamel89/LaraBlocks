# API v1 – Endpoints (LaraBlocks)

Base URL: `/api/v1`

## Auth

-   `POST /auth/login` → { token, user }
    -   Body: { email: string, password: string }
    -   Throttle: 10 req/min
-   `GET /user` (auth: Bearer) → current user

## Health

-   `GET /health` → { status, time, app }

## Tasks

-   `GET /tasks?per_page=20` → paginated list (cap 100)
-   `GET /tasks/{id}`
-   `POST /tasks` (auth: Bearer) → create
-   `PUT/PATCH /tasks/{id}` (auth: Bearer) → update
-   `DELETE /tasks/{id}` (auth: Bearer) → delete
