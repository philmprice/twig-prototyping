twig-prototyping
================

A simple platform for HTML Wireframe design, rapid prototype construction, or browsing views while you're slicing a web design.

Overview
--------

This project browses your Twig patterns, routes url tokens to your 'page' .twig files, feeds your JSON data to the views, and supports in-line annotation. It leverages Twig (http://twig.sensiolabs.org/) to render the templates, bootstrap (http://getbootstrap.com/) to give things a stylish and responsive feel, and borrows a usability/workflow concepts from Pattern Lab (http://patternlab.io/).

Basic Usage
----------

Fill the atomic design pattern up with views, put the views together using the Twig language, browse your views by using the top menu, or preview pages by appending the URL with the page name (ie. '/twig-prototyping/blog' will load up the 'blog.twig' page).

Creating Views
-----------------

Views are organized with the atomic design pattern (http://patternlab.io/about.html) with one exception: the concept for 'templates' has been moved up to encompass pages.

To add views to your projet, simply create a new .twig file in the appropriate /views/ sub-folder. It will then be available for inclusion. If you wish to provide data for a .twig view, simply create an accompanying .json file in the same directory.

Feeding Data
------------

If you provide a page (.twig) file with an accompanying data (.json) file (ie. 'blog.json' to accompany 'blog.twig') that JSON data will be read and sent to Twig as display data. 

To print data from your JSON file to your Twig views, put a {{ token.like.this }} in your twig view where the dot-notation describes the location in the data array (ie. $arrData['token']['like']['this'])

Using Annotations
-----------

Add annotations to any HTML element by giving it a class of 'addTooltip', then setting a title and position (optional).
Example:
<pre><code>&lt;div class="addTooltip" data-position="top" data-title="This text will show up when you mouse over this div"&gt;
  Content
&lt;/div&gt;</code></pre>
