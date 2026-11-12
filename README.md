# FH Technikum Wien web development exercises (2020)

University course exercises from the Web Development course at FH Technikum Wien, 2020. Each folder is one assignment, from static HTML pages to PHP applications that use MySQL.

The repository has no package manifest, so there is no install, build, lint or test command. Exercises 1 and 2 are plain files that open in a browser. The other folders need a PHP web server (see [Running the exercises](#running-the-exercises)).

## Exercises

### FHTW_uebung_1_scheiber (exercise 1)

An index page and four HTML pages: a Fairphone article, a grade table, a patient form and a smart home page. The pages use HTML5 structural elements (`header`, `nav`, `main`, `section`, `footer`), and the two stylesheets use flexbox and grid. `style.css` and `smarthome.css` each have one media query at 768 px. The pages contain no JavaScript.

### FHTW_uebung_2_scheiber (exercise 2)

A smart home controller dashboard in three variants (`index.html`, `uebung2_smarthome.html`, `uebung2_smarthome_mit_fastlane.html`) and a Fairphone article (`responsive_artikel.html`). The pages use Bootstrap 4.6.2 and jQuery 3.5.1 from jsDelivr. `index.html` turns on Bootstrap popovers with one jQuery call. The room values are fixed in the HTML, so nothing is sent to a server.

### FHTW_uebung_3_scheiber (exercise 3)

Basic PHP. `index.php` shows four small pages in iframes:

- `aufgabe1.php` calls `phpinfo()`.
- `aufgabe2.php` adds, subtracts, multiplies and divides two fixed numbers.
- `aufgabe3.php` prints the numbers 1 to 15 in four tables: once written out by hand, then with a `for`, a `do`/`while` and a `while` loop.
- `aufgabe4.php` builds a navigation bar from an array of weekday names and marks the active day with an `if` test.

`hello.php` prints "Hello World!". The pages load Bootstrap 4.4.1 from a CDN.

### FHTW_uebung_4_scheiber (exercise 4)

A patient intake form and a smart home app, both in PHP.

- `index.php` is a form with HTML5 `required` fields, date, email and number inputs, and radio buttons for a gender field. It submits with GET to `auswertung.php`, which prints the submitted values. Nothing is saved. Empty fields show as cells with a `marked` CSS class.
- `SmartHomes/` splits its layout into `inc/` files (header, navigation, content, footer). `content.inc.php` picks the page with a `switch` on `$_GET['menu']`. The room pages in `sites/` show a light status and a temperature as fixed images and text. The login check in `sites/anmeldung.php` compares the submitted user name and password with fixed values, and the credentials travel in the query string.
- `smarthomeErweitert.php` is a single-file version of the smart home page.

### FHTW_uebung_5_scheiber (exercise 5)

A smart home app with a session-based login and a room list, plus a bundled device server.

- `index.php` starts a session and includes `inc/header.inc.php`, `navi.inc.php`, `content.inc.php` and `footer.inc.php`. The page is chosen with `$_GET['menu']`, as in exercise 4.
- The login in `inc/header.inc.php` compares fixed values. If "stay logged in" is checked, it sets a `user` cookie that expires after 600 seconds. `logout.php` clears the cookie.
- `sites/neuerRaum.php` is a form that adds a room through GET parameters. `sites/zimmerliste.php` keeps the rooms in `$_SESSION['zimmerliste']` and prints them as a table.
- `RESTServices/getpatientdata.php` prints one fixed record as JSON with `json_encode()`. `sites/restapi.php` is empty.
- `ViTAL_Server/ViTAL_Server_1.7/` contains a copy of the ViTAL server (a Java jar with start scripts and `values.txt`) and a page, `index.html`, with `vital.js`. The page posts a JSON record to `http://localhost:8080` with XMLHttpRequest.

### FHTW_uebung_6_scheiber (exercise 6)

One page, `index.php`, with two parts.

- The student list reads `studentslist.xml` with `simplexml_load_file()` and prints each student's name, matriculation number, study programme, semester and courses. Values are escaped with `htmlspecialchars()`.
- The feed reader sends a URL with XMLHttpRequest (POST) to `feed_loader.php`. The script fetches it with cURL, falls back to `file_get_contents()`, detects RSS or Atom from the XML root, and prints up to 10 items with title, date, description, link and image. The image comes from `media:thumbnail`, `media:content` or an image enclosure. The preset buttons load Heise (Atom), ORF (RSS) and Der Standard (RSS).

TLS certificate checks are turned off in `feed_loader.php` for both fetch methods.

### FHTW_uebung_7_scheiber (exercise 7)

A student registration and login that use one MySQL table, `studentenliste`.

- `register.php` inserts a row with a PDO prepared statement. It stores the password as an MD5 hash.
- The login form in `inc/header.inc.php` reads all rows with mysqli, compares the email address and the MD5 hash of the password in PHP, and prints the matching name and ID. It does not start a session. A second query joins the submitted email address into the SQL string without escaping.
- `datenbankVerbindung.php` opens a mysqli connection. `register.php` opens its own PDO connection. Both read the database settings from variables. The committed values are placeholders.
- `index.php` routes pages with `?menu=` through `inc/navi.inc.php` and `sites/`. The pages `studenteninfo.php` and `hochschulinfo.php` contain placeholder text.

### Abschlussprojekt (final project)

"Web Tunes", a catalogue of five sound effects. `index.php` reads `res/sounds.xml` with `simplexml_load_file()` and shows each sound with its name, details, an icon and an HTML5 `audio` control. A search box posts a string, and the page keeps the entries whose name contains it (`strpos()`). The ID in each row links to `playlist.php?soundfile=...`, which appends the file to `$_SESSION['stringarray']` and lists the session array. The playlist cannot remove items.

The pages use Bootstrap 4.4.1, jQuery 3.4.1 and Popper 1.16.0 from CDNs. The sounds are recordings by Daniel Simion. `res/sounds.xml` lists them under Attribution 3.0.

## Running the exercises

- Exercises 1 and 2 are static HTML. Open the `.html` files in a browser.
- The other folders need a PHP web server. Start one inside a folder, for example `php -S 127.0.0.1:8000`, and open the `.php` pages through it.
- PHP extensions used: SimpleXML (exercises 6 and the final project), cURL (exercise 6), mysqli and PDO (exercise 7).
- Exercise 5's device server runs with `start.sh` or `start.bat` in `ViTAL_Server/ViTAL_Server_1.7/`. It needs a Java runtime and serves on port 8080.
- Pages load Bootstrap, jQuery and Popper from CDNs, so they need internet access.
- Exercise 7 needs a MySQL database with a `studentenliste` table. The repository has no table definition, and the column names come from the `INSERT` in `register.php`. Set the connection values in `datenbankVerbindung.php` and `register.php` before use.
