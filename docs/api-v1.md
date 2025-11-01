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
-   Options:
    -   `page_mode=page|cursor` (default: page). Cursor mode forces `sort=id` for stability.
    -   `mine=1` (auth required to be effective), `done=0|1`, `q=...`
    -   `due_from=YYYY-MM-DD`, `due_to=YYYY-MM-DD`
    -   `sort=id|due_at|created_at|updated_at`, `order=asc|desc` (default: id, desc)
-   Filters:
    -   mine=1 (auth token required to be effective)
    -   done=0|1
    -   q=search term (title, description)
    -   due_from=YYYY-MM-DD, due_to=YYYY-MM-DD
    -   sort=id|due_at|created_at|updated_at (default: id), order=asc|desc (default: desc)
-   `GET /tasks/{id}`
-   `POST /tasks` (auth: Bearer) → create
-   `PUT/PATCH /tasks/{id}` (auth: Bearer) → update
-   `DELETE /tasks/{id}` (auth: Bearer) → delete
