<?php
  session_start();
  require 'includes/dbh.inc.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dynamic To-Do</title>
  <link rel="stylesheet" href="style-main.css?v=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

  <div id="overflow-bg">
  </div>

  <div id="overflow-content-window">
    <div id="overflow-content-window-header">
      <div id="overflow-x-button" class="x-button">
        <span>x</span>
      </div>
    </div>
    <p id="overflow-content"></p>
  </div>

  <header id="header">
    <div id="logo-container">
      <img src="media/logo.png">
    </div>
    <div id="mode-container">
      <div id="list-mode">

        <?php
          echo file_get_contents('./media/list.txt');
        ?>

      </div>
      <div id="calender-mode">

        <?php
          echo file_get_contents('./media/grid.txt');
        ?>

      </div>
    </div>
    <div id="settings-menu-button" onclick="open_settings_menu()">
    </div>
  </header>

  <section id="main">

    <div id="add-item-container">
      <div id="add-item-menu-header">
        <h3 id="add-item-menu-header-content">ADD ITEM</h3>
        <div class="x-button" id="add-edit-item-x-button">
          <span>x</span>
        </div>
      </div>
      <form id="add-item-form">
        <input id="add-item-input-name" type="text" name="name" placeholder="Name" maxlength="40"></input>
        <div class="add-item-type-container">
          <label class="add-item-type" for="add-item-type-event">
            <input class="radio" id="add-item-type-event" type="radio" name="type" value="event" checked="checked"></input>
            <span class="add-item-type-name">Event</span>
          </label>
          <label class="add-item-type" for="add-item-type-due">
            <input class="radio" id="add-item-type-due" type="radio" name="type" value="due"></input>
            <span class="add-item-type-name">Due</span>
          </label>
          <label class="add-item-type" for="add-item-type-none">
            <input class="radio" id="add-item-type-none" type="radio" name="type" value="task"></input>
            <span class="add-item-type-name">Task</span>
          </label>
        </div>
        <input id="add-item-input-date" type="date" name="date" value="<?php echo date("Y-m-d");?>"></input>
        <button id="add-item-submit" type="submit" name="add-item-submit">Add Item</button>
      </form>
    </div>

    <div id="list-container">
      <div id="list-header">
        <div id="add-item-button" class="no-select" onclick="open_add_item_menu()">
          <h3>+</h3>
        </div>
        <div id="sorting-container">
          <div id="sort-button" class="no-select">SORT</div>
          <div id="sorting-container-buttons">
            <form class="sorting-container-button" action="includes/sort.inc.php" method="post">
              <input class="sorting-button-input" name="sort-type" value="all"></input>
              <button id="all" class="sorting-button-submit" type="submit">ALL</button>
            </form>
            <form class="sorting-container-button" action="includes/sort.inc.php" method="post">
              <input class="sorting-button-input" name="sort-type" value="today"></input>
              <button id="today" class="sorting-button-submit" type="submit">TODAY</button>
            </form>
            <form class="sorting-container-button" action="includes/sort.inc.php" method="post">
              <input class="sorting-button-input" name="sort-type" value="task"></input>
              <button id="task" class="sorting-button-submit" type="submit">TASK</button>
            </form>
            <form class="sorting-container-button" action="includes/sort.inc.php" method="post">
              <input class="sorting-button-input" name="sort-type" value="overdue"></input>
              <button id="overdue" class="sorting-button-submit" type="submit">OVERDUE</button>
            </form>
          </div>
        </div>
      </div>
      <div id="todo-list">
        <script>
          var sort_type = <?php echo json_encode($_SESSION['sort-type']); ?>;
          var themeNum = <?php echo json_encode($_SESSION['themeNum']); ?>;
        </script>
      </div>
    </div>

    <div id="calender-container">
      <p>calender coming sometime maybe yes</p>
    </div>

    <div id="settings-menu-container">
      <div id="settings-menu-header">
        <div id="settings-menu-username">
          <?php
          echo $_SESSION['userUid'];
          ?>
        </div>
        <div class="x-button" onclick="open_settings_menu()">
          <span>x</span>
        </div>
      </div>
      <button class="settings-menu-item" id="theme-btn" type="submit"><h3>THEME</h3></button>
      <button class="settings-menu-item" id="about-btn" type="submit"><h3>ABOUT</h3></button>
      <div class="about-content">
        Web Project Summer 2020
      </div>
      <form action="includes/logout.inc.php" method="post">
        <button id="settings-menu-logout" type="submit">LOGOUT</button>
      </form>
    </div>

  </section>

  <footer>
    <p>DYNAMIC TO-DO © 2020</p>
  </footer>

  <script src="javascript/script.js"></script>

</body>
</html>
