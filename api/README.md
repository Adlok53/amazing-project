# Service Api Documentation

###Api
```
    Category:
        GET     api/category
        GET     api/category/{id}
        POST    api/category
        PUT     api/category/{id}
        DELETE  api/category/{id}

    Style:
        GET     api/style/{id}
        POST    api/style
        PUT     api/style/{id}
        DELETE  api/style/{id}
```
---

###Controllers

```
    CategoryController:
        Response: {id, name}
        Response: {id, name, styles}
        Request:  {name}
        Request:  {name}
        Response: {message, status}

    StyleController:
        Response: {id, name, photo, description, category_id}
        Request:  {id, name, photo, description, category_id}
        Request:  {id, name, photo, description, category_id}
        Response: {message, status}
```

---

###Models

```
    Category:
        Database:
            {
                id            => 'required|integer',
                name          => 'required|string|max:255'
            }

    Style:
        Database:
            {
                'id'          => 'required|integer',
                'name'        => 'required|string|max:255',
                'photo'       => 'required|string|max:255',
                'description' => 'nullable|string',
                'category_id' => 'required|integer|exists:categories,id'
            }
```