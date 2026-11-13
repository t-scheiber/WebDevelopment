# FH Technikum Wien web development exercises (2020)

University course exercises from the Web Development course at FH Technikum Wien, 2020. Each folder is one assignment, from static HTML pages to PHP applications that use MySQL.

The repository has no package manifest, so there is no install, build, lint or test command. Exercises 1 and 2 are plain files that open in a browser. The other folders need a PHP web server (see [Running the exercises](#running-the-exercises)).

## Live pages

Each exercise runs as its own website on Hostinger shared hosting:

- Exercise 1: https://fhtw-uebung1.thomasscheiber.com
- Exercise 2: https://fhtw-uebung2.thomasscheiber.com
- Exercise 3: https://fhtw-uebung3.thomasscheiber.com
- Exercise 4: https://fhtw-uebung4.thomasscheiber.com (smart home app: https://fhtw-uebung4.thomasscheiber.com/SmartHomes/)
- Exercise 5: https://fhtw-uebung5.thomasscheiber.com
- Exercise 6: https://fhtw-uebung6.thomasscheiber.com
- Exercise 7: https://fhtw-uebung7.thomasscheiber.com
- Final project: https://fhtw-abschlussprojekt.thomasscheiber.com

Before the PHP exercises went online, they were changed in these ways:

- Exercise 3 shows the PHP version instead of the full `phpinfo()` output.
- Exercises 4, 5 and the final project escape every submitted value before printing it, and exercise 5 no longer dumps the session room list. Lists kept in the session are capped at 50 rooms and 100 playlist entries.
- Exercise 6 fetches only public http and https addresses and verifies TLS certificates.
- Exercise 7 uses prepared statements and `password_hash()`, reads its database settings from outside the repository, shows no database error details and limits open registration.

The logins in exercises 4 and 5 still compare against `admin`/`admin` and protect nothing, as in the original exercises.

## Exercises

### FHTW_uebung_1_scheiber (exercise 1)

Live: https://fhtw-uebung1.thomasscheiber.com

An index page and four HTML pages: a Fairphone article, a grade table, a patient form and a smart home page. The pages use HTML5 structural elements (`header`, `nav`, `main`, `section`, `footer`), and the two stylesheets use flexbox and grid. `style.css` and `smarthome.css` each have one media query at 768 px. The pages contain no JavaScript.

### FHTW_uebung_2_scheiber (exercise 2)

Live: https://fhtw-uebung2.thomasscheiber.com

A smart home controller dashboard in three variants (`index.html`, `uebung2_smarthome.html`, `uebung2_smarthome_mit_fastlane.html`) and a Fairphone article (`responsive_artikel.html`). The pages use Bootstrap 4.6.2 and jQuery 3.5.1 from jsDelivr. `index.html` turns on Bootstrap popovers with one jQuery call. The room values are fixed in the HTML, so nothing is sent to a server.

### FHTW_uebung_3_scheiber (exercise 3)

Live: https://fhtw-uebung3.thomasscheiber.com

Basic PHP. `index.php` shows four small pages in iframes:

- `aufgabe1.php` was a `phpinfo()` page. It now prints only the PHP version, because the full output lists server paths and settings.
- `aufgabe2.php` adds, subtracts, multiplies and divides two fixed numbers.
- `aufgabe3.php` prints the numbers 1 to 15 in four tables: once written out by hand, then with a `for`, a `do`/`while` and a `while` loop.
- `aufgabe4.php` builds a navigation bar from an array of weekday names and marks the active day with an `if` test.

`hello.php` prints "Hello World!". The pages load Bootstrap 4.4.1 from a CDN.

### FHTW_uebung_4_scheiber (exercise 4)

Live: https://fhtw-uebung4.thomasscheiber.com

A patient intake form and a smart home app, both in PHP.

- `index.php` is a form with HTML5 `required` fields, date, email and number inputs, and radio buttons for a gender field. It submits with GET to `auswertung.php`, which prints the submitted values escaped with `htmlspecialchars()`. Nothing is saved. Empty fields show as cells with a `marked` CSS class.
- `SmartHomes/` splits its layout into `inc/` files (header, navigation, content, footer). `content.inc.php` picks the page with a `switch` on `$_GET['menu']`. The room pages in `sites/` show a light status and a temperature as fixed images and text. The login check in `sites/anmeldung.php` compares the submitted user name and password with fixed values, and the credentials travel in the query string.
- `smarthomeErweitert.php` is a single-file version of the smart home page.

### FHTW_uebung_5_scheiber (exercise 5)

Live: https://fhtw-uebung5.thomasscheiber.com

A smart home app with a session-based login and a room list, plus a bundled device server.

- `index.php` starts a session and includes `inc/header.inc.php`, `navi.inc.php`, `content.inc.php` and `footer.inc.php`. The page is chosen with `$_GET['menu']`, as in exercise 4.
- The login in `inc/header.inc.php` compares fixed values. If "stay logged in" is checked, it sets a `user` cookie that expires after 600 seconds. `logout.php` clears the cookie.
- `sites/neuerRaum.php` is a form that adds a room through GET parameters. `sites/zimmerliste.php` keeps the rooms in `$_SESSION['zimmerliste']` and prints them as a table.
- `RESTServices/getpatientdata.php` prints one fixed record as JSON with `json_encode()`. `sites/restapi.php` is empty.
- `ViTAL_Server/ViTAL_Server_1.7/` contains a copy of the ViTAL server (a Java jar with start scripts and `values.txt`) and a page, `index.html`, with `vital.js`. The page posts a JSON record to the server on port 8080 of localhost with XMLHttpRequest. The Java server does not run on the web host, so the page says so and shows an error when the server is not running on the visitor's own computer.

### FHTW_uebung_6_scheiber (exercise 6)

Live: https://fhtw-uebung6.thomasscheiber.com

One page, `index.php`, with two parts.

- The student list reads `studentslist.xml` with `simplexml_load_file()` and prints each student's name, matriculation number, study programme, semester and courses. Values are escaped with `htmlspecialchars()`.
- The feed reader sends a URL with XMLHttpRequest (POST) to `feed_loader.php`. The script fetches it with cURL, detects RSS or Atom from the XML root, and prints up to 10 items with title, date, description, link and image. The image comes from `media:thumbnail`, `media:content` or an image enclosure. The preset buttons load Heise (Atom), ORF (RSS) and Der Standard (RSS).

`feed_loader.php` accepts only http and https URLs whose host resolves to public IPv4 addresses. It connects to the address it checked, checks every redirect target again, verifies TLS certificates and stops reading after 5 MB.

### FHTW_uebung_7_scheiber (exercise 7)

Live: https://fhtw-uebung7.thomasscheiber.com (demo login: `anna.beispiel@example.com`, password `demo1234`)

A student registration and login that use one MySQL table, `studentenliste`.

- `register.php` inserts a row with a PDO prepared statement and stores the password with `password_hash()`. It checks field lengths, the date and the email address, accepts at most 200 rows and deletes registrations other than the demo rows after 7 days.
- The login form in `inc/header.inc.php` looks up the email address with a mysqli prepared statement, checks the password with `password_verify()`, and prints the matching name and ID escaped. It does not start a session.
- `datenbankVerbindung.php` opens a mysqli connection. `register.php` opens its own PDO connection. Both get the settings from `datenbankKonfiguration.php`, which reads `fhtw7-db-config.php` from the folder above the web root, the file named in `FHTW7_DB_CONFIG`, or the variables `DB_HOST`, `DB_NAME`, `DB_USER` and `DB_PASSWORD`. The repository holds no credentials.
- `sql/studentenliste.sql` creates the table and adds three fictional demo students.
- `index.php` routes pages with `?menu=` through `inc/navi.inc.php` and `sites/`. The pages `studenteninfo.php` and `hochschulinfo.php` contain placeholder text.

### Abschlussprojekt (final project)

Live: https://fhtw-abschlussprojekt.thomasscheiber.com

"Web Tunes", a catalogue of five sound effects. `index.php` reads `res/sounds.xml` with `simplexml_load_file()` and shows each sound with its name, details, an icon and an HTML5 `audio` control. A search box posts a string, and the page keeps the entries whose name contains it (`strpos()`). The ID in each row links to `playlist.php?soundfile=...`, which appends the file to `$_SESSION['stringarray']` (at most 100 entries) and lists the session array with each entry escaped. The playlist cannot remove items.

The pages use Bootstrap 4.4.1, jQuery 3.4.1 and Popper 1.16.0 from CDNs. The sounds are recordings by Daniel Simion. `res/sounds.xml` lists them under Attribution 3.0.

## Running the exercises

- Exercises 1 and 2 are static HTML. Open the `.html` files in a browser.
- The other folders need a PHP web server. Start one inside a folder, for example `php -S 127.0.0.1:8000`, and open the `.php` pages through it.
- PHP extensions used: SimpleXML (exercises 6 and the final project), cURL (exercise 6), mysqli and PDO (exercise 7).
- Exercise 5's device server runs with `start.sh` or `start.bat` in `ViTAL_Server/ViTAL_Server_1.7/`. It needs a Java runtime and serves on port 8080.
- Pages load Bootstrap, jQuery and Popper from CDNs, so they need internet access.
- Exercise 7 needs a MySQL database. Import `FHTW_uebung_7_scheiber/sql/studentenliste.sql`, then set `DB_HOST`, `DB_NAME`, `DB_USER` and `DB_PASSWORD` before starting the server, for example `DB_NAME=fhtw7 DB_USER=fhtw7 DB_PASSWORD=... php -S 127.0.0.1:8000`.
