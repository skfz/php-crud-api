# php-crud-api

A simple implmentation of a CRUD API written in core PHP.

Endpoints can be added in api/config/resources.php and subsequently creating their database tables & controllers. Eg:

```
return [
    "Post",
    "Comment"
];
```

**Improvements**: Implement authentication using JWT

