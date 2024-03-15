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
##### 3 prerequisites: editor, terminal and tools needed for project (MySQL, PHP, Composer etc.)
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
The caching and file_exists() check is now inside the Post model, in a find() function.
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
````