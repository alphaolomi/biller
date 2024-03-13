# Admin API

For a house bills platform with a React frontend, you'll need to design a RESTful API that allows for CRUD operations (Create, Read, Update, Delete) on the various resources such as users, houses, bills, and attachments. Below is an API outline that can support the outlined data models:

### Users

- **GET `/api/users`**: List all users.
- **POST `/api/users`**: Create a new user.
- **GET `/api/users/{id}`**: Get a specific user by ID.
- **PUT `/api/users/{id}`**: Update a specific user by ID.
- **DELETE `/api/users/{id}`**: Delete a specific user by ID.
- **GET `/api/users/{id}/houses`**: Get all houses associated with a specific user.

### Houses

- **GET `/api/houses`**: List all houses.
- **POST `/api/houses`**: Create a new house.
- **GET `/api/houses/{id}`**: Get a specific house by ID.
- **PUT `/api/houses/{id}`**: Update a specific house by ID.
- **DELETE `/api/houses/{id}`**: Delete a specific house by ID.
- **GET `/api/houses/{id}/users`**: Get all users associated with a specific house.
- **GET `/api/houses/{id}/bills`**: Get all bills for a specific house.

### Bills

- **GET `/api/bills`**: List all bills.
- **POST `/api/bills`**: Create a new bill.
- **GET `/api/bills/{id}`**: Get a specific bill by ID.
- **PUT `/api/bills/{id}`**: Update a specific bill by ID.
- **DELETE `/api/bills/{id}`**: Delete a specific bill by ID.
- **GET `/api/bills/{id}/attachments`**: Get all attachments for a specific bill.
- **POST `/api/bills/{id}/contributions`**: Add a contribution to a bill (for shared bills).

### Attachments

- **GET `/api/attachments`**: List all attachments.
- **POST `/api/attachments`**: Upload a new attachment.
- **GET `/api/attachments/{id}`**: Get a specific attachment by ID.
- **DELETE `/api/attachments/{id}`**: Delete a specific attachment by ID.

### Contributions (Optional, for shared bills)

- **GET `/api/contributions`**: List all contributions.
- **POST `/api/contributions`**: Create a new contribution.
- **GET `/api/contributions/{id}`**: Get a specific contribution by ID.
- **PUT `/api/contributions/{id}`**: Update a specific contribution by ID.
- **DELETE `/api/contributions/{id}`**: Delete a specific contribution by ID.

This API outline provides a comprehensive set of endpoints to manage users, houses, bills, attachments, and contributions for the platform. Implementing these APIs would enable a React frontend to perform all necessary operations, including managing users and their houses, creating and tracking bills (including shared bills), and managing attachments for bills.
