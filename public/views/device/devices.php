<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="public/css/base.css" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LEDs play - devices</title>
  </head>
  <body>
    <div class="base-container">
      <section class="base-overlay" id="base-overlay"></section>
      <header>
        <img src="public/img/logo.svg" />
        <a id="base-drawer-btn">
          <i class="fa-solid fa-bars"></i>
        </a>
      </header>
      <nav>
        <img src="public/img/logo.svg" />
        <ul class="base-menu">
          <li><a href="#" class="active">Device</a></li>
          <li><a href="#">Workspace</a></li>
          <li><a href="#">Admin</a></li>
        </ul>
        <ul>
          <li><a href="#">Log out</a></li>
        </ul>
      </nav>
      <main>
        <section class="base-section">
          <div class="base-section-header">
            <h1>Your devices</h1>
            <button class="base-btn">New</button>
          </div>
          <div class="base-section-body">
            <input
              id="base-search-input"
              type="text"
              class="search"
              placeholder="Search"
            />
            <table>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Width</th>
                  <th>Height</th>
                  <th>API key</th>
                  <th>Active workspace</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="base-table-first-cell">
                      Device 1
                      <a>
                        <i class="fa-solid fa-circle-chevron-down"></i>
                        <i class="fa-solid fa-circle-chevron-up"></i>
                      </a>
                    </div>
                  </td>
                  <td>48</td>
                  <td>32</td>
                  <td>zaCELgL.0imfnc8mVLWwy</td>
                  <td>Workspace 1</td>
                  <td>
                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                    <a href="#">
                      <i class="fa-solid fa-circle-arrow-right"></i>
                    </a>
                  </td>
                </tr>

                <tr>
                  <td>
                    <div class="base-table-first-cell">
                      Device 2
                      <a>
                        <i class="fa-solid fa-circle-chevron-down"></i>
                        <i class="fa-solid fa-circle-chevron-up"></i>
                      </a>
                    </div>
                  </td>
                  <td>48</td>
                  <td>32</td>
                  <td>0imfnc8mVLWwsAawjYr4R</td>
                  <td>Workspace 2</td>
                  <td>
                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                    <a href="#">
                      <i class="fa-solid fa-circle-arrow-right"></i>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="base-table-first-cell">
                      Device 3
                      <a>
                        <i class="fa-solid fa-circle-chevron-down"></i>
                        <i class="fa-solid fa-circle-chevron-up"></i>
                      </a>
                    </div>
                  </td>
                  <td>48</td>
                  <td>32</td>
                  <td>sAawjYr4Rx-Af50DDqtlxAt</td>
                  <td>Workspace 3</td>
                  <td>
                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                    <a href="#">
                      <i class="fa-solid fa-circle-arrow-right"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>

        <button class="base-floating-btn">
          <i class="fa-solid fa-plus"></i>
        </button>
      </main>
    </div>
  </body>

  <footer>
    <script
      src="https://kit.fontawesome.com/c1c8d29a2a.js"
      crossorigin="anonymous"
    ></script>
    <script src="public/js/base.js"></script>
  </footer>
</html>
