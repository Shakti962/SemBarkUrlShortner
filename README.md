# SemBark URL Shortener

## Project Setup

Follow these steps to set up the project on your local machine:

1. **Clone the repository**: Pull the code from Git using `git clone <repository-url>`.

2. **Install PHP dependencies**: Run `composer install` to install all the required PHP packages.

3. **Install Node.js dependencies**: Run `npm install` to install all the required Node.js packages.

4. **Set up environment**: Copy the `.env.example` file to `.env` and configure your database and other settings.

5. **Generate application key**: Run `php artisan key:generate` to generate the application key.

6. **Run migrations and seeders**: Execute `php artisan migrate --seed` to set up the database tables and populate initial data.

7. **Build assets**: Run `composer run dev` to compile and serve the frontend assets.

## Custom Flow

As mentioned in the assignment guidelines, there was some unclearity regarding the invite flow, so I implemented a custom flow for better clarity:

- Newly registered users who do not belong to any company (i.e., `company_id` is null) cannot access the application's features. This is enforced using the `HasCompany` middleware.

- When the super admin invites such a user to join a company with a specific role, the user is directly assigned to that role without needing to accept or reject the invite.

- However, users who already belong to a company can receive invite requests and choose to accept or reject them. Upon acceptance, their current company and role will be updated to the new one.

## AI Usage

I used ChatGPT for debugging various issues during development and for creating the `UrlFactory` and VSCode Copilot for Readme Generation.

Additionally, I used ChatGPT and Google search for syntax checks and references related to Laravel 12 and Livewire.

## Technologies Used

- **Jetstream**: Utilized prebuilt Jetstream components for authentication, UI components, and other core features.

- **Livewire**: Used for quick UI updates without page reloads, enabling a smoother user experience.

- **Tailwind CSS**: Employed for styling the application with a utility-first CSS framework.

## Notes on Simplicity

For simplicity and to keep the project straightforward, I did not implement caching or queues. However, if the application needs to be scaled in the future, these can be added for better performance and optimization.
