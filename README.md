# IT-TALK 🗨️
**IT-TALK** is a social media platform designed for dynamic content management and user interaction. The application fosters a community environment through a robust system of posts, comments, and global valuations.

### ✨ Key Features
- **Content Management:** Users can create, edit, and delete their own posts and comments with built-in authorship validation.

- **Social Interaction:** Implements a reactive "like" system that applies to both publications and comments.

- **Influencer Ranking:** Features a specialized algorithm that highlights top users based on the total number of likes received across all their content.

- **Access Control:** Utilizes a tiered role system (Admin, Moderator, User) to secure sensitive actions and administrative panels.

- **Profile & Security:** Includes a personal configuration panel for updating user information and managing secure password changes.

### 🛠️ Tech Stack
- **Framework**: Laravel.

- **Authentication**: Managed via Laravel Breeze.

- **Permissions**: Integrated Spatie Roles & Permissions for scalable and professional access control.

- **Database**: Designed with polymorphic many-to-many relationships to efficiently manage interactions across different models.

### 🚀 Quick Setup
To deploy the database schema and populate it with test users and initial data, run the following command:
```
php artisan migrate:refresh --seed
```

### Test Credentials 🔑
You can explore the platform using these pre-configured profiles:
| Role       | Name | Email           | Password |
|-----------|------|-----------------|----------|
| Admin     | admin| admin@admin.com | admin    |
| Moderator | mod  | mod@mod.com     | mod      |
| User      | user | user@user.com   | user     |
