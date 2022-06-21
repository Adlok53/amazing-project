<!-- Views -->
Api:
    Category:
        A1.1 - GET api/category
        A1.2 - GET api/category/{id}
        A1.3 - POST api/category
        A1.4 - PUT api/category/{id}
        A1.5 - DELETE api/category/{id}

    Style:
        B1.1 - GET api/style/{id}
        B1.2 - POST api/style
        B1.3 - PUT api/style/{id}
        B1.4 - DELETE api/style/{id}

<!-- Controllers -->
A2 CategoryController:
    A1.1 Response: {id, name}
    A1.2 Response: {id, name, styles}
    A1.3 Request:  {name}
    A1.4 Request:  {name}
    A1.5 Response: {message, status}

B2 StyleController:
    B1.1 Response: {id, name, photo, description, category_id}
    B1.2 Request:  {id, name, photo, description, category_id}
    B1.3 Request:  {id, name, photo, description, category_id}
    B1.4 Response: {message, status}


<!-- Models -->
A3 Category:
    Database:
        {
            id   => 'required|integer',
            name => 'required|string|max:255'
        }


B3 Style:
    Database:
        {
            'id'          => 'required|integer',
            'name'        => 'required|string|max:255',
            'photo'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|integer|exists:categories,id'
        }