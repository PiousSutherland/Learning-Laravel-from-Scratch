# Lesson summaries

----

## I. Prerequisites and Setup

### 1: An Animated Introduction to MVC
Learnt: Basic structure to MVC.
Using the routes/web.php file, you will 
> Route::get('/path/here', [GenericController::class, 'methodCalled']);
This will call a ***Controller*** where all necessary database interactions will be specified.
The 'rules' for the interaction are defined by the ***Model***.
The ***Controller*** will then pass all necessary data to the ***View*** for the user to see.

----

### 2. Initial Environment Setup and Composer
**3 prerequisites: editor, terminal and tools needed for project (MySQL, PHP, Composer etc.)**
Laravel documentation was mentioned, but mostly focused on Mac desktops: [Brew](https://brew.sh) and [Sail](https://laravel.com/docs/10.x#sail-on-macos).
[Docker](https://www.docker.com/products/docker-desktop/) was mentioned as well.
[Composer](https://getcomposer.org) was installed + composer.phar installed globally. (On Windows, run:
> where composer.phar

and it should show, even if you are in your C:\Users\{user} home directory)
To start new project:
> composer create-project laravel/laravel app-name

To host locally, run
> php artisan serve

----

### 3. The Laravel Installer Tool
> composer global require laravel/installer
To allow you to run
> laravel new app-name
You have to add the following to to your PATH variable:
> __~/.composer/vendor/bin/laravel__ 
(use the full path name)
On Windows: Win key->search 'cpanel'->enter->search 'system variables'->edit->Advanced->Environment variables->PATH->edit
Add the directory there and save without changing anything else

----

### 4. Why do We Use Tools?
> ...we learn tools because they help us accomplish something or they help us solve a particular problem you have.
The problem for this lecture series is creating a functional blog

----
----

## II. The Basics

### 5. How a Route Loads a View
Explanation of the web.php file and how routes and views work.

```
Routes::get('/api-example', function{
	return ['foo' => 'bar'];
});
```

----

### 6. Include CSS and JavaScript
Edited welcome.blade.php in 'resources/views' with basic HTML and mentioned CSS+JS needing to be created in the 'public/' dir.

----

### 7. Make a Route and Link to it
Changed the name for the '/' view. Made a static posts page.

----

### 8. Store Blog Posts as HTML Files
Showed that extracting html into the 'resources/posts/' can be loaded dynamically using a slug like:

```
	Route::get('/post/{post}', function ($slug) {
    $post = file_get_contents(__DIR__ . "/../resources/posts/$slug.html");

    return view('post', [
        'post' => $post
    ]);
});
```

This means a blog writer can put their blogposts onto a file on something like GitHub if they wanted it to be open-source.
Furthermore, some extra route handling covered:
> abort(404);
return redirect('/');

----

### 9. Route Wildcard Constraints
At the end of the

	Route::get('/path/to', function{
		return "Something";
	})

for some extra constraints / validity checks there can now be added:
> ->where($variable, '[RegExHere]+');

For alpha[numeric]:
> whereAlpha[Numeric]()

----

### 10. Use Caching for Expensive Operations
Caching can be done by ***adding:
> $post = ***cache()->remember("posts.$slug", 5 /* seconds */, fn () =>*** file_get_contents($path)***)***;

----

### 11. Use the Filesystem Class to Read a Directory
* Extracted the database functionality into a new file, App\Models\Post.
For ease of reading, the web.php has the following keywords:
	$post = ***Post***::***find***($slug);
	***return view***('post', [
		'post' => $post
	]);

Now it reads: "Find a Post and Return it to the View"
The caching and `file_exists()` check is now inside the Post model, in a `find()` function.
* Path shothands were mentioned; app_path(), base_path(), resource_path() etc.
* The find() in App\Models\Post is not responsible for redirects.
Instead, throw new ModelNotFoundException();
* To make the original '/' posts page more dynamic, did a foreach() and Post::all() from the view
* Illuminate\Support\Facades\File class was mentioned; used ::files('/path/here').
* return array_map(fn ($file) => $file->getContents(), $files) loops over an array, does something to it, and returns an array.

----

### 12. Find a Composer Package for Post Metadata
* [yaml-front-matter](https://github.com/spatie/yaml-front-matter)
```
composer require spatie/yaml-front-matter
```

You can now add metadata to the html files.
Accessing through code is simple:

```php
$files = File::files(resource_path('posts'));
$documents = array_map(fn ($file) => YamlFrontMatter::parseFile($file), $files);

dd($documents);
```

This will pass it as a Yaml object.

```
// Output
array:4 [▼ // routes\web.php:13
  0 => 
Spatie\YamlFrontMatter
\
Document {#296 ▼
    #matter: []
    #body: """
      <h1>My First post</h1>

      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta impedit ullam ea voluptatum dolor modi. Ipsam

          commodi voluptatibus, nam suscipit expedita in unde ad perspiciatis dolores magnam repudiandae. Nulla, quae.

      </p>
      """
  }
  1 => 
Spatie\YamlFrontMatter
\
Document {#308 ▼
    #matter: array:2 [▼
      "title" => "My Second Post"
      "date" => 1710460800
    ]
    #body: """
      

      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta impedit ullam ea voluptatum dolor modi. Ipsam

          commodi voluptatibus, nam suscipit expedita in unde ad perspiciatis dolores magnam repudiandae. Nulla, quae.

      </p>
      """
  }
]
```

Accessing the properties is simple:

```php
$yamlObj->body(); // Get body (no metadata)
$yamlObj->matter(); // Get all metadata (usually as array)
$yamlObj->matter('title'); // Get specific attribute
$yamlObj->title; // Same as above
```

Collections can be used with a constructor:
```
public static function all()
{
	return collect(File::files(resource_path('posts')))
	->map(fn ($file) => YamlFrontMatter::parseFile($file))
	->map(fn ($doc) => new Post(
		$doc->title,
		$doc->excerpt,
		$doc->date,
		$doc->body(),
		$doc->slug
	));
}
```

----

### 13: Collection Sorting and Caching Refresher
```php
collect()->sortBy[Desc]();
cache()->rememberForever('unique.name'); // Needs to be cleared
cache()->forget('unique.name');
cache()->put('key', 'value');
cache(['key' => 'value']);
```

If you want some more control without changing your code:
> php artisan tinker

* Potential homework: Service Providers

----
----

## III. Blade

### 14. Blade: The Absolute Basics
```blade
{{ Display with htmlspecialchars }}
{!! Display without htmlspecialchars !!}
@foreach ($posts as $post) @endforeach
@dd($var) // <?php dd($var); ?>
<article class="{{ $loop->even ? 'mb-4' : '' }}"> // $loop variable
@if (true) @endif
@unless @endunless
```

Inside storage\framework\views, you'll find the compiled versions of your views.

----

### 15. Blade Layouts Two Ways
* Option 1: @extends, @yield
```blade
{{-- layout.blade.php --}}
<link rel="stylesheet" href="/css/app.css">
<body>
	@yield('name')
</body>
```
```blade
{{-- example.blade.php --}}
@extends('layout')
@section('name')
	{{-- Add new code here --}}
@endsection
````

* Option 2: Components
```blade
{{-- components/layout.blade.php --}}
<link rel="stylesheet" href="/css/app.css">
<body>
	{{ $content }}
	{{-- Alternatively, $slot is used if it's only a variable or text being 'slotted' into it. --}}
</body>
```
```blade
{{-- example.blade.php --}}
<x-layout>
    <x-slot name="content">
		{{-- Add new code here --}}
    </x-slot>
</x-layout>
```

----

### 16. A Few Tweaks and Considerations
* Added `findOrFail()` method
* 

----
----

## IV. Working with Databases

### 17. Environment Files and Database Connections
* .env file is private / sensitive info
* `php artisan migrate` starts the table migrations
* GUIs like TablePlus help visualise the data
* The necessary values are usually read by the various files in the '/config' directory.
> [!NOTE]
> [Many config files are no more in Laravel 11.]

----

### 18. Migrations: The Absolute Basics
* `php artisan migrate` uses the database/migrations directory
* `up()` runs the migration (ie, creates tables) and `down()` reverses it
The code for making a table is easy to understand:
```
function (Blueprint $table) {
	$table->id();
	$table->string('name');
	$table->string('email')->unique();
	$table->timestamp('email_verified_at')->nullable();
	$table->string('password');
	$table->rememberToken();
	$table->timestamps();
}
```

The `migrations` table has a 'batch' record that specifies the rollback-hierarchy in __descending__	 order.
* `php artisan migrate:fresh` deletes everything and migrates again
	* This will not practically be used in production
	* `APP_ENV` can be set to production to try to prevent this
	
----

### 19. Eloquent and the Active Record Pattern
Per Wikipedia:
> The active record pattern is an approach to accessing data in a database. 
A database table or view is wrapped into a class. Thus, an object instance is tied to a single row in the table. 
After creation of an object, a new row is added to the table upon save.

* Each table can have a corresponding Eloquent model
You can use `php artisan tinker`:
```
$user = new App\Models\User;
$user->name = 'Someone';
$user->email = 'name@example.com;
$user->password = bcrypt('password');

$user->save();

User::find(1); // id
User::findOrFail(1);
User::all();
// Here you can add changes and update

$user = new App\Models\User;

// Here you can't

$users = User::all();
$users->pluck('name'); // Returns object with only specified records
$users->first(); // OR $users[0]
```

----

### 20. Make a Post Model and migration

```bash
php artisan make:migration create_{names}_table
php artisan make:model {Name}

php artisan tinker
```

Inside tinker:
```bash
$name = new [App\Models\]{Name}
$name->attribute = 'add here'
$name->oops = 'Can't add to DB; attribute doesn't exist';
unset($name->oops);

$name->save()
```

----

### 21. Eloquent Updates and HTML Escaping
```bash
$temp = App\Models\Temp::find({id});
$temp->attribute = "Add or change" . $temp->attribute
$temp->save()
```

----

### 22. 3 Ways to Mitigate Mass Assignment Vulnerabilities

This throws a MassAssignmentException:
```bash
Temp::create(['attribute' => 'Something'])
```

The above wants you to add 'attribute' to a fillable property:
```php
namespace App\Models\Temp;

use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
	use HasFactory;
	protected $guarded = []; // Just this signals to expert programmers that things should never be mass-assigned
	// Meaning, never take an array or something and then mass assign it
	
	protected $fillable = [ 'attribute' ]; // Now Mass Assignment is possible if you explicitly declare like this
}
```

To change the instance to the original, before save():
```
$temp->fresh()
```

You can also update a specific instance as follows:
```
$temp->update(['attribute' => 'Change val'])
```

----

### 23. Route Model Binding

```php
Route::get('/post/{post/*:attribute*/}', function (Post $post) {
    return view('post', [
        'post' => $post
    ]);
});
```

Alternatively, you can do this in the Model:
```
class getRouteKeyName(){
	return 'attibute';
}
```

Now, use Route::get('/post/{post}'){};

----

### 24. Your First Eloquent Relationship
```php
class Post extends Post
{
	public function category()
	{
		return $this->belongsTo(Category::class);
	}
}
```

In tinker, to run the function:
> $post = Post::find(1)->category

Now you can access it using normal attribute accessing.

----

### 25. Show All Posts Associated With a Category

Route handling:
```php
// web.php
Route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts
    ]);
});
```

Model logic:
```php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
```

Linking on posts[s].blade.php:
```blade
<a href="/categories/{{ $post->category->slug }}">
	Show {{ $post->category->name }} posts
