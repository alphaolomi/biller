# Client API

For a client-public facing API for a web app, where users can manage their houses and bills with authentication, the outline would focus on user registration, authentication, and management of houses and bills. This API needs to ensure secure access to resources, so endpoints related to authentication and user-specific data management are crucial. Here's how such an API could be structured:

### Authentication and User Registration

- **POST `/api/auth/register`**: Register a new user. Requires user details like name, email, and password.
- **POST `/api/auth/login`**: Authenticate a user and return an access token. Requires email and password.
- **POST `/api/auth/logout`**: Log out a user by invalidating their access token.
- **GET `/api/auth/me`**: Get the authenticated user's profile using the access token.

### House Management

After authentication, users should be able to manage houses. The `/me` endpoint signifies that these actions are performed by the authenticated user on their own houses.

- **GET `/api/me/houses`**: List all houses associated with the authenticated user.
- **POST `/api/me/houses`**: Create a new house associated with the authenticated user.
- **GET `/api/me/houses/{houseId}`**: Get details of a specific house owned by the authenticated user.
- **PUT `/api/me/houses/{houseId}`**: Update details of a specific house owned by the authenticated user.
- **DELETE `/api/me/houses/{houseId}`**: Delete a specific house owned by the authenticated user.

### Bill Management

Bills are managed within the context of houses. Each bill is associated with a house, and these endpoints allow managing bills for the houses owned by the authenticated user.

- **GET `/api/me/houses/{houseId}/bills`**: List all bills for a specific house owned by the authenticated user.
- **POST `/api/me/houses/{houseId}/bills`**: Create a new bill for a specific house owned by the authenticated user. This can include details like amount, currency, due date, type (recurring or single-time), and shared status.
- **GET `/api/me/bills/{billId}`**: Get details of a specific bill associated with the authenticated user.
- **PUT `/api/me/bills/{billId}`**: Update details of a specific bill associated with the authenticated user.
- **DELETE `/api/me/bills/{billId}`**: Delete a specific bill associated with the authenticated user.

### Attachment Management for Bills

Attachments can be added to bills for things like invoices or receipts.

- **POST `/api/me/bills/{billId}/attachments`**: Upload a new attachment for a specific bill.
- **GET `/api/me/bills/{billId}/attachments/{attachmentId}`**: Get a specific attachment for a bill.
- **DELETE `/api/me/bills/{billId}/attachments/{attachmentId}`**: Delete a specific attachment from a bill.

This client-public facing API structure ensures that users can securely register, log in, manage their houses, and manage bills and attachments within those houses. All operations on houses and bills are scoped to the authenticated user, ensuring data privacy and security.
