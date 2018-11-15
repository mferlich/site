<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Geneva Consistory</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Muli%7CRoboto:400,300,500,700,900" rel="stylesheet"></head>
  <body>
    <div class="main-nav">
        <ul class="nav">
          <li class="name">Ole Miss Geneva Consistory</li>
          <li><a href="home.php">Home</a></li>
          <li><a href="addLogin.php">Add User</a></li>
          <li><a href="logout.php">Logout</a></li>
          <li><a href="#">Contact Support</a></li>
        </ul>
    </div>

    <header> 
      <h1 class="tag name">Search the Geneva Consistory!</h1>
    </header>

<main>
  <form action = "results.php" method="post" id="search-form">
  <!Dropdown for Field Selection>
      
      <h2 style="font-weight: normal">Field: <select name="field" form="search-form">
      <option value="firstname">First Name</option>
      <option value="lastname ">Last Name</option>
      <option value="id">ID</option>
      <option value="nickname">Nickname</option>
      <option value="gender">Gender</option>
      <option value="spouse">Spouse</option>
      <option value="occupation">Occcupation</option>
      <option value="parents">Parents</option>
      </select>
      

      <!Dropdown for Match Type Selection>
      Match Type:
      <select  class= "custom-select" name="match" form="search-form">
      <option value="includes">Includes</option>
      <option value="exact">Exact</option>
      <option value="Begins With">Begins With</option>
      <option value="Ends With">Ends With</option>
      </select></h2>
      
      <input type="search" name="search" placeholder="Search">
      <input type="submit" value=">>" />
    </form>
</main>

    <footer>
      <ul>
        <li><a href="http://olemiss.edu" target="_blank" class="social olemiss"> Ole Miss</a></li>
      </ul>
      <p class="copyright">Copyright 2018, Ole Miss</p>
    </footer>
  </body>
  </html>