</a>
```

----

### 26. Clockwork, and the N+1 Problem

Inside the loop, you're accessing a relationship that has not yet been loaded:
```blade
 @foreach ($posts as $post)
	<a href="/categories/{{ $post->category->slug }}">
		Show {{ $post->category->name }} posts
	</a>
@endforeach
```

Meaning, you run an additional SQL query for each item in the loop.
To prove this:
```php
\Illuminate\Support\Facades\DB::listen(function ($query) {
	logger($query->sql);
});
```

Returns this on the log:
> [2024-03-18 11:32:05] local.DEBUG: select * from `posts`  
[2024-03-18 11:32:05] local.DEBUG: select * from `categories` where `categories`.`id` = ? limit 1  
[2024-03-18 11:32:05] local.DEBUG: select * from `categories` where `categories`.`id` = ? limit 1  
[2024-03-18 11:32:05] local.DEBUG: select * from `categories` where `categories`.`id` = ? limit 1  
[2024-03-18 11:32:05] local.DEBUG: update `sessions` set `payload` = ?, `last_activity` = ?, `user_id` = ?, `ip_address` = ?, `user_agent` = ? where `id` = ?  

Alternatively, install [Clockwork](https://github.com/itsgoingd/clockwork) for a tab in DevTools.

You can change the 'lazy load':
```php
'posts' => Post::all()
```

To:
```php
'posts' => Post::with('category')->get()
```

It will load the relationship as well.

----

### 27. Database Seeding Saves Time

```php
// Truncate to avoid seeding dupes
 User::truncate();
