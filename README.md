# Simple-REST-Application

Simple REST Application is the simplest **Fabstract** REST application possible.

# Installation

Before you start, you need to have a web server up and running. You can use [Apache][1], [Nginx][2] or [make a google 
search][3].

Clone the project into your working directory.

```bash
git clone git@github.com:Fabstract/Simple-REST-Application.git
```

>Be aware that you need to clone the project into the directory your web server redirects HTTP requests to. 

Now test it with a simple HTTP request.
```bash
curl -i yourdomain.postfix/test
```

You should see the following:
```bash
HTTP/1.1 200 OK
Content-Type: application/json

{"status":"success","data":"get"}
```

# Creating an API

Before we get going, we should agree on some definitions related to RESTful systems.

_Resource_ is any information that you want to share publicly. It could be a document, an image, or some rows from your 
database. In Fabstract, Resources are PHP classes, like `UserResource.php`.

_Endpoint_ is an address to a resource. Say when you want to write an API that deals with _users_, you create an endpoint,
`/user`. 

_Action_ is composed of an HTTP method and a PHP function. You can add actions to your endpoints like GET, POST etc and 
point them to a callable/function by using actions.  

For a detailed description about REST, you can [read this][4].


## 1. Create a Resource

1. Pick a name, it should be a noun like `user` or `product`. It should **NOT** be a verb, like `register` or `buy`.
2. Create a PHP file, and a class with the same name as file. Ex. `UserResource`.
3. Extend it from `\Fabstract\Component\Http\ResourceBase`
4. Implement the method `configureEndpointBag($endpoint_bag)`.

Example:

**UserResource.php**

```php
<?php

namespace Fabstract\Component\SimpleRestApplication\Module\Resource;

use Fabstract\Component\Http\Bag\EndpointBag;
use Fabstract\Component\Http\ResourceBase;

class UserResource extends ResourceBase
{

    /**
     * @param EndpointBag $endpoint_bag
     * @return void
     */
    public function configureEndpointBag($endpoint_bag)
    {
        // TODO: Implement configureEndpointBag() method.
    }
}

```

## 2. Create an Endpoint

1. Pick a routing for URL, like `/` or `/name`. 
2. Create the endpoint by using `create()` method.

Like below: 

**UserResource.php**

```php
public function configureEndpointBag($endpoint_bag)
{
    $endpoint_bag->create('/');
}

```

## 3. Add Actions to the Endpoint

1. Create the function that your endpoint will execute.
2. Map the function with corresponding HTTP method by using corresponding endpoint methods, like `addGET()`.

Like below: 

**UserResource.php**

```php
public function configureEndpointBag($endpoint_bag)
{
    $endpoint_bag->create('/')
        ->addGET('get')
        ->addPOST('create');
}

public function get() {
    return 'inside get function';
}

public function post() {
    return 'insude post function';
}

```

## 4. Map Resource to a URL

Finally, you should map the resource you created to a URL inside your `ResourceProvider.php` file, like this:

```php
class ResourceProvider extends ResourceProviderBase
{

    /**
     * @param ResourceBag $resource_bag
     * @return void
     */
    public function configureResourceBag($resource_bag)
    {
        $resource_bag->create('/user', UserResource::class);
    }
}

```

You're done. You wrote your first API! Now `/user` URL will be redirected to `UserResource.php` file. 

If you `GET`
```bash
curl -i -X GET yourdomain.postfix/user
```

you should see the following:
```bash
HTTP/1.1 200 OK
Content-Type: application/json

{"status":"success","data":"inside get function"}
```

or `POST`
```bash
curl -i -X POST yourdomain.postfix/user -H"Content-Type: application/json"
```

you should see the following:
```bash
HTTP/1.1 200 OK
Content-Type: application/json

{"status":"success","data":"inside post function"}
```

If you send an unmapped HTTP method, you will get `HTTP 405`
```bash
curl -i -X HEAD yourdomain.postfix/user
```

will result below:
```bash
HTTP/1.1 405 OK
Content-Type: application/json

{"error_message":"method_not_allowed","status":"failure"}
```

If you try to access a resource that's _not_ mapped, you get `HTTP 404`

```bash
curl -i -X HEAD yourdomain.postfix/product
```
will result below:
```bash
HTTP/1.1 404 OK
Content-Type: application/json

{"error_message":"not_found","status":"failure"}
```

# Other HTTP Status Codes
You can return a desired `HTTP` status code by throwing an exception, like below:

**UserResource.php**

```php
public function configureEndpointBag($endpoint_bag)
{
    $endpoint_bag->create('/')
        ->addGET('get')
        ->addPOST('create');
}

public function get() {
    return 'inside get function';
}

public function post() {
    throw new \Fabstract\Component\Http\Exception\StatusCodeException\ForbiddenException();
}
```

Now do a `HTTP POST`

```bash
curl -i -X POST yourdomain.postfix/user -H"Content-Type: application/json"
```

you will get following:

```bash
HTTP/1.1 403 OK
Content-Type: application/json

{"error_message":"forbidden","status":"failure"}
```

You can use many of the status code exceptions that come with **Fabstract**

`\Fabstract\Component\Http\Exception\StatusCodeException\ForbiddenException()` will be `HTTP 403`
`\Fabstract\Component\Http\Exception\StatusCodeException\ConflictException()` will be `HTTP 409`
`\Fabstract\Component\Http\Exception\StatusCodeException\UnauthorizedException()` will be `HTTP 401`
`\Fabstract\Component\Http\Exception\StatusCodeException\UnprocessableEntityException()` will be `HTTP 422`

etc.

# Internal Server Errors

When an unexpected error happens, system will give `HTTP 500`. You don't have to do _anything_.



[1]: https://www.apache.org/
[2]: https://www.nginx.com/
[3]: https://www.google.com.tr/search?q=web+server
[4]: https://restfulapi.net/
