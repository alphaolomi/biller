# Schema Models

Creating a data model for a house bills platform using Laravel involves defining the relationships between users, houses, bills, and attachments. Here is an outline of the data models based on your requirements:

### Users

- **Model Name:** User
- **Attributes:** id, name, email, password (plus any additional fields like phone_number, etc.)
- **Relationships:**
  - Houses: Many-to-Many (A user can have multiple houses and a house can have multiple users)
  - Bills: Indirectly through houses (Users are related to bills via the houses they are associated with)

### Houses

- **Model Name:** House
- **Attributes:** id, name, address, description
- **Relationships:**
  - Users: Many-to-Many (A house can have multiple users and a user can have multiple houses)
  - Bills: One-to-Many (A house can have many bills)

### Bills

- **Model Name:** Bill
- **Attributes:** id, house_id, description, amount, currency, due_date, type (recurring, single-time), shared (boolean)
- **Relationships:**
  - House: Many-to-One (Each bill belongs to one house)
  - Attachments: One-to-Many (A bill can have many attachments)
  - Contributions: One-to-Many (To track how each user contributed to the bill, if it's shared)

### Attachments

- **Model Name:** Attachment
- **Attributes:** id, bill_id, file_path (stores the path to the file location)
- **Relationships:**
  - Bill: Many-to-One (Each attachment belongs to one bill)

### Contributions (Optional, for shared bills)

- **Model Name:** Contribution
- **Attributes:** id, bill_id, user_id, amount_contributed
- **Relationships:**
  - Bill: Many-to-One (Each contribution is associated with a bill)
  - User: Many-to-One (Each contribution is made by a user)

These models cover the basic structure of a house bills platform. The relationships are set up to accommodate the requirements that a user can have multiple houses, a house can have multiple users, and bills can be either single-time or recurring and may have attachments. For shared bills, the optional Contributions model can track how much each user contributes to a bill, ensuring flexibility in managing shared expenses.