Category::truncate();
Post::truncate();

$user = User::factory()->create();

$personal = Category::create([
	'name' => 'Personal', 
	'slug' => 'personal'
]);

// You can access attributes for IDs
Post::create([
	'user_id' => $user->id,
	'category_id' => $personal->id,
	'title' => 'My Family Post',
	'slug' => 'my-family-post',
	'excerpt' => 'Lorem ipsum dolor sit amet.',
	'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, totam voluptas. Impedit dignissimos id nobis ipsam sint, tempore, voluptates facilis soluta error deserunt aspernatur recusandae ipsum reiciendis odio numquam molestiae?'
]);
```

----

### 28. Turbo Boost With Factories

To add migration, factory and seeder:
> php artisan make:model -mfs

This:
> $this->faker

is the same as this:
> fake()

Simplest way to 
```php
public function definition(): array
{
	return [
		'other_model_id' => \App\Models\ModelName::factory(), // Choose
		'title' => fake()->title(),
		'slug' => fake()->unique()->slug(),
		'excerpt' => fake()->sentence(),
		'body' => fake()->paragraph() // etc.
	];
}
```

Override certain randomised data:
```php
$user = User::factory()->create([
	'name' => 'John Doe'
]);

Post::factory(5)->create([
	'user_id' => $user->id
]);
```

----

### 29. View All Posts by an Author

```php
// web.php
// latest() orders by; column name can be specified
'posts' => Post::latest()->with('category')->get()
```

```php
// Specify foreign key
public function author() // Laravel assumes author_id
{
	return $this->belongsTo(User::class, 'user_id');
}
```

----

### 30. Eager Load Relationships on an Existing Model

```php
// Eager-load by default in any model
$with = ['parent_table', 'subtable'];

