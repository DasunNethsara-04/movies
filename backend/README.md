<p align="center">
    <img src="https://github.com/user-attachments/assets/ab329545-9c44-4e85-aabe-6f4dc0f0512c" alt="icon-192" width="192" height="192">
</p>
<h1 align="center">ZenithPHP</h1>

Welcome to **ZenithPHP**, a simple and lightweight PHP framework designed to streamline web application development. ZenithPHP follows the MVC (Model-View-Controller) architecture and provides developers with a clean and flexible foundation to build modern PHP applications with ease.

## Official Documentation
You can find the official documentation for ZenithPHP at [ZenithPHP Documentation](https://zenithphp-framework.github.io/start.html). The documentation provides detailed information on how to get started with ZenithPHP, including installation instructions, routing, controllers, models, views, and more.

## Features

- **MVC Architecture**: Keeps code organized by separating the business logic, presentation, and data layers.
- **Custom Routing**: Define clean and flexible routes for your application with ease.
- **Simple Namespacing**: Eliminate the need for `require_once` with proper namespacing.
- **Security Built-in**: Features like password hashing and input validation to keep your app secure.
- **Easy to Extend**: Customize the framework to suit your application’s needs with minimal effort.
- **Pluto Template Engine**: Simplifies view rendering with a clean syntax and powerful directives.

## Installation

To get started with ZenithPHP, follow the instructions below:

1. Clone the repository:
    ```bash
    git clone https://github.com/ZenithPHP-Framework/full-zenith-framework.git
    ```

2. Navigate to the project directory:
    ```bash
    cd full-zenith-framework
    ```

3. Install dependencies using Composer:
    ```bash
    composer install
    ```

4. Configure your environment:
    - Create a copy of the `.env.example` file and rename it to `.env`.
    - Set your database credentials and other necessary configurations.

5. Start your local development server:
    ```bash
    php cli run
    ```

6. Visit `http://localhost:8000` in your browser to see the landing page.

## Folder Structure

- **App/**: Contains the core application files.
- **Config/**: Configuration files like CORS for the application.
- **Core/**: The framework's core classes and functions.
- **View/**: Contains all view files (HTML/PHP templates).
- **Public/**: The main entry point for the application and assets (JS, CSS, images).
- **.env**: Environment variables for the application.
- **.env.example**: Example environment variables file.
- **composer.json**: Composer dependencies file.
- **cli**: Command-line interface for running the application and creating models and controllers.

## How to Get Started

To create your first route:

1. Open `App/routes.php` and define your route:
    ```php
    use ZenithPHP\Core\Http\Router;
    Router::get('/hello', 'WelcomeController', 'index');
    ```

2. Create a new controller (*WelcomeController.php*) inside `App/Controllers/`:
    ```php
    use ZenithPHP\Core\Controller\Controller;

    class WelcomeController extends Controller
    {
        public function index()
        {
            $this->view('welcome');
        }
    }
    ```

3. Now, create a new view file inside `View/welcome.php`:
    ```html
    <h1>Welcome to ZenithPHP</h1>
    ```

4. Visit `http://localhost:8000/welcome` to see the result.

## Working with APIs

Now you can create APIs with ZenithPHP. Here's how you can create a simple API:

1. First, create a new route in `App/routes.php`:
    ```php
    use ZenithPHP\Core\Http\Router;
    Router::get('/api/users', 'UserController', 'index');
    ```

2. Create a new model using the CLI tool:
    ```bash
    php cli make:model User
    ```

3. Implement the model method to fetch data from the database:
    ```php
    use ZenithPHP\Core\Model\Model;

    class User extends Model
    {
        protected string $table_name = 'users';
    }
    ```

4. Create a new controller. For that, you can use the CLI tool:
    ```bash
    php cli make:controller UserController
    ```

5. Implement the controller method to return JSON data:
    ```php
    use ZenithPHP\Core\Controller\Controller;
    use ZenithPHP\Core\Http\Response;
    use ZenithPHP\Core\Http\Request;
    use ZenithPHP\App\Models\User;

    class UserController extends Controller
    {
        public function index(Request $request, Response $response)
        {
            $user = new User($this->pdo);
            $allUsers = $user->getAll();
            $response->json(['status' => 'success', 'data' => $allUsers]);
        }
    }
    ```

6. Visit `http://localhost:8000/api/users` to see the JSON response.


## Pluto Template Engine

The **Pluto** template engine in ZenithPHP allows you to easily build dynamic views with clean and readable syntax. Here’s a quick overview of its directives:

### Pluto Syntax

- **Variable Output**: Use `<< $variable >>` to output PHP variables in the view.
- **Conditional Statements**: Pluto offers `@if`, `@elseif`, `@else`, and `@endif` directives for conditional rendering.
- **Looping**: Use `@foreach` and `@endforeach` to iterate over collections.
- **Comments**: Use `<< // >>` to add comments in your templates.
- **Yielding Sections**: Use `@yield` to define a section that will be replaced with content from child templates.
- **Section Definition**: Use `@section` to define a section that can be filled in child templates.

### Example Syntax
`HomeController.php`
```php
class HomeController extends Controller 
{
    public function index(Request $request, Response $response)
    {
        return view('home', [
            'username' => 'John Doe',
            'userRole' => 'admin',
            'items' => [
                (object) ['name' => 'Laptop', 'price' => '$999'],
                (object) ['name' => 'Smartphone', 'price' => '$499'],
            ]
        ]);
    }
}
```
`home.pluto.php`
```php
<!-- Displaying a variable -->
<< $username >>

<!-- Conditional Statement -->
@if ($userRole == 'admin')
  <p>Welcome, Admin!</p>
@elseif ($userRole == 'member')
  <p>Welcome, Member!</p>
@else
  <p>Welcome, Guest!</p>
@endif

<!-- Looping Through Data -->
@foreach ($items as $item)
  <p><< $item->name >> - << $item->price >></p>
@endforeach
```

## Security Features

- **Password Hashing**: Built-in password hashing methods for user authentication.
- **Input Validation**: Functions to validate and sanitize user inputs.

## Contributing

Contributions are welcome! To contribute:

1. Fork the repository.
2. Create a new branch for your feature/bugfix.
3. Submit a pull request with a clear description of your changes.

## License

ZenithPHP is open-source and licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

---

Built with ❤️ by [Dasun Nethsara](https://techsaralk.epizy.com)
