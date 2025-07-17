<a name="readme-top">

<br/>

<br />
<div align="center">
  <a href="https://github.com/a-manalo/">
  <img src="./assets/img/logo.png" alt="The Forbidden Codex" width="400" height="100">
  </a>

  <h3 align="center">The Forbidden Codex</h3>
</div>

<div align="center">
  A Black Market Mythology Website
</div>

<br />

![](https://visit-counter.vercel.app/counter.png?page=a-manalo/AD-Final-Project)

---

<br />
<br />

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#overview">Overview</a>
      <ol>
        <li>
          <a href="#key-components">Key Components</a>
        </li>
        <li>
          <a href="#technology">Technology</a>
        </li>
      </ol>
    </li>
    <li>
      <a href="#rule,-practices-and-principles">Rules, Practices and Principles</a>
    </li>
    <li>
      <a href="#resources">Resources</a>
    </li>
  </ol>
</details>

---

## Overview

The Forbidden Codex is a mysterious black market platform set in a mythology theme. Users step into a shadowy marketplace where they can buy forbidden products, manage their account, and interact based on their assigned roles. The website has user authentication, role-based functionalities, transactions, and CRUD operations. Whether you’re a Buyer looking to acquire rare artifacts, a Seller managing secret listings, or an Admin maintaining the order behind the chaos, this website is a functional dark e-commerce platform.

### Key Components

- Home Page
  - Hero Section
  - Our Offers
  - The Forbidden Codex of Conduct
  - Footer
- Products Page
  - Product Categories
    - Product Details
    - Buy Product for Buyers
    - Sell Product for Sellers
- Payment Page
  - Payment Form Submission
- Account Page
  - User Profile
  - Dynamic Sidebars Based on Role
- Authentication System
  - Login
  - Signup
  - Role Authentication
- Error Page
- CRUD Operations
- Database Integration

### Technology

#### Language
![HTML](https://img.shields.io/badge/HTML-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

#### Framework/Library
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

#### Databases
![MongoDB](https://img.shields.io/badge/MongoDB-47A248?style=for-the-badge&logo=mongodb&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-336791?style=for-the-badge&logo=postgresql&logoColor=white)

## Rules, Practices and Principles

<!-- Do not Change this -->

1. Always use `AD-` in the front of the Title of the Project for the Subject followed by your custom naming.
2. Do not rename `.php` files if they are pages; always use `index.php` as the filename.
3. Add `.component` to the `.php` files if they are components code; example: `footer.component.php`.
4. Add `.util` to the `.php` files if they are utility codes; example: `account.util.php`.
5. Place Files in their respective folders.
6. Different file naming Cases
   | Naming Case | Type of code         | Example                           |
   | ----------- | -------------------- | --------------------------------- |
   | Pascal      | Utility              | Accoun.util.php                   |
   | Camel       | Components and Pages | index.php or footer.component.php |
8. Renaming of Pages folder names are a must, and relates to what it is doing or data it holding.
9. Use proper label in your github commits: `feat`, `fix`, `refactor` and `docs`
10. File Structure to follow below.

```
AD-Final-Project
└─ assets
|   └─ css
|   |   └─ main.css
|   |   └─ navbar.css
|   |   └─ footer.css
|   |   └─ hero.css
|   |   └─ login_signup.css
|   |   └─ error.css
|   └─ img
|   |   └─ Heading
|   |     └─ 1.png
|   |     └─ 2.png
|   |     └─ 3.png
|   |     └─ 4.png
|   |   └─ Background.jpeg
|   |   └─ greekstuff.png
|   |   └─ hero_no_text.png
|   |   └─ hero.png
|   |   └─ logo.png
|   |   └─ Other_Website_Logo.png
|   |   └─ scare.gif
|   |   └─ Website_Logo.png
|   |   └─ wood.png
|   └─ js
|       └─ navbar.js
└─ components
|   └─ componentGroup
|      └─ productList.component.php
|   └─ templates
|      └─ head.component.php
|      └─ footer.component.php
|      └─ foot.component.php
|      └─ navbar.component.php
|      └─ productCard.component.php
└─ database
|   └─ users.model.sql
|   └─ items.model.sql
|   └─ payments.model.sql
|   └─ transactions.model.sql
|   └─ transaction_items.model.sql
└─ handlers
|   └─ mongodbChecker.handler.php
|   └─ postgreChecker.handler.php
|   └─ auth.handler.php
|   └─ signup.handler.php
|   └─ delete_user.handler.php
|   └─ request_seller.handler.php
|   └─ seller_request.handler.php
|   └─ buy.handler.php
|   └─ process_payment.handler.php
|   └─ remove_item.handler.php
|   └─ sell.handler.php
└─ layout
|   └─ main.layout.php
└─ pages
|  └─ login
|     └─ index.php
|  └─ signup
|     └─ index.php
|  └─ product
|     └─ assets
|     |  └─ css
|     |  |  └─ product.css
|     |  └─ img
|     |     └─ Artifacts
|     |       └─ boneRing.png
|     |       └─ hornCentaur.png
|     |       └─ kagutsuchiEmberstone.png
|     |       └─ mirrorBabaYaga.png
|     |       └─ oracleCoin.png
|     |     └─ Elixirs
|     |       └─ ambrosia_dust.png
|     |       └─ bloodwine_of_dionysus.png
|     |       └─ elixir_of_perun.png
|     |       └─ petals_of_yomi.png
|     |       └─ soma_resin.png
|     |     └─ Weapons
|     |       └─ BowofArtemis.png
|     |       └─ KatanaofSusanoo.png
|     |       └─ MoranasIceDagger.png
|     |       └─ PoseidonsTrident.png
|     |       └─ SvarogsForgeHammer.png
|     |     └─ Web_Services
|     |       └─ bloodpact.png
|     |       └─ hades.png
|     |       └─ slavic.png
|     |       └─ talisman.png
|     |       └─ yokai.png
|     |     └─ sidbar2.png
|     |     └─ sidebar_img.jpg
|     |     └─ sidebar2.jpg
|     |  └─ js
|     |     └─ category_filter.js
|     └─ index.php
|  └─ signup
|     └─ index.php
|  └─ user-profile
|     └─ assets
|     |  └─ css
|     |  |  └─ user-profile.css
|     |  └─ js
|     |  |  └─ user-profile.js
|     └─ index.php
└─ staticData
|  └─ dummies
|     └─ users.staticData.php
|     └─ items.staticData.php
|     └─ payments.staticData.php
|     └─ transactions.staticData.php
|     └─ transaction_items.staticData.php
└─ utils
|   └─ dbResetPostgresql.util.php
|   └─ dbSeederPostgresql.util.php
|   └─ dbMigratePostgresql.util.php
|   └─ auth.util.php
|   └─ envSetter.util.php
|   └─ htmlEscape.util.php
|   └─ signup.util.php
|   └─ delete_user.util.php
|   └─ refresh_user.util.php
|   └─ process_payment.util.php
|   └─ orders.util.php
|   └─ seller_request.util.php
└─ vendor
└─ .dockerignore
└─ .gitignore
└─ bootstrap.php
└─ composer.yaml
└─ composer.json
└─ composer.lock
└─ Dockerfile
└─ index.php
└─ readme.md
└─ router.php
```
> The following should be renamed: name.css, name.js, name.jpeg/.jpg/.webp/.png, name.component.php(but not the part of the `component.php`), Name.utils.php(but not the part of the `utils.php`)

## Resources

| Title        | Purpose                                                                       | Link          |
| ------------ | ----------------------------------------------------------------------------- | ------------- |
| Google Fonts API          | Used for integrating custom fonts for styling                                                                           | https://fonts.googleapis.com           |
| ChatGPT | Used for debugging, dummy data creation, and proper code structure. | https://chatgpt.com/ |
| Bootstrap | Used for frontend framework to make UI responsive. | https://getbootstrap.com |
| Codehal | Referenced for PHP/MySQL e-commerce tutorials | https://www.youtube.com/@Codehal |