// `id` fields are foreign keys in DB
function parent_table()
{
	return $this->belongsTo(ParentModel::class, 'id');
}
function subtable()
{
	return $this->hasMany(ChildModel::class, 'id');
}
```

Disabling for a single query:
```php
App\Models\ModelName::without('parent_table')->get();
```

----
----

## V. Integrate the Design

### 31. Convert the HTML and CSS to Blade
Downloaded [core from GitHub](https://github.com/laracasts/Laravel-From-Scratch-HTML-CSS)
Basically moved things around so it's easier to read.

----

### 32. 
To pass a variable through, you can do this:
```blade
<x-post-featured-card :post="$post"/>
```

> Default timestamps are instances of class+library "Carbon"

Example:
```blade
Published {{ $post->created_at->diffForHumans() }}
{{-- Published 2 hours ago (in my case)--}}
```

For loops, you can skip:
```blade
@foreach ($posts->skip(1) as $post) @endforeach
```

Extra:
```blade
{{-- Main view example --}}
<x-post-card :post="$post" class="bg-red-500"/>

{{-- Incorporate on component / prop --}}
<a{{ $attributes->merge(['class' => 'hover:bg-gray-100 border border-black']) }}></a>
```
----
### 33. Convert the Blog Post Page
Moved some stuff, added images, incorporated Blade even more.
----

### 34. A Small JavaScript Dropdown Detour
Adding AlpineJS to aid with linking to categories.
Basic styling
Exmample:
```HTML
<div x-data="{ show: false }">
	<!-- Problem: Longer text shrinks to width 	-->
	<button @click="show = !show">Text</button>

	<div x-show="show">
		<a href="#">Much longer text here</a>
	</div>
</div>

