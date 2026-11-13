# XML Parsing & RSS/Atom Feed Reader - Web Development Exercise 6 📡


A dual-purpose application featuring XML data parsing and an AJAX-powered RSS/Atom feed reader. This exercise demonstrates working with structured data formats, asynchronous JavaScript, and modern web APIs.

## 🎯 Project Overview

This sixth exercise combines two powerful web development concepts:
1. **XML Student Database** - Parsing and displaying structured XML data
2. **RSS/Atom Feed Reader** - Dynamically loading and displaying news feeds without page reload

## ✨ Key Features

### Part 1: XML Student List (Studentenliste)
- **XML Data Structure** - Student records with matriculation number, name, program, semester, courses
- **PHP XML Parsing** - Using SimpleXML for data extraction
- **Card display** - One card per student with matriculation number, programme, semester and courses
- **Security** - XSS protection with htmlspecialchars()
- **Clean Presentation** - Organized, easy-to-read layout

### Part 2: RSS/Atom Feed Reader
- **AJAX-Powered** - Load feeds without page refresh
- **Format Auto-Detection** - Supports both RSS and Atom standards
- **Feed Parsing** - Extract title, description, link, and images
- **Media Support** - Display thumbnails from media namespaces
- **Error Handling** - Graceful failure with user feedback
- **Card display** - One card per feed item

## 🛠️ Technologies Used

- **PHP 7.0+** - Server-side XML parsing
- **SimpleXML** - Built-in PHP XML parser
- **Vanilla JavaScript (ES6)** - AJAX implementation without jQuery
- **HTML5** - Semantic markup
- **CSS3** - Modern styling and responsive design
- **AJAX** - Asynchronous data loading

## 📂 Project Structure

```
FHTW_uebung_6_scheiber/
├── index.php           # Main page with both tasks
├── feed_loader.php     # AJAX endpoint for feed loading
├── studentslist.xml    # XML database of students
└── README.md
```

## 🎓 Learning Objectives

### XML Data Handling
- Creating well-formed XML documents
- PHP SimpleXML parsing
- Extracting nested data structures
- Displaying XML data in HTML

### AJAX & Asynchronous JavaScript
- XMLHttpRequest API usage
- Handling asynchronous operations
- Processing API responses
- DOM manipulation with JavaScript

### Feed Format Standards
- RSS format structure and parsing
- Atom format structure and parsing
- Media namespace handling
- Cross-format compatibility

## 📡 RSS/Atom Feed Features

### Supported Feed Elements
- **Title** - Article headlines
- **Description** - Article summaries
- **Link** - URLs to original articles
- **Images** - Thumbnails via media:thumbnail, media:content, enclosure tags
- **Auto-Detection** - Identifies feed format automatically

### Preset feed sources

The preset buttons in `index.php` fill the URL field with Heise (Atom), ORF (RSS) and Der Standard (RSS).

## 🔒 Security Features

- **XSS Protection** - Output escaped with `htmlspecialchars()`
- **Error Handling** - Graceful failure modes
- **Input Validation** - URL verification
- **Public URLs only** - `feed_loader.php` fetches only http and https URLs whose host resolves to public IPv4 addresses. It connects to the checked address, checks every redirect target again, verifies TLS certificates and stops after 5 MB.

## 💡 Why This Project Matters

This exercise demonstrates:
- **Data Format Mastery**: Working with XML, RSS, and Atom
- **Asynchronous Programming**: AJAX without page reloads
- **API Integration**: Consuming external data sources

## 🎓 Course Context

Part of **Exercise 6** in the Web Development curriculum at **FHTW (Fachhochschule Technikum Wien)**. This project introduces XML processing, AJAX programming, and modern web API integration.

---

**Built with PHP & Vanilla JavaScript** 🐘⚡ | **FHTW Exercise 6** 📚 | **XML & AJAX** 📡