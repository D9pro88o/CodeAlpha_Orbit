# Orbit 🪐

**Track. Assign. Deliver.**

Orbit is a collaborative project management tool — think Trello/Asana — built with Laravel and Livewire. Teams can create shared projects, organize work on kanban-style boards, assign tasks to members, and discuss work directly inside each task, with live updates pushed over WebSockets.

---

## Features

- **Authentication** — registration, login, password reset (Laravel Breeze)
- **Group Projects** — create projects and invite teammates by email
- **Kanban Boards** — custom task lists (columns) per project, fully editable
- **Task Cards** — title, description, assignee, due date
- **Comments** — threaded discussion inside each task
- **Notifications** — in-app alerts for task assignment, comments, and project invites
- **Real-time updates** — board changes and notifications push live via WebSockets (Laravel Reverb) — no page refresh needed
- **Access control** — project-level policies ensure only owners/members can view, edit, or delete what they should

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | Laravel 12 |
| Frontend | Livewire 3 (server-driven, no separate JS framework) |
| Styling | Tailwind CSS (custom design system — see below) |
| Real-time | Laravel Reverb (WebSocket server) + Laravel Echo |
| Auth scaffolding | Laravel Breeze (Livewire stack) |
| Database | MySQL (or SQLite for local dev) |

---

## Architecture Overview

### Data model

```
User
 ├── owns many Projects
 ├── belongs to many Projects (via project_user pivot, with role: owner/member)
 └── has many Comments

Project
 ├── belongs to one User (owner)
 ├── belongs to many Users (members)
 └── has many TaskLists

TaskList (kanban column)
 ├── belongs to Project
 └── has many Tasks

Task
 ├── belongs to TaskList
 ├── belongs to User (assignee, nullable)
 ├── belongs to User (creator)
 └── has many Comments

Comment
 ├── belongs to Task
 └── belongs to User
```

### Why Livewire instead of a separate API + SPA

Orbit's UI is mostly server-driven interactive state (boards, cards, modals, comment threads) — a natural fit for Livewire's model, where each component acts as its own controller + view. This avoids the overhead of a separate REST/JSON API and frontend framework for a project of this scope, while still supporting live, reactive UI.

### Real-time layer

Two categories of events broadcast over private, per-user or per-project WebSocket channels via **Laravel Reverb**:

- **Notifications** (`App.Models.User.{id}` channel) — task assignment, comments, and project invites
- **Board updates** (`project.{id}` channel) — task/list created, updated, deleted — so all project members see the board update live, without refreshing

Livewire components subscribe to these channels using `echo-private:` listeners, so incoming events trigger a re-render automatically.

---

## Local Setup

### Requirements

- PHP 8.3+ (see note on PHP 8.5 below)
- Composer
- Node.js + npm
- MySQL or SQLite

### Installation

```bash
git clone <your-repo-url> orbit
cd orbit

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Configure your database in `.env`, then:

```bash
php artisan migrate
php artisan notifications:table
php artisan migrate

php artisan install:broadcasting   # sets up Reverb + Echo, if not already configured
```

### Running the app (3 processes, each in its own terminal)

```bash
php artisan serve          # the app itself — http://127.0.0.1:8000
php artisan reverb:start   # WebSocket server for real-time updates
npm run dev                # Vite asset bundling / hot reload
```

### Known compatibility note

A class-name collision (`Comment`) was observed on **PHP 8.5** due to its new native DOM extension classes. If you hit `Call to private Dom\Node::__construct()`, either explicitly `use App\Models\Comment;` wherever it's referenced, or run the project on PHP 8.3/8.4 instead.

---

## Design System

Orbit's visual identity is built around a "mission control" aesthetic — dark instrument-panel chrome paired with a light workspace canvas, echoing the literal orbital-mechanics theme of the app's name.

| Token | Hex | Use |
|---|---|---|
| Ink Navy | `#12182B` | Nav bar, chrome |
| Panel Slate | `#1D2540` | Hover/secondary dark surfaces |
| Canvas | `#EDEEE9` | Main workspace background |
| Signal Amber | `#E8A33D` | Primary actions, active states |
| Orbit Teal | `#2F8F8C` | Links, secondary accents |
| Ink Text | `#1A1F2C` | Body text |

**Type:** Space Grotesk (headings), IBM Plex Sans (body), IBM Plex Mono (metadata/labels)

**Signature element:** every user avatar is a navy initials-badge wrapped in a thin dashed teal ring — an "orbit ring" — used consistently for assignees, commenters, and project members.

---

## Project Structure Highlights

```
app/
  Livewire/            → all interactive UI components (projects, boards, tasks, comments, notifications)
  Models/              → Eloquent models (Project, TaskList, Task, Comment, User)
  Notifications/       → TaskAssigned, TaskCommented, AddedToProject
  Events/              → TaskCreated, TaskUpdated, TaskDeleted, TaskListCreated (broadcast events)
  Policies/            → ProjectPolicy (view/update/delete/addMember authorization)

resources/views/
  livewire/            → Blade views paired with each Livewire component
  components/          → shared Blade components (orbit-avatar, form inputs, etc.)
  layouts/             → app shell + guest/auth layout

routes/
  web.php              → page routes (mostly routed directly to Livewire components)
  channels.php         → private broadcast channel authorization
```

---

## Roadmap / Possible Next Steps

- Drag-and-drop task reordering between lists (Sortable.js + Alpine)
- Email notifications alongside in-app/database ones
- Task due-date reminders
- File attachments on tasks
- Activity log per project

---

## Credits

Built as a learning project to practice full-stack Laravel + Livewire development, real-time features with Reverb, and applied UI design.