<!-- Solution: tailwind css class="w-32" or some other number -->
<!-- @click.away -->
```

----

### 35. How to Extract a Dropdown Blade Component
Extracted into components

----

### 36. Quick Tweaks and Clean-Up
Styling.
Added '<p></p>' tags to excerpt.

----
----

## VI. Search

### 37. Search (The Messy Way)

```php
Route::get('/', function () {
    $posts = Post::latest();

    if (request('search'))
        $posts
            ->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('body', 'like', '%' . request('search') . '%');

    $try = $posts->get();
    isset($try) ? $posts = $posts->get() : redirect('/no-results');

    return view('posts', [
        'posts' => $try,
        'categories' => Category::all()
    ]);
});
```
----

### 38. Search (The Cleaner Way)

```php
// Post model
public function scopeFilter($query, array $filters)
{
	$query
		->when($filters['search'] ?? false, fn ($query, $search) =>
			$query
				->where('title', 'like', "%$search%")
				->orWhere('body', 'like', "%$search%")
	);
}
```
```php
// Controller function executed in web.php
public function index()
{
	// dd(request(['search']));
	return view('posts', [
		'posts' => Post::latest()->filter(request(['search']))->get(),
		'categories' => Category::all()
	]);
}
```

----
----

## VII. Filtering

### 39. Advanced Eloquent Query Constraints
What you are trying to emulate:
```SQL
SELECT * FROM `posts`
WHERE EXISTS (
	SELECT * FROM `categories`
	WHERE `categories`.`id` = `posts`.`category_id` AND `categories`.`slug` = 'earum-illum-consequuntur-eligendi-consequatur-aliquam-ullam'
)
ORDER BY `created_at` DESC
)
```

Here's how it looks in Laravel:
```php
public function scopeFilter($query, array $filters)
{
	$query->when(
		$filters['category'] ?? false,
		fn ($query, $category) =>
		$query
			->whereExists(fn ($query) =>
				$query->from('categories')
					->whereColumn('categories.id', 'posts.category_id')
					->where('categories.slug', $category)
			)
	);
}
```

Even simpler, use whereHas:
```php
$query->when(
	$filters['category'] ?? false,
	fn ($query, $category) =>
	$query->whereHas(
		'category',
		fn ($query) =>
		$query->where('slug', $category)
	)
);

// This reads like:
// "Give 
```

Then in the controller:
```php
public function index()
{
		return view('posts', [
		'posts' => Post::latest()->filter(request(['search', 'category']))->get(),
		'categories' => Category::all(),
		'currentCategory' => Category::firstWhere('slug', request('category'))
	]);
}
```

----

### 40. Extract a Category Dropdown Blade Component
Best practice is for 
```php
class PostController extends Controller
{
    public function index()
    {
        // dd(request(['search']));
        return view('posts.index', [
            'posts' => Post::latest()->filter(request(['search', 'category']))->get()
        ]);
    }
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
```

----

### 41. Author Filtering
Add author filtering to the scopeFilter:
```php
$query->when(
	$filters['author'] ?? false,
	fn ($query, $author) =>
	$query->whereHas(
		'author',
		fn ($query) =>
		$query->where('username', $author)
	)
);
```

Update the view by adding `author` to the check
```php
return view('posts.index', [
	'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->get()
]);
```

----

### 42. Merge Category and Search Queries

```blade
<x-dropdown-item href="/?category={{ $cat->slug }}&{{ http_build_query(request()->except('category')) }}"
	:active="request('category') === $cat->slug">
	{{ ucfirst($cat->name) }}
</x-dropdown-item>
```

----

### 43. Fix a Confusing Eloquent Query Bug
This:
```php
public function scopeFilter($query, array $filters)
{
	$query->when(
		$filters['search'] ?? false,
		fn ($query, $search) =>
		$query
			->where('title', 'like', "%$search%")
			->orWhere('body', 'like', "%$search%")
	);

	$query->when(
		$filters['category'] ?? false,
		fn ($query, $category) =>
		$query->whereHas(
			'category',
			fn ($query) =>
			$query->where('slug', $category)
		)
	);

	$query->when(
		$filters['author'] ?? false,
		fn ($query, $author) =>
		$query->whereHas(
			'author',
			fn ($query) =>
			$query->where('username', $author)
		)
	);
}
```

Produces this SQL:
```SQL
SELECT *
FROM `posts`
WHERE (`title` LIKE '%et%' OR `body` LIKE '%et%' AND EXISTS (
SELECT *
FROM `categories`
WHERE `posts`.`category_id` = `categories`.`id` AND `slug` = 'unde-fugiat-praesentium-praesentium-aut-adipisci-ut-omnis-eum'))
ORDER BY `created_at` DESC
```

Problem with this is the (title OR body and `EXISTS()`) are grouped as opposed to being separate queries.

To fix this, the first part is like this
```php
$query
	->when(
		$filters['search'] ?? false,
		fn ($query, $search) =>
		$query->where(
			fn ($query) =>
			$query
				->where('title', 'like', "%$search%")
				->orWhere('body', 'like', "%$search%")
	)
);
```

Difference: Everything in the search is now inside a single `where()` method.

----
----

## VIII. Pagination

### 44. Laughably Simple Pagination
